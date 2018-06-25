<?php
require_once 'requests/dbConnectClient.php';
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

    <script>


        function checkPass(){ //TODO Prevent SQL injection on form input
            let goodColor = "#66cc66";
            let badColor = "#ff6666";

            let message = document.getElementById('confirmMessage');

            pass1 = document.getElementById("inputPassword");
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

        function validateCode() {
            $.ajax({
                type: 'POST',
                url: 'requests/validateCode.php',
                data: {
                    code: document.getElementById("validationCode").value
                },
                success: function (d) {
                    if(d === "ok"){
                        rp = document.getElementById("response");
                        rp.innerHTML = "<div class=\"alert alert-success\" role=\"alert\">" +
                            "<strong>Cont autentificat!</strong> Acum poți cumpăra!" +
                            "</div>";
                    }
                }
            });
        }

        function register(){
            $.ajax({
                type: 'POST',
                url: 'requests/registerCheck.php',
                data: {
                    email: document.getElementById("inputEmail").value,
                    password: document.getElementById("inputPassword").value,
                    surname: document.getElementById("surnameInput").value,
                    name: document.getElementById("nameInput").value
                },
                success: function(d) {
                    rp = document.getElementById("response");
                    console.log(d);
                    if(d !== "Account exists!"){
                        let name = document.getElementById("nameInput").value + " " + document.getElementById("surnameInput").value;
                        $.ajax({
                            type: 'POST',
                            url: 'requests/sendMail.php',
                            data: {
                                nume: name,
                                email: document.getElementById("inputEmail").value,
                                message: d,
                                subiectMail: "Validare Cont"

                            },
                            success: function (rd) {

                            }
                        });
                        rp.innerHTML = "<div class=\"alert alert-success\" role=\"alert\">" +
                                           "<strong>Felicitări!</strong> Tocmai ți-ai creat un cont nou! Te rugăm să validezi contul prin <strong> linkul primit pe mail!</strong>" +
                                         "</div>" +
                                        "<div class=\"alert alert-info\">\n" +
                            "                    <label for=\"validationCode\">\n" +
                            "                        Cod Validare\n" +
                            "                    </label>\n" +
                            "                    <input type=\"text\" class=\"form-control\" id=\"validationCode\"/>\n" +
                            "                    <input type=\"button\" hidden id=\"fakeButton\" onclick=\"validateCode()\">" +
                            "                </div>";
                        document.getElementById("validationCode")
                            .addEventListener("keyup", function(event) {
                                event.preventDefault();
                                if (event.keyCode === 13) {
                                    document.getElementById("fakeButton").click();
                                }
                            });
                    } else {
                        rp.innerHTML = "<div class=\"alert alert-danger\" role=\"alert\">" +
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
