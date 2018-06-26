<?php
include "dbConnectAdmin.php";
$sql = "insert into product (nameProduct, priceProduct, unitProduct, image, category)
        values ('" .$_POST["newProductName"]."',
         ".$_POST["newProductPrice"].",
          '".$_POST["newProductUnit"]."',
           '".$_POST["newProductPhoto"]."',
           '".$_POST["newProductCategory"]."')";
$result = mysqli_query($conn,$sql);

if($result){
    echo "Success";
} else {
    echo "Fail " . $sql;
}
?>