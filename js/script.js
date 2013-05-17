
/* Sticky Header Menu */

jQuery(document).ready(function(){
	jQuery('.menu-main-container').waypoint('sticky');
})


/* Slide In Portfolio Images */


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


/*jQuery('.site-intro').backstretch('http://localhost:8888/gianlucacherubin.com/wp-content/themes/one-portfolio/img/bg.jpg');*/

jQuery(document).ready(function(){
    var height_siteintro = jQuery(window).height() - jQuery(".site-header").height();
    jQuery(".site-intro").height(height_siteintro);
    //jQuery(".site-intro h1").css("line-height",height_siteintro +"px");
    jQuery(".site-intro").addClass("active");
});
jQuery(window).resize(function() {
	var height_siteintro = jQuery(window).height() - jQuery(".site-header").height();
    jQuery(".site-intro").height(height_siteintro);
    //jQuery(".site-intro h1").css("line-height",height_siteintro +"px");
});

jQuery(document).ready(function(){
	jQuery(".scrolltoworks").on('click',function(e){
		e.preventDefault();
		jQuery('.site-content').ScrollTo({duration: 1000,});
	});
	
});

