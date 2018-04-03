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


    </head>
    <body>
    <?php
        include('navbar.php');
    ?>



        <div class = "container-fluid">
            <div class="row">
                <div class="col-sm-2 content side-bar">
                    <div class="brand" >
                        Merveilleuse
                        <div class = "toggle-button">
                            <img id="sidebarButon" src="res/menu_icon.png" alt="Mountain View">
                        </div>
                    </div>
                    <div id="sidebarID" class="menu-list active">
                        <ul class="menu-content">
                            <li>
                                <span href="#"> <span class="glyphicon glyphicon-stats"></span> Dashboard </span>
                            </li>
                            <li>
                                <a href="productListPanel.php"><span href="#"> <span class="glyphicon glyphicon-th-list"></span> Product List </span></a>
                            </li>
                            <li>
                                <a href = usersPanel.php><span href="#"> <span class="glyphicon glyphicon-user"></span> Users </span> </a>
                            </li>
                            <li>
                                <span href="#"> <span class="glyphicon glyphicon-tags"></span> Orders </span>
                            </li>
                            <li>
                                <span href="#"> <span class="glyphicon glyphicon-camera"></span> Gallery </span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class = "col-sm-10">
                    <div class="productTitle">
                        <h1 class = "h2">Product List</h1>
                        <button type="button" class="btn btn-sm" data-toggle="modal" data-target="#addModal"><i class="material-icons" data-toggle="tooltip" data-target="" title="Add">add_circle_outline</i></button>
                    </div>
                    <div class="row col-8 productTable">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Icon</th>
                                    <th>Name</th>
                                    <th>Price/Unit</th>
                                    <th></th>
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
                                            <td> <img src="res/unu.jpg"> </td>
                                            <td>'. $row["nameProduct"] .'</td>
                                            <td>'. $row["priceProduct"] . "/" . $row["unitProduct"] .'</td>
                                            <td>'. "ceva" .'</td>
                                            <td>
            
                                                <button type="button" class="btn btn-sm" data-toggle="modal" data-target="#editModal"><i class="material-icons" data-toggle="tooltip" data-target="" title="Edit">&#xE254;</i></button>
                                                <button type="button" class="btn btn-sm" data-toggle="modal" data-target="#deleteModal"><i class="material-icons" data-toggle="tooltip" data-target="" title="Delete">delete</i></button>
                                            </td>
                                        </tr>';
                                }
                            } else {
                                echo "0 results";
                            }
                            ?>
                            <!--
                            <tr>
                                <td>
                                        <span class="custom-checkbox">
                                            <input type="checkbox" id="checkbox1" name="options[]" value="1">
                                            <label for="checkbox1"></label>
                                        </span>
                                </td>
                                <td> <img src="res/unu.jpg"> </td>
                                <td>Tort cu Jeleu</td>
                                <td>78 lei / kg</td>
                                <td>(171) 555-2222</td>
                                <td>

                                    <button type="button" class="btn btn-sm" data-toggle="modal" data-target="#editModal"><i class="material-icons" data-toggle="tooltip" data-target="" title="Edit">&#xE254;</i></button>
                                    <button type="button" class="btn btn-sm" data-toggle="modal" data-target="#deleteModal"><i class="material-icons" data-toggle="tooltip" data-target="" title="Delete">delete</i></button>
                                </td>
                            </tr>
                            -->
                            </tbody>
                        </table>
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

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Edit Product</h4>
                    </div>
                    <div class="modal-body">
                        <p>Some text in the modal.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

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
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="newProductName" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Price/Unit</label>
                                <input type="email" name="newProductPriceperUnit" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label></label>
                                <textarea class="form-control" required></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                            <input type="submit" class="btn btn-info" name="saveNewProduct" value="Save">
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </body>
</html>

