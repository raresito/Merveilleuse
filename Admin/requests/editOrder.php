<?php
include "dbConnectAdmin.php";

$today = date("Y-m-d");

if($_POST["set"] == "orderStatus"){
    $sql = "update `order`
        set orderStatus = 1,
        orderDate = '" .$today."'
        where idOrder = '".$_POST["id"]."'";
}

if($_POST["set"] == "deliveryStatus"){
    $sql = "update `order`
            set deliveryStatus = 1,
            deliveryDate = '" .$today."'
            where idOrder = '".$_POST["id"]."'";
}
$result = mysqli_query($conn,$sql);

if($_POST["set"] == "deliveryStatus"){

}

if($result){
    echo "Success";
} else {
    echo "Fail " . mysqli_error($conn) . var_dump($_POST);
}
?>