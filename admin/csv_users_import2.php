<?php
include_once "./config.php";
//error_reporting(0);
$csv = array();

// check there are no errors
if ($_FILES['csv']['error'] == 0) {
    $name = $_FILES['csv']['name'];

    $type = $_FILES['csv']['type'];
    $tmpName = $_FILES['csv']['tmp_name'];

    // check the file is a csv

    if (($handle = fopen($tmpName, 'r')) !== FALSE) {
        // necessary if a large csv file
        set_time_limit(0);

        $row = 0;
$count=0;
        while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
            // number of fields in the csv
            if ($row == 0) {
                $row = 1;
                continue;
            }







            $sql = "select * from usuarios where correo='" . $data[3] . "'";
            $result = mysqli_query($link, $sql);
            $fila = mysqli_fetch_assoc($result);

            if ($fila != null && count($data)==12) {
                continue;
            }

            $sql = "INSERT INTO usuarios (nombre,name_pre,telefono,correo,is_student,id_numero,emergency_contact_name,emergency_contact_phone,tipo_usuario,status,fecha_pago,fechalimite_suscripcion)
            values('" . $data[0] . "','" . $data[1] . "','" . $data[2] . "','" . $data[3] . "','" . $data[4] . "','" . $data[5] . "','" . $data[6] . "','" . $data[7] . "','" . $data[8] . "','" . $data[9] . "','" . $data[10] . "','" . $data[11] . "')";

           
            // inc the row
            $count++;
            mysqli_query($link, $sql);
        }
        fclose($handle);
    }

    $_SESSION["success"] = "Users Imported: ". $count;
    header('Location: ./admin_user.php');

}



