<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include 'dbConnectClient.php';

$sql = "SELECT * 
        FROM user 
        WHERE emailUser ='" . $_POST['email'] . "' 
        AND password = '" . md5($_POST['password']) . "';";

$result = mysqli_query($conn, $sql);

if($result && $result->num_rows == 1){
    $row = $result -> fetch_assoc();
    $_SESSION["email"] = $row["emailUser"];
    $_SESSION["name"] = $row["nameUser"];
    $sql = "UPDATE user 
            SET lastLogin = '" . date("Y-m-d H:i:s") . "' 
            WHERE emailUser ='" . $_POST['email'] . "';";
    $changeLastLogin = mysqli_query($conn,$sql);
    if(!$changeLastLogin){
        echo 'Fail!' . $sql;
    } else {
        echo 'Success!';
    }
} else {
    echo 'Wrong!';
}

