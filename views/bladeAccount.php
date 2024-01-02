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
        <h2>MY ACCOUNT</h2>
            <div class="accoun_wapper">
                <h4><span>Order ID:</span> 5484656</h4>
                <h3><span>Name:</span>Bader Mahmoud Al Bloushi</h3>
                <div class="row justify-content-between">
                    <div class="col-lg-6">
                        <h5><span>Activity:</span>KARATE</h5>
                        <h5><span>Branch:</span>Sabah Al Salem</h5>
                        <h5><span>Subscription Date: </span>03-05-2023</h5>
                    </div>
                    <div class="col-lg-6">
                        <h5><span>Days:</span>Sat, Sun, Mon</h5>
                        <h5><span>Session Time: </span>6:00 - 7:00</h5>
                        <a href="#" class="button">Remaining Sessions: <span>12</span></a>
                    </div>
                </div>
            </div>
            <div class="accoun_wapper accoun_wapper_cus">
                <h4><span>Order ID:</span> 5484656</h4>
                <h3><span>Name:</span>Bader Mahmoud Al Bloushi</h3>
                <div class="row justify-content-between">
                    <div class="col-lg-6">
                        <h5><span>Activity:</span>KARATE</h5>
                        <h5><span>Branch:</span>Sabah Al Salem</h5>
                        <h5><span>Subscription Date: </span>03-05-2023</h5>
                    </div>
                    <div class="col-lg-6">
                        <h5><span>Days:</span>Sat, Sun, Mon</h5>
                        <h5><span>Session Time: </span>6:00 - 7:00</h5>
                        <a href="#" class="button">Remaining Sessions: <span>Expired</span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>