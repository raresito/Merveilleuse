<?php
include "../../dbconnect.php";

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$subtotal = 0;

$sql = "select ar.email, ar.order_id,ar.product_id,ar.quantity, pt.nameProduct, pt.priceProduct, pt.unitProduct, pt.image, pt.category
                            from(
                                select email, order_id, product_id, quantity
                                    from (
                                        select u.email, o.orderID, o.orderStatus
                                            from users u join orders o
                                            on u.id = o.userID
                                            where u.email = '" . $_SESSION["email"] . "' && orderStatus = 0) prev
                                    join products_orders po
                                    on prev.orderID = po.order_id ) ar join producttable pt
                            on ar.product_id = pt.idProduct;";
$result = mysqli_query($conn, $sql);
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
