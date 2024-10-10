<?php

include_once "./config.php";
if ($_SESSION["tipo_usuario"] == 2) {

  header('Location: ./home.php');

}





$id = $_GET["id"];

if (is_null($id) == true)
  header('Location: ./mytrips_edit.php?id=' . $id);


$sql = "SELECT  * FROM events_galery WHERE id=" . $_GET["id"];
$result = mysqli_query($link, $sql);
$fila = mysqli_fetch_assoc($result);

unlink('./uploads/trips/' . $fila["img"]);


$sql = "delete FROM events_galery WHERE id=" . $_GET["id"];
$result = mysqli_query($link, $sql);

$_SESSION["message"] = "Image deleted";
header('Location: ./mytrips_edit.php?id=' . $fila["hevent"]);
?>