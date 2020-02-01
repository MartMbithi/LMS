(function($){

	"use strict";

 // Detect Web Browser
 var ua = navigator.userAgent.toLowerCase(); 
 if (ua.indexOf('safari') != -1) { 
  if (ua.indexOf('chrome') > -1) {
      // Chrome
    } else {
      // Safari
      jQuery('body').addClass('safari-browser');
    }
  }

	var courseWare = {

      	// Bootstrap Carousels

      	carousel: function() {

      		$('.carousel.slide').carousel({
      			cycle: true
      		}); 
      	}, 

      	// Elements Equal Heights

      	matchHeight: function() {
      		$('.grid-3column-01 .item, full-width .item, .client-logos a').matchHeight({ 
      			property: 'min-height' 
      		});

      	},

      	// Fancybox For Popup Image

      	fancybox: function() {
      		$(".fancybox").fancybox();
      	},

      	// Fancybox For Popup Image

      	owlcarousel: function() {
      		$(".category-slider").owlCarousel({
      			items:5,
      			loop:true,
      			margin:15,
      			autoplay: true,
      			responsive:{
      				320:{
      					items:1,
      					margin: 0
      				},
      				480:{
      					items:2,
      					margin: 15
      				},
      				640:{
      					items:3,
      					margin: 15
      				},
      				768:{
      					items:4,
      					margin: 15
      				},
      				1024:{
      					items:5,
      					margin: 15
      				}
      			}
      		});

      		$(".course-slider").owlCarousel({
      			items:4,
      			loop:true,
      			nav: true,
      			margin:30,
      			autoplay: true,
            navContainer: '.popular-courses .top-content .owl-controls',
      			responsive:{
      				320:{
      					items:1,
      					margin: 0
      				},
      				480:{
      					items:2,
      					margin: 15
      				},
      				640:{
      					items:3,
      					margin: 15
      				},
      				768:{
      					items:3,
      					margin: 15
      				},
      				1024:{
      					items:4,
      					margin: 30
      				}
      			}
      		});

      		$(".post-slider").owlCarousel({
      			items:3,
      			loop:true,
      			nav: true,
      			dots: true,
      			margin:30,
      			autoplay: true,
            navContainer: '.recent-posts .top-content .owl-controls',
      			responsive:{
      				320:{
      					items:1,
      					margin: 0
      				},
      				480:{
      					items:2,
      					margin: 15
      				},
      				640:{
      					items:2,
      					margin: 15
      				},
      				768:{
      					items:2,
      					margin: 15
      				},
      				1024:{
      					items:3,
      					margin: 30
      				}
      			}
      		});
      	},


      	// Rating

      	rating: function() {
      		$('.rating-tooltip-manual').rating();
                  $('.rating-tooltip-manual').each(function () {
                        $('<span class="label label-default"></span>')
                        .text($(this).val() || ' ')
                        .insertAfter(this);
                  });
                  $('.rating-tooltip-manual').on('change', function () {
                        $(this).next('.label').text($(this).val());
                  });
            },

            countdown: function() {
              $('#countdown').timeTo({
               timeTo: new Date(new Date('October 25 2018 09:00:00 GMT-0600')),
               displayCaptions: true,
               fontSize: 40,
               captionSize: 15
         }); 
        },


        counterup: function() {
              $('.count').counterUp({
               delay: 15,
               time: 1500
         });
        },


        magnificpopUp: function() {
              $('.popup-video').magnificPopup({
               type: 'iframe'
         });

              $('.image-popup').magnificPopup({
               type: 'image',
               gallery: {
                enabled: true
          },
    });
        },

		// Isotop Filters

		isotope: function() {
			var $PortfolioItems = $('.portfolio-items');
			$PortfolioItems.isotope({
				itemSelector: '.item',
				layoutMode: 'masonry',
				transitionDuration: '0.6s',
				percentPosition: true,
				margin: 45,
				masonry: {
					columnWidth: '.item'
				}
			});

			$('.filter a').on("click", function(e){
				$('.filter .active').removeClass('active');
				$(this).addClass('active');
				var selector = $(this).attr('data-filter');
				$PortfolioItems.isotope({
					filter: selector,
					animationOptions: {
						duration: 600,
						easing: 'linear',
						queue: false
					}
				});
				return false;
			});
		},

		// Images Loaded

		imagesloaded: function() {
			var $PortfolioItems = $('.portfolio-items');
			$PortfolioItems.imagesLoaded().progress( function() {
				$PortfolioItems.isotope('layout');
			});  
		},

		// Google Map Functions

		googlemap: function() {
			function isMobile() {
				return ('ontouchstart' in document.documentElement);
			}
			function init_gmap() {
				if ( typeof google == 'undefined' ) return;
				var options = {
					center: {lat: -37.834812, lng: 144.963055},
					zoom: 15,
					mapTypeControl: true,
					mapTypeControlOptions: {
						style: google.maps.MapTypeControlStyle.DROPDOWN_MENU
					},
					navigationControl: true,
					scrollwheel: false,
					streetViewControl: true,
					styles: [{"featureType":"administrative","elementType":"labels.text.fill","stylers":[{"color":"#faf8f8"}]},{"featureType":"landscape","elementType":"all","stylers":[{"color":"#faf8f8"}]},{"featureType":"poi","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"all","stylers":[{"saturation":-100},{"lightness":45}]},{"featureType":"road.highway","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"road.arterial","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"all","stylers":[{"color":"#cdcdcd"},{"visibility":"on"}]}]
				}
				if (isMobile()) {
					options.draggable = false;
				}
				$('#googleMaps').gmap3({
					map: {
						options: options
					},
                          marker: {
                             latLng: [-37.834811, 144.963054],
                             options: { icon: 'images/map-icon.png' }
                       }
                 });
			}

			init_gmap();
		},
	};

	$(document).ready(function() {
		"use strict";

 
		// Background Img 
		$(".background-bg").css('background-image', function () {
			var bg = ('url(' + $(this).data("image-src") + ')');
			return bg;
		});


		// var navheight = $('.top-content').height();
		// $('#course-slider .owl-nav').css('top', (navheight));

		// var topcontentheight = $('.top-content').height();
		// $('#course-slider ').css('top', (topcontentheight));

		// Change color of the last word in a title

		$('.section-title-02, aside .widget-title').each(function(index, element) {
			var heading = $(element);
			var word_array, last_word, first_part;

            word_array = heading.html().split(/\s+/); // split on spaces
            last_word = word_array.pop();             // pop the last word
            first_part = word_array.join(' ');        // rejoin the first words together

            heading.html([first_part, ' <span class="last-word">', last_word, '</span>'].join(''));

            

      });


		

		courseWare.carousel();
		courseWare.matchHeight();
		courseWare.isotope();
		courseWare.imagesloaded();
		courseWare.rating();
		courseWare.countdown();
		courseWare.owlcarousel();
		courseWare.counterup();
		courseWare.magnificpopUp();
		courseWare.googlemap();
	});


})(jQuery);




window.onload = function(e) {
	//var topcontentheight = $('.top-content').height();
	//$('#course-slider .owl-nav, #post-slider .owl-nav').css('top', - (topcontentheight) * 1.9);

      $('.layout-switcher span.grid').addClass('active');

      $('.layout-switcher span.list').on('click', function(e) {
            e.preventDefault();
            $(this).addClass('active');
            $('.layout-switcher span.grid').removeClass('active');
            $('.course-items, .shop-items').addClass('list-view').removeClass('grid-view');
      });

      $('.layout-switcher span.grid').on('click', function(e) {
            e.preventDefault();
            $(this).addClass('active');
            $('.layout-switcher span.list').removeClass('active');
            $('.course-items, .shop-items').addClass('grid-view').removeClass('list-view');
      });

};




/* Working Contact Form Js
-------------------------------------------------------------------*/
// Email from Validation
jQuery('#submit').on("click", function(e){ 

	    //Stop form submission & check the validation
	    e.preventDefault();

	    // Variable declaration
	    var error = false;
	    var k_name = jQuery('#name').val();
	    var k_email = jQuery('#email').val(); 
	    var k_email = jQuery('#subject').val(); 
	    var k_message = jQuery('#message').val();

	    /* Post Ajax function of jQuery to get all the data from the submission of the form as soon as the form sends the values to email.php*/
	    jQuery.post("email.php", jQuery(".wpcf7-form").serialize(),function(result){
	        //Check the result set from email.php file.
	        if(result == 'sent'){
	        	$('.contact-message').html('<i class="fa fa-check contact-success"></i><div>Your message has been sent.</div>').fadeIn();
	        } else {
	        // $('.error-message').html('<i class="fa fa-thumbs-down contact-error"></i><div>Your message has not been sent</div>').fadeIn();
       }
     });

    }); 
