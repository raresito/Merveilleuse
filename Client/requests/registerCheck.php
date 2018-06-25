<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include 'dbConnectClient.php';

$activationKey = bin2hex(openssl_random_pseudo_bytes(10));
$sql = "INSERT INTO users (email, password, lastLogin, name, validation) 
        VALUES('" . $_POST["email"] . "','" . md5($_POST["password"]) . "','" . date("Y-m-d H:i:s") . "','" . $_POST["surname"] . " " . $_POST["name"] . "', '".$activationKey."')";

$result = mysqli_query($conn, $sql);

if(!$result && $conn->errno == 1062){
    echo "Account exists!";
} else {
    if(isset($result)){
        echo $activationKey;
    }
}

