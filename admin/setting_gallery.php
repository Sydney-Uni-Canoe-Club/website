<?php

include_once "./config.php";
if ($_SESSION["tipo_usuario"] != 1) {

  header('Location: ./home.php');

}


// Loop through each file
for ($i = 0; $i < count($_FILES["gallery"]['name']); $i++) {

  //Get the temp file path
  $tmpFilePath = $_FILES['gallery']['tmp_name'][$i];

  //Make sure we have a file path
  if ($tmpFilePath != "") {
    //Setup our new file path
    $name_file = explode('.', $_FILES["gallery"]["name"][$i]);


    $name_imgallery = random_int(100, 999) . "_" . date('Ymdhisv') . "." . $name_file[1];
    $newFilePath = "./uploads/img/" . $name_imgallery;

    //Upload the file into the temp dir
    if (move_uploaded_file($tmpFilePath, $newFilePath)) {

      $sql = "INSERT INTO gallery_home(img) VALUES ('$name_imgallery')";

      mysqli_query($link, $sql);


    }
  }
}


$_SESSION["message"] = "Images Saved";
header('Location: ./settings.php');
?>