<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Merveilleuse Shop</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../resources/css/Pretty-Product-List.css">
    <link rel="stylesheet" href="../resources/css/spinner.css">


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script  src="../resources/js/sidebar-shop/index.js"></script>

    <link rel="stylesheet" href="../resources/css/overlay.css">
    <script src="../resources/js/overlay.js"></script>

    <script type="text/javascript">

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
                        alert(d);
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
                success: function (d){
                    alert(d);
                    productDiv.innerHTML = d;
                }
            });
        }

    </script>
    <!-- TODO alerta timp de livrare, bani -->

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
        </div>
        <div class="row">

            <div id="filter-sidebar" class="col-sm-6 col-md-3 col-lg-2 collapse">
                <form>
                    <div style = "margin-top:20px">
                        <h4> Categorie </h4>
                        <div id="group-category" class="list-group collapse in">
                            <a class="list-group-item" href="#">
                                <input type="checkbox" onchange="filterProduct(this)" class="type category" value = "Tort">
                                Tort
                            </a>
                            <a class="list-group-item" href="#">
                                <input type="checkbox" onchange="filterProduct(this)" class="type category" value = "Patiserie">
                                Patiserie
                            </a>
                            <a class="list-group-item" href="#">
                                <input type="checkbox" onchange="filterProduct(this)" class="type category" value = "Platouri">
                                Platouri prăjituri
                            </a>
                            <a class="list-group-item" href="#">
                                <input type="checkbox" onchange="filterProduct(this)" class="type category" value = "Tarte/Quiche-uri">
                                Tarte/Quiche-uri
                            </a>
                            <a class="list-group-item" href="#">
                                <input type="checkbox" onchange="filterProduct(this)" class="type category" value = "CandyBar">
                                Candy Bar
                            </a>
                        </div>
                    </div>

                    <div style = "margin-top:20px">
                        <h4> Arome </h4>
                        <div id="group-category" class="list-group collapse in">
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
                        <div id="group-pret" class="list-group collapse in">
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
                <div id="myNav" class="overlay">

                    <!-- Button to close the overlay navigation -->
                    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>

                    <div class="spinner"></div>

                </div>
                <div id="productDiv" class="row row-eq-height product-list">

                    <?php

                    $sql = "SELECT * FROM producttable";
                    $result = mysqli_query($conn,$sql);
                    if(!$result){
                        echo'No result';
                        echo "Error: Our query failed to execute and here is why: \n";
                        echo "Query: " . $sql . "\n";
                        echo "Errno: " . $conn->errno . "\n";
                        echo "Error: " . $conn->error . "\n";
                    }

                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo '<div class="col-xs-6 col-md-6 col-lg-3 product-item d-flex flex-column">
                                    <div class="product-container d-flex flex-column" style="height: 100%;">
                                        <div class="row" style="flex-grow: 1"> 
                                            <div class="col-md-12"><a href="#" class="product-image"><img src="../resources/img/foto/' . $row["image"] . '"></a></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-8">
                                                <h2><a href="#">' .$row["nameProduct"]. '</a></h2>
                                            </div>
                                        </div>
                                        Categorie: '.$row["category"].'
                                        <div class="row">
                                            <div class="col-12">
                                                <p class="product-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam ornare sem sed nisl dignissim, facilisis dapibus lacus vulputate. Sed lacinia lacinia magna. </p>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <button class="btn btn-light fill" type="button" onclick="addToBasket('.$row["idProduct"].')">Cumpără!</button>
                                                    </div>
                                                    <div class="col-12">
                                                        <p class="product-price">' . $row["priceProduct"] . "RON /" . $row["unitProduct"] .' </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>';
                        }
                    } else {
                        echo "0 results";
                    }
                    ?>

                </div>
                <div id="outputDiv">

                </div>
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