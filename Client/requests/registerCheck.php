<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include '../../dbconnect.php';

$sql = "INSERT INTO users (email, password, lastLogin, name) 
        VALUES('" . $_POST["email"] . "','" . md5($_POST["password"]) . "','" . date("Y-m-d H:i:s") . "','" . $_POST["surname"] . " " . $_POST["name"] . "')";

$result = mysqli_query($conn, $sql);

if(!$result && $conn->errno == 1062){
    echo "Account exists!";
} else {
    if(isset($result)){
        echo "Success!";
    }
}

