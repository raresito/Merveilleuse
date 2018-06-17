<html>
<head>
    <?php include '../libraries.php'; ?>
    <!-- TODO Get more images -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../resources/css/merveilleuseSideBar.css" rel="stylesheet">
    <link href="../resources/css/merveilleuseProductList.css" rel="stylesheet">
    <script src="../resources/js/merveilleuseSideBar.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../resources/css/Lightbox-Gallery.css">

    <script>
        $.ajax({
            type: 'POST',
            url: 'requests/retrieveGallery.php',
            data:{},
            success: function (d){
                console.log(d);
                let array = JSON.parse(d);
                for (i in array){
                    document.getElementById("imagesHere").innerHTML += "" +
                        "<div class=\"col-sm-4 col-md-3 col-lg-2 item\">\n" +
                        "    <img class=\"img-fluid\" src='Merveilleuse/" + array[i] + "'>\n" +
                        "</div>"
                }
            }
        })
    </script>

</head>
<body>
<div class="wrapper">
    <?php include("adminSidebar.php"); ?>
    <div class = "container">
        <div class="row">
            <div class="col">
                <div class="photo-gallery">
                    <div class="intro">
                        <button type="button" id="sidebarCollapse" onclick="collapse()" class="btn btn-info navbar-btn">
                            <i class="glyphicon glyphicon-align-left"></i>
                            <span></span>
                        </button>
                        <h2 class="text-center">Gallerie de fotografii</h2>
                    </div>
                    <div>
                        <form action="requests/uploadPhoto.php" method="post" enctype="multipart/form-data">
                            Select image to upload:
                            <input type="file" name="fileToUpload" id="fileToUpload">
                            <input type="submit" value="Upload Image" name="submit">
                        </form>
                    </div>
                    <hr>
                    <div id="imagesHere" class="row"></div>
                </div>
            </div>
        </div>
</div>
</div>

</body>
</html>

