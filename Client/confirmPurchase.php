<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include '../dbconnect.php';

if(!isset($_SESSION["email"])){
    header("Location: login.php");
}

function console_log($data){
    echo '<script>';
    echo 'console.log('. $data .')';
    echo '</script>';
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
    <link href="https://fonts.googleapis.com/css?family=Slabo+27px" rel="stylesheet">



    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script>

    <script>
        let order_id;
        function selectOrder(){
            $.ajax({
                type: 'POST',
                url: '../selectOrders.php',
                data:{type: "mine", email: "<?php echo $_SESSION["email"]; ?>" },
                success: function (d){
                    console.log(d);
                    let productArray = JSON.parse(d);
                    order_id = productArray[0].order_id;
                    let total = 0;
                    document.getElementById("number-of-products").innerText = productArray.length;
                    for(let i = 0; i < productArray.length; i++) {
                        document.getElementById("finalProductList").innerHTML +=
                            "<li class=\"list-group-item d-flex justify-content-between lh-condensed\">\n" +
                            "                    <div>\n" +
                            "                        <h6 class=\"my-0\">" + productArray[i].nameProduct + "</h6>\n" +
                            "                        <small class=\"text-muted\">Cantitate: " + productArray[i].quantity + "</small>\n" +
                            "                    </div>\n" +
                            "                    <span class=\"text-muted\">" + productArray[i].quantity * productArray[i].priceProduct + " RON</span>\n" +
                            "                </li>";
                        total = total + productArray[i].quantity * productArray[i].priceProduct;
                    }
                    document.getElementById("finalProductList").innerHTML +=
                        "<li class=\"list-group-item d-flex justify-content-between\">\n" +
                        "                    <span>Total (RON)</span>\n" +
                        "                    <strong>"+total+" RON</strong>\n" +
                        "                </li>"
                }
            });
        }

        selectOrder();

        function purchase(){

            $.ajax({
                type: 'POST',
                url: 'buy.php',
                data:{
                    id: order_id,
                    name: $("#firstName").val(),
                    lastName: $("#lastName").val(),
                    email: $("#email").val(),
                    mobil: $("#phone").val(),
                    address: $("#address").val()
                },
                success: function (d){
                    console.log(d);
                    $("#content").innerHTML = '';
                }
            })
        }
    </script>

</head>

<body style="font-family: 'Slabo 27px', serif;">
<?php
include 'clientnavbar.php';?>

<div id = "content" class="container" style="background:rgba(256, 256, 256, .9); margin-top: 150px">
    <div class="py-5 text-center">
        <h2>Checkout</h2>
        <p class="lead">După finalizarea comenzii, unul dintre operatorii noștrii vă vor suna pentru a confirma comanda, și pentru a prelua detalii adiționale asupra comenzii.</p>
    </div>

    <div class="row">
        <div class="col-md-4 mb-4">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-muted">Coșul tău</span>
                <span id="number-of-products" class="badge badge-secondary badge-pill">3</span>
            </h4>
            <ul id="finalProductList" class="list-group mb-3">
                <!--<li class="list-group-item d-flex justify-content-between bg-light">
                    <div class="text-success">
                        <h6 class="my-0">Promo code</h6>
                        <small>EXAMPLECODE</small>
                    </div>
                    <span class="text-success">-$5</span>
                </li>-->

            </ul>

            <!--<form class="card p-2">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Promo code">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-secondary">Redeem</button>
                    </div>
                </div>
            </form>-->
        </div>
        <div class="col-md-8">
            <h4 class="mb-3">Adresă de livrare</h4>
            <form class="needs-validation" novalidate="">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="firstName">Prenume</label>
                        <input type="text" class="form-control" id="firstName" placeholder="" value="" required="">
                        <div class="invalid-feedback">
                            Adaugă un prenume de familie valid.
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="lastName">Nume de familie</label>
                        <input type="text" class="form-control" id="lastName" placeholder="" value="" required="">
                        <div class="invalid-feedback">
                            Adaugă un nume de familie valid.
                        </div>
                    </div>
                </div>

                <!--<div class="mb-3">
                    <label for="username">Nume de utilizator</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">@</span>
                        </div>
                        <input type="text" class="form-control" id="username" placeholder="Username" required="">
                        <div class="invalid-feedback" style="width: 100%;">
                            Câmp necesar
                        </div>
                    </div>
                </div>-->

                <div class="mb-3">
                    <label for="email">Email <span class="text-muted">(Opțional)</span></label>
                    <input type="email" class="form-control" id="email" placeholder="you@example.com">
                    <div class="invalid-feedback">
                        Te rog introdu o adresă validă de email.
                    </div>
                </div>

                <div class="mb-3">
                    <label for="phone"> Mobil </label>
                    <input type="number" class="form-control" id="phone" placeholder="0721234567" required>
                    <div class="invalid-feedback">
                        Te rog introdu o adresă validă de email.
                    </div>
                </div>

                <div class="mb-3">
                    <label for="address">Adresă</label>
                    <input type="text" class="form-control" id="address" placeholder="Piața Romană, nr. 9" required="">
                    <div class="invalid-feedback">
                        Te rog introdu o adresă validă
                    </div>
                </div>

                <!--<div class="mb-3">
                    <label for="address2">Adresă 2 <span class="text-muted">(Opțional)</span></label>
                    <input type="text" class="form-control" id="address2" placeholder="Apartament, scară, bloc">
                </div>-->
                <!--<div class="mb-3">
                    <label for="state">Oraș</label>
                    <select class="custom-select d-block" id="state" required="">
                        <option value="">Choose...</option>
                        <option>București</option>
                    </select>
                    <div class="invalid-feedback">
                        Introdu un oraș valid.
                    </div>
                </div>-->

                <div class="row">
                    </div>

                    <!--<div class="col-md-4 mb-3">
                        <label for="zip">Cod poștal</label>
                        <input type="text" class="form-control" id="zip" placeholder="" required="">
                        <div class="invalid-feedback">
                            Trebuie un cod poștal
                        </div>
                    </div>-->
                <!--</div>
                <hr class="mb-4">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="same-address">
                    <label class="custom-control-label" for="same-address">Adresa de livrare este aceeași cu adresa de facturare</label>
                </div>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="save-info">
                    <label class="custom-control-label" for="save-info"></label>
                </div>-->

                <button onclick="purchase()" class="btn btn-primary btn-lg btn-block" type="button">Confirmă Comanda</button>
            </form>
        </div>
    </div>
</div>
    <hr>
<?php include 'footer.php'; ?>

</body>
</html>
