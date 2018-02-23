$( document ).ready(function() {
    //console.log("Test2");

    $("#sidebarButon").click(function(){
        //console.log("Test2.5");
        if($("#sidebarID").hasClass("active")){
            //console.log("test3");
            $("#sidebarID").removeClass("active");
            $("#sidebarID").slideUp();
        }
        else{
            $("#sidebarID").addClass("active");
            $("#sidebarID").slideDown();
        }
    });
});