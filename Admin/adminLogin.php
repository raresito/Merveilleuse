<?php

    require_once '../dbconnect.php';
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

            if(!$result){
                echo'No result';
                echo "Error: Our query failed to execute and here is why: \n";
                echo "Query: " . $sql . "\n";
                echo "Errno: " . $conn->errno . "\n";
                echo "Error: " . $conn->error . "\n";
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

     <?php include '../libraries.php'; ?>
     <link href="../resources/css/adminLogin.css" rel="stylesheet">

</head>
<body>

<div class="flex-center" style="height: 100%;">
<div class="container-fluid flex-center flex-column" >
    <div class="row">
        <img src="../resources/img/logo.jpg">
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

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>