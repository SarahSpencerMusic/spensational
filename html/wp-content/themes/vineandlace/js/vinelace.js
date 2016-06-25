
jQuery(document).ready(function($) {

	// BXslider
	$('.featured .bxslider').bxSlider({
		pager: false,
		auto: true,
		pause: 5000,
		controls: true,
		
		onSliderLoad: function(){
			$("#slides").css("visibility", "visible");
		  }
	});
});