<?php 
$rutaPHPMailer="./PHPMailer/";//debe ir ANTES DE LA FUNCION o marca error!
require_once $rutaPHPMailer."Exception.php";
require_once $rutaPHPMailer."PHPMailer.php";
require_once $rutaPHPMailer."SMTP.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


/*El SMTP donde salen los correos/**/
$smtp['server'] = 'smtp-relay.brevo.com';// Set the SMTP server to send through
$smtp['user']   = 'yop@alexcd2000.com';// SMTP username
$smtp['pwd']    = 'D9YaAnXb340Wp8ZG';// SMTP password
$smtp['secure'] = 'tls';// Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
$smtp['port']   = 587;// TCP port to connect to, use 465 for PHPMailer::ENCRYPTION_SMTPS` above

//prueba
//echo enviarmail("alejandrocastanondiaz@gmail.com","Cliente","webmaster@kanetest.com.mx","Kanetest","Prueba".date('d/m/Y G:i:s', time()),'This is the HTML message body <b>in bold!</b>',$smtp);//esta envia los mails usando la libreria, ponlo después de esos requires
/**/   

//asi la usas desde otro archivo
/*include_once "./PHPMailer/EnviarEmail.php";
$tomail=$_POST[''];
$toname=$_POST[''];
$frommail=$_POST[''];
$fromname=$_POST[''];
$subj=$_POST[''];
$msg=$_POST[''];
enviarmail($tomail,$toname,$frommail,$fromname,$subj,$msg,$smtp);/*Smtp ya esta dentro de enviarEmail.php o lo puedes query de alguna BDD*/


//dentro del try en la función están las credenciales SMTP que tu pasas en la funcion
function enviarmail($To,$Name,$From,$Fromname,$Subject,$MailHtml,$smtp){
// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->Host       = $smtp['server'];// Set the SMTP server to send through
    $mail->Username   = $smtp['user'];// SMTP username
    $mail->Password   = $smtp['pwd'];// SMTP password
    $mail->SMTPSecure = $smtp['secure'];// Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = $smtp['port'];// TCP port to connect to, use 465 for PHPMailer::ENCRYPTION_SMTPS` above
    /*Originales por si acaso
    $mail->Host       = 'smtp.ionos.mx';// Set the SMTP server to send through
    $mail->Username   = 'webmaster@kanetest.com.mx';// SMTP username
    $mail->Password   = 'Kanetest1.';// SMTP password
    $mail->SMTPSecure = 'tls';// Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;// TCP port to connect to, use 465 for PHPMailer::ENCRYPTION_SMTPS` above
    /**/

	// Activo condificacción utf-8
	$mail->CharSet = 'UTF-8';
	
	$mail->SMTPDebug = 0;                                       // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication

    //Recipients
    $mail->setFrom($From, $Fromname);
    $mail->addAddress($To,$Name);     // Add a recipient
    //$mail->addAddress('ellen@example.com');   //multiples correos separados se valen
    
    //$mail->addReplyTo('website@youneedyour.website', 'Information');
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    // Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = $Subject;
    $mail->Body    = $MailHtml;
    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    return 'OK! Message has been sent to '.$To." / ".$Subject;
} catch (Exception $e) {
    return "Mailer Error: {$mail->ErrorInfo}";
}    
}







?>
