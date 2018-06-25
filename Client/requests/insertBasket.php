<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once 'dbConnectClient.php';

/*echo $_POST["id"];*/
$checkUserHasProductAlready = "
    select users.id, users.email, orders.orderID, orders.orderStatus, product_id, quantity
    from users join orders on users.id = orders.userID
    join products_orders on orders.orderID = products_orders.order_id
    where email = '".$_SESSION["email"]."'
    AND product_id = '".$_POST["id"]."'
    AND orderStatus = 0; ";
$incrementProduct = "UPDATE products_orders
                set quantity = quantity + 1
                where order_id = (
                        SELECT orders.orderID
                        from orders
                        join users
                        on orders.userID = users.id
                        where users.email = '".$_SESSION["email"]."'
                        And orders.orderStatus = 0)
                and product_id = '".$_POST["id"]."';";
$checkUserHasOpenOrder = "SELECT orderID
                FROM orders
                where userID = (SELECT id
                                from users
                                where email = '".$_SESSION["email"]."')
                AND orderStatus = 0";
$createEmptyOrder = "INSERT INTO orders (userID)
                    VALUES ((SELECT id
                            from users
                            where email = '".$_SESSION["email"]."'))";
$createProductInOrder = '';
$getProductName = "SELECT nameProduct
                   FROM producttable
                    where idProduct = ".$_POST["id"].";";
if(isset($_POST["id"])) {
    $hasOpenOrder = mysqli_query($conn, $checkUserHasOpenOrder);
    if ($hasOpenOrder && $hasOpenOrder -> num_rows > 0) {
        $row = $hasOpenOrder ->fetch_assoc();
        $createProductInOrder = "INSERT INTO products_orders
                    VALUES ( '".$row["orderID"]."', '".$_POST["id"]."', '1')";

        $hasProduct = mysqli_query($conn, $checkUserHasProductAlready);
        if ($hasProduct && $hasProduct -> num_rows > 0) {
            mysqli_query($conn, $incrementProduct);
            echo (mysqli_query($conn, $getProductName) -> fetch_assoc())["nameProduct"];
        } else {
            /*echo 'Product didn\'t exist before';
            echo 'Insert 1.7';*/
            /*echo $_POST["id"];*/
            mysqli_query($conn, $createProductInOrder);
            echo (mysqli_query($conn, $getProductName) -> fetch_assoc())["nameProduct"];
        }
    } else {
        /*echo 'Order didn\'t exist before';*/
        mysqli_query($conn, $createEmptyOrder);
        $hasOpenOrder = mysqli_query($conn, $checkUserHasOpenOrder);
        /*echo $checkUserHasOpenOrder;
        echo "Errno: " . $conn->errno . "\n";
        echo "Error: " . $conn->error . "\n";*/
        if ($hasOpenOrder && $hasOpenOrder -> num_rows > 0) {
            $row = $hasOpenOrder -> fetch_assoc();
            $createProductInOrder = "INSERT INTO products_orders
                    VALUES ( '" . $row["orderID"] . "', '" . $_POST["id"] . "', '1')";
            /*echo "Insert 2";*/
            echo (mysqli_query($conn, $getProductName) -> fetch_assoc())["nameProduct"];
            /*echo $_POST["id"];*/
            mysqli_query($conn, $createProductInOrder);
        }
    }

} else {
    echo 'No id';
}

?>