<?php

include_once "./config.php";





//get info trip 
echo $sql = "SELECT nombre, fecha_inicio FROM eventos where id=" . $_GET["id"];
$result = mysqli_query($link, $sql);
$trip = mysqli_fetch_assoc($result);


////get email template
$sql = "select subject, msg from email_template where num_type=11";


$result = mysqli_query($link, $sql);
$fila = mysqli_fetch_assoc($result);
$subject = $fila["subject"];
$msg = str_replace("!name_eve!", $trip["nombre"], $fila["msg"]);
$msg = str_replace("!date!", $trip["fecha_inicio"], $msg);

$sql = "SELECT (select correo from usuarios where id=husuario) as email FROM evento_usuario WHERE hevento=" . $_GET["id"];
//sent email
$result = mysqli_query($link, $sql);

require_once __DIR__ . "/PHPMailer/EnviarEmail.php";


while ($user = mysqli_fetch_assoc($result)) {
    echo enviarmail($user["email"], "", "committee@sydneyuniversitycanoeclub.com.au", "", $subject, $msg, $smtp);
}

//delete trip

$sql = "delete from eventos where id='" . $_GET["id"] . "' and husuario=" . $_SESSION["usr_id"];
$result = mysqli_query($link, $sql);

$_SESSION["message"] = "Deleted";
header('Location: ./mytrips.php');