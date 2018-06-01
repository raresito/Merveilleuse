<?php

include "../dbconnect.php";
//echo $_POST['userID'];
$sql = "delete from users where id = ".$_POST['userID'].";";
$result = mysqli_query($conn,$sql);

if($result!=false){
    echo 'success';
}
else{
    echo 'fail';
}
?>