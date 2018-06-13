
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
        space.innerHTML = "Selected photo:" + selectedPhoto.children[0].children[0].getAttribute('src').split("/")[4];
    }
}

function sendChosenPhoto(){
    if(selectedPhoto != null){
        mydiv = document.getElementById("photoPreview");
        mydiv.innerHTML = selectedPhoto.children[0].children[0].getAttribute('src').split("/")[4] + "<input type=\"hidden\" name=\"newProductPhoto\" value=\"" + selectedPhoto.children[0].children[0].getAttribute('src').split("/")[4] + " \"/>";
    }
}

function selectDelete(ceva){
    alert(ceva);
    document.getElementById("deleteProduct").innerText = ceva;
    document.getElementById("deleteInput").innerText = ceva;
    console.log(document.getElementById("deleteInput").innerText)
}

$(document).ready(function (){
    $("#galleryButton").click(function(){
        $.ajax({
            type: "POST",
            url: "retrieveGallery.php",
            success: function(response){
                let arrayGallery = JSON.parse(response);
                for(let i = 0; i < arrayGallery.length; i++){
                    document.getElementById("galleryHere").innerHTML +=
                        "<div class=\"col-sm-6 col-md-4 col-lg-3 item\" onclick=\"SelectPhoto(this)\"> "+
                        "    <a data-lightbox=\"photos\"> " +
                        "       <img class=\"img-responsive\" src='" + arrayGallery[i] + "' style='max-width: 150px'> " +
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
        url: 'selectProducts.php',
        data:{},
        success: function (d){
            var myArray = JSON.parse(d);
            table = document.getElementById("product-table");
            head = "<thead><tr><th>Icon</th><th>Denumire</th><th>Preț/unitate</th> <th>Categorie</th> <th>Acțiuni</th>  </tr></thead>";
            ceva = '';
            for(var i = 0; i < myArray.length; i++){
                ceva = ceva + "<tr> <td><img src=\"../resources/res/foto/" + myArray[i].image + " \"></td> <td> " + myArray[i].nameProduct + " </td> <td> " + myArray[i].priceProduct + "/" + myArray[i].unitProduct + " </td> <td>" + myArray[i].category + " </td> <td> " +
                    "<form method=\"post\" action=\"products.php\">" +
                    "<input name=\"nameProduct\" type=\"hidden\" value =\" " + myArray[i].nameProduct + " \"> " +
                    "<button type=\"button\" class=\"btn btn-sm\" data-toggle=\"modal\" data-target=\"#editModal\"><i class=\"material-icons\" data-toggle=\"tooltip\" title=\"Edit\">&#xE254;</i></button> " +
                    "<button type=\"submit\" class=\"btn btn-sm\" name=\"deleteProduct\" value=\" " + myArray[i].idProduct + " \"><i class=\"material-icons\" title=\"Delete\">delete</i></button> " +
                    " </form> " +
                    " </td>";
            }
            body = "<tbody>" + ceva + "</tbody>";
            table.innerHTML = head + body;
        }
    });
};

reloadProducts();