(function ($) {
	
	// PAGE LOADING TRANSITION
	$("#et-top-navigation a, .et_pb_button, .mobile-nav a, .logo_container a, .menu a").click(function(e) {
	    e.preventDefault();
	    $link = $(this).attr("href");
	    $("body").fadeOut('slow',function(){
	      window.location =  $link; 
	    });
	});
	
	$(document).addStyle("body","display: none");
	
	$(window).load(function() {
		$('body').fadeIn('slow');
	});
	
	// MOVE SCROLL TO TOP BUTTON
	$('.et_pb_scroll_top').insertAfter('#main-header');
	
	$(document).scroll(function() {
	  var y = $(this).scrollTop();
	  if (y > 200) {
	    $('.portrait-bg').fadeIn('slow');
	  }
	});
	
	// SLICK SLIDER / TESTIMONIALS
	$(document).ready(function () {
		$('.testimonials-slider').slick({
			adaptiveHeight: true,
			dots: true,
			arrows: true,
		});
	});
	
	if ( $('.pullquote').length ) {
		//$('body').addClass('content-pullquote');
		$('.pullquote').closest('.et_pb_row').addClass('content-pullquote');
	}
	
	$('.pullquote').parent().css('padding-bottom', '0');
	
	// INLINE SVGs
	$('img.svg').each(function(){
	    var $img = $(this);
	    var imgID = $img.attr('id');
	    var imgClass = $img.attr('class');
	    var imgURL = $img.attr('src');
	
	    $.get(imgURL, function(data) {
	        // Get the SVG tag, ignore the rest
	        var $svg = jQuery(data).find('svg');
	
	        // Add replaced image's ID to the new SVG
	        if(typeof imgID !== 'undefined') {
	            $svg = $svg.attr('id', imgID);
	        }
	        // Add replaced image's classes to the new SVG
	        if(typeof imgClass !== 'undefined') {
	            $svg = $svg.attr('class', imgClass+' replaced-svg');
	        }
	
	        // Remove any invalid XML tags as per http://validator.w3.org
	        $svg = $svg.removeAttr('xmlns:a');
	
	        // Check if the viewport is set, if the viewport is not set the SVG wont't scale.
	        if(!$svg.attr('viewBox') && $svg.attr('height') && $svg.attr('width')) {
	            $svg.attr('viewBox', '0 0 ' + $svg.attr('height') + ' ' + $svg.attr('width'))
	        }
	
	        // Replace image with new SVG
	        $img.replaceWith($svg);
	
	    }, 'xml');
	
	});
	 
})(jQuery);