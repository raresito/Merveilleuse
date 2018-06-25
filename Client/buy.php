<?php
include "requests/dbConnectClient.php";

use PHPMailer\PHPMailer\PHPMailer;
require '../vendor/autoload.php';

var_dump($_POST);

$sql = "update orders
        set orderStatus = 1
        where orderID = ".$_POST["id"].";";
$result = mysqli_query($conn,$sql);



if(!$result){
    die("Failed to modify order!");
}

$sql = "insert into adresses (name, surname, email, phone, location)
        values ('".$_POST["lastName"]."', '".$_POST["name"]."','".$_POST["email"]."','".$_POST["mobil"]."','".$_POST["address"]."')";
$result = mysqli_query($conn,$sql);

if($result){
    echo "Success";
    $subiect = 'Merveilleuse - Comanda nr.' . $_POST["id"];
    $mesaj =  'Multumim pentru comanda efectuata! Iata datele tale: \n Destinatar' . $_POST["lastName"]. ' ' . $_POST['name']. '\n '. $_POST["mobil"]. " \n ". $_POST["address"];
    sendMailMin($_POST["email"],$mesaj);
} else {
    $sql = "update orders
        set orderStatus = 0
        where orderID = ".$_POST["id"].";";
    $result = mysqli_query($conn,$sql);
    echo "Fail " . $sql;
}


function sendMailMin($destinatar, $mesaj){
    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->SMTPDebug = 0;
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587;
    $mail->SMTPSecure = 'tls';
    $mail->SMTPAuth = true;
    $mail->Username = "raresphpcristea@gmail.com";
    $mail->Password = "googlephp";
    $mail->setFrom('raresphpcristea@gmail.com', 'Merveilleuse');
    $mail->addReplyTo('rares@raresito.com', 'Merveilleuse Minion');
    $mail->addAddress($destinatar);
    $mail->Subject = "Comanda Merveilleuse";
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
}
