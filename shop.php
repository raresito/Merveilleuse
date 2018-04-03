<?php

require_once 'dbconnect.php';

function console_log($data){
    echo '<script>';
    echo 'console.log('. $data .')';
    echo '</script>';
}

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

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Merveilleuse Shop</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/Navigation-with-Search.css">
    <link rel="stylesheet" href="assets/css/Pretty-Product-List.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="css/clientnavbar.css">


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <?php include 'clientnavbar.php';?>
    <div class="container">
        <div class="row">
            <div class="col-xl-2"></div>
            <div class="col">
                <div class="row product-list">
                    <?php
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo '<div class="col-sm-6 col-md-4 product-item">
                                    <div class="product-container">
                                        <div class="row">
                                            <div class="col-md-12"><a href="#" class="product-image"><img src="res/unu.jpg"></a></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-8">
                                                <h2><a href="#">' .$row["nameProduct"]. '</a></h2>
                                            </div>
                                        </div>
                                        <div class="product-rating"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-half"></i><a href="#" class="small-text">82 reviews</a></div>
                                        <div class="row">
                                            <div class="col-12">
                                                <p class="product-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam ornare sem sed nisl dignissim, facilisis dapibus lacus vulputate. Sed lacinia lacinia magna. </p>
                                                <div class="row">
                                                    <div class="col-6"><button class="btn btn-light" type="button">Buy Now!</button></div>
                                                    <div class="col-6">
                                                        <p class="product-price">' . $row["priceProduct"] . ' </p>
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
                    <div class="col-sm-6 col-md-4 product-item">
                        <div class="product-container">
                            <div class="row">
                                <div class="col-md-12"><a href="#" class="product-image"><img src="assets/img/iphone6.jpg"></a></div>
                            </div>
                            <div class="row">
                                <div class="col-8">
                                    <h2><a href="#">iPhone 6s</a></h2>
                                </div>
                            </div>
                            <div class="product-rating"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-half"></i><a href="#" class="small-text">82 reviews</a></div>
                            <div class="row">
                                <div class="col-12">
                                    <p class="product-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam ornare sem sed nisl dignissim, facilisis dapibus lacus vulputate. Sed lacinia lacinia magna. </p>
                                    <div class="row">
                                        <div class="col-6"><button class="btn btn-light" type="button">Buy Now!</button></div>
                                        <div class="col-6">
                                            <p class="product-price">$599.00 </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4 product-item">
                        <div class="product-container">
                            <div class="row">
                                <div class="col-md-12"><a href="#" class="product-image"><img src="assets/img/iphone6.jpg"></a></div>
                            </div>
                            <div class="row">
                                <div class="col-8">
                                    <h2><a href="#">iPhone 6s</a></h2>
                                </div>
                            </div>
                            <div class="product-rating"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-half"></i><a href="#" class="small-text">82 reviews</a></div>
                            <div class="row">
                                <div class="col-12">
                                    <p class="product-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam ornare sem sed nisl dignissim, facilisis dapibus lacus vulputate. Sed lacinia lacinia magna. </p>
                                    <div class="row">
                                        <div class="col-6"><button class="btn btn-light" type="button">Buy Now!</button></div>
                                        <div class="col-6">
                                            <p class="product-price">$599.00 </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div></div>
</body>

</html>