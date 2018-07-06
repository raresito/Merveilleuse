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