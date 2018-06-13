<?php

require_once '../dbconnect.php';

function console_log($data){
    echo '<script>';
    echo 'console.log('. $data .')';
    echo '</script>';
}

?>

<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../resources/css/spinnerAdmin.css">

    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <link type="text/css" rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" >
    <link href="../resources/css/merveilleuseSideBar.css" rel="stylesheet">

    <script>
        $(document).ready(function() {
            reloadOrders();

        } );
    </script>

    <script>

        function reloadOrders(){
            $.ajax({
                type: 'POST',
                url: '../selectOrders.php',
                data:{type: "default" },
                success: function (d){
                    let myArray = JSON.parse(d);
                    table = document.getElementById("table_id");
                    head = "<thead><tr><th>#</th><th>userID</th><th>Delivery Status</th><th>Delivery Date</th> <th>Order Status</th> <th>Actions</th>  </tr></thead>";
                    ceva = '';
                    for(var i = 0; i < myArray.length; i++){
                        ceva = ceva + "<tr> <td>" + myArray[i].orderID + "</td> <td> " + myArray[i].userID + " </td> <td> " + ((myArray[i].deliveryStatus !== "0") ? "Delivered" : "Not Delivered" ) + " </td> <td> " + ((myArray[i].deliveryDate !== null) ? myArray[i].deliveryDate : "Not Delivered" ) + " </td> <td> " + ((myArray[i].orderStatus !== "0") ? "Delivered" : "Not delivered") + " </td> <td> " +
                                      " <button type=\"button\" class=\"btn btn-sm\" data-toggle=\"modal\" data-target=\"#viewOrderModal\"><i class=\"material-icons\" data-toggle=\"tooltip\" data-target=\"\" title=\"View\" onclick=\"populateModal(" + myArray[i].orderID + ")\"> <i class=\"fas fa-eye\"></i></button>\n" +
                                      " </td>"
                    }
                    body = "<tbody>" + ceva + "</tbody>";
                    document.getElementById("spinnerOrders").innerHTML = '';
                    table.innerHTML = head + body;
                    $('#table_id').DataTable();
                }
            });
        }

        function populateModal(id){
            let table = document.getElementById("modalTable");
            try {
                table.removeChild(table.firstChild);
                table.removeChild(table.firstChild);
            }
            catch{

            }
            $.ajax({
                type: 'POST',
                url: '../selectOrders.php',
                data:{type: "single", orderID: id},
                success: function(d){
                    document.getElementById("modal-title").innerHTML = "Order no.<strong>" + id + "</strong>";
                    let productsArray = JSON.parse(d);
                    let table = document.getElementById("modalTable");
                    let thead = document.createElement("THEAD");
                    thead.innerHTML = "<thead>\n" +
                                      "    <th> ID Produs  </th>\n" +
                                      "    <th> Imagine  </th>\n" +
                                      "    <th> Denumire  </th>\n" +
                                      "    <th> Cantitate  </th>\n" +
                                      "    <th> Categorie </th>\n" +
                                      "</thead>";
                    let tbody = document.createElement("TBODY");
                    for(let i = 0; i < productsArray.length; i++){
                        let row = document.createElement("TR");
                        row.innerHTML = "<td>" + productsArray[i].product_id + "</td>" +
                                        "<td><img src='../resources/res/foto/" + productsArray[i].image + "' style=\"max-height: 70px;\"></td>" +
                                        "<td>" + productsArray[i].nameProduct + "</td>" +
                                        "<td>" + productsArray[i].quantity + "</td>" +
                                        "<td>" + productsArray[i].category + "</td>";
                        tbody.appendChild(row);
                    }

                    table.appendChild(thead);
                    table.appendChild(tbody);
                }
            })
        }
    </script>
</head>
<body>
<div class="wrapper">
    <?php
        include("adminSidebar.php");
    ?>

    <div class = "container">
        <div class="row">
            <div class="col">
                <button type="button" id="sidebarCollapse" onclick="collapse()" class="btn btn-info navbar-btn">
                    <i class="glyphicon glyphicon-align-left"></i>
                    <span></span>
                </button>
                <h3 class="text-left">
                    Orders
                </h3>
                <div id="spinnerOrders" >
                    <div  class="lds-spinner"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
                </div>
                <table id="table_id" class="display">

                </table>
            </div>
        </div>
    </div>
</div>

<div id="viewOrderModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 id="modal-title" class="modal-title">Order no.</h4>
            </div>
            <div class="modal-body">
                <div
                <table id = "modalTable" class="table">

                </table>
            </div>
            <div class="modal-footer">
                <button class="btn btn-info" onclick="setOrderTaken()">Comandă preluată</button>
                <button class="btn btn-warning" onclick="setOrderDelivered()">Comandă livrată</button>
            </div>
    </div>
</div>
</body>
</html>