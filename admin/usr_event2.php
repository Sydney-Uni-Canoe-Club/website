<?php 
/*
var_dump($_POST);
$_POST["id_evnt"]
$_POST["places"]
*/


include_once "./config.php";
require_once './stripe-php/init.php';
    
    $sql="select * from eventos where id=".$_POST["id_evnt"];
    $result= mysqli_query($link, $sql);

$fila = mysqli_fetch_assoc($result);


$disponible=$fila ["cupo_limite"]-$fila ["cupos_usados"];

if($disponible<$_POST["places"])
 {

  $_SESSION["err"] = "places not available!";
  header('Location: ./usr_event.php?id='.$_POST["id_evnt"]);
  die();
}

/*
//star stripe
\Stripe\Stripe::setApiKey('sk_test_51K29ybA4XIu8BPj5Kol2R438mwcaUJUvttC7sRHBckm5EOGCrzZDG4MX9l9ZpQnTIag31wdvZTO91t0Il9Qjl6Ef00ZiO4GBJs');

// Obtener el token de Stripe enviado desde el formulario
$token = $_POST['stripeToken']; // Token generado por Stripe.js
$amount =  $_POST['monto']*100; // Monto a cobrar en centavos (5000 centavos = 50.00 USD)
$currency = 'AUD'; // Moneda en la que se hará el cobro

try {
    // Crear un cargo
    $charge = \Stripe\Charge::create([
        'amount' => $amount,
        'currency' => $currency,
        'source' => $token,
        'description' => 'Cobro de prueba',
    ]);

    echo 'Pago realizado con éxito. ID de la transacción: ' . $charge->id;
$id_pay=$charge->id;




$charge=json_encode($charge);


$resp_api=$charge;


} catch (\Stripe\Exception\CardException $e) {
    // Manejo de errores de la tarjeta
    $_SESSION["err"]= 'Error: ' . $e->getError()->message;
    $error=1;
}

//end stripe

*/



$sql="INSERT INTO evento_usuario(hevento, husuario, cupos, type)
 VALUES ('".$_POST["id_evnt"]."','".$_SESSION["usr_id"]."','".$_POST["places"]."','".$_POST["type"]."')";

mysqli_query($link, $sql);

$sql="UPDATE eventos SET cupos_usados=cupos_usados+".$_POST["places"]." WHERE id=".$_POST["id_evnt"];
mysqli_query($link, $sql);
$_SESSION["tipo"] = "1";
$_SESSION["msg"] = " Registered at the event.";




require_once __DIR__ . "/PHPMailer/EnviarEmail.php";

//notifation user
$sql = "select subject, msg from email_template where num_type=5";  

$result = mysqli_query($link, $sql);
$fila = mysqli_fetch_assoc($result);
$subject=$fila["subject"];
$name = $_SESSION["usr_nombre"];
$msg = str_replace("!name!", $name, $fila["msg"]);
$email=$_SESSION["usr_email"];
echo enviarmail($email,"","committee@sydneyuniversitycanoeclub.com.au","",$subject,$msg,$smtp);


//trip leader notification

$sql = "select subject, msg from email_template where num_type=7";  

$result = mysqli_query($link, $sql);
$fila = mysqli_fetch_assoc($result);
$subject=$fila["subject"];
$name = $_SESSION["usr_nombre"];
$msg = str_replace("!name!", $name, $fila["msg"]);
$email = $_SESSION["usr_email"];
$msg = str_replace("!email!", $email, $msg);
$msg = str_replace("!name_eve!", $_POST["nombre"], $msg);
$msg = str_replace("!date!", $_POST["fecha_inicio"], $msg);

if($_POST["type"]==1)
$_POST["type"]="Interested";
else if($_POST["type"]==2)
$_POST["type"]="Committed";

$msg = str_replace("!status!", $_POST["type"], $msg);

$sql="SELECT correo FROM usuarios WHERE id in (select husuario from eventos where id=".$_POST["id_evnt"].")";
$result = mysqli_query($link, $sql);
$fila = mysqli_fetch_assoc($result);

$email=$fila["correo"];

    
echo enviarmail($email,"","committee@sydneyuniversitycanoeclub.com.au","",$subject,$msg,$smtp);


header('Location: ./home.php');



?>