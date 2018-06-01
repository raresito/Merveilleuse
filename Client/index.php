<!DOCTYPE html>
<html lang="en">
    <head>
          <meta charset="utf-8">
          <meta http-equiv="X-UA-Compatible" content="IE=edge">
          <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
          <meta name="description" content="">
          <meta name="author" content="">
          <link rel="shortcut icon" href="../resources/res/favicon.ico" />

        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,500&amp;subset=cyrillic">
        <link rel="stylesheet" href="../resources/css/Header-Cover01.css">

        <link rel="stylesheet" href="../assets/css/styles.css">
        <link rel="stylesheet" href="../resources/css/index.css">

        <!-- Helper Styles -->
        <link href="../resources/css/loaders.css" rel="stylesheet">
        <link href="../resources/css/swiper.min.css" rel="stylesheet">
        <link rel="stylesheet" href="../resources/css/animate.min.css">
        <link rel="stylesheet" href="../resources/css/nivo-lightbox.css">
        <link rel="stylesheet" href="../resources/css/custom.css">
        <!-- Font Awesome Style -->
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">



        <title>Merveilleuse - Atelier de prajituri Artizanale</title>

    </head>

    <body>
    <?php include 'clientnavbar.php';?>

    <div class="container-fluid" style="z-index: 5; margin-top: 100px;">
        <div class="row">
            <div class="swiper-container main-slider" id="myCarousel">
                <div class="swiper-wrapper">
                    <div class="swiper-slide slider-bg-position" style="background:url('../resources/res/unu.jpg')" data-hash="slide1">
                        <h2>It is health that is real wealth and not pieces of gold and silver</h2>
                    </div>
                    <div class="swiper-slide slider-bg-position" style="background:url('../resources/res/doi.jpg')" data-hash="slide2">
                        <h2>Happiness is nothing more than good health and a bad memory</h2>
                    </div>
                </div>
                <!-- Add Pagination -->
                <div class="swiper-pagination"></div>
                <!-- Add Navigation -->
                <div class="swiper-button-prev"><i class="fa fa-chevron-left"></i></div>
                <div class="swiper-button-next"><i class="fa fa-chevron-right"></i></div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <?php
                for($i = 1; $i <= 9; $i++){
                    echo'<div class="col-12 col-sm-6 col-md-4 col-lg-2 square-div"
                            style = "background-image: url("../resources/res/foto/IMG-20180403-WA0001.jpg\");
                                     background-size: cover;
                                     background-repeat: no-repeat;
                                     background-position: 50% 50%;">
                        </div>';
                }
            ?>
        </div>
    </div>
           <!-- <div class="highlight-phone content">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="intro">
                                <h2>Visul unui Candybar ...</h2>
                                <p>Nu e ușor când trebuie să faci fericiți mulți pofticioși. Spune-ne pentru ce fel de eveniment te pregătești, iar noi îți vom recomanda candybar-ul perfect!</p>
                                <a class="btn btn-primary" role="button" href="#">Recomandă!</a></div>
                        </div>
                        <div class="col-sm-4">
                            <div class="d-none d-md-block iphone-mockup"><img src="../resources/res/candybar1-removal.png" style="margin-left: -350px" class="device">
                                <div class="screen"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>-->
<!--
        <div class="container-fluid">
            <div class="row intro">
                <h2 class="text-center"><br>Tot ce e mai bun, pentru evenimente unice!<br></h2>
                <p class="text-center"> </p>
            </div>
            <div class="row articles">
                <div class="col-sm-6 col-md-4 item"><a href="#"><img  class="img-fluid favorite-prodcut-image" src="../resources/res/generic-cupcake.png"></a>
                    <h3 class="name">Article Title</h3>
                    <p class="description">Aenean tortor est, vulputate quis leo in, vehicula rhoncus lacus. Praesent aliquam in tellus eu gravida. Aliquam varius finibus est, interdum justo suscipit id.</p><a href="#" class="action"><i class="fa fa-arrow-circle-right"></i></a></div>
                <div class="col-sm-6 col-md-4 item"><a href="#"><img class="img-fluid favorite-prodcut-image" src="../resources/res/generic-cupcake.png"></a>
                    <h3 class="name">Article Title</h3>
                    <p class="description">Aenean tortor est, vulputate quis leo in, vehicula rhoncus lacus. Praesent aliquam in tellus eu gravida. Aliquam varius finibus est, interdum justo suscipit id.</p><a href="#" class="action"><i class="fa fa-arrow-circle-right"></i></a></div>
                <div
                        class="col-sm-6 col-md-4 item"><a href="#"><img class="img-fluid favorite-prodcut-image" src="../resources/res/generic-cupcake.png"></a>
                    <h3 class="name">Article Title</h3>
                    <p class="description">Aenean tortor est, vulputate quis leo in, vehicula rhoncus lacus. Praesent aliquam in tellus eu gravida. Aliquam varius finibus est, interdum justo suscipit id.</p><a href="#" class="action"><i class="fa fa-arrow-circle-right"></i></a></div>
            </div>
        </div>
-->
    <?php include '../Client/footer.php' ?>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../resources/js/jquery.min.js" ></script>
    <script src="../resources/js/bootstrap.min.js"></script>
    <script src="../resources/js/scrollPosStyler.js"></script>
    <script src="../resources/js/swiper.min.js"></script>
    <script src="../resources/js/isotope.min.js"></script>
    <script src="../resources/js/nivo-lightbox.min.js"></script>
    <script src="../resources/js/wow.min.js"></script>
    <script src="../resources/js/core.js"></script>
    </body>
  </html>