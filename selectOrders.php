<?php

include "Admin/requests/dbConnectAdmin.php";

if(isset($_POST["type"])) {
    if ($_POST["type"] == "default") {
        $sql = "select * from `order`";

        $result = mysqli_query($conn, $sql);

        $arr = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $arr[] = $row;
        }

        echo json_encode($arr);
    } elseif ($_POST["type"] == "open") {
        $sql = "select * 
                from `order` join user
                on user.idUser = `order`.idUser
                join addresses
                on addresses.idAddress = `order`.idAddress
                where deliveryStatus = 0";
        $result = mysqli_query($conn, $sql);
        echo $result -> num_rows;

    } elseif ($_POST["type"] == "single") {
        $sql = "select *
                from `product-order` po join product pt
                on po.idProduct = pt.idProduct
                where po.idOrder = " . $_POST["orderID"];
        $result = mysqli_query($conn, $sql);
        $arr = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $arr[] = $row;
        }
        if ($result -> num_rows < 1) {
            echo 'Nul';
        }
        echo json_encode($arr);

    } elseif ($_POST["type"] == "mine") {
        $sql = "select pt.idProduct, pt.nameProduct, pt.priceProduct, pt.unitProduct, pt.image, z.idOrder as orderId, z.quantity
                from product pt join (
                select o.idOrder, po.quantity, po.idProduct
                from `product-order` po join `order` o
                    on po.idOrder = o.idOrder
                where idUser = (select idUser
                                from user
                                where emailUser = '" . $_POST["email"] . "'
                                limit 1)
                and orderStatus = 0) z
                on z.idProduct = pt.idProduct
                ;";
        $result = mysqli_query($conn, $sql);
        $arr = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $arr[] = $row;
        }

        echo json_encode($arr);
    } elseif ($_POST["type"] == "done") {

        $sql = "select count(idOrder) as nom
                from `order`
                where MONTH(deliveryDate) = MONTH(CURRENT_DATE())
                group by MONTH(deliveryDate)";
        $result = mysqli_query($conn, $sql);
        if($result -> fetch_assoc()["nom"] == null){
            echo '0';
        }
        echo $result -> fetch_assoc()["nom"];
    }
}

?>