<?php
include_once "./config.php";


echo   $sql = "UPDATE settings SET days_pay=".$_POST['days_pay'].", stripe_creden='".$_POST['stripe_creden']."',
    stripe_secret='".$_POST['stripe_secret']."', price_regu=".$_POST['price_regu'].",	price_student=".$_POST['price_student']."";
   




mysqli_query($link, $sql);




$_SESSION["tipo"] = "1";

header('Location: ./settings.php');