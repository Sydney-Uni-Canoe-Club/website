<?php

include_once "./config.php";



$sql = "delete from usuarios where id='" . $_GET["id"]."'";

$result = mysqli_query($link, $sql);


$_SESSION["success"] = "Deleted";
header('Location: ./admin_user.php');