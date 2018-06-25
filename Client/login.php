<?php
//TODO SEND MAIL TO CONFIRM
include "requests/dbConnectClient.php";
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if(isset($_SESSION['email'])) {
    header ("Location: basket.php");
}
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="shortcut icon" href="../resources/img/favicon.ico" />
        <title>Merveilleuse Shop</title>

        <?php include '../libraries.php'; ?>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="../resources/css/basket.css">
        <link rel="stylesheet" href="../resources/css/login.css">



    </head>

    <body>
        <?php include 'clientnavbar.php';?>
        <div class="container-fluid respect">
            <div class="row">
                <div class="col-md-6 offset-md-3 content">
                    <div id="loginResult" class="alert alert-danger" hidden>
                        Te rog scrie un mail!
                    </div>
                    <div id="loginWrong" class="alert alert-danger" hidden>
                        Te rog scrie un mail!
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">
                            Email address
                        </label>
                        <input type="email" class="form-control" id="inputEmail" required/>
                    </div>
                    <div class="form-group">
                        <label for="InputPassword">
                            Password
                        </label>
                        <input type="password" class="form-control" id="inputPassword" required/>
                    </div>

                    <div class="buttons">
                        <button id="submitForm" onclick="loginCheck()" class="btn btn-primary">
                            Submit
                        </button>
                        <a href="register.php">Creează Cont</a>
                    </div>
                </div>
            </div>
        </div>
        <script>
            function loginCheck(){
                document.getElementById("loginWrong").hidden = true;
                document.getElementById("loginResult").hidden = true;

                $.ajax({
                    type: 'POST',
                    url: 'requests/loginCheck.php',
                    data: {
                        email: document.getElementById("inputEmail").value,
                        password: document.getElementById("inputPassword").value
                    },
                    success: function(d){
                        if(d === "Success!"){
                            window.location = 'basket.php';
                        }
                        else{
                            if(d === "Wrong"){
                                document.getElementById("loginWrong").hidden = false;
                            } else {
                                document.getElementById("loginResult").hidden = false;
                                console.log("Error on login" + d);
                            }
                        }
                    }
                });
            }
        </script>
    </body>
    </html>
