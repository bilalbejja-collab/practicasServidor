<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;


error_reporting(E_ALL);
ini_set("display_errors", 1);

// Load Composer's autoloader
require 'vendor/autoload.php';

/*
require 'vendor\phpmailer\phpmailer\src\Exception.php';
require 'vendor\phpmailer\phpmailer\src\PHPMailer.php';
require 'vendor\phpmailer\phpmailer\src\SMTP.php';
*/

echo "Enviando mail con PHPMailer ...";

$mail = new PHPMailer;
//Tell PHPMailer to use SMTP
$mail->isSMTP();
//Enable SMTP debugging
// SMTP::DEBUG_OFF = off (for production use)
// SMTP::DEBUG_CLIENT = client messages
// SMTP::DEBUG_SERVER = client and server messages
/* 
$mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );

$mail->SMTPDebug = SMTP::DEBUG_SERVER;
*/

//Set the hostname of the mail server
$mail->Host = 'in-v3.mailjet.com';
// use
// $mail->Host = gethostbyname('smtp.gmail.com');
// if your network does not support SMTP over IPv6
//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->Port = 465;  //2525 o 587 sin ssl
//Set the encryption mechanism to use - STARTTLS or SMTPS
$mail->SMTPSecure = 'ssl';
//Whether to use SMTP authentication
$mail->SMTPAuth = true;
//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = 'cec1d7911e7da53bd169831912929ab8';
//Password to use for SMTP authentication
$mail->Password = '3b29ab9c8b5bd4e94e6bcfd8e518f496';
//Set who the message is to be sent from
$mail->setFrom('jjavierguillen@gmail.com');
//Set an alternative reply-to address
//$mail->addReplyTo('replyto@example.com', 'First Last');
//Set who the message is to be sent to
$mail->addAddress('josejavierguillen@gmail.com', 'JJ');
//Set the subject line
$mail->Subject = 'Prueba desde Heroku';
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
