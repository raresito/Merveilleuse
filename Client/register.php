<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../vendor/autoload.php';

require_once '../dbconnect.php';
session_start();
var_dump($_SESSION);



function console_log($data){
    echo '<script>';
    echo 'console.log('. $data .')';
    echo '</script>';
}

function sendConfirmMail(){

    $mail = new PHPMailer(true);                     // Passing `true` enables exceptions
    try {
        //Server settings
        $mail->SMTPDebug = 2;                                 // Enable verbose debug output
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp1.example.com;smtp2.example.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'user@example.com';                 // SMTP username
        $mail->Password = 'secret';                           // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;                                    // TCP port to connect to

        //Recipients
        $mail->setFrom('from@example.com', 'Mailer');
        $mail->addAddress('joe@example.net', 'Joe User');     // Add a recipient
        $mail->addAddress('ellen@example.com');               // Name is optional
        $mail->addReplyTo('info@example.com', 'Information');
        $mail->addCC('cc@example.com');
        $mail->addBCC('bcc@example.com');

        //Attachments
        $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
        $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

        //Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'Here is the subject';
        $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
    }
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
    </script>
</head>

<body>
<?php include 'clientnavbar.php';?>
<div class="container-fluid" style="margin-top: 100px;">

    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6 content">
            <?php
            if(isset($_SESSION["email"]))
                header("Location: /Client/basket.php");
            else{
                if (isset($_POST["password"])) {
                    $sql = "INSERT INTO users (email, password, lastLogin, name) VALUES('" . $_POST["email"] . "','" . $_POST["password"] . "','" . date("Y-m-d H:i:s") . "','" . $_POST["surname"] . " " . $_POST["name"] . "')";
                    $result = mysqli_query($conn, $sql);
                    if(isset($result)){
                        sendConfirmMail();
                        echo '<div class="alert alert-success" role="alert">
                                <strong>Felicitări!</strong> Tocmai ți-ai creat un cont nou! Te rugăm să validezi contul prin <strong> linkul primit pe mail!</strong>
                              </div>';
                    }
                    if(!$result && $conn->errno == 1062){
                        echo '<div class="alert alert-danger" role="alert">
                                Deja există un cont cu această adresă de email. Ți-ai uitat parola? 
                              </div>';
                    } else {
                        if (!$result) {
                            //echo'No result';
                            echo "Error: Our query failed to execute and here is why: \n";
                            echo "Query: " . $sql . "\n";
                            echo "Errno: " . $conn -> errno . "\n";
                            echo "Error: " . $conn -> error . "\n";
                        }
                    }
                }
            }

            ?>
            <form action = "register.php" method = "post" role="form">
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
                    <input type="email" class="form-control" id="exampleInputEmail1" name="email"/>
                </div>
                <div class="form-group">
                    <label for="InputPassword">
                        Password
                    </label>
                    <input type="password" class="form-control" id="InputPassword" name="password"/>
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
