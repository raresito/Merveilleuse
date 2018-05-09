<?php
session_start();
var_dump($_POST);
var_dump($_SESSION);
require_once '../dbconnect.php';

if(isset($_POST['id'])){
    $checkProduct = "SELECT * FROM users_product WHERE email = '" . $_SESSION["email"] .  "' AND product_id = '".$_POST["id"]."'; ";
    $check = mysqli_query($conn, $checkProduct);
    if($check->num_rows > 0){
        $sql = "UPDATE users_product
                set quantity = quantity + 1
                where email = '".$_SESSION["email"]."' and product_id = '".$_POST["id"]."';";
        $result = mysqli_query($conn, $sql);
    }
    else{
        $sql = "INSERT INTO users_product (email, product_id) VALUES ('".$_SESSION["email"]."','".$_POST["id"] ."')";
        $result = mysqli_query($conn,$sql);
    }
    if(!$check){
        echo'No result';
        echo "Error: Our query failed to execute and here is why: \n";
        echo "Query: " . $sql . "\n";
        echo "Errno: " . $conn->errno . "\n";
        echo "Error: " . $conn->error . "\n";
    }
}
?>