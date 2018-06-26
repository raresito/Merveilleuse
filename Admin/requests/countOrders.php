<?php

include "dbConnectAdmin.php";
$sql = "select MONTH(orderDate) as month, count(idOrder) as cnt
        from `order`
        group by MONTH(orderDate);";
$result = mysqli_query($conn,$sql);

$arr = array();
while($row = mysqli_fetch_assoc($result)){
    $arr[] = $row;
}

echo json_encode($arr);
?>