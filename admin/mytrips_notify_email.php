
<?php 



include_once "./config.php";

require_once __DIR__ . "/PHPMailer/EnviarEmail.php";

$sql = "select *, (select name from events_category ec where ec.id=hcategory) as category from eventos where id=" . $_GET["id"];

$result = mysqli_query($link, $sql);
$event = mysqli_fetch_assoc($result);



$sql = "select subject, msg from email_template where num_type=9";  

$result = mysqli_query($link, $sql);
$fila = mysqli_fetch_assoc($result);
$subject=$fila["subject"];

$name_eve=$event["nombre"];

$msg = str_replace("!name_eve!", $name_eve, $fila["msg"]);

$cat_eve=$event["category"];

$msg = str_replace("!cat_eve!", $cat_eve, $msg);

$date_eve=$event["fecha_inicio"]; 

$msg = str_replace("!date_eve!", $date_eve, $msg);

$email=$_SESSION["usr_email"];


$descrip_eve=$event["descripcion"]; 


$msg = str_replace("!descrip_eve!", $descrip_eve, $msg);



$sql="SELECT correo FROM usuarios where tipo_usuario=2";
$result = mysqli_query($link, $sql);
while($fila = mysqli_fetch_assoc($result))
{
$email=$fila["correo"];    
echo enviarmail($email,"","committee@sydneyuniversitycanoeclub.com.au","",$subject,$msg,$smtp);
}


$_SESSION["message"]=" Email sent to all user";


header('Location: ./'.$_GET["redirect"]);
