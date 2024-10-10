<?php
include_once "./config.php";



 $sql="UPDATE contact SET reply='".$_POST["reply"]."' WHERE id=".$_POST["id"];

 require_once __DIR__."/PHPMailer/EnviarEmail.php";
 
 

echo enviarmail($_POST["email"],"","committee@sydneyuniversitycanoeclub.com.au","","Contact Form",$_POST["reply"],$smtp);


mysqli_query($link,  $sql);
$_SESSION["success"]="Response sent successfully";
header('Location: ./contact_form.php');
?>