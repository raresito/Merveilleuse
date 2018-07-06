<?php

require_once 'dbConnectAdmin.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$sql = "SELECT * 
        FROM user 
        WHERE emailUser ='" . $_POST['email'] . "' 
        AND admin = 1 
        AND password = '".md5($_POST["password"])."';";

$result = mysqli_query($conn,$sql);

echo $conn->error;

if ($result->num_rows > 0) {
    while ($row = $result -> fetch_assoc()) {
        $_SESSION["email"] = $row["emailUser"];
        $_SESSION["name"] = $row["nameUser"];
    }

    echo "Success";
}
else echo "nut";

