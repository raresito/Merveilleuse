<?php

require_once '../dbconnect.php';

?>

<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
        <script src="../resources/js/merveilleuseSideBar.js"></script>



        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

        <link href="../resources/css/merveilleuseSideBar.css" rel="stylesheet">
        <link href="../resources/css/merveilleuseProductList.css" rel="stylesheet">
        <link rel="stylesheet" href="../resources/css/Lightbox-Gallery.css">
        <script src="../resources/js/products.js"></script>

    </head>
    <body>
        <div class="wrapper">
            <?php
            include("adminSidebar.php");
            ?>
            <div class = "container">
            <div class="row">
                <div class = "col-sm-12">
                    <?php
                    //var_dump($_POST);
                    if(isset($_POST["newProductName"])) {
                        $sqlinsert = "INSERT into producttable (nameProduct, priceProduct, unitProduct, image, category)
                                                     VALUES ( \"" . $_POST["newProductName"] . "\", \"" . $_POST["newProductPrice"] . "\",\"" . $_POST["newProductUnit"] . "\",\"" . $_POST["newProductPhoto"] . " \",\"" . $_POST["newProductCategory"] . " \")";
                        $insert = mysqli_query($conn,$sqlinsert);
                        echo mysqli_error($conn);
                        //echo $insert;
                        if ($insert) {
                            echo '<div class="alert alert-success" role="alert">
                              <strong>Încărcat!</strong> Ai adăugat un produs nou!
                            </div>';
                        } else {
                            echo "File upload failed, please try again.";
                            echo '<div class="alert alert-danger" role="alert">
                                A apărut o problemă, mai încearcă odată!
                            </div>';
                        }
                    }

                    if(isset($_POST["deleteProduct"])){
                        $sqldelete = "Delete from producttable where idProduct = '" . $_POST["deleteProduct"] . "';";
                        //echo $sqldelete;
                        $delete = mysqli_query($conn,$sqldelete);
                        //echo $delete;
                        //echo mysqli_error($conn);
                        if($delete){
                            echo '<div class="alert alert-success" role="alert">
                              <strong>Șters!</strong> Ai șters produsul '.$_POST["nameProduct"].'
                            </div>';
                        } else {
                            echo "File upload failed, please try again.";
                            echo '<div class="alert alert-danger" role="alert">
                                A apărut o problemă, mai încearcă odată!
                            </div>';
                        }

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
                    <div class="productTitle">
                        <button type="button" id="sidebarCollapse" onclick="collapse()" class="btn btn-info navbar-btn">
                            <i class="glyphicon glyphicon-align-left"></i>
                            <span></span>
                        </button>
                        <h1 class = "h2">Product List</h1>
                        <button type="button" class="btn btn-sm" data-toggle="modal" data-target="#addModal"><i class="material-icons" data-toggle="tooltip" data-target="" title="Add">add_circle_outline</i></button>
                    </div>
                    <div class="productTable">
                        <table id="product-table" class="table table-striped table-hover">
                        </table>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <!-- Modal -->
        <div id="editModal" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Edit Product</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nameEditInput">Name</label>
                            <input type="text" class="form-control" id="nameEditInput" required>
                        </div>
                        <div class="form-group">
                            <label for="categoryEditInput">Category</label>
                            <input type="text" id="categoryEditInput" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="priceEditInput">Price/Unit</label>
                            <input type="text" id="priceEditInput" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label></label>
                            <textarea class="form-control" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        <input type="submit" class="btn btn-info" value="Save">
                    </div>
                </div>
            </div>
        </div>
        <div id="deleteModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <form action="products.php" method="post"><div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Remove product</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <p>Are you sure you want to delete <div id="deleteProduct"></div>
                                <input id = "deleteInput" type="hidden" name="deleteProduct" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        <input type="submit" class="btn btn-danger" data-dismiss="modal" name="submit" value="Delete">
                    </div>
                </div>
                </form>
            </div>
        </div>
        <div id="addModal" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <form action="products.php" method="post">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Add New Product</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <label>Name</label>
                                    <input type="text" name="newProductName" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <label>Category</label>
                                    <input type="text" name="newProductCategory" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <label>Price/Unit</label>
                                    <input type="number" name="newProductPrice" class="form-control" required>
                                </div>
                                <div class="col-sm-6">
                                    <label>Unit</label>
                                    <input type="text" name="newProductUnit" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <label>Select image to upload:</label>
                                    <button type="button" id="galleryButton" class="btn btn-sm" data-toggle="modal" data-target="#galleryModal"><strong>Gallery</strong></button>
                                    <div id="photoPreview">
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <input type="button" class="btn btn-default" data-dismiss="addmodal" value="Cancel">
                            <input type="submit" class="btn btn-info" data-dismiss="addmodal" name="submit" value="UPLOAD">
                        </div>
                    </div>

                </form>
            </div>
        </div>

        <div id="galleryModal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                <!-- Modal content-->
                    <div class="photo-gallery"  style="border-radius: 20px">
                        <div class="modal-header">
                            <h2 class="text-center">Gallery</h2>
                            <form class="form-inline">
                                <div class="form-group">
                                    <label id="photoPrompt">Selected photo:</label>
                                </div>
                                <input type="button" onclick="sendChosenPhoto()" class="btn btn-default" data-dismiss="modal" value="Confirm">
                            </form>
                        </div>
                        <div class="modal-body">
                            <div class="row" id="galleryHere">
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Load JavaScript at end for performance -->


        <!-- Latest compiled and minified JavaScript -->


    </body>
</html>

