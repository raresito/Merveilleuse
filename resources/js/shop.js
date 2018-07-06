
function toggleSidebar() {
    if (document.getElementById("filter-sidebar").classList.contains("collapse")) {
        document.getElementById("filter-sidebar").classList.remove("collapse");
    }
    else
        document.getElementById("filter-sidebar").classList.add("collapse");
}


let filterSelection = {
    type : [],
    flavour: [],
    price: []
};

function filterProduct(obj) {
    if (obj.checked === true) {
        if (obj.classList.contains("type")) {
            filterSelection.type.push(obj.value);
        }
        if (obj.classList.contains("flavour")) {
            filterSelection.flavour.push(obj.value);
        }
        if (obj.classList.contains("pret")) {
            filterSelection.pret.push(obj.value);
        }
    }
    if(obj.checked === false){
        if(obj.classList.contains("type")) {
            for(let k in filterSelection.type){
                if(filterSelection.type[k] === obj.value){
                    filterSelection.type.splice(k, 1);
                }
            }
        }
        if(obj.classList.contains("flavour")) {
            for(let k in filterSelection.flavour){
                if(filterSelection.flavour[k] === obj.value){
                    filterSelection.flavour.splice(k, 1);
                }
            }
        }
        if(obj.classList.contains("pret")) {
            for(let k in filterSelection.flavour){
                if(filterSelection.price[k] === obj.value){
                    filterSelection.price.splice(k, 1);
                }
            }
        }
    }
    if(!obj.classList.contains("pret") && !obj.classList.contains("type") && !obj.classList.contains("flavour")){
        filterSelection = '';
    }
    console.log(filterSelection);
    reloadCatalog();
}

function reloadCatalog(){
    $.ajax({
        type: 'POST',
        url: 'shop-filter.php',
        data:{
            selection : filterSelection
        },
        success: function (d) {
            console.log(d);
            if(d === "{}"){
                productDiv = document.getElementById("productDiv");
                productDiv.innerHTML = '<div class="alert alert-warning" style="width: 100%; text-align:center;" role="alert">\n' +
                    'Dar pretențios mai ești ... \n' +
                    '</div>';
            } else {
                arrayProduse = JSON.parse(d);
                productDiv = document.getElementById("productDiv");
                productDiv.innerHTML = '';
                for (let i in arrayProduse) {
                    //TODO Repair title only one row
                    productDiv.innerHTML += '' +
                        '<div class="col-xs-6 col-sm-6 col-md-6 col-lg-4 col-xl-3 product-item d-flex flex-column">' +
                        '<div class="product-container d-flex flex-column" style="height: 100%">' +
                        '<div class="row" style="flex-grow: 1">' +
                        '<div class="col-md-12">' +
                        '<a href="#" class="product-image">' +
                        '<img src="../resources/img/foto/' + arrayProduse[i].image + '">' +
                        '</a>' +
                        '</div>' +
                        '</div>' +
                        '<div class="row">' +
                        '<div class="col-8">' +
                        '<h2><a href="#">' + arrayProduse[i].nameProduct + '</a></h2>' +
                        '</div>' +
                        '</div>' +
                        'Categorie: ' + arrayProduse[i].category +
                        '<div class="row">' +
                        '<div class="col-12">' +
                        '<div class="row">' +
                        '<div class="col-12">' +
                        '<button class="btn btn-light fill" type="button" onclick="addToBasket(' + arrayProduse[i].idProduct + ')">Cumpără!</button> ' +
                        '</div>' +
                        '<div class="col-12">' +
                        '<p class="product-price">' + arrayProduse[i].priceProduct + "RON /" + arrayProduse[i].unitProduct + ' </p>' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '</div>';

                }
            }
        }
    });
}

function loadCategories() {
    $.ajax({
        type: 'POST',
        url: 'requests/selectCategories.php',
        success: function (d) {
            categorii = JSON.parse(d);
            for (let i in categorii) {
                document.getElementById("group-category").innerHTML += "" +
                    "<a class=\"list-group-item\" href=\"#\">\n" +
                    "    <input type=\"checkbox\" onchange=\"filterProduct(this)\" class=\"type category\" value = \"" +
                    categorii[i].category +
                    " \">\n" +
                    categorii[i].category  +
                    "</a>"
            }
        }
    });

    $.ajax({
        type: 'POST',
        url: 'requests/selectFlavours.php',
        success: function (d) {
            flavours = JSON.parse(d);
            for (let i in flavours) {
                document.getElementById("group-flavour").innerHTML += "" +
                    "<a class=\"list-group-item\" href=\"#\">\n" +
                    "    <input type=\"checkbox\" onchange=\"filterProduct(this)\" class=\"flavour category\" value = \"" +
                    flavours[i].flavour +
                    " \">\n" +
                    flavours[i].flavour  +
                    "</a>"
            }
        }
    });
}

reloadCatalog();
loadCategories();