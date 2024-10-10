<?php
include_once "./config.php";
$_POST["subject"] = str_replace("'", "''", $_POST["subject"]);
$_POST["msg"] = str_replace("'", "''", $_POST["msg"]);

    $sql = "UPDATE email_template SET  subject='".$_POST['subject']."' , msg='".$_POST['msg']."' where id=".$_POST['id'];
   




mysqli_query($link, $sql);

$_SESSION["tipo"] = "1";
header('Location: ./settings.php');


