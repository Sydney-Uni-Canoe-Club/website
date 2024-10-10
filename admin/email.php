<?php 
ini_set('display_errors', 1);ini_set('display_startup_errors', 1);error_reporting(E_ALL);//Activa ver warnings


require_once __DIR__."/PHPMailer/EnviarEmail.php";



echo enviarmail("josedelia1@gmail.com","Sydney Uni Canoe Club","australia@trips.club","Sydney Uni Canoe Club","successfully registered",'Thank you for registering, when your registration is approved you will be notified by email',$smtp);


