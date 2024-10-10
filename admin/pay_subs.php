<?php
include_once "./config.php";
require_once './stripe-php/init.php';


$sql="SELECT * FROM settings";

$result= mysqli_query($link,  $sql);
$row = mysqli_fetch_assoc($result);

//star stripe $row["stripe_creden"]
//\Stripe\Stripe::setApiKey('sk_test_51K29ybA4XIu8BPj5Kol2R438mwcaUJUvttC7sRHBckm5EOGCrzZDG4MX9l9ZpQnTIag31wdvZTO91t0Il9Qjl6Ef00ZiO4GBJs');
\Stripe\Stripe::setApiKey($row["stripe_secret"]);

$error = 0;
// Obtener el token de Stripe enviado desde el formulario
$token = $_POST['stripeToken']; // Token generado por Stripe.js
$amount = $_POST['monto'] * 100; // Monto a cobrar en centavos (5000 centavos = 50.00 USD)
$currency = 'AUD'; // Moneda en la que se hará el cobro

try {
    // Crear un cargo
    $charge = \Stripe\Charge::create([
        'amount' => $amount,
        'currency' => $currency,
        'source' => $token,
        'description' => 'payment subscription',
    ]);

   // echo 'Pago realizado con éxito. ID de la transacción: ' . $charge->id;
    $id_pay = $charge->id;
    //$_SESSION["success_pay"] = "Successful payment, id transaction:".$id_pay;
    $charge = json_encode($charge);
    $resp_api = $charge;


} catch (\Stripe\Exception\CardException $e) {
    // Manejo de errores de la tarjeta
    $_SESSION["err"] = 'Error: ' . $e->getError()->message;
    $error = 1;
}

//end stripe


if ($error == 0) {


    $sql = "select * from usuarios where id=" . $_SESSION["usr_id"];
    $result = mysqli_query($link, $sql);
    
    $fila = mysqli_fetch_assoc($result);
    
    
    $fecha_pago = $fila["fecha_pago"] ;
    
    if ($fecha_pago=='0000-00-00')
    {
        $fecha_pago=date('Y-m-d');
    
    
        
    }
    
    
    $new_date=date('Y-m-d', strtotime("+1 year")) ;
    $_SESSION["fecha_limite"]=$new_date;
    $deco=json_decode($resp_api);



    
  $sql="INSERT INTO pagos(husuario, json_stripe, monto, fecha, url_stripe) 
  VALUES ('" . $_SESSION["usr_id"] . "','$charge','" . $_POST["monto"] . "','".date('Y-m-d')."','".$deco->receipt_url."')";  


    mysqli_query($link, $sql);
    $sql= "UPDATE usuarios SET fecha_pago='".date('Y-m-d')."', fechalimite_suscripcion='".$new_date."',noti_30days=0, noti_7days=0, noti_1days=0 where id=". $_SESSION["usr_id"]; 
    mysqli_query($link, $sql);
    $_SESSION["tipo"] = "1";
    $_SESSION["success_pay"] = "Pay successful. ID: " . $id_pay." URL payment: ".$deco->receipt_url;

    


    $sql = "select subject, msg from email_template where num_type=10";
    $name = $_SESSION["usr_nombre"];
    
    $result = mysqli_query($link, $sql);
    $fila = mysqli_fetch_assoc($result);
    
    $msg = str_replace("!name!", $name, $fila["msg"]);
    $subject=$fila["subject"];

    $msg = str_replace("!url_pay!", $deco->receipt_url, $msg);

    require_once __DIR__ . "/PHPMailer/EnviarEmail.php";

    echo enviarmail($_SESSION["usr_email"],"","committee@sydneyuniversitycanoeclub.com.au","",$subject,$msg,$smtp);
    

   header('Location: ./profile.php');
} else {


    header('Location: ./profile.php');

}

?>