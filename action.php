<?php
if(isset($_POST['submission'])) {
$to = "maddsalt@maddsalt.com";
$notification = "Contact Form Submission:";
$name_field = $_POST['name'];
$email_field = $_POST['email'];
$message = $_POST['message'];

$body = "From: $name_field\n E-Mail: $email_field\n Message:\n $message";

mail($to, $notification, $body);
header("location: https://maddsalt.com/messagesuccess#contact");
exit();
} else {
echo "There was an error submitting the messsage. Please try again!";
}
$recaptcha = $_POST['g-recaptcha-response'];
$res = reCaptcha($recaptcha);
if(!$res['success']){
  // Error
}
function reCaptcha($recaptcha){
    $secret = "6LfdglwaAAAAAM6lvOdOikGnzO-dA2lxXCnPBTB9";
    $ip = $_SERVER['REMOTE_ADDR'];
  
    $postvars = array("secret"=>$secret, "response"=>$recaptcha, "remoteip"=>$ip);
    $url = "https://www.google.com/recaptcha/api/siteverify";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postvars);
    $data = curl_exec($ch);
    curl_close($ch);
  
    return json_decode($data, true);
  }
?>
