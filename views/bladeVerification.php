<?php
if( isset($_GET["m"]) && !empty($_GET["m"]) ){
$randNumber = randNumber();
$_SESSION["otp"] = $randNumber;
/*
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://www.kwtsms.com/API/send/',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => 
  array('username' => 'targetkwnet',
        'password' => 'kyAf*HGc8Dz',
        'sender' => 'KWT-SMS',
        'mobile' => "965{$_GET["m"]}",
        'lang' => '1',
        'test' => '0',
        'message' => "{$randNumber}"
    ),
  CURLOPT_HTTPHEADER => array(
    'Cookie: PHPSESSID=e7687b136755b738f048053f94f742c0'
  ),
));
$response = curl_exec($curl);
curl_close($curl);
*/
}else{
    //echo "<script>window.history.back()</script>";
    die();
}
?>

<main class="overflow-hidden over_custom">
    <!-- sign_area -->
    <div class="sign_area">
        <div class="container">
            <h2><?php echo direction("VERIFY YOUR ACCOUNT","تحقق من حسابك") ?></h2>
            <div class="sign_wapper">
                <h3><?php echo direction("Please verify your account with the sms you received","الرجاء التحقق من حسابك بمطابقة الرمز المرسل")?></h3>
                <form action="?v=Account" method="post" class="sign_form">
                    <div class="sing_inp">
                        <input type="text" name="otp1">
                        <input type="text" name="otp2">
                        <input type="text" name="otp3">
                        <input type="text" name="otp4">
                        <input type="text" name="otp5">
                        <input type="text" name="otp6">
                    </div>
                    <div class="text-center mt_100">
                        <button class="button" type="submit"><?php echo direction("Verify","تحقق") ?> <img src="img/veri.svg" alt=""></button>
                    </div>
                </form>
                <p><?php echo direction("Didn't get your OTP? ","لم تستلم رمز التحقق؟") ?><a href="?v=Verification&m=<?php echo $_GET["m"] ?>"><?php echo direction("Send again","ارسال مرة اخرى") ?></a>.</p>
            </div>
        </div>
    </div>
</main>