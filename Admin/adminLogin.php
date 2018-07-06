<?php
    if(isset($_POST["logoutVariable"])) {
        if ($_POST["logoutVariable"] == true) {
            session_unset();
            session_destroy();
            header("Location: adminLogin.php");
        }
    }
    echo $_POST["logoutVariable"];
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

    <script>
        function login(){
            $.ajax({
                type: 'POST',
                url: 'requests/loginCheck.php',
                data: {
                    email: document.getElementById("inputEmail").value,
                    password: document.getElementById("inputPassword").value
                },
                success: function (d) {
                    if(d === "Success") {
                        document.getElementById("loginResponseDiv").hidden = false;
                    }
                    else { console.log(d) }
                }
            });
        }
    </script>

</head>
<body>

<div class="flex-center" style="height: 100%;">
<div class="container-fluid flex-center flex-column" >
    <div class="row">
        <img src="../resources/img/logo.jpg">
    </div>


    <div class="row top-buffer" id="resultDiv">
        <?php
        if(isset($_POST["logoutVariable"]) && $_POST["logoutVariable"] == "true"){
            echo'
                 <div class="alert alert-primary" role="alert">
                       Te-ai delogat cu succes!
                 </div>  
            ';
        }
        ?>
    </div>
    <div class="row mt-4" style="width:100%;">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div id="loginResponseDiv" class="alert alert-info" role="alert" hidden>
                <a href="dashboard.php"> Bine ai revenit! Click aici pentru a merge la Dashboard! </a>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">
                    Email address
                </label>
                <input type="email" class="form-control" id="inputEmail" name="email"/>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">
                    Password
                </label>
                <input type="password" class="form-control" id="inputPassword" name="password"/>
            </div>
            <div class="checkbox">
                <label>
                    <input type="checkbox" /> Remember me!
                </label>
            </div>
            <button type="button" onclick="login()" class="btn btn-primary">
                Submit
            </button>
        </div>
        <div class="col-md-3"></div>
    </div>
</div>
</div>
</body>
</html>