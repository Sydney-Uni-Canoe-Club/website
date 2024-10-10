<?php
include_once "./config.php";

if(isset($_GET["code"])==false)
{
  unset($_SESSION['usr_id']);

  header('Location: ./login.php');
  die();

}

$sql = "select * from usuarios where code='" . $_GET["code"] . "' and status=0 and email_activated='0'";
$result = mysqli_query($link, $sql);
$fila = mysqli_fetch_assoc($result);
if (is_null($fila) == true)
{
  unset($_SESSION['usr_id']);
  $_SESSION["err"] = "Email already verified, please log in";
  header('Location: ./login.php');
  die();
}




$sql = "UPDATE usuarios SET status='1', email_activated='1' WHERE code=" . $_GET["code"] . "";

mysqli_query($link, $sql);

$sql = "select * from usuarios where code='" . $_GET["code"] . "'";
$result = mysqli_query($link, $sql);
$fila = mysqli_fetch_assoc($result);

if (is_null($fila) != true) {
  $_SESSION["usr_id"] = $fila["id"];
  $_SESSION["usr_nombre"] = $fila["nombre"];
  $_SESSION["usr_email"] = $fila["correo"]; 
  $_SESSION["tipo_usuario"] = $fila["tipo_usuario"];
  $_SESSION["fecha_limite"] = $fila["fechalimite_suscripcion"];
  $_SESSION["status"] = $fila["status"];
  $_SESSION["avatar"] = $fila["avatar"];
  $_SESSION["is_student"] = $fila["is_student"];
  $_SESSION["success_pay"] = "successfully registered";
  $_SESSION["err"] = "Payment Required";
  header('Location: ./profile.php');

} else
  {
    $_SESSION["err"] = "Email already verified, please log in";
    unset($_SESSION['usr_id']);
    header('Location: ./login.php');
  
  }

?>