<?php
include_once "./config.php";

$_POST["text"] = str_replace("'", "''", $_POST["text"]);
$_POST["text_2"] = str_replace("'", "''", $_POST["text_2"]);
$sql = "UPDATE gallery_home SET text='" . $_POST['text'] . "', text_2='" . $_POST['text_2'] . "' where id=" . $_POST['id'] . "";

mysqli_query($link, $sql);
$_SESSION["tipo"] = "1";
header('Location: ./settings.php');
