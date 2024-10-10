<?php
include_once "./config.php";





 require_once __DIR__."/PHPMailer/EnviarEmail.php";
 

$sql = "SELECT correo FROM usuarios";
$result = mysqli_query($link, $sql);
while ($fila = mysqli_fetch_assoc($result)) {

    echo enviarmail($fila['correo'],"","committee@sydneyuniversitycanoeclub.com.au","",$_POST['subject'],$_POST["reply"],$smtp);

}


mysqli_query($link,  $sql);
$_SESSION["success"]="Emails sent successfully";
header('Location: ./admin_user.php');
?>