<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if(!isset($_SESSION["email"])){
    header("Location: login.php");
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../resources/img/favicon.ico" />
    <title>Merveilleuse Shop</title>
    <?php include '../libraries.php' ?>
    <link rel="stylesheet" href="../resources/css/basket.css">



</head>

<body>
<?php include 'clientnavbar.php';?>
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
            <tbody id="tableBody"></tbody>
            <tfoot>
            <tr>
                <td><a href="../Client/shop.php" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continue Shopping</a></td>
                <td colspan="2" class="hidden-xs"></td>
                <td id = "hereTotal" class="hidden-xs text-center"><strong>Total RON (TVA inclus)</strong></td>
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

<div class = "container" style="margin-bottom: 75px">
    <div id="accordion"></div>
</div>

<script src = "../resources/js/basket.js"></script>

<?php include 'footer.php'; ?>
</body>
</html>
