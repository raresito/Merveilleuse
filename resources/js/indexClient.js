let i;
window.onload = function() {
    let beautifulPlace = document.getElementById("image-holder");

    let images = new Array(50);
    for(let i = 0; i < 41; i++){
        images[i] = "../img/foto/IMG-20180403-WA00" + (i>9 ? i : "0" + i) + ".jpg";

        let image = document.createElement('div');

        image.classList.add("col-12");
        image.classList.add("col-sm-6");
        image.classList.add("col-md-3");
        image.classList.add("col-lg-2");
        image.classList.add("square-div");

        image.style.minHeight = "200px";
        image.style.display = "none";
        image.style.border = "1px transparent";
        image.style.backgroundImage = "url(" + images[i] + ")";
        image.style.backgroundSize = "cover";
        image.style.backgroundRepeat = "no-repeat";
        image.style.backgroundPosition = "50% 50%";

        if(i < 1){
            image.classList.add("order-1.order-md-3");
        }


        if(i === 2){
            image.style.backgroundImage = "url(../resources/img/logoBG.png)";
            image.classList.remove("col-sm-6");
            image.classList.remove("col-md-3");
            image.classList.remove("col-lg-2");
            image.classList.add("col-sm-12");
            image.classList.add("col-md-6");
            image.classList.add("col-lg-4");
            image.classList.add("order-2.order.md-6");
            image.style.backgroundSize = "contain";
            image.style.backgroundColor = "white";
            image.style.backgroundRepeat = "none";
            image.style.backgroundPosition = "center";
        }

        if(i > 2){

            image.classList.add("order-3.order.md-3");
        }

        beautifulPlace.appendChild(image);
    }

    i = 0;
    x = beautifulPlace.getElementsByTagName("div");

    let myVar = setInterval("showPic(x[i])", 600);
};

function showPic(v){
    $(v).fadeIn();
    i++;
}