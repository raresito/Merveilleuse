<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include '../dbconnect.php';

$driver = new mysqli_driver();
$driver->report_mode = MYSQLI_REPORT_ERROR;

if(!isset($_SESSION["email"])){
    header("Location: login.php");
}

function console_log($data){
    echo '<script>';
    echo 'console.log('. $data .')';
    echo '</script>';
}

if(isset($_POST["idProduct"]) && isset($_POST["quantity"])){
    if($_POST["quantity"] == 0){
        $deleteProduct = "DELETE FROM products_orders
                          WHERE order_id = (
                                            SELECT orders.orderID
                                            from orders
                                            join users
                                            on orders.userID = users.id
                                            where users.email = '".$_SESSION["email"]."'
                                            And orders.orderStatus = 0)
                          AND product_id = '".$_POST["idProduct"]."';";
        $result = mysqli_query($conn, $deleteProduct);
    } else {
        $incrementProduct = "UPDATE products_orders
                set quantity = " . $_POST["quantity"] . "
                where order_id = (
                        SELECT orders.orderID
                        from orders
                        join users
                        on orders.userID = users.id
                        where users.email = '" . $_SESSION["email"] . "'
                        And orders.orderStatus = 0)
                and product_id = '" . $_POST["idProduct"] . "';";
        $result = mysqli_query($conn, $incrementProduct);
    }
}
?>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Merveilleuse Shop</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../resources/css/basket.css">



    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script>

    <script>

        function setZero(x){
            x.parentElement.parentElement.getElementsByClassName("text-center")[0].value = 0;
        }
        window.onload = function() {
            let space = document.getElementById("accordion");
            $.ajax({
                type: 'POST',
                url: 'selectOldOrders.php',
                data: {},
                success: function (d) {

                    console.log(d);
                    var result = JSON.parse(d);

                    for(let i = 0; i < result.length; i++){

                        var currentOrder = document.createElement('DIV');
                        currentOrder.classList.add("card");

                        let heading = document.createElement("DIV");
                        heading.classList.add("card-header");
                        heading.id = "heading" + result[i].order_id;

                        let mb0 = document.createElement("H5");
                        mb0.classList.add("mb-0");

                        let button = document.createElement("BUTTON");
                        button.classList.add("btn");
                        button.classList.add("btn-link");
                        button.setAttribute("data-toggle", "collapse");
                        button.setAttribute("data-target", "#collapse" + result[i].order_id);
                        button.setAttribute("aria-expanded", "true");
                        button.setAttribute("aria-controls", "collapse" + result[i].order_id);
                        button.innerText = "Comanda #"+ result[i].order_id;

                        mb0.appendChild(button);
                        heading.appendChild(mb0);

                        var collapse = document.createElement("DIV");
                        collapse.id="collapse"+result[i].order_id;
                        collapse.classList.add("collapse");
                        collapse.setAttribute("aria-labelledby", "heading" + result[i].order_id);
                        collapse.setAttribute("data-parent", "#accordion");

                        var card_body = document.createElement("DIV");
                        card_body.classList.add("card-body");

                        var table = document.createElement("TABLE");
                        table.classList.add("table");
                        var thead = document.createElement("THEAD");
                        thead.innerHTML = "<th class = \"d-none d-md-table-cell\" >Imagine</th> <th>Nume Produs</th> <th>Cantitate</th> <th>Preț Unitar</th> <th>Subtotal</th>";
                        var tbody = document.createElement("TBODY");

                        if(i === 0) {
                            var row = document.createElement("TR");
                            var cell1 = document.createElement("TD");
                            cell1.classList.add("d-none");
                            cell1.classList.add("d-md-table-cell");
                            cell1.innerHTML = "<img src = \"../resources/res/foto/" + result[i].image +"\" style=\"max-height:100px\" class=\"img-responsive\" >";
                            row.appendChild(cell1);
                            var cell2 = document.createElement("TD");
                            cell2.innerText = result[i].nameProduct;
                            row.appendChild(cell2);
                            var cell3 = document.createElement("TD");
                            cell3.innerText = result[i].quantity;
                            row.appendChild(cell3);
                            var cell4 = document.createElement("TD");
                            cell4.innerText = result[i].priceProduct;
                            row.appendChild(cell4);
                            var cell5 = document.createElement("TD");
                            cell5.innerText = result[i].priceProduct * result[i].quantity;
                            row.appendChild(cell5);
                            tbody.appendChild(row);
                            i++;
                        }

                        while (result[i].order_id === result[i - 1].order_id) {
                            var row = document.createElement("TR");
                            var cell1 = document.createElement("TD");
                            cell1.classList.add("d-none");
                            cell1.classList.add("d-md-table-cell");
                            cell1.innerHTML = "<img src = \"../resources/res/foto/" + result[i].image +"\" style=\"max-height:100px\" class=\"img-responsive\" >";
                            row.appendChild(cell1);
                            var cell2 = document.createElement("TD");
                            cell2.innerText = result[i].nameProduct;
                            row.appendChild(cell2);
                            var cell3 = document.createElement("TD");
                            cell3.innerText = result[i].quantity;
                            row.appendChild(cell3);
                            var cell4 = document.createElement("TD");
                            cell4.innerText = result[i].priceProduct;
                            row.appendChild(cell4);
                            var cell5 = document.createElement("TD");
                            cell5.innerText = result[i].priceProduct * result[i].quantity;
                            row.appendChild(cell5);
                            tbody.appendChild(row);
                            i++;
                            if(i === result.length){
                                break;
                            }

                        }
                        table.appendChild(thead);
                        table.appendChild(tbody);
                        card_body.appendChild(table);
                        collapse.appendChild(card_body);
                        currentOrder.appendChild(heading);
                        currentOrder.appendChild(collapse);
                        document.getElementById("accordion").appendChild(currentOrder);
                    }
                }

            });
        }
    </script>

</head>

<body>
<?php
echo "Errno: " . $conn->errno . "\n";
echo "Error: " . $conn->error . "\n";
include 'clientnavbar.php';?>
<div class="container content">

        <table id="cart" class="table table-hover table-condensed">
            <thead>
            <tr>
                <th style="width:50%">Produs</th>
                <th style="width:10%">Preț</th>
                <th style="width:8%">Cantitate</th>
                <th style="width:22%" class="text-center">Subtotal</th>
                <th style="width:10%"></th>
            </tr>
            </thead>
            <tbody>
                <?php

                $subtotal = 0;

                if(isset($_SESSION['email'])) {
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

                    if (!$result) {
                        echo 'No result';
                        echo "Error: Our query failed to execute and here is why: \n";
                        echo "Query: " . $sql . "\n";
                        echo "Errno: " . $conn -> errno . "\n";
                        echo "Error: " . $conn -> error . "\n";
                    }
                    if ($result -> num_rows > 0) {
                        while ($rowProduct = $result -> fetch_assoc()) {

                            echo '
                                <form action = "basket.php" method = "post" role="form">
                                    <tr>
                                        <td data-th="Produs">
                                            <div class="row">
                                                <div class="col-sm-4 hidden-xs"><img src=../resources/res/foto/' . $rowProduct["image"] . ' style="max-height:100px" class="img-responsive"/></div>
                                                <div class="col-sm-8">
                                                    <h4 class="nomargin">' . $rowProduct["nameProduct"] . '</h4>
                                                    <input name="idProduct" value="'.$rowProduct["product_id"].'" type="hidden"/>
                                                    <p>Quis aute iure reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Lorem ipsum dolor sit amet.</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td data-th="Preț">RON ' . $rowProduct["priceProduct"] . " /" . $rowProduct["unitProduct"] . '</td>
                                        <td data-th="Cantitate">
                                            <input name = "quantity" type="number" class="form-control text-center" value="'.$rowProduct["quantity"].'">
                                        </td>
                                        <td data-th="Subtotal" class="text-center">' . $rowProduct["priceProduct"] * $rowProduct["quantity"]. '</td>
                                        <td class="actions" data-th="">
                                            <button type = "submit" class="btn btn-info btn-sm"><i class="fa fa-refresh"></i></button>
                                            <button onclick = "setZero(this)" class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></button>
                                        </td>
                                    </tr>
                                </form>
                            ';
                            $subtotal = $subtotal + ($rowProduct["priceProduct"] * $rowProduct["quantity"]);
                        }
                    }

                }
                ?>

            </tbody>
            <tfoot>
            <tr class="visible-xs">
                <td class="text-center"><strong>Total <?php echo $subtotal; ?></strong></td>
                <?php
                if(isset($POST["quantity"])){
                    echo $_POST["quantity"] . " " . $_POST["nameProduct"];
                }

                ?>
            </tr>
            <tr>
                <td><a href="../Client/shop.php" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continue Shopping</a></td>
                <td colspan="2" class="hidden-xs"></td>
                <td class="hidden-xs text-center"><strong>Total <?php echo $subtotal; ?> RON</strong></td>
                <td><a href="confirmPurchase.php" class="btn btn-success btn-block">Checkout <i class="fa fa-angle-right"></i></a></td>
            </tr>
            </tfoot>
        </table>

</div>
<br>
<div class="container">
    <div class="row">
        <div class="alert alert-warning" style = "width: 100%">
            <div style="text-align: center">
                N-ai găsit ce căutai? <a href = "contact.php"> Scrie-ne! </a>
            </div>
        </div>
    </div>
</div>

<div class = "container">
    <div id="accordion"></div>
</div>
</body>
</html>
