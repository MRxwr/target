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
    
    <!-- karate_area -->
    <div class="jarate_area">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mt_45">
                    <div class="man_jarate" style="background-image: url(img/jarate.png);">
                        <img alt="" class="img-fluid" src="img/man_style.png">
                        </img>
                    </div>
                </div>

                <?php
                if( $subscription = selectDB("subscriptions","`id` = '{$_POST["id"]}' AND `status` = '0' AND `hidden` = '0'") ){
                    $sport = selectDB("sports","`id` = '{$subscription[0]["sportId"]}' AND `hidden` = '0' AND `status` = '0'");
                    $branches = json_decode($subscription[0]["branches"],true);
                    $genders = json_decode($subscription[0]["genders"],true);
                }else{
                    header("Location: " . $_SERVER['HTTP_REFERER']);die();
                }
                ?>
                <div class="col-lg-8 mt_45">
                    <div class="karate_box">
                        <div class="kd_wap d-flex align-items-center justify-content-between">
                            <h2><?php echo direction($sport[0]["enTitle"],$sport[0]["arTitle"]) ?></h2>
                            <span><?php echo $price = ($subscription[0]["priceAfterDiscount"] > 0) ? $subscription[0]["priceAfterDiscount"] : $subscription[0]["price"] ?>KD</span>
                        </div>
                        <h3><?php echo $subscription[0]["numberOfDays"] . " " . direction("Sessions per month","الحصص في الشهر") ?></h3>
                        <h4><?php echo direction("Description","الشرح") ?>:</h4>
                        <p><?php echo direction($subscription[0]["enDetails"],$subscription[0]["arDetails"]) ?></p>
                        <h5><?php echo direction("Share","المشاركة") ?>:</h5>
                        <div class="karate_icon">
                            <?php
                            $referer = $_SERVER['HTTP_REFERER'];
                            $title = $mainAcademy[0]["enTitle"];
                            $imageUrl = $mainAcademy[0]["imageurl"];
                            ?>
                            <a href="https://www.facebook.com/sharer.php?u=<?php echo $referer ?>">
                                <img alt="" class="w-100" src="img/icon_1.svg"/>
                            </a>
                            <a href="https://twitter.com/share?url=<?php echo $referer ?>&text=<?php echo $title ?>">
                                <img alt="" class="w-100" src="img/icon_2.svg"/>
                            </a>
                            <a href="https://pinterest.com/pin/create/bookmarklet/?media=<?php echo $imageUrl ?>&url=<?php echo $referer ?>&is_video=&description=<?php echo $title ?>">
                                <img alt="" class="w-100" src="img/icon_3.svg"/>
                            </a>
                            <a href="https://www.linkedin.com/shareArticle?url=<?php echo $referer ?>&title=<?php echo $title ?>">
                                <img alt="" class="w-100" src="img/icon_4.svg"/>
                            </a>
                            <a href="https://t.me/share/url?url=<?php echo $referer ?>&text=<?php echo $title ?>">
                                <img alt="" class="w-100" src="img/icon_5.svg"/>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Personal Details -->
<!-- Personal Details -->
    <div class="personal_details">
        <div class="container">
            <div class="personal_wapper">
                <form action="#" id="regForm">
                    <!-- Circles which indicates the steps of the form: -->
                    <div class="step_wap">
                        <span class="step">
                            <div class="personal_item">
                                <p>
                                    <span>
                                        1
                                    </span>
                                    <?php echo direction("Personal Details","البيانات الشخصية") ?>
                                </p>
                            </div>
                        </span>
                        <span class="step">
                            <div class="personal_item">
                                <p>
                                    <span>
                                        2
                                    </span>
                                    <?php echo direction("Subscription Details","تفاصيل الاشتراك") ?>
                                </p>
                            </div>
                        </span>
                        <span class="step">
                            <div class="personal_item">
                                <p>
                                    <span>
                                        3
                                    </span>
                                    <?php echo direction("Checkout","الدفع") ?>
                                </p>
                            </div>
                        </span>
                    </div>
                    <!-- One "tab" for each step in the form: -->
                    <div class="tab">
                        <div class="row align-items-center">
                            <div class="col-lg-5">
                                <div class="teb_left">
                                    <h2>
                                    <?php echo direction("Personal Details","البيانات الشخصية") ?>
                                    </h2>
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="tab_right">
                                    <div class="tab_title">
                                        <h3>
                                            <?php echo direction("Name","الاسم")?> *
                                        </h3>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <input placeholder="First Name" type="text">
                                            </input>
                                        </div>
                                        <div class="col-lg-4">
                                            <input placeholder="Middle Name" type="text">
                                            </input>
                                        </div>
                                        <div class="col-lg-4">
                                            <input placeholder="last Name" type="text">
                                            </input>
                                        </div>
                                    </div>
                                    <div class="tab_title mt_20">
                                        <h3>
                                            <?php echo direction("Mobile Number","رقم الهاتف")?> *
                                        </h3>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <input placeholder="Mobile Number" type="tel">
                                            </input>
                                        </div>
                                    </div>
                                    <div class="tab_title mt_20">
                                        <h3>
                                            <?php echo direction("Gender","الجنس")?> *
                                        </h3>
                                    </div>
                                    <div class="style_radio">
                                        <?php
                                        for( $i = 0; $i < sizeof($genders); $i++ ){
                                            if( $loopGender = selectDB("genders","`id` = '{$genders[$i]}' AND `hidden` = '0' AND `status` = '0'") ){
                                                $loopGender = $loopGender[0];
                                                $title = direction("{$loopGender["enTitle"]}","{$loopGender["arTitle"]}");
                                                $subTitle = direction("{$loopGender["enSubTitle"]}","{$loopGender["arSubTitle"]}");
                                                $checked = ( $i == 0 ) ? "checked=''" : "" ;
                                                echo "<div class=\"size_radio\"> <input id=\"us{$i}\" name=\"gender\" type=\"radio\" {$checked}> <label for=\"us{$i}\"> {$title} <span> {$subTitle} </span> </label> </input> </div>";
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab">
                        <div class="row align-items-center">
                            <div class="col-lg-5">
                                <div class="teb_left">
                                    <h2>
                                    <?php echo direction("Subscription Details","تفاصيل الاشتراك") ?>
                                    </h2>
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="tab_right">
                                    <div class="tab_title">
                                        <h4>
                                            <?php echo direction("Branch","الفرع")?>
                                        </h4>
                                    </div>
                                    <div class="style_radio style_radio_2">
                                        <?php 
                                        for( $i = 0; $i < sizeof($branches); $i++ ){
                                            if( $branch = selectDB("branches","`id` = '{$branches[$i]}' AND `hidden` = '0' AND `status` = '0'") ){
                                                $title = direction("{$branch[0]["enTitle"]}","{$branch[0]["arTitle"]}");
                                                $checked = ( $i == 0 ) ? "" : "" ;
                                                echo "<div class=\"size_radio clickedBranch\" id='{$i}'> <input id=\"ba{$i}\" name=\"branch\" type=\"radio\" {$checked}> <label for=\"ba{$i}\" class='ba{$i}'> {$title} </label> </input> </div>";
                                            }
                                        }
                                        ?>
                                    </div>
                                    <div class="tab_title mt_25">
                                        <h4>
                                            <?php echo direction("Days","الايام")?>
                                        </h4>
                                    </div>
                                        <?php 
                                        $counter = 0;
                                        $dayBranches = '';
                                        for ($i = 0; $i < sizeof($branches); $i++) {
                                            if ($days = selectDB("days", "`branchId` = '{$branches[$i]}' AND `hidden` = '0' AND `status` = '0'")) {
                                                $dayStyle = ($i == 0) ? "" : "display:none";
                                                $dayBranches .= "<div class=\"style_radio style_radio_2 dayBranch\" id='dayBranch{$i}' style='{$dayStyle}'>";
                                                for ($y = 0; $y < sizeof($days); $y++) {
                                                    $title = direction("{$days[$y]["enTitle"]}","{$days[$y]["arTitle"]}");
                                                    $checked = ($y == 0) ? "checked=''" : "";
                                                    $dayBranches .= "<div class=\"size_radio\">
                                                                        <input id=\"da{$counter}\" name=\"day\" type=\"radio\" {$checked}>
                                                                        <label for=\"da{$counter}\" class='da{$counter}'> {$title} </label>
                                                                    </div>";
                                                    $counter++;
                                                }
                                                $dayBranches .= "</div>";
                                            }
                                        }
                                        echo $dayBranches;
                                        ?>
                                    <div class="tab_title mt_25">
                                        <h4>
                                            <?php echo direction("Time","الوقت")?>
                                        </h4>
                                    </div>
                                    <?php
                                    $counter = 0;
                                    $sessionBranches = '';
                                    for ($i = 0; $i < sizeof($branches); $i++) {
                                        if ($sessions = selectDB("sessions", "`branchId` = '{$branches[$i]}' AND `hidden` = '0' AND `status` = '0'")) {
                                            $sessionStyle = ($i == 0) ? "" : "display:none";
                                            $sessionBranches .= "<div class=\"style_radio style_radio_2 sessionBranch\" id='sessionBranch{$i}' style='{$sessionStyle}'>";
                                            for ($y = 0; $y < sizeof($sessions); $y++) {
                                                $title = direction("{$sessions[$y]["enTitle"]}","{$sessions[$y]["arTitle"]}");
                                                $checked = ($y == 0) ? "checked=''" : "";
                                                $seatsText = direction("Seats Available: {$sessions[$y]["quantity"]}","المقاعد المتوفرة: {$sessions[$y]["quantity"]}");
                                                $sessionBranches .= "<div class=\"size_radio\">
                                                                        <input id=\"se{$counter}\" name=\"session\" type=\"radio\" {$checked}>
                                                                        <label for=\"se{$counter}\" class='se{$counter}'> {$title} </label>
                                                                        <h6> {$seatsText} </h6>
                                                                    </div>";
                                                $counter++;
                                            }
                                            $sessionBranches .= "</div>";
                                        }
                                    }
                                    echo $sessionBranches;
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab">
                        <div class="row align-items-center">
                            <div class="col-lg-5">
                                <div class="teb_left">
                                    <h2>
                                    <?php echo direction("Checkout","الدفع") ?>
                                    </h2>
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="tab_right">
                                    <div class="tab_title">
                                        <h4>
                                            <?php echo direction("Checkout Details","تفاصيل الدفع") ?>
                                        </h4>
                                    </div>
                                    <div class="checkout_wap mt_45">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <h5>
                                                    <?php echo direction("Activity","النشاط") ?>:
                                                    <span><?php echo direction($sport[0]["enTitle"],$sport[0]["arTitle"]) ?></span>
                                                </h5>
                                                <h5>
                                                    <?php echo direction("Branch","الفرع") ?>:
                                                    <span id="branchSel"></span>
                                                </h5>
                                                <h5>
                                                    <?php echo direction("Date","التاريخ") ?>:
                                                    <span>
                                                        <?php
                                                            date_default_timezone_set("Asia/Kuwait");
                                                            echo date("d/m/Y");
                                                        ?>
                                                    </span>
                                                </h5>
                                            </div>
                                            <div class="col-lg-6">
                                                <h5>
                                                    <?php echo direction("Days","الايام") ?>:
                                                    <span id="daySel"></span>
                                                </h5>
                                                <h5>
                                                    <?php echo direction("Time","الوقت") ?>:
                                                    <span id="timeSel"></span>
                                                </h5>
                                                <h5>
                                                    <?php echo direction("Price","السعر") ?>:
                                                    <span id="priceSel"><?php echo $price ?>KD</span>
                                                </h5>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="check_inp mt_30">
                                                <input placeholder="Coupon Code" type="text">
                                                    <button class="check_btn" type="submit">
                                                        <?php echo direction("Apply","تطبيق") ?>
                                                    </button>
                                                </input>
                                            </div>
                                            <div class="shape_radio mt_20">
                                                <div class="shape_items mb_10">
                                                    <input checked="" id="au1" name="pk1" type="radio">
                                                        <label for="au1">
                                                            <span>
                                                            </span>
                                                            KNET
                                                        </label>
                                                    </input>
                                                </div>
                                                <div class="shape_items">
                                                    <input id="au2" name="pk1" type="radio">
                                                        <label for="au2">
                                                            <span>
                                                            </span>
                                                            VISA / MASTER CARD
                                                        </label>
                                                    </input>
                                                </div>
                                            </div>
                                            <div class="agree_box">
                                                <input checked="" id="chk1" type="checkbox">
                                                    <label for="chk1">
                                                        <span class="rectangle">
                                                        </span>
                                                        <div>
                                                            <?php echo direction("I agree to the","أوافق على") ?>
                                                            <a data-toggle="modal" href="#terms"><?php echo direction("terms and conditions.","الشروط والاحكام.") ?></a>
                                                        </div>
                                                    </label>
                                                </input>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="step_control">
                        <button class="button_box" id="prevBtn" onclick="nextPrev(-1)" type="button">
                            <?php echo direction("Previous","السابق") ?>
                        </button>
                        <button class="button_box" id="nextBtn" onclick="nextPrev(1)" type="button">
                            <?php echo direction("NEXT","التالي") ?>
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</main>