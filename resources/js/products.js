
var selectedPhoto;
function SelectPhoto(e) {
    if(e.classList.contains("chosen-picture")){
        e.classList.remove("chosen-picture");
        selectedPhoto = null;
    }
    else {
        e.classList.add("chosen-picture");
        selectedPhoto = e;
    }
    for(var i = 1; i < e.parentElement.childNodes.length-2; i++){
        if(e.parentElement.childNodes[i] === e){
            i++;
        }
        //alert(e.parentElement.childNodes[i].classList);
        if(typeof e.parentElement.childNodes[i].classList !== 'undefined')
            if(e.parentElement.childNodes[i].classList.contains("chosen-picture"))
                e.parentElement.childNodes[i].classList.remove("chosen-picture");
    }
    //alert(e.parentElement.childNodes[2].innerHTML);
    changePhotoPrompt();
}
function changePhotoPrompt(){
    var space = document.getElementById("photoPrompt");
    if(selectedPhoto != null){
        space.innerHTML = "Selected photo:" + selectedPhoto.children[0].children[0].getAttribute('src').split("/")[6];
    }
}

function sendChosenPhoto(){
    if(selectedPhoto != null){
        mydiv = document.getElementById("photoPreview");
        mydiv.innerHTML = selectedPhoto.children[0].children[0].getAttribute('src').split("/")[6];
    }
}


$(document).ready(function (){
    $("#galleryButton").click(function(){
        $.ajax({
            type: "POST",
            url: "requests/retrieveGallery.php",
            success: function(response){
                let arrayGallery = JSON.parse(response);
                for(let i = 0; i < arrayGallery.length; i++){
                    document.getElementById("galleryHere").innerHTML +=
                        "<div class=\"col-sm-6 col-md-4 col-lg-3 item\" onclick=\"SelectPhoto(this)\"> "+
                        "    <a data-lightbox=\"photos\"> " +
                        "       <img class=\"img-responsive\" src='Merveilleuse/" + arrayGallery[i] + "' style='max-width: 150px'> " +
                        "    </a> " +
                        " </div> ";
                }
            }
        })
    })
});



function reloadProducts(){
    $.ajax({
        type: 'POST',
        url: 'requests/selectProducts.php',
        data:{},
        success: function (d){
            var myArray = JSON.parse(d);
            table = document.getElementById("product-table");
            head = "<thead><tr><th>Icon</th><th>Denumire</th><th>Preț/unitate</th> <th>Categorie</th> <th>Acțiuni</th>  </tr></thead>";
            ceva = '';
            for(var i = 0; i < myArray.length; i++){
                ceva = ceva + "<tr> <td><img src=\"../resources/img/foto/" + myArray[i].image + " \"></td> <td> " + myArray[i].nameProduct + " </td> <td> " + myArray[i].priceProduct + "/" + myArray[i].unitProduct + " </td> <td>" + myArray[i].category + " </td> <td> " +
                    "<form method=\"post\" action=\"products.php\">" +
                    "<input name=\"nameProduct\" type=\"hidden\" value =\" " + myArray[i].nameProduct + " \"> " +
                    "<button type=\"button\" class=\"btn btn-sm\" data-toggle=\"modal\" data-target=\"#editModal\" onclick=\"setEditModal("+ myArray[i].idProduct+ ",'"  + myArray[i].nameProduct + "',"+myArray[i].priceProduct+",'"+myArray[i].unitProduct+"','"+myArray[i].category+"','" + myArray[i].image + "')\"><i class=\"material-icons\" data-toggle=\"tooltip\" title=\"Edit\">&#xE254;</i></button> " +
                    "<button type=\"button\" class=\"btn btn-sm\" name=\"deleteProduct\" onclick=\"deleteProduct("+ myArray[i].idProduct+ ")\"><i class=\"material-icons\" title=\"Delete\">delete</i></button> " +
                    " </form> " +
                    " </td>";
            }
            body = "<tbody>" + ceva + "</tbody>";
            table.innerHTML = head + body;
        }
    });
}

reloadProducts();

function setEditModal(id, denumire, pret, unitate, categorie, imagine){
    $("#editProdusId").val(id);
    $("#editProdusName").val(denumire);
    $("#editProdusCategory").val(categorie);
    $("#editProdusPretUnitar").val(pret);
    $("#editProdusUM").val(unitate);
    $("#editProdusImagine").val(imagine);
}

function deleteProduct(b){
    alert(b);
    $.ajax({
        type: 'POST',
        url: 'requests/deleteProduct.php',
        data: {
            editID: id,
            editNameProduct: $("#editProdusName").val(),
            editCategory: $("#editProdusCategory").val(),
            editPriceProduct: $("#editProdusPretUnitar").val(),
            editUnitProduct: $("#editProdusUM").val(),
            editImageProduct: $("#editProdusImagine").val()
        },
        success: function (result) {
            if(result !== "fail") {
                document.getElementById("addedDiv").innerHTML = "" +
                    "<div class=\"alert alert-danger\" role=\"alert\">\n" +
                    "  <strong> Șters! </strong> Ai șters produsul " + result +
                    "</div>";
            } else {
                console.log(result);
            }
        }
    });
}
//TODO ADD FLAVOUR
function editProdus(){
    id = $("#editProdusId").val();
    $.ajax({
        type: 'POST',
        url: 'requests/editProdus.php',
        data:{
            editID: id,
            editNameProduct: $("#editProdusName").val(),
            editCategory: $("#editProdusCategory").val(),
            editPriceProduct: $("#editProdusPretUnitar").val(),
            editUnitProduct: $("#editProdusUM").val(),
            editImageProduct: $("#editProdusImagine").val()
        },
        success: function (result){
            if(result === "Success"){
                $("#editModal").modal('hide');
                reloadProducts();
            }
            else{
                alert("Ne cerem scuze, a apărut o erorare");
                console.log("error" + result);
            }
        }
    });
}

function addProduct(){
    $.ajax({
        type: 'POST',
        url: 'requests/insertProduct.php',
        data: {
            newProductName: document.getElementById("newProductName").value,
            newProductPrice: document.getElementById("newProductPrice").value,
            newProductUnit: document.getElementById("newProductUnit").value,
            newProductPhoto: document.getElementById("photoPreview").innerHTML,
            newProductCategory: document.getElementById("newProductCategory").value
        },
        success: function(d){
            if(d === "Success") {
                document.getElementById("addedDiv").innerHTML = "" +
                    "<div class=\"alert alert-success\" role=\"alert\">" +
                    "<strong>Încărcat!</strong> Ai adăugat un produs nou!" +
                    "</div>";
                reloadProducts();
                $("#addModal").modal('hide');
            } else {
                console.log(d);
                document.getElementById("addedDiv").innerHTML = ""+
                    "<div class=\"alert alert-danger\" role=\"alert\">" +
                    "A apărut o problemă, mai încearcă odată!" +
                    "</div>"
                $("#addModal").modal('hide');
            }
        }
    });
}