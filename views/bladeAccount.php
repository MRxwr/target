<?php
if( isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"] == 1 ){
}elseif( isset($_POST["otp1"]) ){
    $originalOTP = $_POST["otp1"].$_POST["otp2"].$_POST["otp3"].$_POST["otp4"].$_POST["otp5"].$_POST["otp6"];
    $sessionOTP = $_SESSION["otp"];
    if( $originalOTP != $sessionOTP){
        echo "<script>alert('Wrong OTP');window.history.go(-2);</script>";die();
    }else{
        $_SESSION["loggedIn"] = 1;
    }
}else{
    echo "<script>alert('Wrong OTP');window.history.go(-2);</script>";die();
}
?>
<main class="overflow-hidden over_custom">
    <!-- account_area -->
    <div class="account_area mt_40">
        <div class="container">
        <h2><?php echo direction("MY ACCOUNT","حسابي") ?></h2>
        <?php
        if( $orders = selectDB("orders","`status` != '2' AND `phone` LIKE '%{$_SESSION["mobile"]}%' ORDER BY `date` DESC") ){
            for( $i =0; $i < sizeof($orders); $i++ ){
                $subscription = selectDB("subscriptions","`id` = {$order[$i]["subscriptionId"]}");
                $sport = selectDB("sports","`id` = {$subscription[0]["sportId"]}");
                ?>
                <div class="accoun_wapper">
                    <h4><span>#:</span> <?php echo $orders[$i]["id"] ?></h4>
                    <h3><span><?php echo direction("Name","الاسم") ?>:</span><?php echo "{$orders[$i]["fName"]} {$orders[$i]["mName"]} {$orders[$i]["lName"]}" ?></h3>
                    <div class="row justify-content-between">
                        <div class="col-lg-6">
                            <h5><span><?php echo direction("Activity","النشاط") ?>:</span><?php echo direction($sport[0]["enTitle"],$sport[0]["arTitle"]) ?></h5>
                            <h5><span><?php echo direction("Branch","الفرع") ?>:</span><?php echo direction($orders[$i]["enBranch"],$orders[$i]["arBranch"]) ?></h5>
                            <h5><span><?php echo direction("Date","تاريخ") ?>: </span><?php echo substr($orders[$i]["date"],0,10) ?></h5>
                        </div>
                        <div class="col-lg-6">
                            <h5><span><?php echo direction("Days","الايام") ?>:</span><?php echo direction($orders[$i]["enDay"],$orders[$i]["arDay"]) ?></h5>
                            <h5><span><?php echo direction("Time","وقت") ?>: </span><?php echo direction($orders[$i]["enSession"],$orders[$i]["arSession"]) ?></h5>
                            <a href="#" class="button"><?php echo direction("Remaining Sessions","الجلسات المتبقية") ?>: <span>12</span></a>
                        </div>
                    </div>
                </div>
                <?php
            }
        }
        ?>
        </div>
    </div>
</main>