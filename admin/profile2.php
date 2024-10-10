<?php
include_once "./config.php";


$sql = "select * from usuarios where correo='" . $_POST["email"] . "' and id!=" . $_SESSION["usr_id"];
$result = mysqli_query($link, $sql);
$fila = mysqli_fetch_assoc($result);

if ($fila != null) {
    $_SESSION["err"] = "Email already registered!";
    header('Location: ./profile.php');
}

if ($_POST["pass"] != $_POST["pass2"]) {
    $_SESSION["err"] = "Password are not identical";
    header('Location: ./profile.php');
    die();
}


//avatar
if (empty($_FILES["avatar"]["name"]) == false) {
    //Get the temp file path
    $tmpFilePath = $_FILES['avatar']['tmp_name'];

    //Make sure we have a file path
    if ($tmpFilePath != "") {
        //Setup our new file path
        $name_file = explode('.', $_FILES["avatar"]["name"]);


        $name_imgallery = random_int(100, 999) . "_" . date('Ymdhisv') . "." . $name_file[1];
        $newFilePath = "./uploads/avatar/" . $name_imgallery;



        //Upload the file into the temp dir
        if (move_uploaded_file($tmpFilePath, $newFilePath)) {
            //delete old avatar
            if (is_null($_POST["filename_avatar"]) == false) {
                unlink("./uploads/avatar/" . $_POST["filename_avatar"]);
            }


            $new_width = 250;
            $new_height = 250;
            list($width, $height, $type, $attr) = getimagesize($newFilePath);
            $filename = $newfilename = $newFilePath;
            $path_parts = pathinfo($newFilePath);
            if ($path_parts['extension'] == 'jpg' || $path_parts['extension'] == 'jpeg') {
                $image_p = imagecreatetruecolor($new_width, $new_height);
                $image = imagecreatefromjpeg($filename);
                imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
                imagejpeg($image_p, $newfilename);
            } elseif ($path_parts['extension'] == 'gif') {
                $image_p = imagecreatetruecolor($new_width, $new_height);
                $image = imagecreatefromgif($filename);
                imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
                imagegif($image_p, $newfilename);
            } elseif ($path_parts['extension'] == 'png') {
                $image_p = imagecreatetruecolor($new_width, $new_height);
                $image = imagecreatefrompng($filename);
                imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
                imagepng($image_p, $newfilename);
            } else {
                echo "Source file is not a supported image file type.";
            }




            $sql = "UPDATE usuarios SET avatar='$name_imgallery'  
       WHERE id=" . $_SESSION["usr_id"];
            echo $sql;
            mysqli_query($link, $sql);
            $_SESSION["avatar"] = $name_imgallery;

        }
    }

}


//avatar end







if (empty($_POST["pass"]) == false) {//con pass
    $_POST["pass"] = base64_encode($_POST["pass"]);
    $sql = "UPDATE usuarios SET nombre='" . $_POST["name"] . "',clave='" . $_POST["pass"] . "',
    telefono='" . $_POST["phone"] . "',correo='" . $_POST["email"] . "',
    emergency_contact_name='" . $_POST["emerg_contact_name"] . "', emergency_contact_phone='" . $_POST["emerg_contact_phone"] . "',name_pre='" . $_POST["name_pre"] . "'    
     WHERE id=" . $_SESSION["usr_id"];

} else {
    //sin pass
    $sql = "UPDATE usuarios SET nombre='" . $_POST["name"] . "',
telefono='" . $_POST["phone"] . "',correo='" . $_POST["email"] . "',
    emergency_contact_name='" . $_POST["emerg_contact_name"] . "', emergency_contact_phone='" . $_POST["emerg_contact_phone"] . "', name_pre='" . $_POST["name_pre"] . "'    
 WHERE id=" . $_SESSION["usr_id"];
    echo $sql;
}
mysqli_query($link, $sql);

if ($_POST["is_student"] == 1) {
    $sql = "UPDATE usuarios SET id_numero='" . $_POST["id_number"] . "' WHERE id=" . $_SESSION["usr_id"];
    mysqli_query($link, $sql);
}

$email = $_POST['email'];

$sql = "select * from usuarios where id=" . $_SESSION["usr_id"];
$result = mysqli_query($link, $sql);
$fila = mysqli_fetch_assoc($result);



if($fila["name_pre"]!='')
{
  
    $name = explode(" ", $fila["nombre"]);
    $fila["name_pre"];

    $lastname = str_replace( $name[0], "", $fila["nombre"]);
    

    $_SESSION["usr_nombre"] = $name[0].' "'.$fila["name_pre"].'"'.$lastname;

}else{

    $_SESSION["usr_nombre"] = $fila["nombre"];
}

$_SESSION["tipo_usuario"] = $fila["tipo_usuario"];
$_SESSION["success"] = 1;
header('Location: ./profile.php');