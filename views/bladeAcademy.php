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
            <div class="text-center mt_60">
                <div class="button_box"><?php echo direction("ACTIVITES","الأنشطة") ?></div>
            </div>
        </div>
    </div>
    <!-- insight_cart -->
    <div class="insight_cart">
        <div class="container">
            <div class="row mt_30">
<?php
$sports = json_decode($mainAcademy[0]["sport"],true);
for( $y = 0; $y < sizeof($sports); $y++){
    if( $mainSports = selectDB("sports","`id` = '{$sports[$y]}' AND `hidden` = '0' AND `status` = '0'") ){
        $subscription = selectDB("subscriptions","`sportId` = '{$mainSports[0]["id"]}' AND `academyId` = '{$mainAcademy[0]["id"]}' AND `hidden` = '0' AND `status` = '0' ORDER BY `price` ASC LIMIT 1");
        $title = direction($mainSports[0]["enTitle"],$mainSports[0]["arTitle"]);
?>
                <div class="col-lg-3 col-sm-6 col-6 mt_50">
                    <a href="#<?php echo strtolower(str_replace(" ","_",$title)) ?>" data-toggle="modal" class="man_box">
                        <div class="man_top">
                            <h2><?php echo $title ?></h2>
                            <h3><?php echo direction($subscription[0]["enSubTitle"],$subscription[0]["arSubTitle"]) ?></h3>
                            <h4><?php echo direction("Starting from","يبدأ من") . " {$subscription[0]["price"]}KD" ?></h4>
                        </div>
                        <div class="man_body" style="background-image: url(img/man.png);">
                            <img src="logos/<?php echo $mainSports[0]["imageurl"] ?>" alt="" class="img-fluid">
                        </div>
                    </a>
                </div> 
<?php
    }
}
?>
            </div>
        </div>
    </div>
</main>

<?php 
for( $i = 0; $i < sizeof($sports); $i++){
    if( $mainSports = selectDB("sports","`id` = '{$sports[$i]}' AND `hidden` = '0' AND `status` = '0'") ){
        $priceAfterText = 0;
        $title = direction($mainSports[0]["enTitle"],$mainSports[0]["arTitle"]);
        if( $subscription = selectDB("subscriptions","`sportId` = '{$mainSports[0]["id"]}' AND `academyId` = '{$mainAcademy[0]["id"]}' AND `hidden` = '0' AND `status` = '0' ORDER BY `price`") ){
            for( $z = 0; $z < sizeof($subscription); $z++ ){
                if ( !empty($subscription[$z]["priceAfterDiscount"]) ){
                    $priceAfterText = 1;
                    break;
                }
            }
?>
<div class="modal fade" id="<?php echo strtolower(str_replace(" ","_",$title)) ?>" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <div class="modal-body p-0 text-center">
                <h2><?php echo direction("Choose the subscription period","إختر مدة الإشتراك")?></h2>
                <?php 
                if ( $priceAfterText ){
                    echo "<h3>" . direction("We also have saving plans","لدينا إشتراكات خاصه") . "</h3>";
                }
                    for( $y = 0; $y < sizeof($subscription); $y++ ){
                        $genders = json_decode($subscription[$y]["genders"],true);;
				        $gender = selectDB("genders","`id` = '{$genders[0]}'");
                ?>
                <div class="month_wap" onclick="submitForm('<?php echo $subscription[$y]["id"]; ?>')">
                    <?php
                    $priceAfer = (float)$subscription[$y]["price"]-(float)$subscription[$y]["priceAfterDiscount"];
                    echo $save = ( !empty($subscription[$y]["priceAfterDiscount"]) ) ? "<div class='save_style'><p>SAVE {$priceAfer}KD</p></div>" : "";
                    ?>
                    <h4><?php echo direction("{$subscription[$y]["enTitle"]} - {$gender[0]["enTitle"]} {$gender[0]["enSubTitle"]}","{$subscription[$y]["arTitle"]} - {$gender[0]["arTitle"]} {$gender[0]["arSubTitle"]}") ?></h4>
                    <h6><?php echo $price = ( !empty($subscription[$y]["priceAfterDiscount"]) ) ? $subscription[$y]["priceAfterDiscount"] : $subscription[$y]["price"] ;?>KD</h6>
                </div>
                <?php
                    }
                ?>
            </div>
        </div>
    </div>
</div> 
<?php
        }
    }
}
?>
<form id="myForm" action="?v=Details" method="POST">
        <input id="idInput" type="hidden" name="id">
</form>
<script>
    function submitForm(id) {
        document.getElementById('idInput').value = id;
        document.getElementById('myForm').submit();
    }
</script>