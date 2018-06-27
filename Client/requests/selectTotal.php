<?php
include "dbConnectClient.php";

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$subtotal = 0;

$sql = "select ar.emailUser, ar.idOrder,ar.idProduct,ar.quantity, pt.nameProduct, pt.priceProduct, pt.unitProduct, pt.image, pt.category
                            from(
                                select emailUser, po.idOrder, idProduct, quantity
                                    from (
                                        select u.emailUser, o.idOrder, o.orderStatus
                                            from user u join `order` o
                                            on u.idUser = o.idUser
                                            where u.emailUser = '" . $_SESSION["email"] . "' && orderStatus = 0) previ
                                    join `product-order` po
                                    on previ.idOrder = po.idOrder ) ar join product pt
                            on ar.idProduct = pt.idProduct;";
$result = mysqli_query($conn, $sql);
echo mysqli_error($conn);
$arr = array();
if ($result -> num_rows > 0) {
    while ($rowProduct = $result -> fetch_assoc()) {
        $subtotal = $subtotal + ($rowProduct["priceProduct"] * $rowProduct["quantity"]);
    }
    echo $subtotal;
} else {
    echo 0;
}
?>
