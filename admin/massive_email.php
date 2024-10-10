<?php
include_once "./config.php";





 require_once __DIR__."/PHPMailer/EnviarEmail.php";
 
if ($_POST["origin"]==1)
{
    $return="newsletter.php";
    $sql = "SELECT email FROM newsletter";
}


$result = mysqli_query($link, $sql);
while ($fila = mysqli_fetch_assoc($result)) {
echo $fila['email'];
    echo enviarmail($fila['email'],"","committee@sydneyuniversitycanoeclub.com.au","",$_POST["subject"],$_POST["reply"],$smtp);

}



$_SESSION["success"]="Emails sent successfully";
header('Location: ./'.$return);
?>