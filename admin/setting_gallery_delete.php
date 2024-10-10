<?php

include_once "./config.php";
if ($_SESSION["tipo_usuario"] != 1) {

  header('Location: ./home.php');

}





$id = $_GET["id"];

if (is_null($id) == true)
  header('Location: ./mytrips_edit.php?id=' . $id);


$sql = "SELECT  * FROM gallery_home WHERE id=" . $_GET["id"];
$result = mysqli_query($link, $sql);
$fila = mysqli_fetch_assoc($result);

unlink('./uploads/img/' . $fila["img"]);


$sql = "delete FROM gallery_home WHERE id=" . $_GET["id"];
$result = mysqli_query($link, $sql);

$_SESSION["message"] = "Image deleted";
header('Location: ./settings.php?id=' . $fila["hevent"]);
?>