<?php


include_once "./config.php";


$_POST["pass"] = base64_encode($_POST["pass"]);

$sql = "select * from usuarios where correo='" . $_POST["email"] . "'";
$result = mysqli_query($link, $sql);
$fila = mysqli_fetch_assoc($result);

if ($fila != null) {
    $_SESSION["err"] = "Email already registered!";
    header('Location: ./register.php');
    die();
}

$codigo=mt_rand().mt_rand();


if($_POST["is_student"]==1)
{
    
if(strlen($_POST["number_id"])!=9)
{
    $_SESSION["err"] = "Student ID Invalid";
    header('Location: ./register.php');
    die();
}

}








if($_POST["is_student"]==0)

$sql = "INSERT INTO usuarios(nombre,code, clave, telefono, correo, is_student, emergency_contact_name, emergency_contact_phone, tipo_usuario, status ,name_pre,registration_date) 
VALUES ('" . $_POST["import_field1"] . "','" . $codigo . "','" . $_POST["pass"] . "','" . $_POST["phone"] . "','" . $_POST["email"] . "',
'" . $_POST["is_student"] . "','" . $_POST["emerg_contact_name"] . "','" . $_POST["emerg_contact_phone"] . "','2','0','" . $_POST["import_field2"] . "','".date('Y-m-d')."')";

else if($_POST["is_student"]==1)
$sql = "INSERT INTO usuarios(nombre,code, clave, telefono, correo, is_student,id_numero, emergency_contact_name, emergency_contact_phone, tipo_usuario, status,name_pre,registration_date ) 
VALUES ('" . $_POST["import_field1"] . "','" . $codigo . "','" . $_POST["pass"] . "','" . $_POST["phone"] . "','" . $_POST["email"] . "',
'" . $_POST["is_student"] . "','" . $_POST["number_id"] . "','" . $_POST["emerg_contact_name"] . "','" . $_POST["emerg_contact_phone"] . "','2','0','" . $_POST["import_field2"] . "','".date('Y-m-d')."')";



mysqli_query($link, $sql);



require_once __DIR__ . "/PHPMailer/EnviarEmail.php";

$sql = "select subject, msg from email_template where num_type=1";
$name = $_POST["import_field1"];

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

echo enviarmail($_POST["email"],"","committee@sydneyuniversitycanoeclub.com.au","",$subject,$msg,$smtp);

//notification admin
/*
$sql = "select subject, msg from email_template where num_type=2";


$result = mysqli_query($link, $sql);
$fila = mysqli_fetch_assoc($result);
$subject=$fila["subject"];
$msg = str_replace("!name!", $name, $fila["msg"]);
$msg = str_replace("!email!", $_POST["email"], $msg);


$sql = "SELECT correo FROM usuarios where tipo_usuario=1";
$result = mysqli_query($link, $sql);

while ($fila = mysqli_fetch_assoc($result)) {
   // echo enviarmail($fila["correo"],"","committee@sydneyuniversitycanoeclub.com.au","",$subject,$msg,$smtp);
}
*/
$_SESSION["waiting"] = "successfully registered, Please verify your email. Please check your inbox.<br>If you entered your email incorrectly, don't worry, register again";


/*
$sql = "select * from usuarios where correo='".$_POST["email"]."'";
$result = mysqli_query($link, $sql);
$fila = mysqli_fetch_assoc($result);

    $_SESSION["usr_id"] = $fila["id"];
    $_SESSION["usr_nombre"] = $fila["nombre"];
    $_SESSION["usr_email"] =  $email;
    $_SESSION["tipo_usuario"] = $fila["tipo_usuario"]; 
    $_SESSION["fecha_limite"] = $fila["fechalimite_suscripcion"]; 
    $_SESSION["status"]= $fila["status"];
    $_SESSION["avatar"]= $fila["avatar"];
    $_SESSION["is_student"] = $fila["is_student"];


*/
//$_SESSION["success_pay"] = "successfully registered";
//$_SESSION["err"] = "Payment Required";
unset($_SESSION['usr_id']);
header('Location: ./login.php');



