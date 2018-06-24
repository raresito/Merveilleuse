<link rel="stylesheet" href="../resources/css/clientnavbarCSS.css">
<link rel="stylesheet" href="../resources/css/Navigation-with-Button.css">
<link rel="stylesheet" href="../resources/css/custom.css">
<script src="../resources/js/clientnavbarJS.js"></script>

<?php


include '../dbconnect.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$basketAmount = '';
if(isset($_SESSION["email"])) {

    $sql = "Select SUM(quantity) as suma
            from products_orders
            WHERE order_id = (SELECT orders.orderID
                              from  orders join users
                                  on userID = users.id
                              where email = '".$_SESSION["email"]."'
                                    AND orderStatus = 0);";
    $result = mysqli_query($conn, $sql);
    while($row = $result->fetch_assoc()){
        $basketAmount = $row["suma"];
    }
    echo $basketAmount;
}
?>

<nav id="clientNavBar" class="navbar navbar-light navbar-static-top sps sps--abv navbar-expand-md navigation-clean-button" style="z-index: 10">
    <div class="container">
        <div>
            <a class="navbar-brand" href="index.php"><img class="navbar-logo" alt="img" src="../resources/img/logo.jpg"></a>
            <button class="navbar-toggler collapsed" data-toggle="collapse" data-target="#navcol-1">
            <span class="sr-only">
                Toggle navigation
            </span>
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>

        <div class="collapse navbar-collapse" id="navcol-1">
            <ul class="nav navbar-nav mr-auto"></ul>
            <span class="navbar-text actions">
                                <a class="btn btn-light action-button" role="button" href="../Client/shop.php">
                    <img src="../resources/img/cupcake-icon2.png" alt="img" class="icon-cupcake">Gustă-mă
                </a>
                <?php
                    if(isset($_SESSION["email"])){
                        echo '
                        <a class="btn btn-light action-button" role="button" href="login.php">
                            <img alt="img" src="../resources/img/shopping-cart-icon.png" class="icon-cupcake">
                            Cont
                            <span class="badge badge-light">' . $basketAmount .  '</span>
                        </a>
                        <a class="btn btn-light action-button" role="button" href="../Client/logout.php">
                            Log Out
                        </a>
                        ';
                    } else {
                        echo '
                        <!--<div id="popHere"> </div>-->
                        <a class="btn btn-light action-button" role="button" href="../Client/login.php">
                            <img alt="img" src="../resources/img/shopping-cart-icon.png" class="icon-cupcake">Cont
                            <span class="badge badge-light">' . $basketAmount .  '</span>
                        </a>
                        <a class="btn btn-light action-button" role="button" href="register.php">Sign Up</a>
                        ';
                    }
                    ?>
            </span>
        </div>
    </div>
</nav>