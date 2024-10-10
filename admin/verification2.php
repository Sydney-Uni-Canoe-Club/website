<?php
include_once "./config.php";


$email=$_POST["email"];


$sql = "select * from usuarios where correo='".$_POST ["email"]."'";
$result = mysqli_query($link, $sql);
$fila = mysqli_fetch_assoc($result);

if ($fila==null)
{$_SESSION["err"]="Email not found";
    header('Location: ./verification.php');
die();
}
$codigo=$fila["code"];
require_once __DIR__ . "/PHPMailer/EnviarEmail.php";

$sql = "select subject, msg from email_template where num_type=1";
$name = $_POST["name"];

$result = mysqli_query($link, $sql);
$fila = mysqli_fetch_assoc($result);

$msg = str_replace("!name!", $name, $fila["msg"]);


if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')   
$url = "https://";   
else  
$url = "http://";   

$url.= $_SERVER['HTTP_HOST'];   





$url=$url."/admin/activate_user.php?code=".$codigo;


$msg = str_replace("!url_email!", $url, $msg);
$subject=$fila["subject"];

echo enviarmail($email,"","committee@sydneyuniversitycanoeclub.com.au","",$subject,$msg,$smtp);

$_SESSION["waiting"]="New Activation code sent to email: ".$email;

    header('Location: ./login.php');



