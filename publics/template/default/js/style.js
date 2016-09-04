$(document).ready(function(){
	
	//expand menu mobile
    $('.mobile-menu-button').click(function() {
        if ($('.mobile-menu').hasClass("menu-tiny")) {
            $('.mobile-menu').removeClass("menu-tiny");
			$('.mobile-menu').slideUp();
        } else {
            $('.mobile-menu').addClass("menu-tiny");
			$('.mobile-menu').slideDown();
        }
        return false;
    });
	
	//tab 
	$(".tab-title a").click(function(){
		var parent = $(this).parent();
		var grand = $(this).parent().parent();
		$('a', $(parent)).removeClass("active");
		$(this).addClass("active");
		$('.tab-content', $(grand)).hide();
		var activeTab = $(this).attr("href");
		$(activeTab).fadeIn();
		return false;
	});
	
	$('.carousel').carousel({
		pause: "true"
	});
	
	//main content click 
	$(".btn-close").click(function(){
		var parent = $(this).parent();
		if ($(parent).hasClass("m-hide")) {
            $(parent).removeClass("m-hide");
			$('.main-inner').show();
        } else {
            $(parent).addClass("m-hide");
			$('.main-inner').hide();
        }
		return false;
	});
	
	//Scroll bar cart
	$('#detail-content').slimScroll({
		height: '440px',
		width: '365px'
	});
	
	$("#showcase").awShowcase(
	{
		content_width:			144,
		content_height:			643,
		fit_to_parent:			false,
		auto:					true,
		interval:				5000,
		continuous:				true,
		loading:				true,
		tooltip_width:			200,
		tooltip_icon_width:		32,
		tooltip_icon_height:	32,
		tooltip_offsetx:		18,
		tooltip_offsety:		0,
		arrows:					true,
		buttons:				true,
		btn_numbers:			true,
		keybord_keys:			false,
		mousetrace:				false, /* Trace x and y coordinates for the mouse */
		pauseonover:			false,
		stoponclick:			false,
		transition:				'fade', /* hslide/vslide/fade */
		transition_delay:		300,
		transition_speed:		800,
		show_caption:			'onhover', /* onload/onhover/show */
		thumbnails:				true,
		thumbnails_position:	'outside-last', /* outside-last/outside-first/inside-last/inside-first */
		thumbnails_direction:	'horizontal', /* vertical/horizontal */
		thumbnails_slidex:		1, /* 0 = auto / 1 = slide one thumbnail / 2 = slide two thumbnails / etc. */
		dynamic_height:			true, /* For dynamic height to work in webkit you need to set the width and height of images in the source. Usually works to only set the dimension of the first slide in the showcase. */
		speed_change:			false, /* Set to true to prevent users from swithing more then one slide at once. */
		viewline:				false /* If set to true content_width, thumbnails, transition and dynamic_height will be disabled. As for dynamic height you need to set the width and height of images in the source. */
	});
	
	//button popup 
	$(".btn-open-popup").click(function(){
		$('.popup').css("z-index","1000");
		$('.popup').animate({opacity : 1},800);
		return false;
	});
	
	//button hide popup 
	$(".popup-close").click(function(){
		$('.popup').animate({opacity : 0},800);
		setTimeout(function(){$('.popup').css("z-index","-9999")},800);
		return false;
	});
	
	//bookslider
	$('#bookslider').owlCarousel({
		items:1,
		loop:true,
		margin:0,
		responsiveClass:false,
		nav:false,
		dots:true,
		autoplay:true,
		autoHeight:false,
		autoplayTimeout:7000,
		autoplaySpeed:1000,
		autoplayHoverPause:false,
		animateOut: 'fadeOut',
    	animateIn: 'fadeIn',
		mouseDrag:false,
		touchDrag:false,
	});
	//bookslider
	$('#promotion').owlCarousel({
		items:1,
		loop:true,
		margin:0,
		responsiveClass:false,
		nav:false,
		dots:true,
		autoplay:true,
		autoHeight:false,
		autoplayTimeout:7000,
		autoplaySpeed:1000,
		autoplayHoverPause:false,
		animateOut: 'fadeOut',
    	animateIn: 'fadeIn',
		mouseDrag:false,
		touchDrag:false,
	});
	//bookslider
	$('#product').owlCarousel({
		items:1,
		loop:true,
		margin:0,
		responsiveClass:false,
		nav:false,
		dots:true,
		autoplay:true,
		autoHeight:false,
		autoplayTimeout:7000,
		autoplaySpeed:1000,
		autoplayHoverPause:false,
		animateOut: 'fadeOut',
    	animateIn: 'fadeIn',
		mouseDrag:false,
		touchDrag:false,
	});
	
	//bookslider click 
	$(".bs-close").click(function(){
		var parent = $(this).parent();
		if ($(parent).hasClass("m-hide")) {
            $(parent).removeClass("m-hide");
			$('.bs-slider').show();
        } else {
            $(parent).addClass("m-hide");
			$('.bs-slider').hide();
        }
		return false;
	});
	
	var ss = 0;
	ss = $(".sidebar").height();
	var bs = 0;
	bs = $(document).height();
	var bb = 0;
	bb = $(".bg-white").height();
	var shight = bs-bb;	
	if (bs > ss) {
		$('.bg-black').css("height",shight);
	};	
});

$(window).on('resize', function(){
	var ss = 0;
	ss = $(".sidebar").height();
	var bs = 0;
	bs = $(document).height();
	var bb = 0;
	bb = $(".bg-white").height();
	var shight = bs-bb;	
	if (bs > ss) {
		$('.bg-black').css("height",shight);
	}
});