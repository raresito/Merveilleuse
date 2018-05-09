<?php

if(isset($_SESSION["email"])){
    header("Location: basket.php");
}

include "../dbconnect.php";
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

function console_log($data){
    echo '<script>';
    echo 'console.log('. $data .')';
    echo '</script>';
}



if(!isset($_SESSION['email'])) {
    if (isset($_POST['email'])) {
        $sql = "SELECT * FROM users WHERE email ='" . $_POST['email'] . "';";

        $result = mysqli_query($conn, $sql);
        if ($result && $result -> num_rows == 1) {

            $row = $result -> fetch_assoc();
            $_SESSION["email"] = $row["email"];
            $_SESSION["name"] = $row["name"];
            $sql = "UPDATE users SET lastLogin = '" . date("Y-m-d H:i:s") . "' WHERE email ='" . $_POST['email'] . "';";
        } else
            if (!$result) {
                echo 'No result';
                echo "Error: Our query failed to execute and here is why: \n";
                echo "Query: " . $sql . "\n";
                echo "Errno: " . $conn -> errno . "\n";
                echo "Error: " . $conn -> error . "\n";
            }
    }
}
else{
    console_log("apca");
    header ("Location: basket.php");
}
?>
    <html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Merveilleuse Shop</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="../resources/css/basket.css">

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script>
    </head>

    <body>
        <?php include 'clientnavbar.php';?>
        <div class="container-fluid" style="margin-top: 100px;">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <form action = "login.php" method = "post" role="form">
                        <div class="form-group">
                            <label for="exampleInputEmail1">
                                Email address
                            </label>
                            <input type="email" class="form-control" id="exampleInputEmail1" name="email"/>
                        </div>
                        <div class="form-group">
                            <label for="InputPassword">
                                Password
                            </label>
                            <input type="password" class="form-control" id="InputPassword" name="password"/>
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
