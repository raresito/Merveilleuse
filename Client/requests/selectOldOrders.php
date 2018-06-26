<?php

include "dbConnectClient.php";

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}



    $sql = "select po.order_id, po.quantity, po.product_id, pt.nameProduct, pt.priceProduct, pt.unitProduct, pt.image
            from `product-order` po join producttable pt
            on pt.idProduct = po.product_id
            where idOrder in (select idOrder 
                                from `order` 
                                where orderStatus = 1 
                                and idUser = (SELECT idUser
                                              from user
                                              where emailUser = e" .$_SESSION["email"]. "mail))
             order by po.order_id";



    $result = mysqli_query($conn,$sql);

    $arr = array();
    while($row = mysqli_fetch_assoc($result)){
        $arr[] = $row;
    }

    echo json_encode($arr);

?>