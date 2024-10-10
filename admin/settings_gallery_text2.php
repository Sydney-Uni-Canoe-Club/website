<?php
include_once "./config.php";


    $sql = "UPDATE gallery_home SET text_2='".$_POST['txt']."' where id=".$_POST['id']."";
   




mysqli_query($link, $sql);




$_SESSION["tipo"] = "1";
