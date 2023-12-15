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
                    $genders = json_decode($subscription[0]["genders"],true);
                    $sessions = json_decode($subscription[0]["sessions"],true);
                    $days = json_decode($subscription[0]["days"],true);
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
                                                echo "<div class=\"size_radio\"> <input id=\"us{$i}\" name=\"gender\" type=\"radio\"> <label for=\"us{$i}\"> {$title} <span> {$subTitle} </span> </label> </input> </div>";
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
                                        if( $branches = selectDB("subscriptions","`sportId` = '{$subscription[0]["sportId"]}' AND `academyId` = '{$mainAcademy[0]["id"]}' AND `hidden` = '0' AND `status` = '0'") ){
                                            for( $i = 0; $i < sizeof($branches); $i++ ){
                                                $branch = selectDB("branches","`id` = '{$branches[$i]["branchId"]}' AND `hidden` = '0' AND `status` = '0'");
                                                $title = direction("{$branch[0]["enTitle"]}","{$branch[0]["arTitle"]}");
                                                $checked = ( $i == 0 ) ? "checked=''" : "" ;
                                                echo "<div class=\"size_radio\"> <input id=\"ba{$i}\" name=\"branch\" type=\"radio\" {$checked}> <label for=\"ba{$i}\"> {$title} </label> </input> </div>";
                                            }
                                        }
                                        ?>
                                    </div>
                                    <div class="tab_title mt_25">
                                        <h4>
                                            Days
                                        </h4>
                                    </div>
                                    <div class="style_radio style_radio_2">
                                        <div class="size_radio">
                                            <input checked="" id="ba10" name="ba4" type="radio">
                                                <label for="ba10">
                                                    Sat, Sun, Mon
                                                </label>
                                            </input>
                                        </div>
                                        <div class="size_radio">
                                            <input id="ba11" name="ba4" type="radio">
                                                <label for="ba11">
                                                    Tues, Wed
                                                </label>
                                            </input>
                                        </div>
                                    </div>
                                    <div class="tab_title mt_25">
                                        <h4>
                                            Session Time
                                        </h4>
                                    </div>
                                    <div class="style_radio style_radio_2">
                                        <div class="size_radio">
                                            <input checked="" id="in1" name="in1" type="radio">
                                                <label for="in1">
                                                    6:00 - 7:00
                                                </label>
                                                <h6>
                                                    Seats Available: 10
                                                </h6>
                                            </input>
                                        </div>
                                        <div class="size_radio">
                                            <input id="in2" name="in1" type="radio">
                                                <label for="in2">
                                                    8:00 - 9:00
                                                </label>
                                                <h6>
                                                    Seats Available: 0
                                                </h6>
                                            </input>
                                        </div>
                                        <div class="size_radio">
                                            <input id="in3" name="in1" type="radio">
                                                <label for="in3">
                                                    9:00 - 10:00
                                                </label>
                                                <h6>
                                                    Seats Available: 4
                                                </h6>
                                            </input>
                                        </div>
                                        <div class="size_radio">
                                            <input id="in4" name="in1" type="radio">
                                                <label for="in4">
                                                    6:00 - 7:00
                                                </label>
                                                <h6>
                                                    Seats Available: 10
                                                </h6>
                                            </input>
                                        </div>
                                        <div class="size_radio">
                                            <input id="in5" name="in1" type="radio">
                                                <label for="in5">
                                                    8:00 - 9:00
                                                </label>
                                                <h6>
                                                    Seats Available: 0
                                                </h6>
                                            </input>
                                        </div>
                                        <div class="size_radio">
                                            <input id="in6" name="in1" type="radio">
                                                <label for="in6">
                                                    9:00 - 10:00
                                                </label>
                                                <h6>
                                                    Seats Available: 4
                                                </h6>
                                            </input>
                                        </div>
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
                                    <?php echo direction("Checkout","الدفع") ?>
                                    </h2>
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="tab_right">
                                    <div class="tab_title">
                                        <h4>
                                            Please choose preferd payment method:
                                        </h4>
                                    </div>
                                    <div class="checkout_wap mt_45">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <h5>
                                                    Activity:
                                                    <span>
                                                        HEAVY LIFTING
                                                    </span>
                                                </h5>
                                                <h5>
                                                    Branch:
                                                    <span>
                                                        Sabah Al Salem
                                                    </span>
                                                </h5>
                                                <h5>
                                                    Subscription Date:
                                                    <span>
                                                        03-05-2023
                                                    </span>
                                                </h5>
                                            </div>
                                            <div class="col-lg-6">
                                                <h5>
                                                    Days:
                                                    <span>
                                                        Sat, Sun, Mon
                                                    </span>
                                                </h5>
                                                <h5>
                                                    Session Time:
                                                    <span>
                                                        6:00 - 7:00
                                                    </span>
                                                </h5>
                                                <h5>
                                                    Total Price:
                                                    <span>
                                                        45 KD
                                                    </span>
                                                </h5>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="check_inp mt_30">
                                                <input placeholder="Coupon Code" type="text">
                                                    <button class="check_btn" type="submit">
                                                        Apply
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
                                                            I agree to the 
                                                            <a data-toggle="modal" href="#terms">terms and conditions.</a>
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
                            Previous
                        </button>
                        <button class="button_box" id="nextBtn" onclick="nextPrev(1)" type="button">
                            NEXT
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</main>