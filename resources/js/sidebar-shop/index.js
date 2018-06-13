// utility

function isTouchDevice() {
	return !!('ontouchstart' in window || navigator.msMaxTouchPoints);
}

$(".type").change(function() {

    var categoryCheckboxes = document.getElementsByClassName("category");
    var categories = [];
    for(var i = 0; i < categoryCheckboxes.length; i++){
        if(categoryCheckboxes[i].checked) {
            categories.push(categoryCheckboxes[i].value);
        }
    }
    var categoriesFinal = JSON.stringify(categories);

    var priceCheckboxes = document.getElementsByClassName("pret");
    var prices = [];
    for(var i = 0; i < priceCheckboxes.length;i++){
        if(priceCheckboxes[i].checked){
            prices.push(priceCheckboxes[i].value);
        }
    }
    var pricesFinal = JSON.stringify(prices);

    console.log(categoriesFinal + " " +pricesFinal );

    $(".product-list").innerHTML = '';

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function(){
        openNav();
        if(this.readyState == 4 && this.status == 200){
            console.log(this.responseText);
            document.getElementsByClassName("product-list")[0].innerHTML = this.responseText;
            closeNav();
        }
    }
    xmlhttp.open("GET", "shop-filter.php?category="+categoriesFinal+"&price="+pricesFinal, true)
    xmlhttp.send();
});

//console.log(s);