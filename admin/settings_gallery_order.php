<?php
include_once "./config.php";


    $sql = "UPDATE gallery_home SET order_pic=".$_POST['order']." where id='".$_POST['id']."'";
   




mysqli_query($link, $sql);




$_SESSION["tipo"] = "1";
