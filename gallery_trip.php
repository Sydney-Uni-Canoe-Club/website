<?php

include_once "./admin/config.php";
$date = date("Y-m-d");
$sql = "select img, hcategory from eventos where id=" . $_POST["id"] . " limit 1";


$result = mysqli_query($link, $sql);

while ($row = mysqli_fetch_assoc($result)) {


   if ($row["img"] != '')
      $array["img"] = $row["img"];
   else {

      $sql = "select img from  events_category_img where hcategory=" . $row["hcategory"] . " and type=1 limit 1";


      $result = mysqli_query($link, $sql);
      $row = mysqli_fetch_assoc($result);

      if ($row != null)
         $array["img"] = $row["img"];
      else
         $array["img"] = '';
   }

}




$sql = "select descripcion, hour_end from eventos where id=" . $_POST["id"];


$result = mysqli_query($link, $sql);

while ($row = mysqli_fetch_assoc($result)) {
   // echo $row["img"];

   $array["descrip"] = strip_tags($row["descripcion"]);
   $array["descrip"] = substr($array["descrip"], 0, 50) . "...";
   $array["hour_end"] = strip_tags($row["hour_end"]);

}






echo json_encode($array);