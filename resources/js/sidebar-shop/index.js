if (!isTouchDevice()) {
  $('[data-toggle*="tooltip"]').tooltip();
}

// utility

function isTouchDevice() {
	return !!('ontouchstart' in window || navigator.msMaxTouchPoints);
}

$(".category").change(function() {
    if(this.checked) {
        var x = document.getElementsByClassName("category");
        var s = "";
        for(var i = 0; i < x.length; i++){
            if(x[i].checked)
                s = s + " " + x[i].value;
        }
        console.log(s);
    } else {
        var x = document.getElementsByClassName("category");
        var s = "";
        for(var i = 0; i < x.length; i++){
            if(x[i].checked)
                s = s + " " + x[i].value;
        }
        console.log(s);
    }
});