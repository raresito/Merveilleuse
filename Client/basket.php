<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if(!isset($_SESSION["email"])){
    header("Location: login.php");
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../resources/img/favicon.ico" />
    <title>Merveilleuse Shop</title>
    <?php include '../libraries.php' ?>
    <link rel="stylesheet" href="../resources/css/basket.css">



</head>

<body>
<?php include 'clientnavbar.php';?>
<div class="container content">
        <table id="cart" class="table table-hover table-condensed">
            <thead>
            <tr>
                <th style="width:50%">Produs</th>
                <th style="width:10%">Preț</th>
                <th style="width:8%">Cantitate</th>
                <th style="width:22%" class="text-center">Subtotal</th>
                <th style="width:10%"></th>
            </tr>
            </thead>
            <tbody id="tableBody"></tbody>
            <tfoot>
            <tr>
                <td><a href="../Client/shop.php" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continue Shopping</a></td>
                <td colspan="2" class="hidden-xs"></td>
                <td id = "hereTotal" class="hidden-xs text-center"><strong>Total RON (TVA inclus)</strong></td>
                <td><a href="confirmPurchase.php" class="btn btn-success btn-block">Checkout <i class="fa fa-angle-right"></i></a></td>
            </tr>
            </tfoot>
        </table>

</div>
<br>
<div class="container">
    <div class="row">
        <div class="alert alert-warning" style = "width: 100%">
            <div style="text-align: center">
                N-ai găsit ce căutai? <a href = "contact.php"> Scrie-ne! </a>
            </div>
        </div>
    </div>
</div>

<div class = "container" style="margin-bottom: 75px">
    <div id="accordion"></div>
</div>

<script>
    function setZero(x, idProduct, idOrder){
        x.parentElement.parentElement.getElementsByClassName("text-center")[0].value = 0;
        updateProduct(x, idProduct, idOrder);
    }
    window.onload = function() {
        let space = document.getElementById("accordion");
        loadBasketProduct();
        $.ajax({
            type: 'POST',
            url: 'requests/selectOldOrders.php',
            data: {},
            success: function (d) {

                console.log(d);
                var result = JSON.parse(d);

                for(let i = 0; i < result.length; i++){

                    var currentOrder = document.createElement('DIV');
                    currentOrder.classList.add("card");

                    let heading = document.createElement("DIV");
                    heading.classList.add("card-header");
                    heading.id = "heading" + result[i].idOrder;

                    let mb0 = document.createElement("H5");
                    mb0.classList.add("mb-0");

                    let button = document.createElement("BUTTON");
                    button.classList.add("btn");
                    button.classList.add("btn-link");
                    button.setAttribute("data-toggle", "collapse");
                    button.setAttribute("data-target", "#collapse" + result[i].idOrder);
                    button.setAttribute("aria-expanded", "true");
                    button.setAttribute("aria-controls", "collapse" + result[i].idOrder);
                    button.innerText = "Comanda #"+ result[i].idOrder;

                    mb0.appendChild(button);
                    heading.appendChild(mb0);

                    var collapse = document.createElement("DIV");
                    collapse.id="collapse"+result[i].idOrder;
                    collapse.classList.add("collapse");
                    if(i === 0){
                        collapse.classList.add("show");
                    }
                    collapse.setAttribute("aria-labelledby", "heading" + result[i].idOrder);
                    collapse.setAttribute("data-parent", "#accordion");

                    var card_body = document.createElement("DIV");
                    card_body.classList.add("card-body");

                    var table = document.createElement("TABLE");
                    table.classList.add("table");
                    var thead = document.createElement("THEAD");
                    thead.innerHTML = "<th class = \"d-none d-md-table-cell\" >Imagine</th> <th>Nume Produs</th> <th>Cantitate</th> <th>Preț Unitar</th> <th>Subtotal</th>";
                    var tbody = document.createElement("TBODY");

                    if(i === 0) {
                        var row = document.createElement("TR");
                        var cell1 = document.createElement("TD");
                        cell1.classList.add("d-none");
                        cell1.classList.add("d-md-table-cell");
                        cell1.innerHTML = "<img src = \"../resources/img/foto/" + result[i].image +"\" style=\"max-height:100px\" class=\"img-responsive\" >";
                        row.appendChild(cell1);
                        var cell2 = document.createElement("TD");
                        cell2.innerText = result[i].nameProduct;
                        row.appendChild(cell2);
                        var cell3 = document.createElement("TD");
                        cell3.innerText = result[i].quantity;
                        row.appendChild(cell3);
                        var cell4 = document.createElement("TD");
                        cell4.innerText = result[i].priceProduct;
                        row.appendChild(cell4);
                        var cell5 = document.createElement("TD");
                        cell5.innerText = result[i].priceProduct * result[i].quantity;
                        row.appendChild(cell5);
                        tbody.appendChild(row);
                        i++;
                    }
                    if(result[i]){
                        while (result[i].idOrder === result[i - 1].idOrder) {
                            var row = document.createElement("TR");
                            var cell1 = document.createElement("TD");
                            cell1.classList.add("d-none");
                            cell1.classList.add("d-md-table-cell");
                            cell1.innerHTML = "<img src = \"../resources/img/foto/" + result[i].image + "\" style=\"max-height:100px\" class=\"img-responsive\" >";
                            row.appendChild(cell1);
                            var cell2 = document.createElement("TD");
                            cell2.innerText = result[i].nameProduct;
                            row.appendChild(cell2);
                            var cell3 = document.createElement("TD");
                            cell3.innerText = result[i].quantity;
                            row.appendChild(cell3);
                            var cell4 = document.createElement("TD");
                            cell4.innerText = result[i].priceProduct;
                            row.appendChild(cell4);
                            var cell5 = document.createElement("TD");
                            cell5.innerText = result[i].priceProduct * result[i].quantity;
                            row.appendChild(cell5);
                            tbody.appendChild(row);
                            i++;
                            if (i === result.length) {
                                break;
                            }
                        }
                    }
                    table.appendChild(thead);
                    table.appendChild(tbody);
                    card_body.appendChild(table);
                    collapse.appendChild(card_body);
                    currentOrder.appendChild(heading);
                    currentOrder.appendChild(collapse);
                    document.getElementById("accordion").appendChild(currentOrder);
                }
            }

        });
    }
    function updateProduct(but, idProduct, idOrder) {
        let val = but.parentElement.parentElement.getElementsByClassName("quantity")[0].value;
        $.ajax({
            type: 'POST',
            url: 'requests/updateBasketProducts.php',
            data: {
                idProd: idProduct,
                idOrder: idOrder,
                quant: val
            },
            success: function (d) {
                console.log(d);
                loadBasketProduct();
            }
        });
    }
    function loadBasketProduct(){
        $.ajax({
            type: 'POST',
            url: 'requests/selectBasketProducts.php',
            data: {},
            success: function (d) {
                produse = JSON.parse(d);
                document.getElementById("tableBody").innerHTML = '';
                for(let i in produse){
                    document.getElementById("tableBody").innerHTML += tableEntry(produse[i])
                }
            }
        });
        updateTotal();
    }
    function tableEntry(produs){
        return '<tr>\n' +
            '    <td data-th="Produs">\n' +
            '        <div class="row">\n' +
            '            <div class="col-sm-4 hidden-xs"><img src="../resources/img/foto/'+ produs.image + '" style="max-height:100px" class="img-responsive"/></div>\n' +
            '            <div class="col-sm-8">\n' +
            '                <h4 class="nomargin">' + produs.nameProduct + '</h4>\n' +
            '                <input name="idProduct" value="' + produs.idProduct + '" type="hidden"/>\n' +
            '                <p>Categorie:' + produs.category + ' </p>\n' +
            '                <p>Categorie:' + produs.flavour + ' </p>\n' +
            '            </div>\n' +
            '        </div>\n' +
            '    </td>\n' +
            '    <td data-th="Preț">RON' + produs.priceProduct + ' /' + produs.unitProduct + '</td>\n' +
            '    <td data-th="Cantitate">\n' +
            '        <input id = "quantity" type="number" class="quantity form-control text-center" min = 0 value="'+ produs.quantity +'">\n' +
            '    </td>\n' +
            '    <td data-th="Subtotal" class="text-center">'+ produs.priceProduct * produs.quantity + '</td>\n' +
            '    <td class="actions" data-th="">\n' +
            '        <button onclick ="updateProduct(this, '+produs.idProduct+', '+produs.idOrder+')" type = "submit" class="btn btn-info btn-sm"><i class="fa fa-retweet" aria-hidden="true"></i></button>\n' +
            '        <button onclick = "setZero(this, '+produs.idProduct+', '+produs.idOrder+')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>\n' +
            '    </td>\n' +
            '</tr>\n';
    }
    function updateTotal() {
        $.ajax({
            type: 'POST',
            url: 'requests/selectTotal.php',
            success: function (d) {
                console.log("Success"+ d);
                document.getElementById("hereTotal").innerHTML = "Total " + d + " RON (TVA inclus)";
            },
            fail: function(d){
                console.log("fail de ajax");
            }
        });
    }
</script>

<?php include 'footer.php'; ?>
</body>
</html>
