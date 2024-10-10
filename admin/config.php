<?php
session_start();

$actual_link = $_SERVER['HTTP_HOST'];
if ($actual_link == 'localhost') {
    $host_name = '127.0.0.1';
    $user_name = "root";
    $password = "";
    $database = 'usyddkuf_database';
} else {
    $host_name = 'localhost';
    $user_name = "usyddkuf_user";
    $password = "horseeatingalemon";
    $database = 'usyddkuf_database';
}


$link = mysqli_connect($host_name, $user_name, $password, $database);
if ($link->connect_error) {
    die("Connection failed: " . $link->connect_error);
} else {/* echo "Connected successfully";/**/
}
/*character set to utf8mb4 */
$link->set_charset("utf8mb4");




//check user expire date payment notificaction 
$sql = "SELECT id, avatar, nombre, name_pre,  correo, fechalimite_suscripcion,
 DATEDIFF(fechalimite_suscripcion,CURRENT_DATE) as day_rest, noti_30days,
  noti_7days, noti_1days FROM usuarios where tipo_usuario=2 and fechalimite_suscripcion!='0000-00-00'";
$result = mysqli_query($link, $sql);
while ($fila = mysqli_fetch_assoc($result)) {
    $sql = '';
    $send_email = 0;
    if ($fila["day_rest"] == 30 && $fila["noti_30days"] == 0) {
        $send_email = 1;
        $sql = "UPDATE usuarios SET  noti_30days=1 where id=" . $fila["id"];
    }

    if ($fila["day_rest"] == 7 && $fila["noti_7days"] == 0) {
        $send_email = 1;
        $sql = "UPDATE usuarios SET  noti_7days=1 where id=" . $fila["id"];
    }

    if ($fila["day_rest"] == 1 && $fila["noti_1days"] == 0) {
        $send_email = 1;
        $sql = "UPDATE usuarios SET  noti_1days=1 where id=" . $fila["id"];
    }
    if ($sql != '')
        mysqli_query($link, $sql);


    if ($send_email == 1) {
        $sql = "select subject, msg from email_template where num_type=12";


        $result = mysqli_query($link, $sql);
        $email = mysqli_fetch_assoc($result);
        $subject = $email["subject"];
        $msg = str_replace("!name!", $fila["nombre"], $email["msg"]);
        $msg = str_replace("!date_expire!", $fila["fechalimite_suscripcion"], $msg);


        require_once __DIR__ . "/PHPMailer/EnviarEmail.php";
        enviarmail($fila["correo"], "", "committee@sydneyuniversitycanoeclub.com.au", "", $subject, $msg, $smtp);
    }

}



    //Delete user with unverified email

    $sql = "delete FROM usuarios WHERE  registration_date!='".date('Y-m-d')."' and email_activated=0";
    $result = mysqli_query($link, $sql);


