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

        <link rel="stylesheet" href="../resources/css/index.css">

        <!-- Helper Styles -->
        <link href="../resources/css/loaders.css" rel="stylesheet">
        <link href="../resources/css/swiper.min.css" rel="stylesheet">
        <link rel="stylesheet" href="../resources/css/animate.min.css">
        <link rel="stylesheet" href="../resources/css/nivo-lightbox.css">
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
                <img src="../resources/res/shopping-cart-icon.png" class="icon-cupcake">Încearcă!
            </a>
        </div>
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



    <div class="container-fluid">
        <div id="image-holder" class="row">

        </div>
    </div>

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