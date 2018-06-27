<?php

include "dbConnectAdmin.php";
$sql = "delete from product 
        where idProduct = ".$_POST['idProduct'].";";
$result = mysqli_query($conn,$sql);

if($result!=false){
    $sql = "select nameProduct
            from product
            where idProduct =" . $_POST['idProduct'].";";
    echo mysqli_query($conn, $sql)->fetch_assoc()["nameProduct"];
}
else{
    echo 'fail';
}
?>