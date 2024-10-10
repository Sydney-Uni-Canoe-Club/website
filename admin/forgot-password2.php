<?php
include_once "./config.php";


$email=$_POST["email"];


$sql = "select * from usuarios where correo='".$_POST ["email"]."'";
$result = mysqli_query($link, $sql);
$fila = mysqli_fetch_assoc($result);

if ($fila==null)
{$_SESSION["err"]="Email not found";
    header('Location: ./forgot-password.php');
die();
}

function random_str(
    int $length = 64,
    string $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'
): string {
    if ($length < 1) {
        throw new \RangeException("Length must be a positive integer");
    }
    $pieces = [];
    $max = mb_strlen($keyspace, '8bit') - 1;
    for ($i = 0; $i < $length; ++$i) {
        $pieces []= $keyspace[random_int(0, $max)];
    }
    return implode('', $pieces);
}


$pass=random_str(8);

$pass2=base64_encode($pass);

$sql="UPDATE usuarios SET clave='$pass2' WHERE correo='$email'";


 mysqli_query($link, $sql);




require_once __DIR__."/PHPMailer/EnviarEmail.php";

echo enviarmail($_POST ["email"],"","committee@sydneyuniversitycanoeclub.com.au","","Recover Access",'hello your new password is: '.$pass,$smtp);




$_SESSION["waiting"]="New Password sent to email: ".$email;
unset($_SESSION['usr_id']);
    header('Location: ./login.php');



