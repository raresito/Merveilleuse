<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once 'dbConnectClient.php';

/*echo $_POST["id"];*/
$checkUserHasProductAlready = "
    select user.id, user.email, `order`.orderID, `order`.orderStatus, idProduct, quantity
    from user join `order` on user.id = `order`.userID
    join `product-order` on `order`.orderID = `product-order`.order_id
    where emailUser = e" .$_SESSION["email"]. "mail
    AND idProduct = i" .$_POST["id"]."d
    AND orderStatus = 0; ";
$incrementProduct = "UPDATE `product-order`
                set quantity = quantity + 1
                where idOrder = (
                        SELECT `order`.orderID
                        from `order`
                        join user
                        on `order`.userID = user.id
                        where user.email = e" .$_SESSION["email"]. "mail
                        And `order`.orderStatus = 0)
                and product_id = i" .$_POST["id"]."d;";
$checkUserHasOpenOrder = "SELECT idOrder
                FROM `order`
                where idUser = (SELECT idUser
                                from user
                                where emailUser = e" .$_SESSION["email"]."mail)
                AND orderStatus = 0";
$createEmptyOrder = "INSERT INTO `order` (idUser)
                    VALUES ((SELECT idUser
                            from user
                            where emailUser = '" .$_SESSIOemailail"]."'))";
$createProductInOrder = '';
$getProductName = "SELECT nameProduct
                   FROM producttable
                    where idProduct = ".$_POST["id"].";";
if(isset($_POST["id"])) {
    $hasOpenOrder = mysqli_query($conn, $checkUserHasOpenOrder);
    if ($hasOpenOrder && $hasOpenOrder -> num_rows > 0) {
        $row = $hasOpenOrder ->fetch_assoc();
        $createProductInOrder = "INSERT INTO `product-order`
                    VALUES ( '" .$row["orderID"]."', '".$_POST["id"]."', '1')";

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
            $createProductInOrder = "INSERT INTO `product-order`
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