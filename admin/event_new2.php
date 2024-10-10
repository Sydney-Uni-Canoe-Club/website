<?php 

include_once "./config.php";
if($_SESSION["tipo_usuario"]!=1){
  
  header('Location: ./home.php');

} 

if ($_FILES["avatar"]["name"] != '') {


  $name_file = explode('.', $_FILES["avatar"]["name"]);


  $name_imgmain = random_int(100, 999) . date('Ymdhisv') . "." . $name_file[1];
  $tmpFilePath = $_FILES['avatar']['tmp_name'];
  $newFilePath = "./uploads/trips/" . $name_imgmain;

  //Upload the file into the temp dir
  move_uploaded_file($tmpFilePath, $newFilePath);

} else
  $name_imgmain = '';


  $_POST["name"] = str_replace("'", "''", $_POST["name"]);
    $sql="INSERT INTO eventos(nombre, img, descripcion,  fecha_inicio, fecha_fin, cupo_limite, hcategory, husuario,status,hour,hour_end,location)
    VALUES ('".$_POST["name"]."','$name_imgmain','".$_POST["description"]."','".$_POST["date1"]."','".$_POST["date2"]."','".$_POST["coupons"]."','".$_POST["hcategory"]."','". $_POST["husuario"]."','". $_POST["status"]."','". $_POST["hour"]."','". $_POST["hour_end"]."','". $_POST["location"]."')";

mysqli_query($link, $sql);






if (count($_FILES["gallery"]['name']) > 0) {
  // Loop through each file
  $id = mysqli_insert_id($link);
  for ($i = 0; $i < count($_FILES["gallery"]['name']); $i++) {

    //Get the temp file path
    $tmpFilePath = $_FILES['gallery']['tmp_name'][$i];

    //Make sure we have a file path
    if ($tmpFilePath != "") {
      //Setup our new file path
      $name_file = explode('.', $_FILES["gallery"]["name"][$i]);


      $name_imgallery = random_int(100, 999) . "_" . date('Ymdhisv') . "." . $name_file[1];
      $newFilePath = "./uploads/trips/" . $name_imgallery;

      //Upload the file into the temp dir
      if (move_uploaded_file($tmpFilePath, $newFilePath)) {

        $sql = "INSERT INTO events_galery(hevent, img) VALUES ($id,'$name_imgallery')";

        mysqli_query($link, $sql);


      }
    }
  }
}







//sent email if create with status public

if ($_POST["status"] =1){


  require_once __DIR__ . "/PHPMailer/EnviarEmail.php";
  
  $sql = "select *, (select name from events_category ec where ec.id=hcategory) as category from eventos where id=" . $id;
  
  $result = mysqli_query($link, $sql);
  $event = mysqli_fetch_assoc($result);
  
  
  
  $sql = "select subject, msg from email_template where num_type=9";  
  
  $result = mysqli_query($link, $sql);
  $fila = mysqli_fetch_assoc($result);
  $subject=$fila["subject"];
  
  $name_eve=$event["nombre"];
  
  $msg = str_replace("!name_eve!", $name_eve, $fila["msg"]);
  
  $cat_eve=$event["category"];
  
  $msg = str_replace("!cat_eve!", $cat_eve, $msg);
  
  $date_eve=$event["fecha_inicio"]; 
  
  $msg = str_replace("!date_eve!", $date_eve, $msg);
  
  $email=$_SESSION["usr_email"];
  
  
  $descrip_eve=$event["descripcion"]; 
  
  
  $msg = str_replace("!descrip_eve!", $descrip_eve, $msg);
  
  
  
  $sql="SELECT correo FROM usuarios where tipo_usuario=2";
  $result = mysqli_query($link, $sql);
  while($fila = mysqli_fetch_assoc($result))
  {
  $email=$fila["correo"];    
  echo enviarmail($email,"","committee@sydneyuniversitycanoeclub.com.au","",$subject,$msg,$smtp);
  }
  
  }




$_SESSION["tipo"]="1";
header('Location: ./events.php');
?>