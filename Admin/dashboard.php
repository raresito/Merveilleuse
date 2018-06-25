<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require 'requests/dbConnectAdmin.php';


$sql = "Select * from users where email = '".$_SESSION["email"]."' LIMIT 1 ";
$result = mysqli_query($conn,$sql);
$row = $result ->fetch_assoc();
if($row["admin"] == 0){
    header("Location: adminLogin.php");
}


?>

<html>
<head>
    <?php include '../libraries.php'; ?>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../resources/css/merveilleuseSideBar.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.min.js"></script>

    <script>

        window.onload = function(){
            today();
            openOrderCount();
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


    </script>


</head>
<body>
<div class="wrapper">
    <?php
    include("adminSidebar.php");
    ?>
    <div class = "container">
        <button type="button" id="sidebarCollapse" onclick="collapse()" class="btn btn-info navbar-btn">
            <i class="glyphicon glyphicon-align-left"></i>
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
        </div>
        <div class="row">
            <div style="width:600px; height: 300px">
                <canvas id="myChart" width="100" height="100"></canvas>
                <script>

                    let counts;
                    window.onload = function() {
                        counts = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];

                        $.ajax({
                            type: 'POST',
                            url: 'requests/countOrders.php',
                            success: function (d) {
                                console.log(d);
                                array = JSON.parse(d);
                                for (let i in array) {
                                    alert(array[i].month);
                                    counts[parseInt(array[i].month)] = parseInt(array[i].cnt);
                                }
                            }

                        });
                    };

                    let ctx = document.getElementById("myChart").getContext('2d');

                    let myChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: ["Ianuarie", "Februarie", "Martie", "Aprilie", "Mai", "Iunie", "Iulie", "August", "Octombrie", "Noiembrie", "Decembrie"],
                            datasets: [{
                                label: '# of Votes',
                                data: counts,
                                backgroundColor: [
                                    'rgba(255, 99, 132, 0.2)',
                                    'rgba(54, 162, 235, 0.2)',
                                    'rgba(255, 206, 86, 0.2)',
                                    'rgba(75, 192, 192, 0.2)',
                                    'rgba(153, 102, 255, 0.2)',
                                    'rgba(255, 159, 64, 0.2)'
                                ],
                                borderColor: [
                                    'rgba(255,99,132,1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(255, 206, 86, 1)',
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(153, 102, 255, 1)',
                                    'rgba(255, 159, 64, 1)'
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero:true
                                    }
                                }]
                            },
                        }
                    });
                </script>
            </div>
        </div>
    </div>
</body>