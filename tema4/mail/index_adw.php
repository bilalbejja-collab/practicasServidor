<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

error_reporting(E_ALL);
ini_set("display_errors", 1);

// Load Composer's autoloader
require 'vendor/autoload.php';

echo "Enviando mail con PHPMailer ...";

$mail = new PHPMailer;
//Tell PHPMailer to use SMTP
$mail->isSMTP();
//$mail->SMTPDebug = SMTP::DEBUG_SERVER;   //Para depurar los mensajes de error del correo. IMPORTANTE
//Set the hostname of the mail server
$mail->Host = 'free.mboxhosting.com';

//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->Port = 465;  //2525 o 587 sin ssl
//Set the encryption mechanism to use - STARTTLS or SMTPS
$mail->SMTPSecure = 'ssl';
//Whether to use SMTP authentication
$mail->SMTPAuth = true;
//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = "iesjaroso@iesjaroso.tk";
//Password to use for SMTP authentication
$mail->Password = "jaroso2021";  //Usar un token de Gmail (Cuenta -> Seguridad -> Contraseñas de aplicaciones)
//Set who the message is to be sent from
$mail->setFrom('iesjaroso@iesjaroso.tk');
//Set who the message is to be sent to
$mail->addAddress('jjavierguillen@gmail.com');
//Set the subject line
$mail->Subject = 'Adwards desde Heroku';
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
$mail->msgHTML("<body><h2>Hoooola</h2></body>", __DIR__);
//Replace the plain text body with one created manually
$mail->AltBody = 'This is a plain-text message body';
//Attach an image file
$mail->addAttachment('prueba.pdf');
//send the message, check for errors
if (!$mail->send()) {
    echo 'Mailer Error: '. $mail->ErrorInfo;
} else {
    echo 'Message sent!';
}

?>
