<?php
include "requests/dbConnectClient.php";

use PHPMailer\PHPMailer\PHPMailer;
require '../vendor/autoload.php';

$sql = "update `order`
        set orderStatus = 1, orderDate = CURDATE()
        where idOrder = " .$_POST["id"].";";
$result = mysqli_query($conn,$sql);

if(!$result){
    die("Failed to modify order!");
}

$sql = "insert into addresses (surname, nameAddress, emailAddress, phone, location)
        values ('" .$_POST["lastName"]."', '".$_POST["name"]."','".$_POST["email"]."','".$_POST["mobil"]."','".$_POST["address"]."')";
$result = mysqli_query($conn,$sql);

if($result){
    $sql = "select *
            from `order` join `product-order`
              on `order`.idOrder = `product-order`.idOrder
              join product on product.idProduct = `product-order`.idProduct
            where `order`.idOrder = 40";
    $result = mysqli_query($conn,$sql);

    echo "Success";
    $subiect = 'Merveilleuse - Comanda nr.' . $_POST["id"];
    $mesaj =  'Multumim pentru comanda efectuata! Iata datele tale: <br> Destinatar ' .
        $_POST["lastName"]. ' ' .
        $_POST['name']. ' '.
        $_POST["mobil"]. " ".
        $_POST["address"]. " <br>";
    while($row = $result->fetch_assoc()){
        $mesaj = $mesaj . $row["idProduct"] . ", " . $row["nameProduct"] . ", " . $row["priceProduct"] * $row["quantity"] . "<br>" ;
    }
    sendMailMin($_POST["email"],$mesaj);
} else {
    $sql = "update `order`
        set orderStatus = 0
        where idOrder = " .$_POST["id"].";";
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
