<?php
if( !isset($_POST) ){
    $response["msg"] = "Please make sure you send post data before submitting.";
	echo outputError($response);die();
}else{
    $data = $_POST;
    unset($_POST);
    
    //checking voucher
    $numberOfTimesAvalability = false;
    $academyAprroved = false;
    $dateApproved = false;
    if( isset($voucher) && !empty($voucher) && $voucher = selectDB("vouchers","`code` = '{$data["voucher"]}' AND `hidden` = '0' AND `status` = '0'")){
        $currentDate = date("Y-m-d");
        if( (substr($voucher[0]["startDate"],0,10) <= $currentDate) && (substr($voucher[0]["endDate"],0,10) >= $currentDate) ){
            $dateApproved = true;
        }
        
        if( $voucher[0]["numberOfTimes"] == 0 ){
            $numberOfTimesAvalability = true;
        }elseif( $voucher[0]["numberOfTimes"] != 0 ){
            if( $orders = selectDB("orders","`voucher` = '{$voucher[0]["id"]}'")){
                $numberOfUsage = sizeof($orders);
                if( $voucher[0]["numberOfTimes"] > $numberOfUsage ){
                    $numberOfTimesAvalability = true;
                }else{
                    $numberOfTimesAvalability = false;
                }
            }else{
                $numberOfTimesAvalability = true;
            }
        }
        
        if( $voucher[0]["academyId"] != 0 ){
            if( $voucher[0]["academyId"] == $academy ){
                $academyAprroved = true;
            }else{
                $academyAprroved = false;
            }
        }elseif( $voucher[0]["academyId"] == 0 ){
            $academyAprroved = true;
        }
        
        if( $numberOfTimesAvalability && $academyAprroved && $dateApproved){
            $voucherType = ($voucher[0]["type"] == 0) ? 0 : 1;
            $voucherAmount = $voucher[0]["amount"];
        }
    }

    //checking session information
    if( $sessionData = selectDB("sessions","`id` = '{$data["sessionId"]}' AND `quantity` > '0'")){}else{
        $response = array(
            "msg" => 'No sessions available anymore.',
        );
        echo outputError($response);die();
    }

    //checking adamin settings for main IBAN
    if( $AdminSettings = selectDB("settings","`id` = '1'") ){}

    //checking academy Inforamtion
    if( $academyData = selectDB("academies","`id` = '{$data["academyId"]}'")){}
    if( $dayData = selectDB("days","`id` = '{$data["dayId"]}'")){}
    if( $branchData = selectDB("branches","`id` = '{$data["branchId"]}'")){}
    if( $genderData = selectDB("genders","`id` = '{$data["genderId"]}'")){}

    //checking subscription information
    if( $subscriptionData = selectDB("subscriptions","`id` = '{$data["subscriptionId"]}'")){
        $price = ($subscriptionData[0]["priceAfterDiscount"] != 0 ) ? $subscriptionData[0]["priceAfterDiscount"] : $subscriptionData[0]["price"] ;
        if( $numberOfTimesAvalability && $academyAprroved ){
            $price = $subscriptionData[0]["price"];
        }
        $totalPrice = (float)$price;
    }else{
        $totalPrice = 0;
        $price = 0;
    }

    //calulation of total prices
    $newTotal = (float)$totalPrice;
    if( $numberOfTimesAvalability && $academyAprroved ){
        $newTotal = ( $voucherType == 0 ) ? ($newTotal*(1-($voucherAmount/100))) : $newTotal - $voucherAmount;
    }

    $_POST["fName"] = "{$data["fName"]}}";
    $_POST["mName"] = "{$data["mName"]}}";
    $_POST["lName"] = "{$data["lName"]}}";
    $_POST["mobile"] = "{$data["mobile"]}";
    $_POST["email"] = "{$AdminSettings[0]["email"]}";
    $_POST["academyId"] = $data["academyId"];
    $_POST["enAcademy"] = $academyData[0]["enTitle"];
    $_POST["arAcademy"] = $academyData[0]["arTitle"];
    $_POST["sessionId"] = $data["sessionId"];
    $_POST["enSession"] = $sessionData[0]["enTitle"];
    $_POST["arSession"] = $sessionData[0]["arTitle"];
    $_POST["branchId"] = $data["branchId"];
    $_POST["enBranch"] = $branchData[0]["enTitle"];
    $_POST["arBranch"] = $branchData[0]["arTitle"];
    $_POST["dayId"] = $data["dayId"];
    $_POST["enDay"] = $dayData[0]["enTitle"];
    $_POST["arDay"] = $dayData[0]["arTitle"];
    $_POST["genderId"] = $data["genderId"];
    $_POST["enGender"] = "{$genderData[0]["enTitle"]} {$genderData[0]["enSubTitle"]}";
    $_POST["arGender"] = "{$genderData[0]["arTitle"]} {$genderData[0]["arSubTitle"]}";
    $_POST["subscriptionId"] = $data["subscriptionId"];
    $_POST["enSubscription"] = $subscriptionData[0]["enTitle"];
    $_POST["arSubscription"] = $subscriptionData[0]["arTitle"];
    $_POST["subscriptionQuantity"] = 1;
    $_POST["subscriptionPrice"] = $price;
    $_POST["total"] = $totalPrice;
    $_POST["paymentMethod"] = $data["paymentMethod"];
    $_POST["voucher"] = $data["voucher"];

    //calculate totals prices that should be sent to upayments 
    if( $data["paymentMethod"] == 1 ){
        $paymentGateway = "Knet";
    }elseif( $data["paymentMethod"] == 2 ){
        $paymentGateway = "cc";
    }

    //preparing upayment payload
    $extraMerchantData =  array(
        'amounts' => array($newTotal),
        'charges' => array(0.250),
        'chargeType' => array('fixed'),
        'cc_charges' => array(3),
        'cc_chargeType' => array('percentage'),
        'ibans' => array("{$academyData[0]["iban"]}")
    );
    $comon_array = array(
        "merchant_id"=> "24072",
        "username"=> "create_lwt",
        "password"=> stripslashes('sJg@Q9N6ysvP'),
        "api_key"=> password_hash('afmceR6nHQaIehhpOel036LBhC8hihuB8iNh9ACF',PASSWORD_BCRYPT),
        "payment_gateway" => "{$paymentGateway}",
        "order_id"=> time(),
        'total_price'=>$newTotal,
        'success_url'=>'https://createkuwait.com/index.php',
        'error_url'=>'https://createkuwait.com/index.php',
        'notifyURL'=>'https://createkuwait.com/index.php',
        'test_mode'=>0,
        "whitelabled" => 1,
        'CurrencyCode'=>'KWD',			
        'CstFName'=>"{$_POST["fName"]} {$_POST["mName"]} {$_POST["lName"]}",			
        'Cstemail'=>"{$AdminSettings[0]["email"]}",
        'CstMobile'=>"{$_POST["mobile"]}",
        'ExtraMerchantsData'=> json_encode($extraMerchantData),//Optional for multivendor API
    );
    
    //print_r($comon_array);die();

    $fields_string = http_build_query($comon_array);
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_URL,"https://api.upayments.com/payment-request");
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS,$fields_string);
	// receive server response ...
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$server_output = curl_exec($ch);
	curl_close ($ch);
	$response = json_decode($server_output,true);

    //saving info and redirecting to payment pages
    if( $response["status"] == "success" && isset($response["paymentURL"]) && !empty($response["paymentURL"]) ){
        $_POST["gatewayId"] = $comon_array["order_id"];
        $_POST["gatewayURL"] = $response["paymentURL"];
        $_POST["apiPayload"] = json_encode($comon_array);
        $_POST["apiResponse"] = json_encode($response);
        $response["data"] = array(
            "paymentURL" => $response["paymentURL"],
            "InvoiceId"  => $comon_array["order_id"]
        );
        insertDB2("orders",$_POST);
        echo outputData($response);
    }else{
        $response = array(
            "msg" => 'Error while proccessing payment',
        );
        echo outputError($response);
    }
    
}
?>