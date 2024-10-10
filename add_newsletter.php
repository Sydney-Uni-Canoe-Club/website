<?php

include_once "./admin/config.php";




$sql = "select *  from newsletter where email='" . $_POST["email"]."'";

$result = mysqli_query($link, $sql);
$fila = mysqli_fetch_assoc($result);


if (is_null($fila) == true) {
    $date = date("Y-m-d");
    $sql = "INSERT INTO newsletter(date,email) VALUES ('$date','".$_POST["email"]."')";

    mysqli_query($link, $sql);


}




$_SESSION["newsletter"] = "Thanks for subscribing";
header('Location: '.$_POST["redirect"]);