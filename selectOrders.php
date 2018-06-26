<?php

include "Admin/requests/dbConnectAdmin.php";

if($_POST["type"] == "default"){
    $sql = "select * from `order`";

    $result = mysqli_query($conn,$sql);

    $arr = array();
    while($row = mysqli_fetch_assoc($result)){
        $arr[] = $row;
    }

    echo json_encode($arr);
} elseif ($_POST["type"] == "open"){
    $sql = "select * from `order` where orderStatus = 0";
    $result = mysqli_query($conn,$sql);
    echo $result ->num_rows;

} elseif ($_POST["type"] == "single"){
    $sql = "select *
            from `product-order` po join producttable pt
            on po.product_id = pt.idProduct
            where po.order_id = " .$_POST["orderID"];
    $result = mysqli_query($conn,$sql);
    $arr = array();
    while($row = mysqli_fetch_assoc($result)){
        $arr[] = $row;
    }
    if($result -> num_rows < 1){
        echo 'Nul';
    }
    echo json_encode($arr);

} elseif ($_POST["type"] == "mine"){
    $sql = "select pt.idProduct, pt.nameProduct, pt.priceProduct, pt.unitProduct, pt.image, z.order_id as order_id, z.quantity
            from producttable pt join (
            select *
            from `product-order` po join `order` o
                on idOrder = idOrder
            where idUser = (select idUser
                            from user
                            where emailUser = e" .$_POST["email"]."mail
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