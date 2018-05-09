<?php

session_start();

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

<?php

session_unset();
session_destroy();

include 'clientnavbar.php';

echo'
    <div class="container" style="margin-top: 100px;">
        <div class="row">
            <div class="alert alert-success" role="alert">
                Te-ai delogat cu succes!
            </div>
        </div>
    </div>
';

//header( "refresh:5;url=index.php" );


include 'footer.php'

?>
</body>
</html>

