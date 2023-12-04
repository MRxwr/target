<?php 
if( !isset($_GET["academy"]) || empty($_GET["academy"]) ){
	$response = array("msg"=>"Please set academy id");
	echo outputError($response);die();
}else{
	if( $academy = selectDB2("`id`, `imageurl`, `arTitle`, `enDetails`, `arDetails`, `tiktok`, `instagram`, `snapchat`, `youtube`, `enAlert`, `arAlert`, `sport`","academies","`hidden` = '0' AND `status` = '0' AND `enTitle` LIKE '{$_GET["academy"]}'") ){
		$listOfSports = json_decode($academy[0]["sport"],true);
		$response["academy"] = $academy[0];
		$response["academy"]["sport"] = array();
		if( is_array($listOfSports) && sizeof($listOfSports) > 0  ){
			for( $i = 0; $i < sizeof($listOfSports); $i++ ){
				$sportDetails = selectDB2("`id`, `imageurl`, `arTitle`, `enTitle`","sports","`id` = '{$listOfSports[$i]}'");
				array_push($response["academy"]["sport"],$sportDetails[0]);
				if( $subscriptions = selectDB2("`id`, `enTitle`, `arTitle`, `price`, `priceAfterDiscount`","subscriptions","`academyId` = '{$academy[0]["id"]}' AND `sportId` = '{$listOfSports[$i]}' AND `status` = '0' ORDER BY `price` ASC") ){
					$response["academy"]["sport"]["subscriptions"] = $subscriptions;
				}else{
					$response["academy"]["sport"]["subscriptions"] = array();
				}
			}
		}else{
			$response["academy"]["sport"] = array();
		}
	}else{
		$response["msg"] = "there is no academy with this id";
		echo outputError($response);die();
	}
}

echo outputData($response);
?>