<?php

include "dbConnectClient.php";

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}



    $sql = "select po.order_id, po.quantity, po.product_id, pt.nameProduct, pt.priceProduct, pt.unitProduct, pt.image
            from products_orders po join producttable pt
            on pt.idProduct = po.product_id
            where order_id in (select orderID 
                                from orders 
                                where orderStatus = 1 
                                and userID = (SELECT id
                                              from users
                                              where email = '".$_SESSION["email"]."'))
             order by po.order_id";



    $result = mysqli_query($conn,$sql);

    $arr = array();
    while($row = mysqli_fetch_assoc($result)){
        $arr[] = $row;
    }

    echo json_encode($arr);

?>