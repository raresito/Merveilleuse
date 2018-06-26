<?php
include "dbConnectClient.php";

if($_POST["quant"] < 0){
    die("Hacker detected!");
}

if($_POST["quant"] == 0){
    $sql = "delete from `product-order` where idOrder = " .$_POST['idOrder']." AND product_id = ".$_POST['idProd'].";";
    $result = mysqli_query($conn,$sql);
}

$sql = "update `product-order`
        set quantity = ".$_POST["quant"]."
        where order_id = ".$_POST["idOrder"]." AND product_id = ".$_POST["idProd"].";";
$result = mysqli_query($conn,$sql);

if($result){
    echo "Success" . $sql;
} else {
    echo "Fail " . var_dump($_POST);
}

?>