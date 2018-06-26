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

if ($result->num_rows > 0) {
    while ($row = $result -> fetch_assoc()) {
        $_SESSION["email"] = $row["email"];
        $_SESSION["name"] = $row["name"];
    }

    echo "Success";
}
        /*else{
            echo '<div class="alert alert-danger" role="alert">
                                A apărut o problemă, mai încearcă odată!
                            </div>';

        }*/
else{
    header("Location: dashboard.php");
}