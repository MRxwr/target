<main class="overflow-hidden over_custom">
    <!-- insight_home -->
    <div class="insight_home">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 mt_45 text-center">
                    <img src="logos/<?php echo $mainAcademy[0]["imageurl"] ?>" alt="" class="insight_bg">
                </div>
                <div class="col-lg-7 mt_45">
                    <div class="insight_right">
                        <img src="logos/<?php echo $mainAcademy[0]["imageurl"] ?>" alt="">
                        <div class="button_box"><?php echo direction($mainAcademy[0]["enTitle"],$mainAcademy[0]["arTitle"]) ?></div>
                        <p><?php echo direction($mainAcademy[0]["enDetails"],$mainAcademy[0]["arDetails"]) ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- alert_area -->
    <div class="alert_area">
        <div class="container">
            <?php
            if( !empty($mainAcademy[0]["enAlert"]) ){
                ?>
                <div class="alert alert-danger" role="alert">
                <?php echo direction($mainAcademy[0]["enAlert"],$mainAcademy[0]["arAlert"]) ?>
                </div>
                <?php
            }
            ?>
            <div class="social_icon">
                <?php
                $socialAccounts = [$mainAcademy[0]["tiktok"],$mainAcademy[0]["instagram"],$mainAcademy[0]["snapchat"],$mainAcademy[0]["youtube"]];
                $socialImages = ["tik_1.svg","ins_1.svg","sna_1.svg","you.svg"];
                $socialLinks = ["https://www.tiktok.com/@","https://www.instagram.com/","https://www.snapchat.com/add/","https://www.youtube.com/"];
                for( $i = 0; $i < sizeof($socialImages); $i++){
                    if( !empty( $socialAccounts[$i] ) ){
                        echo "<a href='{$socialLinks[$i]}{$socialAccounts[$i]}' target='_blank'><img src='img/{$socialImages[$i]}' alt=''></a>";
                    }
                }
                ?>
            </div>
        </div>
    </div>
    <!-- succesful_area -->
    <div class="succesful_area">
        <div class="container">
            <div class="row justify-content-between align-items-center">
                <div class="col-lg-4 mt_50 custom_full">
                    <h2><?php echo direction("Your payment has failed","عملية دفع فاشلة") ?></h2>
                    <p><?php echo direction("Please try again and make sure to book your seat.","يرجى المحاولة مرة اخرى وتأكد من حجز المقعد.") ?></p>
                    <h3><?php echo direction("Thank you.","شكرا.") ?></h3>
                    <a href="https://targetkw.net/<?php echo $_GET["academyURL"] ?>" class="button_box"><img src="img/home.svg" alt=""><?php echo direction("Home","الرئيسية") ?></a>
                </div>
                <div class="col-lg-4 mt_50">
                    <div class="order_box">
                        <?php 
                        if( $order = selectDB("orders","`gatewayId` = {$_GET["OrderID"]}") ){
                            $subscription = selectDB("subscriptions","`id` = {$order[0]["subscriptionId"]}");
                            $sport = selectDB("sports","`id` = {$subscription[0]["sportId"]}");
                        }else{
                            echo "<script>alert('Session Expired');window.history.go(-2);</script>";die();
                        }
                        ?>
                        <h3>#: <span><?php echo $order[0]["id"] ?></span></h3>
                        <h4><span><?php echo direction("Activity","النشاط") ?>:</span><?php echo direction($sport[0]["enTitle"],$sport[0]["arTitle"]) ?></h4>
                        <h4><span><?php echo direction("Branch","الفرع") ?>:</span><?php echo direction($order[0]["enBranch"],$order[0]["arBranch"]) ?></h4>
                        <h4><span><?php echo direction("Subscription Date","تاريخ الاشتراك") ?>:</span><?php echo substr($order[0]["date"],0,10) ?></h4>
                        <h4><span><?php echo direction("Days","الايام") ?>:</span><?php echo direction($order[0]["enDay"],$order[0]["arDay"]) ?></h4>
                        <h4><span><?php echo direction("Time","وقت") ?>:</span><?php echo direction($order[0]["enSession"],$order[0]["arSession"]) ?></h4>
                        <h4><span><?php echo direction("Price","السعر") ?>:</span><?php echo $order[0]["price"] ?>KD</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>