<?php

include "dbConnectAdmin.php";
//echo $_POST['userID'];
$sql = "delete from user where idUser = ".$_POST['userID'].";";
$result = mysqli_query($conn,$sql);

if($result!=false){
    echo 'success';
}
else{
    echo 'fail';
}
?>