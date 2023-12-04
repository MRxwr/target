<?php 
// 1 live subscriptions
// 2 cancelled 
// 3 refunded
// 4 ended
if( $subscription = selectDB2("`id`,`enTitle`,`arTitle`,`enSubTitle`,`arSubTitle`,`enDetails`,`arDetails`,`numberOfDays`,`price`,`priceAfterDiscount`","subscriptions","`id` = '{$_GET["id"]}' AND `status` = '0' AND `hidden` = '0'") ){
    $response = $subscription[0];
    $subscriptionSp = selectDB2("`academyId`,`sportId`,`days`,`branches`,`sessions`","subscriptions","`id` = '{$_GET["id"]}' AND `status` = '0' AND `hidden` = '0'");

    $academy = selectDB2("`id`, `imageurl`, `arTitle`, `enDetails`, `arDetails`, `tiktok`, `instagram`, `snapchat`, `youtube`, `enAlert`, `arAlert`, `sport`","academies","`hidden` = '0' AND `status` = '0' AND `enTitle` LIKE '{$subscriptionSp[0]["academyId"]}'");
    $response["academy"] = $academy[0];

    $sportDetails = selectDB2("`id`, `imageurl`, `arTitle`, `enTitle`","sports","`id` = '{$subscriptionSp[0]["sportId"]}'");
    $response["sport"] = $sportDetails[0];

    $listOfDays = json_decode($subscriptionSp[0]["days"],true);
    $response["days"] = array();
    if( is_array($listOfDays) && sizeof($listOfDays) > 0  ){
        for( $i = 0; $i < sizeof($listOfDays); $i++ ){
            $daysDetails = selectDB2("`id`, `academyId`, `arTitle`, `enTitle`","days","`id` = '{$listOfDays[$i]}' AND `status` = '0' AND `hidden` = '0'");
            array_push($response["days"],$daysDetails[0]);
        }
    }else{
        $response["days"] = array();
    }

    $listOfBranches = json_decode($subscriptionSp[0]["branches"],true);
    $response["branches"] = array();
    if( is_array($listOfBranches) && sizeof($listOfBranches) > 0  ){
        for( $i = 0; $i < sizeof($listOfBranches); $i++ ){
            $branchDetails = selectDB2("`id`, `academyId`, `arTitle`, `enTitle`","branches","`id` = '{$listOfBranches[$i]}' AND `status` = '0' AND `hidden` = '0'");
            array_push($response["branches"],$branchDetails[0]);
        }
    }else{
        $response["branches"] = array();
    }

    $listOfSessions = json_decode($subscriptionSp[0]["sessions"],true);
    $response["sessions"] = array();
    if( is_array($listOfSessions) && sizeof($listOfSessions) > 0  ){
        for( $i = 0; $i < sizeof($listOfSessions); $i++ ){
            $sessionDetails = selectDB2("`id`, `academyId`, `arTitle`, `enTitle`, `quantity`","sessions","`id` = '{$listOfSessions[$i]}' AND `status` = '0' AND `hidden` = '0'");
            array_push($response["sessions"],$sessionDetails[0]);
        }
    }else{
        $response["sessions"] = array();
    }
}else{
    $response = array("msg"=>"we could not find any subscription for this id.");
    echo outputError($response);die();
}
echo outputData($response);
?>