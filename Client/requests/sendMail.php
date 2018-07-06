<?php
session_start();

$destinatar = 'rares@raresito.com';
$denumireDestinatar = 'John Doe';
$subiectMail = 'Comanda Merveilleuse';
$fromName = 'Merveilleuse';
$fromEmail = 'rares@raresito.com';
$replyTo = 'rares@raresito.com';
$mesaj = '';

if(isset($_POST['email'])){
    $destinatar = $_POST['email'];
}

if(isset($_POST['nume'])){
    $denumireDestinatar = $_POST['nume'];
}

if(isset($_POST['subiectMail'])){
    $subiectMail = $_POST['subiectMail'];
}

if(isset($_POST['fromName'])){
    $fromName = $_POST['fromName'];
}

if(isset($_POST['fromEmail'])){
    $fromEmail = $_POST['fromEmail'];
}

if(isset($_POST['message'])){
    $mesaj = $_POST['message'];
}

use PHPMailer\PHPMailer\PHPMailer;
require '../../vendor/autoload.php';

$mail = new PHPMailer;
$mail->isSMTP();
$mail->SMTPDebug = 0;
$mail->Host = 'smtp.gmail.com';
$mail->Port = 587;
$mail->SMTPSecure = 'tls';
$mail->SMTPAuth = true;
$mail->Username = "raresphpcristea@gmail.com";
$mail->Password = "googlephp";
$mail->setFrom($fromEmail, $fromName);
$mail->addReplyTo($fromEmail, 'Merveilleuse Minion');
$mail->addAddress($destinatar,$denumireDestinatar);
$mail->Subject = $subiectMail;
$mail->msgHTML($mesaj, __DIR__);
$mail->AltBody = 'This is a plain-text message body';

$mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);

if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message sent!";
}

?>