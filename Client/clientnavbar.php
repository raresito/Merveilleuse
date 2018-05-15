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


    $sql = "Select SUM(quantity) as suma from users_product WHERE email ='" . $_SESSION['email'] . "';";
    $result = mysqli_query($conn, $sql);
    if ($result && $result -> num_rows == 1) {
        $row = $result -> fetch_assoc();
        $basketAmount = $row["suma"];
    }
}
?>

<nav id="clientNavBar" class="navbar navbar-light navbar-static-top sps sps--abv navbar-expand-md navigation-clean-button" style="z-index: 10">
    <div class="container">
        <a class="navbar-brand" href="index.php"><img class="navbar-logo" src="../resources/res/logo.jpg"></a>
        <button class="navbar-toggler" data-toggle="collapse" data-target="#navcol-1">
            <span class="sr-only">
                Toggle navigation
            </span>
            <span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navcol-1">
            <ul class="nav navbar-nav mr-auto"></ul>
            <span class="navbar-text actions">
                                <a class="btn btn-light action-button" role="button" href="../Client/shop.php">
                    <img src="../resources/res/cupcake-icon2.png" class="icon-cupcake">Gustă-mă
                </a>
                <?php
                    if(isset($_SESSION["email"])){
                        echo '
                        <a class="btn btn-light action-button" role="button" href="login.php">
                            <img src="../resources/res/shopping-cart-icon.png" class="icon-cupcake">
                            Cont
                            <span class="badge badge-light">' . $basketAmount .  '</span>
                        </a>
                        <a class="btn btn-light action-button" role="button" href="../Client/logout.php">
                            <img src="" class="icon-cupcake">Log Out
                        </a>
                        ';
                    } else {
                        echo '
                        <a class="btn btn-light action-button" role="button" href="../Client/login.php">
                            <img src="../resources/res/shopping-cart-icon.png" class="icon-cupcake">Cont
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