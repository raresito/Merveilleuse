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






    <script>
        function toggleSidebar() {
            if (document.getElementById("filter-sidebar").classList.contains("collapse")) {
                document.getElementById("filter-sidebar").classList.remove("collapse");
            }
            else
                document.getElementById("filter-sidebar").classList.add("collapse");
        }
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

        let filterSelection = {
            type : [],
            flavour: [],
            price: []
        };

        function filterProduct(obj) {
            if (obj.checked === true) {
                if (obj.classList.contains("type")) {
                    filterSelection.type.push(obj.value);
                }
                if (obj.classList.contains("flavour")) {
                    filterSelection.flavour.push(obj.value);
                }
                if (obj.classList.contains("pret")) {
                    filterSelection.pret.push(obj.value);
                }
            }
            if(obj.checked === false){
                if(obj.classList.contains("type")) {
                    for(let k in filterSelection.type){
                        if(filterSelection.type[k] === obj.value){
                            filterSelection.type.splice(k, 1);
                        }
                    }
                }
                if(obj.classList.contains("flavour")) {
                    for(let k in filterSelection.flavour){
                        if(filterSelection.flavour[k] === obj.value){
                            filterSelection.flavour.splice(k, 1);
                        }
                    }
                }
                if(obj.classList.contains("pret")) {
                    for(let k in filterSelection.flavour){
                        if(filterSelection.price[k] === obj.value){
                            filterSelection.price.splice(k, 1);
                        }
                    }
                }
            }
            if(!obj.classList.contains("pret") && !obj.classList.contains("type") && !obj.classList.contains("flavour")){
                filterSelection = '';
            }
            console.log(filterSelection);
            reloadCatalog();
        }

        function reloadCatalog(){
            $.ajax({
                type: 'POST',
                url: 'shop-filter.php',
                data:{
                    selection : filterSelection
                },
                success: function (d) {
                    console.log(d);
                    arrayProduse = JSON.parse(d);
                    productDiv = document.getElementById("productDiv");
                    productDiv.innerHTML = '';
                    for (let i in arrayProduse) {
                        productDiv.innerHTML += '' +
                            '<div class="col-xs-6 col-sm-6 col-md-3 product-item d-flex flex-column">' +
                                '<div class="product-container d-flex flex-column" style="height: 100%">' +
                                    '<div class="row" style="flex-grow: 1">' +
                                        '<div class="col-md-12">' +
                                            '<a href="#" class="product-image">' +
                                                '<img src="../resources/img/foto/' + arrayProduse[i].image + '">' +
                                            '</a>' +
                                        '</div>' +
                                    '</div>' +
                                    '<div class="row">' +
                                        '<div class="col-8">' +
                                            '<h2><a href="#">' + arrayProduse[i].nameProduct + '</a></h2>' +
                                        '</div>' +
                                    '</div>' +
                                    'Categorie: ' + arrayProduse[i].category +
                                    '<div class="row">' +
                                        '<div class="col-12">' +
                                            '<div class="row">' +
                                                '<div class="col-12">' +
                                                    '<button class="btn btn-light fill" type="button" onclick="addToBasket(' + arrayProduse[i].idProduct + ')">Cumpără!</button> ' +
                                                '</div>' +
                                                '<div class="col-12">' +
                                                    '<p class="product-price">' + arrayProduse[i].priceProduct + "RON /" + arrayProduse[i].unitProduct + ' </p>' +
                                                '</div>' +
                                            '</div>' +
                                        '</div>' +
                                    '</div>' +
                                '</div>' +
                            '</div>';

                    }/*
                    alert(productDiv.innerHTML);*/
                }
            });
        }

        function loadCategories() {
            $.ajax({
                type: 'POST',
                url: 'requests/selectCategories.php',
                success: function (d) {
                    categorii = JSON.parse(d);
                    for (let i in categorii) {
                        document.getElementById("group-category").innerHTML += "" +
                            "<a class=\"list-group-item\" href=\"#\">\n" +
                            "    <input type=\"checkbox\" onchange=\"filterProduct(this)\" class=\"type category\" value = \"" +
                            categorii[i].category +
                            " \">\n" +
                                categorii[i].category  +
                            "</a>"
                    }
                }
            });
        }

        reloadCatalog();
        loadCategories();

    </script>

    <style>
        img:before {
            content: ' ';
            display: block;
            position: absolute;
            height: 50px;
            width: 50px;
            background-image: url(ishere.jpg);
    </style>

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
            <div id="filter-sidebar" class="col-sm-6 col-md-3 col-lg-2 collapse">
                <form>
                    <div style = "margin-top:20px">
                        <h4> Categorie </h4>
                        <div id="group-category" class="list-group in"></div>
                    </div>

                    <div style = "margin-top:20px">
                        <h4> Arome </h4>
                        <div id="group-flavour" class="list-group in">
                            <a class="list-group-item" href="#">
                                <input type="checkbox" class="flavour category" value = "Ciocolata">
                                Ciocolata
                            </a>
                            <a class="list-group-item" href="#">
                                <input type="checkbox" class="flavour category" value = "Fructe">
                                Fructe
                            </a>
                            <a class="list-group-item" href="#">
                                <input type="checkbox" class="flavour category" value = "Vanilie">
                                Vanilie
                            </a>
                            <a class="list-group-item" href="#">
                                <input type="checkbox" class="flavour category" value = "Fără zahăr">
                                Fără zahăr
                            </a>
                        </div>
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

</body>

</html>