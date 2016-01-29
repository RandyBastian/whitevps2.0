"use strict";

//Plaeholder handler
if(!Modernizr.input.placeholder){             //placeholder for old brousers and IE
 
  $('[placeholder]').focus(function() {
   	var input = $(this);
   	if (input.val() == input.attr('placeholder')) {
    	input.val('');
    	input.removeClass('placeholder');
   	}
  }).blur(function() {
   	var input = $(this);
   	if (input.val() == '' || input.val() == input.attr('placeholder')) {
    	input.addClass('placeholder');
    	input.val(input.attr('placeholder'));
   	}
  }).blur();
 
  $('[placeholder]').parents('form').submit(function() {
   	$(this).find('[placeholder]').each(function() {
    	var input = $(this);
    	if (input.val() == input.attr('placeholder')) {
     		input.val('');
    	}
   	})
  });
 }


//Function section
function mobile_menu(elem) {

		if($(elem).length==0){
			return 0;
		};

		// Call mobile menu 
		$('.z-nav__list').mobileMenu({
		    triggerMenu:'.z-nav__toggle',
			subMenuTrigger: ".z-nav__toggle-sub",
			animationSpeed:500	
		});

		$('.z-nav__toggle').on('mousedown touchstart', function (){
			$('.z-nav__toggle').toggleClass('open-nav');
			var $mobileNav = $('.z-nav__list');
			var $cart = $('.cart__list');
			var $cartToggle = $('.cart__toggle');

			if($mobileNav.hasClass('open-nav')){
				$mobileNav.removeClass('open-nav close-nav');
				$mobileNav.addClass('close-nav');
			}
			else{
				$mobileNav.removeClass('open-nav close-nav');
				$mobileNav.addClass('open-nav');

				$cart.removeClass('open-nav close-nav');
				$cart.addClass('close-nav');
				$cartToggle.removeClass('open-nav close-nav');
				$cartToggle.addClass('close-nav');
			}
		});
}

function navAnim(elem){	
				if($(elem).length==0){
				 	return 0;
				};
				//Animated header positioning
				var $head = $( '.fixed-top' );
				$( '.waypoint' ).each( function(i) {
					var $el = $( this ),
					animClassDown = $el.data( 'animateDown' ),
					animClassUp = $el.data( 'animateUp' );
								 
					$el.waypoint( function( direction ) {
						if( direction === 'down' && animClassDown ) {
							$head.attr('class', 'fixed-top ' + animClassDown);
						}
						else if( direction === 'up' && animClassUp ){
							$head.attr('class', 'fixed-top ' + animClassUp);
						}
					});
				});
}

//Start function
function cart(elem) {
				if($(elem).length==0){
				 	return 0;
				};

				function cartUsage(){
					$('.cart__toggle').toggleClass('open-nav');
					var $cart = $('.cart__list');
					var $mobileNav = $('.z-nav__list');
					var $navToggle = $('.z-nav__toggle');

					if($cart.hasClass('open-nav')){
						$cart.removeClass('open-nav close-nav');
						$cart.addClass('close-nav');	
					}
					else{
						$cart.removeClass('open-nav close-nav');
						$cart.addClass('open-nav');

						if($mobileNav.hasClass('open-nav')){
							$mobileNav.removeClass('open-nav close-nav');
							$mobileNav.addClass('close-nav');

							$navToggle.removeClass('open-nav close-nav');
							$navToggle.addClass('close-nav');
						}
					}
				}

				if( 'ontouchstart' in window ) {
					$('.cart__toggle').on('touchstart', function () {
						cartUsage();
					});			
				} else {
					$('.cart__toggle').on('click', function () {
						cartUsage();
					});
				}


}
//end function

//Start function
function initMap(elem) {

	if($(elem).length==0){
		return 0;
	};

	//Map start init - location New York
    var mapOptions = {
        scaleControl: true,
        center: new google.maps.LatLng(40.705002, -73.983450),
        zoom: 9,
        disableDefaultUI: true,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };
                    
    var map = new google.maps.Map(document.getElementById('map'),mapOptions);
    var marker = new google.maps.Marker({
        map: map,
        position: map.getCenter() 
    });
}
//end function

//Start function
function initMapLocation(elem) {

	if($(elem).length==0){
		return 0;
	};

	//Map start init
    var mapOptions = {
        scaleControl: true,
        center: new google.maps.LatLng(51.546109, -0.146007),
        zoom: 13,
        disableDefaultUI: true,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };
                    
    var map = new google.maps.Map(document.getElementById('map'),mapOptions);
    var marker = new google.maps.Marker({
        map: map,
        position: map.getCenter() 
    });

    //Custome map style
    var map_style = [{stylers:[{saturation:-100},{gamma:3}]},{elementType:"labels.text.stroke",stylers:[{visibility:"off"}]},{featureType:"poi.business",elementType:"labels.text",stylers:[{visibility:"off"}]},{featureType:"poi.business",elementType:"labels.icon",stylers:[{visibility:"off"}]},{featureType:"poi.place_of_worship",elementType:"labels.text",stylers:[{visibility:"off"}]},{featureType:"poi.place_of_worship",elementType:"labels.icon",stylers:[{visibility:"off"}]},{featureType:"road",elementType:"geometry",stylers:[{visibility:"simplified"}]},{featureType:"water",stylers:[{visibility:"on"},{saturation:0},{gamma:2},{hue:"#aaaaaa"}]},{featureType:"administrative.neighborhood",elementType:"labels.text.fill",stylers:[{visibility:"off"}]},{featureType:"road.local",elementType:"labels.text",stylers:[{visibility:"off"}]},{featureType:"transit.station",elementType:"labels.icon",stylers:[{visibility:"off"}]}]

    //Then we use this data to create the styles.
    var styled_map = new google.maps.StyledMapType(map_style, {name: "Cusmome style"});

    map.mapTypes.set('map_styles', styled_map);
    map.setMapTypeId('map_styles');
}
//end function

//Start function
function sequenceExp(elem) {
	if($(elem).length==0){
		return 0;
	};

				var sequence =  $('.sequence__item');
				
				sequence.click(function (e) {
					e.preventDefault();

					sequence.removeClass('sequence__item--active');
					$(this).addClass('sequence__item--active');

					var sepatators = $('.sequence--clickable .sequence__separator');
					var connector = $(this).attr('data-connect');
					var textArea = $('.sequence__text');

					textArea.hide(0);
					$('.'+ connector).show();

					var defaultSeparator = '<span class="sequence__devider"></span><span class="sequence__devider"></span><span class="sequence__devider"></span><span class="sequence__devider"></span><span class="sequence__devider"></span><span class="sequence__devider"></span><span class="sequence__devider"></span><span class="sequence__devider"></span>';
					var prevSeparator= '<span class="sequence__devider sequence__color--one"></span><span class="sequence__devider sequence__color--one1"></span><span class="sequence__devider sequence__color--one2"></span><span class="sequence__devider sequence__color--one3"></span><span class="sequence__devider sequence__color--two3"></span><span class="sequence__devider sequence__color--two2"></span><span class="sequence__devider sequence__color--two1"></span><span class="sequence__devider sequence__color--two"></span>';
					var nextSeparator = '<span class="sequence__devider sequence__color--two"></span><span class="sequence__devider sequence__color--two1"></span><span class="sequence__devider sequence__color--two2"></span><span class="sequence__devider sequence__color--two3"></span><span class="sequence__devider sequence__color--one3"></span><span class="sequence__devider sequence__color--one2"></span><span class="sequence__devider sequence__color--one1"></span><span class="sequence__devider sequence__color--one"></span>';

					sepatators.html(defaultSeparator);
					$(this).prev('.sequence__separator').html(prevSeparator);
					$(this).next('.sequence__separator').html(nextSeparator);
				});
}
//end function

//Start function
function galleryPopup(elem) {
	if($(elem).length==0){
		return 0;
	};

	$('.gallery-wrapper').magnificPopup({
		delegate: 'a',
		type: 'image',
		tLoading: 'Loading image #%curr%...',
		mainClass: 'mfp-img-mobile',
		gallery: {
			enabled: true,
			navigateByImgClick: true,
			preload: [0,1] // Will preload 0 - before current, and 1 after the current image
		},
		image: {
			tError: '<a href="%url%">The image #%curr%</a> could not be loaded.'
		}
	});
}
//end function

function count(elem){	
	if($(elem).length==0){
		return 0;
	};

	//CountDown
    var dateOfBeginning = "Jan 17, 2014", //type your date of the Beginnig
        dateOfEnd = "Dec 25, 2014"; //type your date of the end

    countDown(dateOfBeginning, dateOfEnd); 

}