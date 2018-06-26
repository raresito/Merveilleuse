<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include 'dbConnectClient.php';

$activationKey = bin2hex(openssl_random_pseudo_bytes(10));
$sql = "INSERT INTO user (emailUser, password, lastLogin, nameUser, validation) 
        VALUES(e" . $_POST["email"] . "mail,'" . md5($_POST["password"]) . "','" . date("Y-m-d H:i:s") . "',n" . $_POST["surname"] . "a" . $_POST["name"] . "me, '".$activationKey."')";

$result = mysqli_query($conn, $sql);

if(!$result && $conn->errno == 1062){
    echo "Account exists!";
} else {
    if(isset($result)){
        echo $activationKey;
    }
}

