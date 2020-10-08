<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

// Load Composer's autoloader
//require 'vendor/autoload.php';

require 'vendor/phpmailer/phpmailer/src/Exception.php';
require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/SMTP.php';


$mail = new PHPMailer(true);

try {

    //Server settings
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                 // Enable verbose debug output
    $mail->SMTPDebug = SMTP::DEBUG_OFF;                      // Enable verbose debug output
    $mail->isSMTP();                                         // Send using SMTP
    $mail->Host       = 'in-v3.mailjet.com';                 // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                // Enable SMTP authentication
    $mail->Username   = getenv('MJ_APIKEY_PUBLIC');          // SMTP username
    $mail->Password   = getenv('MJ_APIKEY_PRIVATE');         // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;      // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
    //$mail->SMTPSecure = 'ssl';
    $mail->Port       =  587;                                // TCP port to connect to 465 (ssl), 587 o 25

    //Recipients
    $mail->setFrom('admin@erasmusiesjaroso.com', 'Correo de prueba');
    $mail->addAddress('jjavierguillen@gmail.com', 'Javier');     // Add a recipient
    //$mail->addAddress('ellen@example.com');               // Name is optional
    //$mail->addReplyTo('info@example.com', 'Information');
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    // Attachments
    //$mail->addAttachment('prueba.pdf');         // Add attachments

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Email de prueba con PHPMailer';
    $mail->Body    = 'Este es el cuerpo del mensaje <b>PHPMailer</b>';
    $mail->AltBody = 'Este es el cuerpo del mensaje para clientes de correo sin soporte HTML';

    $mail->send();
    echo 'Mensaje enviado';
} catch (Exception $e) {
    echo "Mensaje no enviado. Mailer Error: {$mail->ErrorInfo}";
}


?>
