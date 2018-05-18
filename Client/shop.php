<?php


function console_log($data){
    echo '<script>';
    echo 'console.log('. $data .')';
    echo '</script>';
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="../resources/css/overlay.css">
    <script src="../resources/js/overlay.js"></script>

    <script type="text/javascript">
        function addToBasket(info){
            <?php
                if(isset($_SESSION["email"])){
                    echo'
                    var display = document.getElementById("content");
                    var xmlhttp = new XMLHttpRequest();
                    xmlhttp.open("POST", "hello.php");
                    xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                    xmlhttp.send("id=" + info.toString());
                    xmlhttp.onreadystatechange = function() {
                        if (this.readyState === 4 && this.status === 200) {
                            display.innerHTML = this.responseText;
                        } else {
                            display.innerHTML = "Loading...";
                        }
                    }
                    ';
                }
                else{
                    echo'
                    location.href="../Client/login.php";
                    ';
                }
            ?>

        }

    </script>

</head>

<body>
    <div id="content">
    </div>
    <?php include 'clientnavbar.php';?>

    <div class="container" style="margin-top: 100px;">
        <div class="row">
            <div class="navbar navbar-default visible-xs">
                <div class="container-fluid">
                    <button class="btn btn-default navbar-btn" data-toggle="collapse" data-target="#filter-sidebar">
                        <i class="fa fa-tasks"></i> Filtre
                    </button>
                </div>
            </div>
        </div>
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
        ?>
        <div class="row">
            <div id="filter-sidebar" class="col-xs-6 col-sm-3 collapse">
                <form>
                    <div style = "margin-top:20px">
                        <h4> Categorie </h4>
                        <div id="group-category" class="list-group collapse in">
                            <a class="list-group-item" href="#">
                                <input type="checkbox" class="type category" value = "Tort">
                                Tort
                            </a>
                            <a class="list-group-item" href="#">
                                <input type="checkbox" class="type category" value = "Prăjitură">
                                Prăjitură
                            </a>
                            <a class="list-group-item" href="#">
                                <input type="checkbox" class="type category" value = "CandyBar">
                                Candy Bar
                            </a>
                        </div>
                    </div>

                    <div style = "margin-top:20px">
                        <h4> Preț </h4>
                        <div id="group-pret" class="list-group collapse in">
                            <a class="list-group-item" href="#">
                                <input type="checkbox" class="type pret" value = "1">
                                0-20 lei
                            </a>
                            <a class="list-group-item" href="#">
                                <input type="checkbox" class="type pret" value = "2">
                                20-60 lei
                            </a>
                            <a class="list-group-item" href="#">
                                <input type="checkbox" class="type pret" value = "3">
                                60-200 lei
                            </a>
                            <a class="list-group-item" href="#">
                                <input type="checkbox" class="type pret" value = "4">
                                200+ lei
                            </a>
                        </div>
                    </div>
                </form>
                <script  src="../resources/js/sidebar-shop/index.js"></script>
            </div>
            <div class="col">
                <div id="myNav" class="overlay">

                    <!-- Button to close the overlay navigation -->
                    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>

                    <div class="spinner"></div>

                </div>
                <div class="row product-list">
                    <?php

                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo '<div class="col-xs-6 col-sm-6 col-md-3 product-item">
                                    <div class="product-container">
                                        <div class="row">
                                            <div class="col-md-12"><a href="#" class="product-image"><img src="../resources/res/foto/' . $row["image"] . '"></a></div>
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
                                                    <div class="col-6">
                                                        <button class="btn btn-light" type="button" onclick="addToBasket('.$row["idProduct"].')">Cumpără!</button>
                                                    </div>
                                                    <div class="col-6">
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



    <span onclick="openNav()">open</span>

</body>

</html>