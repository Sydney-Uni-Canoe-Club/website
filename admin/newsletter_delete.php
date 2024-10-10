<?php

include_once "./config.php";



$sql = "delete from newsletter where id='" . $_GET["id"]."'";

$result = mysqli_query($link, $sql);


$_SESSION["success"] = "Deleted";
header('Location: ./newsletter.php');