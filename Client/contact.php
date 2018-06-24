<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../resources/img/favicon.ico" />

    <?php include '../libraries.php' ?>
    <link rel="stylesheet" href="../resources/css/contact_form/Contact-Form-Clean.css" >
    <link rel="stylesheet" href="../resources/css/contact_form/user.css" >


    <title>Merveilleuse - Atelier de prajituri Artizanale</title>

    <script>
        function submitMessage() {
            $.ajax({
                type: 'POST',
                url: 'requests/sendMail.php',
                data: {
                    nume: document.getElementById("numeContact").value,
                    message: document.getElementById("messageContent").value,
                    fromEmail: document.getElementById("emailContact").value
                },
                success: function (d) {
                    if (d === "Message sent!") {
                        document.getElementById("successAlert").style.display = "block";
                    }
                }

            });
        }

    </script>

</head>

<body style="font-family: 'Slabo 27px', serif;">
<?php
include 'clientnavbar.php';?>

<div style="margin-top: 130px">

</div>

<div id="successAlert" class="alert alert-success" style="display:none" role="alert">
    This is a success alert—check it out!
</div>

<div class="contact-clean">
    <form>
        <h2 class="text-center">Contactează-ne!</h2>
        <div class="form-group has-success has-feedback"><input class="form-control" type="text" name="name" placeholder="Nume" id="numeContact"><i class="form-control-feedback glyphicon glyphicon-ok" aria-hidden="true"></i></div>
        <div class="form-group has-error has-feedback"><input class="form-control" type="email" name="email" placeholder="Email" id="emailContact"><i class="form-control-feedback glyphicon glyphicon-remove" aria-hidden="true"></i>
            <!--<p class="help-block">Introdu o adresă de email validă!</p>-->
        </div>
        <div class="form-group"><textarea class="form-control" rows="14" name="message" id="messageContent" placeholder="Mesaj"></textarea></div>
        <div class="form-group"><button class="btn btn-primary" type="button" onclick="submitMessage()">Trimte! </button></div>
    </form>
</div>
<hr>
<?php include 'footer.php'; ?>

</body>
</html>