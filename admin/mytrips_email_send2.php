<?php
include_once "./config.php";

 require_once __DIR__."/PHPMailer/EnviarEmail.php";
 




   echo enviarmail($_POST['email'],"","committee@sydneyuniversitycanoeclub.com.au","",$_POST['subject'],$_POST["reply"],$smtp);



$_SESSION["success_email"]="Email sent successfully to: ".$_POST['email'];
header('Location: ./'.$_POST["redirect"]);
?>