<?php
include_once "./config.php";





    $sql = "UPDATE  usuarios SET is_student=".$_POST['is_student']." where id='".$_SESSION["usr_id"]."'";
   
//register question answers in this session
$_SESSION["question"]=1;


mysqli_query($link, $sql);


