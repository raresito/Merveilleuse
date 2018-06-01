<?php

include "../dbconnect.php";

if($_POST["type"] == "default"){
    $sql = "select * from orders";

    $result = mysqli_query($conn,$sql);

    $arr = array();
    while($row = mysqli_fetch_assoc($result)){
        $arr[] = $row;
    }

    echo json_encode($arr);
} elseif ($_POST["type"] == "open"){
    $sql = "select * from orders where orderStatus = 0";
    $result = mysqli_query($conn,$sql);
    echo $result ->num_rows;

}


?>