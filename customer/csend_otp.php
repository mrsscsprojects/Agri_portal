<?php
session_start();
require('../sql.php'); // Includes Login Script

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'C:/xampp/htdocs/Agriculture-portal/PHPMailer/src/Exception.php';
require 'C:/xampp/htdocs/Agriculture-portal/PHPMailer/src/PHPMailer.php';
require 'C:/xampp/htdocs/Agriculture-portal/PHPMailer/src/SMTP.php';

$email=$_SESSION['customer_login_user'];
$res=mysqli_query($conn,"select * from custlogin where email='$email'");
$count=mysqli_num_rows($res);
if($count>0){
    $otp=rand(11111,99999);
    mysqli_query($conn,"update custlogin set otp='$otp' where email ='$email'");
	$html="Your otp verification code for Agriculture Portal is ".$otp;
	$_SESSION['farmer_login_user'];
    smtp_mailer($email,'OTP Verification',$html); 
    echo "yes";
}
else{
    echo "not exist";
}
 
function smtp_mailer($to, $subject, $msg) {
    require_once("../smtp/class.phpmailer.php");
    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->SMTPDebug = 2;
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'ssl';
    $mail->Host = "smtp.gmail.com";
    $mail->Port = 465;
    $mail->IsHTML(true);
    $mail->CharSet = 'UTF-8';
    $mail->Username = "mrsscsprojects@gmail.com";
    $mail->Password = "jwvh hdqi hqhw hbiy";
    $mail->SetFrom("mrsscsprojects@gmail.com");
    $mail->Subject = $subject;
    $mail->Body = $msg;
    $mail->AddAddress($to);
    
    if (!$mail->Send()) {
        echo "Mailer Error: " . $mail->ErrorInfo;
        return 0;
    } else {
        return 1;
    }
}
?>

