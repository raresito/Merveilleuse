<!DOCTYPE html>
<html lang="en">
    <head>
          <meta charset="utf-8">
          <meta http-equiv="X-UA-Compatible" content="IE=edge">
          <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
          <meta name="description" content="">
          <meta name="author" content="">
          <link rel="shortcut icon" href="../resources/img/favicon.ico" />

        <?php include '../libraries.php'; ?>

        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,500&amp;subset=cyrillic">
        <link rel="stylesheet" href="../resources/css/Header-Cover01.css">

        <link rel="stylesheet" href="../resources/css/index.css">

        <!-- Helper Styles -->
        <link href="../resources/css/loaders.css" rel="stylesheet">
        <link href="../resources/css/swiper.min.css" rel="stylesheet">
        <link rel="stylesheet" href="../resources/css/animate.min.css">
        <link rel="stylesheet" href="../resources/css/custom.css">
        <!-- Font Awesome Style -->
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

        <script src = "../resources/js/indexClient.js"></script>


        <title>Merveilleuse - Atelier de prajituri Artizanale</title>

    </head>

    <body>
    <?php include 'clientnavbar.php';?>

    <div class="container-fluid" style="position:relative">
        <div style="position: relative; z-index:6; top:660px; text-align: center;">
            <a class="btn action-button" style="color: black; background-color: greenyellow" role="button" href="../Client/shop.php">
                <img src="../resources/img/shopping-cart-icon.png" alt="image" class="icon-cupcake">Încearcă!
            </a>
        </div>
        <div class="row">
            <div class="swiper-container main-slider" id="myCarousel">
                <div class="swiper-wrapper">
                    <div class="swiper-slide slider-bg-position" style="background:url('../resources/img/unu.jpg')" data-hash="slide1">
                        <h2>În prăjitura vieţii, prietenii sunt chipsuri de ciocolată.</h2>
                    </div>
                    <div class="swiper-slide slider-bg-position" style="background:url('../resources/img/doi.jpg')" data-hash="slide2">
                        <h2>O dietă echilibrată înseamnă câte o prăjitură în fiecare mână.</h2>
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



    <div class="container-fluid">
        <div id="image-holder" class="row">

        </div>
    </div>

    <?php include '../Client/footer.php' ?>

    <script src="../resources/js/scrollPosStyler.js"></script>
    <script src="../resources/js/swiper.min.js"></script>
    <script src="../resources/js/isotope.min.js"></script>
    <script src="../resources/js/nivo-lightbox.min.js"></script>
    <script src="../resources/js/wow.min.js"></script>
    <script src="../resources/js/core.js"></script>
    </body>
  </html>