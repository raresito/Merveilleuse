<?php

include "dbconnect.php";

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

} elseif ($_POST["type"] == "single"){
    $sql = "select *
            from products_orders po join producttable pt
            on po.product_id = pt.idProduct
            where po.order_id = ".$_POST["orderID"];
    $result = mysqli_query($conn,$sql);
    $arr = array();
    while($row = mysqli_fetch_assoc($result)){
        $arr[] = $row;
    }

    echo json_encode($arr);

} elseif ($_POST["type"] == "mine"){
    $sql = "select pt.idProduct, pt.nameProduct, pt.priceProduct, pt.unitProduct, pt.image, z.order_id, z.quantity
            from producttable pt join (
            select *
            from products_orders po join orders o
                on orderID = order_id
            where userID = (select id
                            from users
                            where email = '".$_POST["email"]."'
                            limit 1)
            and orderStatus = 0) z
            on z.product_id = pt.idProduct
            ;";
    $result = mysqli_query($conn, $sql);
    $arr = array();
    while($row = mysqli_fetch_assoc($result)){
        $arr[] = $row;
    }

    echo json_encode($arr);
}


?>