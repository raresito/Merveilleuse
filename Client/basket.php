<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if(!isset($_SESSION["email"])){
    header("Location: login.php");
}

function console_log($data){
    echo '<script>';
    echo 'console.log('. $data .')';
    echo '</script>';

    if (isset($_POST["quantity"])){
        echo $_POST["quantity"];
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
</head>

<body>
<?php include 'clientnavbar.php';?>
<div class="container" style="margin-top: 100px">

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
                    $sql = "SELECT * FROM users_product WHERE email = '" . $_SESSION["email"] . "';";
                    $result = mysqli_query($conn, $sql);
                    if (!$result) {
                        echo 'No result';
                        echo "Error: Our query failed to execute and here is why: \n";
                        echo "Query: " . $sql . "\n";
                        echo "Errno: " . $conn -> errno . "\n";
                        echo "Error: " . $conn -> error . "\n";
                    }
                    if ($result -> num_rows > 0) {
                        while ($row = $result -> fetch_assoc()) {
                            //echo $row["product_id"] . ",";
                            $sqlProduct = "SELECT * FROM producttable WHERE idProduct = '" . $row["product_id"] . "';";
                            $resultProduct = mysqli_query($conn, $sqlProduct);
                            $rowProduct = $resultProduct -> fetch_assoc();

                            if($resultProduct) {
                                echo '
                                    <form action = "basket.php" method = "post" role="form">
                                    <tr><td data-th="Product">
                                        <div class="row">
                                            <div class="col-sm-4 hidden-xs"><img src=../resources/res/foto/' . $rowProduct["image"] . ' style="max-height:100px" class="img-responsive"/></div>
                                            <div class="col-sm-8">
                                                <h4 class="nomargin">' . $rowProduct["nameProduct"] . '</h4>
                                                <p>Quis aute iure reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Lorem ipsum dolor sit amet.</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td data-th="Price">RON ' . $rowProduct["priceProduct"] . " /" . $rowProduct["unitProduct"] . '</td>
                                    <td data-th="Quantity">
                                        <input name = "quantity" type="number" class="form-control text-center" value="'.$row["quantity"].'">
                                    </td>
                                    <td data-th="Subtotal" class="text-center">' . $rowProduct["priceProduct"] * $row["quantity"]. '</td>
                                    <td class="actions" data-th="">
                                        <button type = "submit" class="btn btn-info btn-sm"><i class="fa fa-refresh"></i></button>
                                        <button class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></button>
                                    </td></tr>
                                    </form>
                                ';
                                $subtotal = $subtotal + $rowProduct["priceProduct"] * $row["quantity"];
                            }


                            else
                                echo 'No result';
                        }
                    }

                }
                ?>

            </tbody>
            <tfoot>
            <tr class="visible-xs">
                <td class="text-center"><strong>Total <?php echo $subtotal; ?></strong></td>
            </tr>
            <tr>
                <td><a href="../Client/shop.php" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continue Shopping</a></td>
                <td colspan="2" class="hidden-xs"></td>
                <td class="hidden-xs text-center"><strong>Total <?php echo $subtotal; ?> RON</strong></td>
                <td><a href="payment.php" class="btn btn-success btn-block">Checkout <i class="fa fa-angle-right"></i></a></td>
            </tr>
            </tfoot>
        </table>

</div>
</body>
</html>