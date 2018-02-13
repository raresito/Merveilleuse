$(window).scroll(function (){
	//$('span').html($(window).scrollTop());
	//if($(window).scrollTop() >= 200){
		var x = $(window).scrollTop() * 0.005
		$('.navbar').css('opacity',x);
	//}
	//$('.navbar').css('opacity','1');
});
