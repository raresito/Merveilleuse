<?php
require_once 'requests/dbConnectClient.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if(isset($_SESSION["email"]))
    header("Location: basket.php");

//TODO Replace md5 with password HASH
?>

<html>

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
    <link rel="stylesheet" href="../resources/css/register.css">
    <script src = "../resources/js/register.js"></script>

</head>

<body>
<?php include 'clientnavbar.php';?>
<div class="container-fluid" style="margin-top: 100px;">

    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6 content">
            <div id="response">

            </div>
            <span id="confirmMessage" class="confirmMessage"></span>
            <div class="form-group">
                <label for="surnameInput">
                    Prenume
                </label>
                <input type="text" class="form-control" id="surnameInput" name="surname"/>
            </div>
            <div class="form-group">
                <label for="nameInput">
                    Nume
                </label>
                <input type="text" class="form-control" id="nameInput" name="name"/>
            </div>
            <div class="form-group">
                <label for="inputEmail">
                    Email address
                </label>
                <input type="email" class="form-control" id="inputEmail" name="email"/>
            </div>
            <div class="form-group">
                <label for="inputPassword">
                    Password
                </label>
                <input type="password" class="form-control" id="inputPassword" name="password"/>
            </div>
            <div class="form-group">
                <label for="checkPassword">
                   Confirm Password
                </label>
                <input type="password" onkeyup="checkPass(); return false;" class="form-control" id="checkPassword" />
            </div>
            <div class="checkbox">
                <label>
                    <input type="checkbox" /> Remember me!
                </label>
            </div>
            <button type="button" onclick="register()" class="btn btn-primary">
                Submit
            </button>
        </div>
        <div class="col-md-3"></div>
    </div>
</div>
</body>
</html>
