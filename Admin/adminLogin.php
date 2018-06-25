<?php

    require_once 'requests/dbConnectAdmin.php';
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if(!isset($_SESSION['email'])){
        if(isset($_POST['email'])){
            $sql = "SELECT * FROM users WHERE email ='" . $_POST['email'] . "' AND admin = 1 AND password = '".md5($_POST["password"])."';";
            $result = mysqli_query($conn,$sql);
            if ($result->num_rows > 0) {
                while ($row = $result -> fetch_assoc()) {
                    $_SESSION["email"] = $row["email"];
                    $_SESSION["name"] = $row["name"];
                }
                header("location: dashboard.php");
            }
            else{
                echo '<div class="alert alert-danger" role="alert">
                                A apărut o problemă, mai încearcă odată!
                            </div>';
            }
        }
    }
    else{
        if(isset($_POST["logoutVariable"])) {
            if ($_POST["logoutVariable"] == "true") {
                session_unset();
                session_destroy();
                header("Location: adminLogin.php");
            }
        }
        header("Location: dashboard.php");
    }
?>
<html>
<head>


    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../resources/img/favicon.ico" />
     <?php include '../libraries.php'; ?>

    <style>
        .flex-center{
            display: flex;
            align-items: center;
        }
        .flex-column{
            flex-direction: column;
        }
    </style>

</head>
<body>

<div class="flex-center" style="height: 100%;">
<div class="container-fluid flex-center flex-column" >
    <div class="row">
        <img src="../../resources/img/logo.jpg"> <!-- TODO Fix dieses -->
    </div>
    <?php
    if(isset($_POST["logoutVariable"]) && $_POST["logoutVariable"] == "true"){
        echo'
             <div class="alert alert-primary" role="alert">
                   Te-ai delogat cu succes!
             </div>  
        ';
    }
    ?>
    <div id="alertDiv" class="row">

    </div>
    <div class="row" style="width:100%;">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <form id = "loginForm" action = "adminLogin.php" method = "post" role="form">
                <div class="form-group">

                    <label for="exampleInputEmail1">
                        Email address
                    </label>
                    <input type="email" class="form-control" id="exampleInputEmail1" name="email"/>
                </div>
                <div class="form-group">

                    <label for="exampleInputPassword1">
                        Password
                    </label>
                    <input type="password" class="form-control" id="exampleInputPassword1" name="password"/>
                </div>
                <div class="checkbox">

                    <label>
                        <input type="checkbox" /> Remember me!
                    </label>
                </div>
                <button type="submit" class="btn btn-primary">
                    Submit
                </button>
            </form>
        </div>
        <div class="col-md-3"></div>
    </div>
</div>
</div>
</body>
</html>