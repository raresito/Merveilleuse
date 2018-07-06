<?php

$servername = "localhost";
$username = "rares";
$password = "creative5436";
$dbname = "merveilleuse";

// Create connection
$conn = mysqli_connect($servername, $username, $password,$dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$conn->set_charset("utf8");
?>