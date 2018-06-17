<?php
session_start();

$destinatar = 'raresito@gmail.com';
$denumireDestinatar = 'John Doe';
$subiectMail = 'Generic Subject';

if(isset($_POST['email'])){
    $destinatar = $_POST['email'];
}

if(isset($_POST['nume'])){
    $denumireDestinatar = $_POST['nume'];
}

if(isset($_POST['subiectMail'])){
    $subiectMail = $_POST['subiectMail'];
}

//Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
require '../vendor/autoload.php';
//Create a new PHPMailer instance
$mail = new PHPMailer;
//Tell PHPMailer to use SMTP
$mail->isSMTP();
//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug = 0;
//Set the hostname of the mail server
$mail->Host = 'smtp.gmail.com';
// use
// $mail->Host = gethostbyname('smtp.gmail.com');
// if your network does not support SMTP over IPv6
//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->Port = 587;
//Set the encryption system to use - ssl (deprecated) or tls
$mail->SMTPSecure = 'tls';
//Whether to use SMTP authentication
$mail->SMTPAuth = true;
//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = "raresphpcristea@gmail.com";
//Password to use for SMTP authentication
$mail->Password = "googlephp";
//Set who the message is to be sent from
$mail->setFrom('raresphpcristea@gmail.com', 'Merveilleuse');
//Set an alternative reply-to address
$mail->addReplyTo('rares@raresito.com', 'Merveilleuse Minion');
//Set who the message is to be sent to
$mail->addAddress($destinatar, $denumireDestinatar);
//Set the subject line
$mail->Subject = $subiectMail;
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
$mail->msgHTML('Something', __DIR__);
//Replace the plain text body with one created manually
$mail->AltBody = 'This is a plain-text message body';

$mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);
//Attach an image file
//$mail->addAttachment('images/phpmailer_mini.png');
//send the message, check for errors
if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message sent!";
}

?>