<?php

include "../dbconnect.php";
$sql = "select * from users";
$result = mysqli_query($conn,$sql);

$arr = array();
while($row = mysqli_fetch_assoc($result)){
    $arr[] = $row;
}

echo json_encode($arr);
?>