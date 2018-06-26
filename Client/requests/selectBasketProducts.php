<?php

include "dbConnectClient.php";

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$subtotal = 0;

if(isset($_SESSION['email'])) {
    $sql = "select ar.email, ar.order_id,ar.product_id,ar.quantity, pt.nameProduct, pt.priceProduct, pt.unitProduct, pt.image, pt.category
                            from(
                                select emailUser, idOrder, idProduct, quantity
                                    from (
                                        select u.email, o.orderID, o.orderStatus
                                            from user u join `order` o
                                            on u.id = o.userID
                                            where u.email = e" . $_SESSION["email"] . "mail && orderStatus = 0) prev
                                    join products_orders po
                                    on prev.orderID = po.order_id ) ar join producttable pt
                            on ar.product_id = pt.idProduct;";
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