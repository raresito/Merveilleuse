<?php

include "dbConnectClient.php";

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$subtotal = 0;

if(isset($_SESSION['email'])) {
    $sql = "select ar.emailUser, ar.idOrder,ar.idProduct,ar.quantity, pt.nameProduct, pt.priceProduct, pt.unitProduct, pt.image, pt.category
                            from(
                                select emailUser, po.idOrder, idProduct, quantity
                                    from (
                                        select u.emailUser, o.idOrder, o.orderStatus
                                            from user u join `order` o
                                            on u.idUser = o.idUser
                                            where u.emailUser = " . $_SESSION["email"] . " && orderStatus = 0) prev
                                    join `product-order` po
                                    on prev.idOrder = po.idOrder ) ar join product pt
                            on ar.idProduct = pt.idProduct;";
    $result = mysqli_query($conn, $sql);
    $arr = array();
    if ($result -> num_rows > 0) {
        while ($rowProduct = $result -> fetch_assoc()) {
            $arr[] = $rowProduct;
        }
    }

    echo json_encode($arr);

}

?>