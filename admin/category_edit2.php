<?php
include_once "./config.php";
if($_SESSION["tipo_usuario"]!=1 || isset($_POST)==false){
  
  header('Location: ./home.php');

} 

 $sql="UPDATE events_category SET name='".$_POST["name"]."', status='".$_POST["status"]."'
 WHERE id=".$_POST["id"]."";

mysqli_query($link,  $sql);
$_SESSION["message"]="Saved!";
header('Location: ./category_edit.php?id='.$_POST["id"]);
?>