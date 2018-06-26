<?php

include "dbConnectAdmin.php";
$sql = "delete from product 
        where idProduct = ".$_POST['idProduct'].";";
$result = mysqli_query($conn,$sql);

if($result!=false){
    echo 'Success';
}
else{
    echo 'fail';
}
?>