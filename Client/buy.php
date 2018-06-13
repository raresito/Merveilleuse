<?php
include "../dbconnect.php";

$sql = "update orders
        set orderStatus = 1
        where orderID = ".$_POST["id"].";";
$result = mysqli_query($conn,$sql);

if(!$result){
    die("Failed to modify order!");
}

$sql = "insert into adresses (name, surname, email, phone, location)
        values ('".$_POST["lastName"]."', '".$_POST["name"]."','".$_POST["email"]."','".$_POST["mobil"]."','".$_POST["address"]."')";
$result = mysqli_query($conn,$sql);

if($result){
    echo "Success";
} else {
    echo "Fail " . $sql;
}
?>