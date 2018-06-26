<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include 'dbConnectAdmin.php';

$sql = "SELECT * 
        FROM user 
        WHERE emailUser ='" . $_POST['email'] . "';";

$result = mysqli_query($conn, $sql);

if($result && $result->num_rows == 1){
    $row = $result -> fetch_assoc();
    if($row["admin"] == 1){
        check
    }
    if(!$changeLastLogin){
        echo 'Fail!' . $sql;
    } else {
        echo 'Success!';
    }
} else {
    echo 'Wrong!';
}

