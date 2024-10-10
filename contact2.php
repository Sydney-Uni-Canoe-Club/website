<?php

include_once "./admin/config.php";
$date = date("Y-m-d");
$sql = "INSERT INTO contact( name, email, message, date) VALUES ('" . $_POST["name"] . "','" . $_POST["email"] . "','" . $_POST["message"] . "','$date')";
mysqli_query($link, $sql);
$_SESSION["contact"] = "Thanks, we will reply soon.";
header('Location: ./index.php#contact');