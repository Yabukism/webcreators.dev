jQuery(document).ready(function($){

	function exist_element(oID) {
		return jQuery(oID).length > 0;
	}
		 
	var essb_postfloat_height_break = 0;
	if ($('.essb_break_scroll').length) {
		/*if (essb_postfloat_height_break == 0) {
			essb_postfloat_height_break = $('.essb_displayed_postfloat').outerHeight(true);
			essb_postfloat_height_break = parseInt(essb_postfloat_height_break);
		}
		*/
		var break_position = $('.essb_break_scroll').position();
		var break_top = break_position.top;
		
		console.log("Scroll break position: " + essb_postfloat_height_break);
	}

	if (!exist_element(".essb_displayed_postfloat")) { return; }

	var top = $('.essb_displayed_postfloat').offset().top - parseFloat($('.essb_displayed_postfloat').css('marginTop').replace(/auto/, 0));
	var basicElementWidth = '';
	$(window).scroll(function (event) {
    // what the y position of the scroll is
		var y = $(this).scrollTop();

    // whether that's below the form
		if (y >= top) {
      // if so, ad the fixed class
			$('.essb_displayed_postfloat').addClass('essb_postfloat_fixed');
      
			var element_position = $('.essb_displayed_postfloat').offset();
			var element_height = $('.essb_displayed_postfloat').outerHeight();
			var element_top = parseInt(element_position.top) + parseInt(element_height);
			
			if (element_top > break_top) {
				if (!$('.essb_displayed_postfloat').hasClass("essb_postfloat_breakscroll")) {
					$('.essb_displayed_postfloat').addClass("essb_postfloat_breakscroll");
				}
			}
			else {
				if ($('.essb_displayed_postfloat').hasClass("essb_postfloat_breakscroll")) {
					$('.essb_displayed_postfloat').removeClass("essb_postfloat_breakscroll");
				}
			}
		} 
		else {
      // otherwise remove it
      $('.essb_displayed_postfloat').removeClass('essb_postfloat_fixed');
    }
  });


});

/*

jQuery(document).ready(function($){
	$(window).scroll(essb_postfloat_onscroll);
	var essb_postfloat_height_break = 0;
	function essb_postfloat_onscroll() {
		var current_pos = $(window).scrollTop();
		
		if ($('.essb_break_scroll').length) {
			if (essb_postfloat_height_break == 0) {
				essb_postfloat_height_break = $('.essb_displayed_postfloat').outerHeight(true);
				essb_postfloat_height_break = parseInt(essb_postfloat_height_break);
			}
			
			var break_position = $('.essb_break_scroll').position();
			var element_position = $('.essb_displayed_postfloat').offset();
			
			var element_top = parseInt(element_position.top);
			if ($('.essb_displayed_postfloat').css('display') != 'none') {
				element_top -= essb_postfloat_height_break;
			}
			var break_top = break_position.top;
			
			//console.log('current position='+current_pos);
			//console.log('break position='+break_top);
			//console.log('element position='+element_top);
			//console.log('height of bar: ' + essb_postfloat_height_break);
			if (element_top > break_top) {
				if ($('.essb_displayed_postfloat').css('display') != 'none') {
					$('.essb_displayed_postfloat').hide(200);
				//console.log('hide at element pos = '+element_top+', break = '+break_top);
				}
			}
			else {
				if ($('.essb_displayed_postfloat').css('display') == 'none') {
					$('.essb_displayed_postfloat').show(200);
				//console.log('show at element pos = '+element_top+', break = '+break_top);
				}
			}
		}
	
	}
});*/