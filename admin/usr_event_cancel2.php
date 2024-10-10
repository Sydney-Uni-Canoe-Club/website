<?php 

include_once "./config.php";

    
$sql="DELETE FROM evento_usuario WHERE hevento=".$_POST["id_evnt"]." and husuario=".$_SESSION["usr_id"];


mysqli_query($link, $sql);

$sql="UPDATE eventos SET cupos_usados=cupos_usados-1 WHERE id=".$_POST["id_evnt"];
mysqli_query($link, $sql);
$_SESSION["tipo"] = "1";
$_SESSION["msg"] = " Cancel for the event.";



//trip leader notification

$sql = "select subject, msg from email_template where num_type=8";  

$result = mysqli_query($link, $sql);
$fila = mysqli_fetch_assoc($result);
$subject=$fila["subject"];
$name = $_SESSION["usr_nombre"];
$msg = str_replace("!name!", $name, $fila["msg"]);
$email = $_SESSION["usr_email"];
$msg = str_replace("!email!", $email, $msg);
$msg = str_replace("!name_eve!", $_POST["nombre"], $msg);
$msg = str_replace("!date!", $_POST["fecha_inicio"], $msg);



$sql="SELECT correo FROM usuarios WHERE id in (select husuario from eventos where id=".$_POST["id_evnt"].")";
$result = mysqli_query($link, $sql);
$fila = mysqli_fetch_assoc($result);

$email=$fila["correo"];

require_once __DIR__ . "/PHPMailer/EnviarEmail.php";
    
echo enviarmail($email,"","committee@sydneyuniversitycanoeclub.com.au","",$subject,$msg,$smtp);
















header('Location: ./home.php');


?>