<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
var_dump($_POST);
var_dump($_SESSION);
require_once '../dbconnect.php';

function console_log($data){
    echo '<script>';
    echo 'console.log('. $data .')';
    echo '</script>';
}

$checkUserHasProductAlready = "
    select users.id, users.email, order.orderID, order.orderStatus, product_id, quantity
    from users join merveilleuse.order on users.id = order.userID
    join products_orders on order.orderID = products_orders.order_id
    where email = '".$_SESSION["email"]."'
    AND product_id = '".$_POST["id"]."'; ";
$incrementProduct = "UPDATE products_orders
                set quantity = quantity + 1
                where order_id = (
                        SELECT merveilleuse.order.orderID
                        from merveilleuse.order
                        join users
                        on merveilleuse.order.userID = users.id
                        where users.email = '".$_SESSION["email"]."'
                        And merveilleuse.order.orderStatus = 0)
                and product_id = '".$_POST["id"]."';";
$checkUserHasOpenOrder = "SELECT orderID
                FROM merveilleuse.order
                where userID = (SELECT id
                                from users
                                where email = '".$_SESSION["email"]."')
                                AND orderStatus = 0";
$createEmptyOrder = "INSERT INTO merveilleuse.order (userID)
                    VALUES ((SELECT id
                            from users
                            where email = '".$_SESSION["email"]."'))";
$createProductInOrder = '';
if(isset($_POST["id"])) {
    $hasOpenOrder = mysqli_query($conn, $checkUserHasOpenOrder);
    if ($hasOpenOrder && $hasOpenOrder -> num_rows > 0) {
        $row = $hasOpenOrder ->fetch_assoc();
        $createProductInOrder = "INSERT INTO products_orders
                    VALUES ( '".$row["orderID"]."', '".$_POST["id"]."', '1')";
        $hasProduct = mysqli_query($conn, $checkUserHasProductAlready);
        if ($hasProduct && $hasProduct -> num_rows > 0) {
            mysqli_query($conn, $incrementProduct);
        } else {
            echo 'Product didn\'t exist before';
            mysqli_query($conn, $createProductInOrder);
        }
    } else {
        echo 'Order didn\'t exist before';
        mysqli_query($conn, $createEmptyOrder);
        $hasOpenOrder = mysqli_query($conn, $checkUserHasOpenOrder);
        /*echo $checkUserHasOpenOrder;
        echo "Errno: " . $conn->errno . "\n";
        echo "Error: " . $conn->error . "\n";*/
        if ($hasOpenOrder && $hasOpenOrder -> num_rows > 0) {
            $row = $hasOpenOrder -> fetch_assoc();
            $createProductInOrder = "INSERT INTO products_orders
                    VALUES ( '" . $row["orderID"] . "', '" . $_POST["id"] . "', '1')";
            mysqli_query($conn, $createProductInOrder);
        }
    }
} else {
    echo 'No id';
}

?>