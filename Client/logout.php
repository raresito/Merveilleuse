<?php

session_start();

?>

<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Merveilleuse Shop</title>
    <?php include '../libraries.php' ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../resources/css/basket.css">

    <?php include '../libraries.php'; ?>
</head>
<body>

<?php

session_unset();
session_destroy();

include 'clientnavbar.php';

echo'
    <div class="container" style="margin-top: 150px;">
        <div class="row">
            <div class="alert alert-success" role="alert">
                Te-ai delogat cu succes!
            </div>
        </div>
    </div>
';

include 'footer.php'

?>
</body>
</html>

