<?php 

include_once "./config.php";
if($_SESSION["tipo_usuario"]!=1){
  
  header('Location: ./home.php');

} 

    
    $sql="INSERT INTO events_category(name, status)
    VALUES ('".$_POST["name"]."',1)";


mysqli_query($link, $sql);
$_SESSION["message"]="Category Saved!";
header('Location: ./category.php');
?>