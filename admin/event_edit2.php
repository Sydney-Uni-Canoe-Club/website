<?php
include_once "./config.php";
if($_SESSION["tipo_usuario"]!=1 || isset($_POST)==false){
  
  header('Location: ./home.php');

} 


if ($_FILES["avatar"]["name"] != '') {

  $name_file = explode('.', $_FILES["avatar"]["name"]);
  $name_imgmain = random_int(100, 999) . date('Ymdhisv') . "." . $name_file[1];
  $tmpFilePath = $_FILES['avatar']['tmp_name'];
  $newFilePath = "./uploads/trips/" . $name_imgmain;

  //Upload the file into the temp dir
  move_uploaded_file($tmpFilePath, $newFilePath);
  if ($_POST["old_image_main"] != '')
    unlink('./uploads/trips/' . $_POST["old_image_main"]);

  $sql = "UPDATE eventos SET img='$name_imgmain' WHERE  id=" . $_POST["id"];
  mysqli_query($link, $sql);
}


$_POST["name"] = str_replace("'", "''", $_POST["name"]);

 $sql="UPDATE eventos SET nombre='".$_POST["name"]."', descripcion='".$_POST["description"]."', 
status=".$_POST["status"].", fecha_inicio='".$_POST["date1"]."' , fecha_fin='".$_POST["date2"]."',hour='".$_POST["hour"]."', 
cupo_limite=".$_POST["coupons"]." , hcategory=".$_POST["hcategory"]." , husuario=".$_POST["husuario"].", hour_end='" . $_POST["hour_end"] . "', location='" . $_POST["location"] . "'  WHERE id=".$_POST["id"]."";

mysqli_query($link,  $sql);
$_SESSION["message"] = "Edited!";
header('Location: ./event_edit.php?id='.$_POST["id"]);
?>