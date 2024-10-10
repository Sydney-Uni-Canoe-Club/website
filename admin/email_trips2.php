<?php
include_once "./config.php";





 require_once __DIR__."/PHPMailer/EnviarEmail.php";
 

$sql = "SELECT u.correo FROM evento_usuario eu 
INNER JOIN usuarios u on u.id=eu.husuario where eu.hevento=".$_POST["hevento"];
$result = mysqli_query($link, $sql);
while ($fila = mysqli_fetch_assoc($result)) {

    echo enviarmail($fila['correo'],"Sydney Uni Canoe Club","australia@trips.club","Sydney Uni Canoe Club","About your trip",$_POST["reply"],$smtp);

}
echo enviarmail($_POST["email"],"Sydney Uni Canoe Club","australia@trips.club","Sydney Uni Canoe Club","About your trip",$_POST["reply"],$smtp);


mysqli_query($link,  $sql);
$_SESSION["message"]="Emails sent successfully";
header('Location: ./mytrips_edit.php?id='.$_POST["hevento"]);
?>