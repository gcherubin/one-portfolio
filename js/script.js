
/* Sticky Header Menu */

jQuery(document).ready(function(){
	jQuery('.menu-main-container').waypoint('sticky');
})


/* Slide In Portfolio Images */
/*
jQuery(document).ready(function(){
	jQuery('article img').first().addClass("active");
});

jQuery(window).scroll(function() {   
	jQuery('article').each( function(i){
		var bottom_of_object = jQuery(this).position().top;
        var bottom_of_window = jQuery(window).scrollTop() + jQuery(window).height();
        if( bottom_of_window > bottom_of_object ){
        	jQuery(this).find('img').each( function(i) {
        		jQuery(this).addClass('active');
        	});
        }
    }); 
});
*/