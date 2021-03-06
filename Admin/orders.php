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

<html>
<head>
    <?php include '../libraries.php'; ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

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
                    head = "<thead><tr>" +
                                "<th>#</th>" +
                                "<th>userID</th>" +
                                "<th>Order Date </th> " +
                                "<th>Order Status</th> " +
                                "<th>Delivery Status</th>" +
                                "<th>Delivery Date</th> " +
                                "<th>Actions</th>  " +
                            "</tr></thead>";
                    ceva = '';
                    for(let i = 0; i < myArray.length; i++){
                        console.log(myArray[i]);
                        ceva = ceva + "<tr> " +
                                        "<td>" + myArray[i].idOrder + "</td>" +
                                        "<td> " + myArray[i].idUser + " </td> " +
                                        "<td> " + ((myArray[i].orderDate !== null) ? myArray[i].orderDate : "În selecție") + " </td>" +
                                        "<td> " + ((myArray[i].orderStatus !== "0") ? "Plasată!" : "În selecție") + " </td>" +
                                        "<td> " + ((myArray[i].deliveryStatus !== "0") ? "Livrată" : "Nelivrată" ) + " </td>" +
                                        "<td> " + ((myArray[i].deliveryDate !== null) ? myArray[i].deliveryDate : "Nelivrată" ) + " </td>" +
                                        "<td> <button type=\"button\" class=\"btn btn-sm\" style = \"width:100%\" data-toggle=\"modal\" data-target=\"#viewOrderModal\"><i class=\"material-icons\" data-toggle=\"tooltip\" data-target=\"\" title=\"View\" onclick=\"populateModal(" + myArray[i].idOrder + ")\"> <i class=\"fas fa-eye\"></i></button> </td>"
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
                    console.log(d);
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
                        row.innerHTML = "<td>" + productsArray[i].idProduct + "</td>" +
                                        "<td><img src='../resources/img/foto/" + productsArray[i].image + "' style=\"max-height: 70px;\"></td>" +
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

        function setOrderTaken() {
            tables = document.getElementById("modal-title");
            orderNumber = tables.innerText;
            orderNumber = orderNumber.substring(9);
            alert(orderNumber);

            $.ajax({
                type: 'POST',
                url: 'requests/editOrder.php',
                data: {
                    id: orderNumber,
                    set: 'orderStatus'
                },
                success: function (d) {
                    console.log(d + "set orderStatus");
                    reloadOrders();
                }
            });
        }

        function setOrderDelivered() {
            tables = document.getElementById("modal-title");
            orderNumber = tables.innerText;
            orderNumber = orderNumber.substring(9);
            alert(orderNumber);

            $.ajax({
                type: 'POST',
                url: 'requests/editOrder.php',
                data: {
                    id: orderNumber,
                    set: 'deliveryStatus'
                },
                success: function (d) {
                    console.log(d + "set deliveryStatus");
                    reloadOrders();
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
            <div class="col">
                <button type="button" id="sidebarCollapse" onclick="collapse()" class="btn btn-info navbar-btn">
                    <i class="fas fa-align-left"></i>
                    <span></span>
                </button>
                <h3 class="text-left">
                    Orders
                </h3>
                <hr>
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
                <h4 id="modal-title" class="modal-title">Order no.</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div
                <table id = "modalTable" class="table"></table>
            </div>
            <div class="modal-footer">
                <button class="btn btn-info" onclick="setOrderTaken()" >Comandă preluată</button>
                <button class="btn btn-warning" onclick="setOrderDelivered()">Comandă livrată</button>
            </div>
    </div>
</div>
</body>
</html>