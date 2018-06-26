<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require 'requests/dbConnectAdmin.php';


$sql = "Select * from user where emailUser = '" .$_SESSION["email"]."' LIMIT 1 ";
$result = mysqli_query($conn,$sql);
$row = $result ->fetch_assoc();
if($row["admin"] == 0){
    header("Location: adminLogin.php");
}

?>
<!-- TODO Major overhaul over here -->
<!-- TODO Produs inactiv -->
<html>
    <head>
        <?php include '../libraries.php'; ?>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="../resources/js/merveilleuseSideBar.js"></script>



        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

        <link href="../resources/css/merveilleuseSideBar.css" rel="stylesheet">
        <link href="../resources/css/merveilleuseProductList.css" rel="stylesheet">
        <link rel="stylesheet" href="../resources/css/Lightbox-Gallery.css">
        <script src="../resources/js/products.js"></script>

        <script>
            function setEditModal(id, denumire, pret, unitate, categorie, imagine){
                $("#editProdusId").val(id);
                $("#editProdusName").val(denumire);
                $("#editProdusCategory").val(categorie);
                $("#editProdusPretUnitar").val(pret);
                $("#editProdusUM").val(unitate);
                $("#editProdusImagine").val(imagine);
            }
            //TODO ADD FLAVOUR
            function editProdus(){
                id = $("#editProdusId").val();
                alert(id);
                $.ajax({
                    type: 'POST',
                    url: 'requests/editProdus.php',
                    data:{
                        editID: id,
                        editNameProduct: $("#editProdusName").val(),
                        editCategory: $("#editProdusCategory").val(),
                        editPriceProduct: $("#editProdusPretUnitar").val(),
                        editUnitProduct: $("#editProdusUM").val(),
                        editImageProduct: $("#editProdusImagine").val()
                    },
                    success: function (result){
                        if(result === "Success"){
                            $("#editModal").modal('hide');
                            reloadProducts();
                        }
                        else{
                            alert("Ne cerem scuze, a apărut o erorare");
                            console.log("error" + result);
                        }
                    }
                });
            }

        </script>

    </head>
    <body>
        <div class="wrapper">
            <?php
            include("adminSidebar.php");
            ?>
            <div class = "container" style="margin-top: 25px">
            <div class="row">
                <div class = "col-sm-12">
                    <?php
                    //var_dump($_POST);
                    if(isset($_POST["newProductName"])) {
                        $sqlinsert =  $_POST["newProductName"] . "\", \"" . $_POST["newProductPrice"] . "\",\"" . $_POST["newProductUnit"] . "\",\"" . $_POST["newProductPhoto"] . " \",\"" . $_POST["newProductCategory"] . " \")";
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

                    ?>
                    <div class="productTitle">
                        <button type="button" id="sidebarCollapse" onclick="collapse()" class="btn btn-info navbar-btn">
                            <i class="fas fa-align-left"></i>
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
                        <h4 class="modal-title">Edit Product</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>ID Produs</label>
                            <input type="text" class="form-control" id="editProdusId" disabled>
                        </div>
                        <div class="form-group">
                            <label>Denumire Produs</label>
                            <input type="text" class="form-control" id="editProdusName" required>
                        </div>
                        <div class="form-group">
                            <label>Categorie</label>
                            <input type="text" id="editProdusCategory" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Preț/Unitate de măsură</label>
                            <input type="text" id="editProdusPretUnitar" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Unitate de măsură</label>
                            <input type="text" id="editProdusUM" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Imagine</label>
                            <input type="text" id="editProdusImagine" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        <input type="submit" class="btn btn-info" value="Save" id="editSaveButton" onclick="editProdus()">
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
                <form action="products.php" method="post">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Add New Product</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <label for="newProductName" >Denumire produs</label>
                                    <input type="text" id="newProductName" name="newProductName" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <label>Categorie</label>
                                    <input type="text" name="newProductCategory" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <label>Preț/Unitate de măsură</label>
                                    <input type="number" name="newProductPrice" class="form-control" required>
                                </div>
                                <div class="col-sm-6">
                                    <label>Unitate de măsură</label>
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
                            <div class="row" id="galleryHere"> </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

