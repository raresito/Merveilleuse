function collapse(){
    if(document.getElementById("sidebar").classList.contains("toggle")){
        document.getElementById("sidebar").classList.remove("toggle");
        document.getElementById("sidebarBrand").classList.remove("toggle");
    }
    else {
        document.getElementById("sidebar").classList.add("toggle");
        document.getElementById("sidebarBrand").classList.add("toggle");
    }
}