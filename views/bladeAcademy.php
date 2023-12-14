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
                <div class="button_box">ACTIVITES</div>
            </div>
        </div>
    </div>
    <!-- insight_cart -->
    <div class="insight_cart">
        <div class="container">
            <div class="row mt_30">
                <div class="col-lg-3 col-sm-6 col-6 mt_50">
                    <a href="#karate" data-toggle="modal" class="man_box">
                        <div class="man_top">
                            <h2>KARATE</h2>
                            <h3>12 Session per Month</h3>
                            <h4>Starting from 45 KD</h4>
                        </div>
                        <div class="man_body" style="background-image: url(img/man.png);">
                            <img src="img/man_1.png" alt="" class="img-fluid">
                        </div>
                    </a>
                </div> 
                <div class="col-lg-3 col-sm-6 col-6 mt_50">
                    <a href="#karate" data-toggle="modal" class="man_box">
                        <div class="man_top">
                            <h2>Fencing sport</h2>
                            <h3>12 Session per Month</h3>
                            <h4>Starting from 45 KD</h4>
                        </div>
                        <div class="man_body" style="background-image: url(img/man.png);">
                            <img src="img/man_2.png" alt="" class="img-fluid">
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-sm-6 col-6 mt_50">
                    <a href="#karate" data-toggle="modal" class="man_box">
                        <span class="post-date">NEW</span>
                        <div class="man_top">
                            <h2>KICK BOXING</h2>
                            <h3>12 Session per Month</h3>
                            <h4>Starting from 45 KD</h4>
                        </div>
                        <div class="man_body" style="background-image: url(img/man.png);">
                            <img src="img/man_3.png" alt="" class="img-fluid">
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-sm-6 col-6 mt_50">
                    <a href="#karate" data-toggle="modal" class="man_box">
                        <span class="post-date post-color">Sold Out</span>
                        <div class="man_top">
                            <h2>BOXING</h2>
                            <h3>12 Session per Month</h3>
                            <h4>Starting from 45 KD</h4>
                        </div>
                        <div class="man_body" style="background-image: url(img/man.png);">
                            <img src="img/man_4.png" alt="" class="img-fluid">
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</main>

<div class="modal fade" id="karate" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <div class="modal-body p-0 text-center">
                <h2>Choose the subscription period</h2>
                <h3>We also have saving plans</h3>
                <div class="month_wap mt_30">
                    <h4>One Month Subscription</h4>
                    <h6>45 KD</h6>
                </div>
                <div class="month_wap">
                    <div class="save_style">
                        <p>Save 10%</p>
                    </div>
                    <h4>Two Month Subscription</h4>
                    <h6>80 KD</h6>
                </div>
                <div class="month_wap">
                    <div class="save_style">
                        <p>Save 20%</p>
                    </div>
                    <h4>Three Month Subscription</h4>
                    <h6>120 KD</h6>
                </div>
            </div>
        </div>
    </div>
</div> 