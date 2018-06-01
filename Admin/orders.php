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


    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="../resources/css/spinnerAdmin.css">

    <script>

        $(document).ready( function () {
            $('#table_id').DataTable();
        } );

        function reloadOrders(){
            $.ajax({
                type: 'POST',
                url: 'selectOrders.php',
                data:{type: "default" },
                success: function (d){
                    //document.getElementById("debug").innerHTML = d;
                    var myArray = JSON.parse(d);
                    table = document.getElementById("table_id");
                    head = "<thead><tr><th>#</th><th>userID</th><th>Delivery Status</th><th>Delivery Date</th> <th>Order Status</th> <th>Actions</th>  </tr></thead>";
                    ceva = '';
                    for(var i = 0; i < myArray.length; i++){
                        ceva = ceva + "<tr> <td>" + myArray[i].orderID + "</td> <td> " + myArray[i].userID + " </td> <td> " + ((myArray[i].deliveryStatus !== "0") ? "Delivered" : "Not Delivered" ) + " </td> <td> " + ((myArray[i].deliveryDate !== null) ? myArray[i].deliveryDate : "Not Delivered" ) + " </td> <td> " + ((myArray[i].orderStatus !== "0") ? "Delivered" : "Not delivered") + " </td> <td> " +
                            " <button type=\"button\" class=\"btn btn-sm\" data-toggle=\"modal\" data-target=\"#editModal\"><i class=\"material-icons\" data-toggle=\"tooltip\" data-target=\"\" title=\"Edit\">&#xE254;</i></button>\n" +
                            " <button type=\"button\" class=\"btn btn-sm\" data-toggle=\"modal\" data-target=\"#deleteModal\"><i class=\"material-icons\" data-toggle=\"tooltip\" data-target=\"\"  title=\"Delete\" ></i></button>\n" +
                            " </td>"
                    }
                    body = "<tbody>" + ceva + "</tbody>";
                    document.getElementById("spinnerOrders").innerHTML = '';
                    table.innerHTML = head + body;
                }
            });
        };

        reloadOrders();
    </script>



    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.js"></script>

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
</body>
</html>