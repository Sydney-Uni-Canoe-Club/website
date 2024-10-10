<?php
include_once "./config.php";


$sql = "select * from usuarios where correo='" . $_POST["email"] . "' and id!=" . $_POST["id"];

$result = mysqli_query($link, $sql);
$fila = mysqli_fetch_assoc($result);

if ($fila != null) {
    $_SESSION["err"] = "Email already registered!";
    header('Location: ./user_edit.php?id='.$_POST["id"]);
    die();
}

if (empty($_POST["pass"]) == false) {//con pass
    $_POST["pass"] = base64_encode($_POST["pass"]);
    $sql = "UPDATE usuarios SET nombre='" . $_POST["name"] . "',clave='" . $_POST["pass"] . "',
    telefono='" . $_POST["phone"] . "',correo='" . $_POST["email"] . "',
    emergency_contact_name='" . $_POST["emerg_contact_name"] . "', emergency_contact_phone='" . $_POST["emerg_contact_phone"] ."', is_student='" . $_POST["is_student"] . "',name_pre='" . $_POST["name_pre"] . "', fechalimite_suscripcion='" . $_POST["expire_date"] . "', comment='" . $_POST["comment"] . "'
     WHERE id=" . $_POST["id"];
} else {
    //sin pass
    $sql = "UPDATE usuarios SET nombre='" . $_POST["name"] . "',
telefono='" . $_POST["phone"] . "',correo='" . $_POST["email"] . "',
emergency_contact_name='" . $_POST["emerg_contact_name"] . "', emergency_contact_phone='" . $_POST["emerg_contact_phone"] ."', is_student='" . $_POST["is_student"] . "',name_pre='" . $_POST["name_pre"] . "', fechalimite_suscripcion='" . $_POST["expire_date"] . "', comment='" . $_POST["comment"] . "'
,status='" . $_POST["status"] . "',tipo_usuario='" . $_POST["tipo"] . "'   
 WHERE id=" . $_POST["id"];
   
}

echo $sql;
mysqli_query($link, $sql);


if ($_POST["is_student"] == 1) {
    $sql = "UPDATE usuarios SET id_numero='" . $_POST["id_numero"] . "' WHERE id=" . $_POST["id"];
    mysqli_query($link, $sql);
}





$email = $_POST['email'];

$sql = "select * from usuarios where id=" . $_POST["id"];
$result = mysqli_query($link, $sql);
$fila = mysqli_fetch_assoc($result);


$_SESSION["success"] = "Updated User successfully, User notified.";


require_once __DIR__."/PHPMailer/EnviarEmail.php";

/*
$sql = "select subject, msg from email_template where num_type=1";
$name = $_POST["name"];

$result = mysqli_query($link, $sql);
$fila = mysqli_fetch_assoc($result);

$msg = str_replace("!name!", $name, $fila["msg"]);
$subject=$fila["subject"];





*/







if ($_POST["status"]==1)
{
    $sql = "select subject, msg from email_template where num_type=3";       
}else{
    $sql = "select subject, msg from email_template where num_type=4";  
}

$result = mysqli_query($link, $sql);
$fila = mysqli_fetch_assoc($result);
$subject=$fila["subject"];
$name = $_POST["name"];
$msg = str_replace("!name!", $name, $fila["msg"]);

echo enviarmail($_POST["email"],"","committee@sydneyuniversitycanoeclub.com.au","",$subject,$msg,$smtp);

header('Location: ./admin_user.php');