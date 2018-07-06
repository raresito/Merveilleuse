<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../resources/img/favicon.ico" />
    <title>Merveilleuse Shop</title>
    <?php include '../libraries.php' ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../resources/css/Pretty-Product-List.css">



</head>

<body>

    <?php include 'clientnavbar.php';?>

    <div class="container" style="margin-top: 100px;">
        <div class="row">
            <div class="navbar navbar-default visible-xs">
                <div class="container-fluid">
                    <button class="btn btn-default navbar-btn" onclick="toggleSidebar()">
                        <i class="fa fa-tasks"></i> Filtre
                    </button>
                </div>
            </div>
        </div>
        <div class = "row" id="content">
            <div id="addSuccess" class="alert alert-success d-none" role="alert">

            </div>
        </div>
        <div class="row">
            <div id="filter-sidebar" class="col-sm-12 col-md-3 col-lg-2 collapse">
                <form>
                    <div style = "margin-top:20px">
                        <h4> Categorie </h4>
                        <div id="group-category" class="list-group in"></div>
                    </div>

                    <div style = "margin-top:20px">
                        <h4> Arome </h4>
                        <div id="group-flavour" class="list-group in"></div>
                    </div>

                    <div style = "margin-top:20px">
                        <h4> Preț </h4>
                        <div id="group-pret" class="list-group in">
                            <a class="list-group-item" href="#">
                                <input type="checkbox" class="category pret" value = "1">
                                0-20 lei
                            </a>
                            <a class="list-group-item" href="#">
                                <input type="checkbox" class="category pret" value = "2">
                                20-60 lei
                            </a>
                            <a class="list-group-item" href="#">
                                <input type="checkbox" class="category pret" value = "3">
                                60-200 lei
                            </a>
                            <a class="list-group-item" href="#">
                                <input type="checkbox" class="category pret" value = "4">
                                200+ lei
                            </a>
                        </div>
                    </div>
                </form>

            </div>
            <div class="col">
                <div id="productDiv" class="row row-eq-height product-list"></div>
            </div>
        </div>

    </div>
    <div class="container">
        <div class="row">
            <div class="alert alert-warning" style = "width: 100%">
                <div style="text-align: center">
                    N-ai găsit ce căutai? <a href = "contact.php"> Scrie-ne! </a>
                </div>
            </div>
        </div>
    </div>

    <script>
        function addToBasket(info){
            if("<?php if(isset($_SESSION["email"])){ echo $_SESSION["email"]; } else echo "" ?>" !== ""){
                $.ajax({
                    type: 'POST',
                    url: 'requests/insertBasket.php',
                    data: {id: info},
                    success: function (d) {
                        /*alert(d);*/
                        document.getElementById("addSuccess").classList.add("d-block");
                        document.getElementById("addSuccess").innerHTML = "Ai adăugat <strong>" + d + "</strong> în coș!";
                    }
                })
            }
            else {
                location.href="../Client/login.php";
            }
        }
    </script>
    <script src="../resources/js/shop.js"></script>

</body>

</html>