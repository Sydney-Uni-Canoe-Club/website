<?php
include_once "./config.php";


$_POST["pass"] = base64_encode($_POST["pass"]);

$sql = "select * from usuarios where correo='" . $_POST["email"] . "'";
$result = mysqli_query($link, $sql);
$fila = mysqli_fetch_assoc($result);

if ($fila != null) {
    $_SESSION["err"] = "Email already registered!";
    header('Location: ./new_user.php');
    die();
}



if($_POST["is_student"]==0)

$sql = "INSERT INTO usuarios(nombre, clave, telefono, correo, is_student, emergency_contact_name, emergency_contact_phone, tipo_usuario, status,name_pre,fechalimite_suscripcion) 
VALUES ('" . $_POST["name"] . "','" . $_POST["pass"] . "','" . $_POST["phone"] . "','" . $_POST["email"] . "',
'" . $_POST["is_student"] . "','" . $_POST["emerg_contact_name"] . "','" . $_POST["emerg_contact_phone"] . "','" . $_POST["tipo"] . "','" . $_POST["status"] . "','" . $_POST["name_pre"] . "','" . $_POST["expire_date"] . "')";

else if($_POST["is_student"]==1)
$sql = "INSERT INTO usuarios(nombre, clave, telefono, correo, is_student,id_numero, emergency_contact_name, emergency_contact_phone, tipo_usuario, status, name_pre,fechalimite_suscripcion) 
VALUES ('" . $_POST["name"] . "','" . $_POST["pass"] . "','" . $_POST["phone"] . "','" . $_POST["email"] . "',
'" . $_POST["is_student"] . "','" . $_POST["number_id"] . "','" . $_POST["emerg_contact_name"] . "','" . $_POST["emerg_contact_phone"] . "','" . $_POST["tipo"] . "','" . $_POST["status"] . "','" . $_POST["name_pre"] . "','" . $_POST["expire_date"] . "')";




mysqli_query($link, $sql);



$_SESSION["success"] = "successfully registred";

header('Location: ./admin_user.php');
