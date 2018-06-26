<?php

include "dbConnectClient.php";

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}



    $sql = "select po.idOrder, po.quantity, po.idProduct, pt.nameProduct, pt.priceProduct, pt.unitProduct, pt.image
            from `product-order` po join product pt
            on pt.idProduct = po.idProduct
            where idOrder in (select idOrder 
                                from `order` 
                                where orderStatus = 1 
                                and idUser = (SELECT idUser
                                              from user
                                              where emailUser = " .$_SESSION["email"]. "))
             order by po.idOrder";



    $result = mysqli_query($conn,$sql);

    $arr = array();
    while($row = mysqli_fetch_assoc($result)){
        $arr[] = $row;
    }

    echo json_encode($arr);

?>