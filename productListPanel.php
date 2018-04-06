<?php

require_once 'dbconnect.php';

function console_log($data){
    echo '<script>';
    echo 'console.log('. $data .')';
    echo '</script>';
}

?>

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

        <link href="css/merveilleuseSideBar.css" rel="stylesheet">
        <link href="css/merveilleuseProductList.css" rel="stylesheet">
        <script src="js/merveilleuseSideBar.js"></script>

        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="css/Lightbox-Gallery.css">

        <script>

            var selectedPhoto;
            function SelectPhoto(e) {
                if(e.classList.contains("chosen-picture")){
                    e.classList.remove("chosen-picture");
                    selectedPhoto = null;
                }
                else {
                    e.classList.add("chosen-picture");
                    selectedPhoto = e;
                }
                for(var i = 1; i < e.parentElement.childNodes.length-2; i++){
                    if(e.parentElement.childNodes[i] === e){
                        i++;
                    }
                    //alert(e.parentElement.childNodes[i].classList);
                    if(typeof e.parentElement.childNodes[i].classList !== 'undefined')
                        if(e.parentElement.childNodes[i].classList.contains("chosen-picture"))
                            e.parentElement.childNodes[i].classList.remove("chosen-picture");
                }
                //alert(e.parentElement.childNodes[2].innerHTML);
                changePhotoPrompt();
            }
            function changePhotoPrompt(){
                var space = document.getElementById("photoPrompt");
                if(selectedPhoto != null){
                    space.innerHTML = "Selected photo:" + selectedPhoto.children[0].children[0].getAttribute('src').split("/")[2];
                }
            }

            function sendChosenPhoto(){
                if(selectedPhoto != null){
                    mydiv = document.getElementById("photoPreview");
                    mydiv.innerHTML = selectedPhoto.children[0].children[0].getAttribute('src').split("/")[2] + "<input type=\"hidden\" name=\"newProductPhoto\" value=\"" + selectedPhoto.children[0].children[0].getAttribute('src').split("/")[2] + " \"/>";
                }
            }

            function selectDelete(ceva){
                //alert(ceva);
                document.getElementById("deleteProduct").innerText = ceva;
                document.getElementById("deleteInput").innerText = ceva;
                console.log(document.getElementById("deleteInput").innerText)
            }

            $(document).ready(function (){
                $("#galleryButton").click(function(){
                    $.ajax({
                        type: "POST",
                        url: "retrieveGallery.php",
                        dataType: "html",
                        success: function(response){
                            $("#galleryHere").html(response);
                        }
                    })
                })
            })


        </script>

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
                              <strong>Șters!</strong> Ai șters produsul'.$_POST["deleteProduct"].'
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
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Icon</th>
                                    <th>Name</th>
                                    <th>Price/Unit</th>
                                    <th>Category</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    echo '<tr>
                                            <td>
                                                    <span class="custom-checkbox">
                                                        <input type="checkbox" id="checkbox1" name="options[]" value="1">
                                                        <label for="checkbox1"></label>
                                                    </span>
                                            </td>
                                            <td> <img src="res/foto/'.$row["image"] . '"> </td>
                                            <td>'. $row["nameProduct"] .'</td>
                                            <td>'. $row["priceProduct"] . "/" . $row["unitProduct"] .'</td>
                                            <td>'. $row["category"] .'</td>
                                            <td>
            
                                                
                                               <!-- <button type="button" class="btn btn-sm" data-toggle="modal" data-target="#deleteModal"><i class="material-icons" data-toggle="tooltip" data-target="" title="Delete" onClick="selectDelete(\''. $row["nameProduct"] .'\')">delete</i></button>-->
                                                <form method="post" action="productListPanel.php" onsubmit="return confirm(\'Are you sure you want to delete '. $row["nameProduct"] .'\');">
                                                    <button type="button" class="btn btn-sm" data-toggle="modal" data-target="#editModal"><i class="material-icons" data-toggle="tooltip" data-target="" title="Edit">&#xE254;</i></button>
                                                    <button type="submit" class="btn btn-sm" name="deleteProduct" value="'.$row["idProduct"].'"><i class="material-icons" title="Delete">delete</i></button>
                                                </form>
                                            </td>
                                        </tr>';
                                }
                            } else {
                                echo "0 results";
                            }
                            ?>
                            </tbody>
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
                            <label>Name</label>
                            <input type="text" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Category</label>
                            <input type="text" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Price/Unit</label>
                            <input type="email" class="form-control" required>
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
                <form action="productListPanel.php" method="post"><div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Remove product</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <p>Are you sure you want to delete <div id="deleteProduct"></div> ?</p>
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
                <form action="productListPanel.php" method="post">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Add New Product</h4>
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
                            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                            <input type="submit" class="btn btn-info"  name="submit" value="UPLOAD">
                        </div>
                    </div>

                </form>
            </div>
        </div>

        <div id="galleryModal" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="photo-gallery">
                    <div class="row" style="padding: 35px;">
                        <div class="intro">
                            <h2 class="text-center">Gallery</h2>
                            <form class="form-inline">
                                <div class="form-group">
                                    <label id="photoPrompt">Selected photo:</label>
                                </div>
                                <input type="button" onclick="sendChosenPhoto()"class="btn btn-default" data-dismiss="modal" value="Confirm">
                            </form>
                        </div>
                        <div id="galleryHere">
                            <?php
/*                            include("retrieveGallery.php");
                            */?>
                        <div>
                    </div>
                </div>
            </div>
        </div>

    </body>
</html>

