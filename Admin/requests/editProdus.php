<?php
include "dbConnectAdmin.php";

$sql = "update product
        set nameProduct = '".$_POST["editNameProduct"]."',
          category = '".$_POST["editCategory"]."',
          priceProduct = ".$_POST["editPriceProduct"].",
          unitProduct = '".$_POST["editUnitProduct"]."',
          image = '".$_POST["editImageProduct"]."'
        where idProduct = '".$_POST["editID"]."'";
$result = mysqli_query($conn,$sql);

if($result){
    echo "Success";
} else {
    echo "Fail " . mysqli_error($conn) . var_dump($_POST);
}
?>