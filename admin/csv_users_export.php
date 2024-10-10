<?php
include_once "./config.php";
if ($_SESSION["tipo_usuario"] != 1) {

  header('Location: ./home.php');

}
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="users.csv"');
$sql = "select * from usuarios";

$result=mysqli_query($link, $sql);


$fields = array('name', 'pre_name', 'phone', 'email', 'is_student', 'id_number', 'emergency_contact_name', 'emergency_contact_phone', 'user_type', 'status', 'payment_date', 'subscription_deadline');




$out = fopen('php://output', 'w');
fputcsv($out, $fields);

while ($fila = mysqli_fetch_assoc($result)) {

  fputcsv($out, array( $fila['nombre'], $fila['name_pre'], $fila['telefono'], $fila['correo'],
   $fila['is_student'], $fila['id_numero'], $fila['emergency_contact_name'], $fila['emergency_contact_phone'], $fila['tipo_usuario'], $fila['status'], $fila['fecha_pago'], $fila['fechalimite_suscripcion']));

}

fclose($out);












?>