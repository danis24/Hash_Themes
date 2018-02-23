(function ($) {
    "use strict";
	$(document).ready(function() {
		$('#carousel-example-generic1').carousel({
		  interval: 1600
		});
                $('#postcarousel').carousel({
		  interval: 1600
		});
                
		$('.header_submit').attr('value','');
		$('.fm_newsletter').attr('value','');
		
		$('.header_submit') .on('click', function(){
            $('.header_input').toggleClass('display_block');
        });	
	});
});


jQuery(document).ready(function($){
    
    $('.only-for-mobile .m_nav').on('click', function(e) {
	        	$('.only-for-mobile .mobi-menu').slideToggle();
    });
	var test = $('#cssmenu > ul > li').children('ul.sub-menu');
	
	  $(test).prev('a').on('click', function(e){
	      e.preventDefault();
         $(this).toggleClass('open');
         $(this).next('ul').toggleClass('mobile-display');
	      
	      });
	      $(test).prev().addClass('plus');
	      
	      //if ( $('#cssmenu > ul > li').children('ul.sub-menu').length > 0 ) {
	      //var find = $(#cssmenu > ul > li').children('ul.sub-menu');
	      //console.log(this);
	       //$('#cssmenu > ul > li > a').addClass('plus'); 
	      //}
 
});

jQuery(document).ready(function($){
if ( $('.animated').length){
	var $ = jQuery;

	$('.animated').appear(function(){
	var element = $(this);
	var animation = element.data('animation');
	var animationDelay = element.data('delay');
	if (animationDelay) {
	setTimeout(function(){
	element.addClass( animation + " in" );
	element.removeClass('out');
	}, animationDelay);
	}
	else {
	element.addClass( animation + " in" );
	element.removeClass('out');
	}    

	},{accY: -150});

	}
});