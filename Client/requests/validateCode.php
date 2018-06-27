<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include 'dbConnectClient.php';

$sql = "SELECT validation
        FROM user
        where emailUser='" . $_POST["email"] . "';";

$result = mysqli_query($conn, $sql);
$row = $result ->fetch_assoc();
if($row["validation"] == $_POST["code"]){
    echo "ok";
    $sql = "UPDATE user
            set validation = 1
            where emailUser = '" .$_POST["email"]."' ;";
    $re = mysqli_query($conn, $sql);
    if(!$re){
        echo $conn->error;
    }
}