<?php
include_once "./config.php";
if (isset($_SESSION['usr_id']) == TRUE)
    header('Location: ./home.php');

$email = $_POST['email'];
$pass = base64_encode($_POST['pass']);

$sql = "select * from usuarios where correo='$email' and clave='$pass'";
$result = mysqli_query($link, $sql);
$fila = mysqli_fetch_assoc($result);
if ($fila!=null) {
    $_SESSION["usr_id"] = $fila["id"];

//putt prefered name
    if($fila["name_pre"]!='')
    {
      
        $name = explode(" ", $fila["nombre"]);
        $fila["name_pre"];

        $lastname = str_replace( $name[0], "", $fila["nombre"]);
        
    
        $_SESSION["usr_nombre"] = $name[0].' "'.$fila["name_pre"].'"'.$lastname;
    
    }else{

        $_SESSION["usr_nombre"] = $fila["nombre"];
    }
    $_SESSION["usr_email"] =  $email;
    $_SESSION["tipo_usuario"] = $fila["tipo_usuario"]; 
    $_SESSION["fecha_limite"] = $fila["fechalimite_suscripcion"]; 
    $_SESSION["status"]= $fila["status"];
    $_SESSION["avatar"]= $fila["avatar"];
    $_SESSION["is_student"] = $fila["is_student"];
    
    if(isset($_SESSION["redirect"])==false)
    {header('Location: ./home.php');}
else{
if($fila["status"]==1)
{
 $url= $_SESSION["redirect"];
unset($_SESSION["redirect"]);
header('Location: '.$url);
}else{
    header('Location: ./home.php');
}

}

} else {
    //datos incorrectos
    unset($_SESSION['usr_id']);
    $_SESSION["err_login"]=1;
    header('Location: ./login.php');

}


