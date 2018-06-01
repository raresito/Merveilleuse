<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script
        src="http://code.jquery.com/jquery-2.2.4.min.js"
        integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
        crossorigin="anonymous"></script>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>-->

    <link href="../css/merveilleuseSideBar.css" rel="stylesheet">
    <link href="../css/merveilleuseProductList.css" rel="stylesheet">
    <script src="../js/merveilleuseSideBar.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/Lightbox-Gallery.css">



</head>
<body>
<div class="wrapper">
    <?php
    include("adminSidebar.php");
    ?>
    <div class = "container">
    <div class="row">
        <div class="col">
            <div class="photo-gallery">
                    <div class="intro">
                        <button type="button" id="sidebarCollapse" onclick="collapse()" class="btn btn-info navbar-btn">
                            <i class="glyphicon glyphicon-align-left"></i>
                            <span></span>
                        </button>
                        <h2 class="text-center">Lightbox Gallery</h2>
                        <p class="text-center">Nunc luctus in metus eget fringilla. Aliquam sed justo ligula. Vestibulum nibh erat, pellentesque ut laoreet vitae. </p>
                    </div>
                    <div class="">
                        <?php
                        $files = glob("../resources/res/foto/*.jpg");
                        for ($i=1; $i<count($files); $i++)
                        {
                            $num = $files[$i];
                            echo'<div class="col-sm-4 col-md-3 col-lg-2 item">
                                    <a href=' . $num . ' data-lightbox="photos">
                                        <img class="img-responsive" src=' . $num . '>
                                    </a>
                                </div>';
                        }
                        ?>
                    </div>

            </div>
        </div>
    </div>
</div>
</div>

</body>
</html>

