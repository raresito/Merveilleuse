<?php

    require_once '../dbconnect.php';
    session_start();

    if(!isset($_SESSION['email'])){
        if(isset($_POST['email'])){
            $sql = "SELECT * FROM admin WHERE email ='" . $_POST['email'] . "';";
            $result = mysqli_query($conn,$sql);
            if ($result->num_rows > 0) {
                while ($row = $result -> fetch_assoc()) {
                    $_SESSION["email"] = $row["email"];
                    $_SESSION["role"] = $row["role"];
                    $_SESSION["name"] = $row["name"];
                }
                //echo $_SESSION["email"];
            }
            else

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
        header("Location: productListPanel.php");
    }
?>



<html>
<head>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link href="../resources/css/adminLogin.css" rel="stylesheet">


</head>

<body>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <form action = "adminLogin.php" method = "post" role="form">
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
</body>
</html>