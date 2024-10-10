<?php
include_once "./config.php";





    $sql = "UPDATE  events_category_img SET type=".$_POST['new_type']." where id='".$_POST['id']."'";
   




mysqli_query($link, $sql);


