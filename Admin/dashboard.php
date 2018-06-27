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
    <link href="../resources/css/merveilleuseSideBar.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.min.js"></script>

    <script>

        window.onload = function(){
            today();
            openOrderCount();
            doneOrderCount();
        };
        function today(){
            let today = new Date();
            let dd = today.getDate();
            let mm = today.getMonth()+1; //January is 0!
            let yyyy = today.getFullYear();

            document.getElementById("todayDiv").innerText += dd + "/" + mm + "/" + yyyy;

        }

        function openOrderCount(){
            $.ajax({
                type: 'POST',
                url: '../selectOrders.php',
                data:{type: "open"},
                success: function (d){
                    document.getElementById("divOpenOrderCount").innerText = d;
                }
            });
        }

        function doneOrderCount(){
            $.ajax({
                type: 'POST',
                url: '../selectOrders.php',
                data:{type: "done"},
                success: function (d){
                    document.getElementById("divDoneOrderCount").innerText = d;
                }
            });
        }


    </script>

    <!-- TODO GDPR -->

</head>
<body>
<div class="wrapper">
    <?php
    include("adminSidebar.php");
    ?>
    <div class = "container" style="margin-top: 25px">
        <button type="button" id="sidebarCollapse" onclick="collapse()" class="btn btn-info navbar-btn">
            <i class="fas fa-align-left"></i>
            <span></span>
        </button>
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Dashboard</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">

                    <div class="card-body">
                        <h5 class="card-title">Comenzi primite:  </h5><div id="divOpenOrderCount" class="huge"></div>
                    </div>
                    <a href="orders.php">
                        <div class="card-footer">
                            <span class="pull-left">Vezi Comenzi</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card text-white bg-secondary mb-3" style="max-width: 18rem;">

                    <div class="card-body">
                        <h5 class="card-title">Bonul de Consum,  </h5>
                        <div id="todayDiv">

                        </div>
                    </div>
                    <a href="bonConsum.php">
                        <div class="card-footer">
                            <span class="pull-left">Descarca PDF</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card text-white bg-info mb-3" style="max-width: 18rem;">

                    <div class="card-body">
                        <h5 class="card-title">Comenzi livrate luna aceasta:</h5><div id="divDoneOrderCount" class="huge"></div>
                    </div>
                    <a href="orders.php">
                        <div class="card-footer">
                            <span class="pull-left">Vezi Comenzi</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="row">
            <div style="width:600px; height: 300px"></div>
        </div>
    </div>
</body>