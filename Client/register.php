<?php
require_once '../dbconnect.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if(isset($_SESSION["email"]))
    header("Location: /Client/basket.php");
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



    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script>

    <script>
        function checkPass(){ //TODO Prevent SQL injection on form input
            var goodColor = "#66cc66";
            var badColor = "#ff6666";

            var message = document.getElementById('confirmMessage');

            pass1 = document.getElementById("InputPassword");
            pass2 = document.getElementById("checkPassword");

            if(pass1.value === pass2.value){
                pass2.style.backgroundColor = goodColor;
                message.style.color = goodColor;
                message.innerHTML = "Passwords Match!"
            }else{
                //The passwords do not match.
                //Set the color to the bad color and
                //notify the user.
                pass2.style.backgroundColor = badColor;
                message.style.color = badColor;
                message.innerHTML = "Passwords Do Not Match!"
            }
        }

        function register(){
            $.ajax({
                type: 'POST',
                url: 'requests/registerCheck.php',
                data: {
                    email: document.getElementById("inputEmail"),
                    password: document.getElementById("inputPassword"),
                    surname: document.getElementById("surnameInput"),
                    name: document.getElementById("nameInput")
                },
                success: function(d){
                    if(d === "Success!"){
                        response.innerHTML = "<div class=\"alert alert-success\" role=\"alert\">" +
                                               "<strong>Felicitări!</strong> Tocmai ți-ai creat un cont nou! Te rugăm să validezi contul prin <strong> linkul primit pe mail!</strong>" +
                                           "</div>";
                    } else {
                        response.innerHTML = "<div class=\"alert alert-danger\" role=\"alert\">" +
                                                "Deja există un cont cu această adresă de email. Ți-ai uitat parola?" +
                                             "</div>"
                    }
                }
            });
        }
    </script>
</head>

<body>
<?php include 'clientnavbar.php';?>
<div class="container-fluid" style="margin-top: 100px;">

    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6 content">
            <div id="response"></div>
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
                <label for="exampleInputEmail1">
                    Email address
                </label>
                <input type="email" class="form-control" id="inputEmail" name="email"/>
            </div>
            <div class="form-group">
                <label for="InputPassword">
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
