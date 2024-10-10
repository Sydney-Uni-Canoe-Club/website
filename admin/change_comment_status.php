<?php
include_once "./config.php";





    $sql = "UPDATE events_blog SET status=".$_POST['new_status']." where id='".$_POST['id']."'";
   




mysqli_query($link, $sql);
/*

//user notification

$sql = "select subject, msg from email_template where num_type=6";  

$result = mysqli_query($link, $sql);
$fila = mysqli_fetch_assoc($result);
$subject=$fila["subject"];


if($_POST["new_type"]==1)
$_POST["new_type"]="Interested";
else if($_POST["new_type"]==2)
$_POST["new_type"]="Committed";
else if($_POST["new_type"]==3)
$_POST["new_type"]="Going";
$msg = str_replace("!status!", $_POST["new_type"], $fila["msg"]);


$sql="SELECT * FROM usuarios WHERE id in (SELECT husuario FROM evento_usuario WHERE id=".$_POST["id"].")";
$result = mysqli_query($link, $sql);
$fila = mysqli_fetch_assoc($result);

$email=$fila["correo"];
$name = $fila["nombre"];
$msg = str_replace("!name!", $name, $msg);
$msg = str_replace("!email!", $email, $msg);

$sql="SELECT nombre, fecha_inicio FROM eventos WHERE id in (select hevento from evento_usuario where id=".$_POST["id"].")";
$result = mysqli_query($link, $sql);
$fila = mysqli_fetch_assoc($result);

$msg = str_replace("!name_eve!", $fila["nombre"], $msg);
$msg = str_replace("!date!", $fila["fecha_inicio"], $msg);
require_once __DIR__ . "/PHPMailer/EnviarEmail.php";
    
echo enviarmail($email,"","committee@sydneyuniversitycanoeclub.com.au","",$subject,$msg,$smtp);


*/




