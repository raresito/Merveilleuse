<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include '../../dbconnect.php';

$sql = "SELECT * 
        FROM users 
        WHERE email ='" . $_POST['email'] . "' 
        AND password = '" . md5($_POST['password']) . "';";

$result = mysqli_query($conn, $sql);

if($result && $result->num_rows == 1){
    $row = $result -> fetch_assoc();
    $_SESSION["email"] = $row["email"];
    $_SESSION["name"] = $row["name"];
    $sql = "UPDATE users 
            SET lastLogin = '" . date("Y-m-d H:i:s") . "' 
            WHERE email ='" . $_POST['email'] . "';";
    $changeLastLogin = mysqli_query($conn,$sql);
    if(!$changeLastLogin){
        echo 'Fail!' . $sql;
    } else {
        echo 'Success!';
    }
} else {
    echo 'Wrong!';
}

