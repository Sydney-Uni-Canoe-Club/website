<?php 

include_once "./config.php";
if($_SESSION["tipo_usuario"]!=1){
  
  header('Location: ./home.php');

} 


$id=$_POST["id"];
echo $id;

  // Loop through each file


  //Get the temp file path
  $tmpFilePath = $_FILES['img_comment']['tmp_name'];

  //Make sure we have a file path
  if ($tmpFilePath != ""){
    //Setup our new file path
    $name_file= explode('.',$_FILES["img_comment"]["name"]);


    $name_imgallery=random_int(100, 999)."_".date('Ymdhisv').".".$name_file[1];
    $newFilePath = "./uploads/comments/" . $name_imgallery;

    //Upload the file into the temp dir
    if(move_uploaded_file($tmpFilePath, $newFilePath)) {
      //events_blog

$sql="INSERT INTO `events_blog`(`hevent`, `husuario`, `date`, `comment`, `status`, `img`) VALUES ('$id','".$_SESSION["usr_id"]."','".date("Y-m-d")."','".$_POST["message"]."',0,'$name_imgallery')";

   
     mysqli_query($link, $sql);
    

    }
  }



$_SESSION["message"]="Comment saved, waiting approval";
header('Location: ../trip.php?id='.$id);
?>