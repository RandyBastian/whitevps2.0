/*
 * Nucleus Multi-Purpose Technology Template
 * Copyright 2016 8Guild.com
 * Theme Custom Scripts
 */
 /* ╔══╗╔═══╗╔╗╔╗╔══╗╔╗──╔══╗
  	║╔╗║║╔══╝║║║║╚╗╔╝║║──║╔╗╚╗
  	║╚╝║║║╔═╗║║║║─║║─║║──║║╚╗║
  	║╔╗║║║╚╗║║║║║─║║─║║──║║─║║
  	║╚╝║║╚═╝║║╚╝║╔╝╚╗║╚═╗║╚═╝║
  	╚══╝╚═══╝╚══╝╚══╝╚══╝╚═══╝
*/

jQuery(document).ready(function($) {
	'use strict';

	// Disable default link behavior for dummy links that have href='#'
	var $emptyLink = $('a[href=#]');
	$emptyLink.on('click', function(e){
		e.preventDefault();
	});

	// Stuck navbar on scroll
	if($('.navbar-sticky').length && $('.main-navigation').length) {
		var sticky = new Waypoint.Sticky({
		  element: $('.navbar-sticky .main-navigation')[0]
		});
	}

	// Search form expand (Topbar)
	var $searchToggle = $('.search-btn > i, .toolbar');
	$searchToggle.on('click', function(){
		$(this).parent().find('.search-box').addClass('open');
	});
	$('.search-btn').on('click', function(e) {
    e.stopPropagation();
	});
	$(document).on('click', function(e) {
		$('.search-box').removeClass('open');
	});

	// Waves Effect (on Buttons)
	if($('.waves-effect').length > 0) {
		Waves.displayEffect( { duration: 600 } );
	}

	// Animated Scroll to Top Button
	var $scrollTop = $('.scroll-to-top-btn');
	if ($scrollTop.length > 0) {
		$(window).on('scroll', function(){
	    if ($(window).scrollTop() > 600) {
	      $scrollTop.addClass('visible');
	    } else {
	      $scrollTop.removeClass('visible');
	    }
		});
		$scrollTop.on('click', function(e){
			e.preventDefault();
			$('html').velocity("scroll", { offset: 0, duration: 1000, easing:'easeOutExpo', mobileHA: false });
		});
	}

	// Smooth scroll to element
	var $scrollTo = $('.scroll-to');
	$scrollTo.on('click', function(event){
		var $elemOffsetTop = $(this).data('offset-top');
		$('html').velocity("scroll", { offset:$(this.hash).offset().top-$elemOffsetTop, duration: 1000, easing:'easeOutExpo', mobileHA: false});
		event.preventDefault();
	});


	// Toggle Mobile Navigation
	var $navToggle = $('.nav-toggle', '.navbar');
	$navToggle.on('click', function(){
		$(this).toggleClass('active').parents('.navbar').find('.toolbar, .main-navigation, .mobile-socials').toggleClass('expanded');
	});

	// Mobile Submenu
	var $hasSubmenu = $('.menu-item-has-children > a', '.main-navigation');
	$hasSubmenu.on('click', function(){
		$(this).parent().toggleClass('active').find('.sub-menu, .mega-menu').toggleClass('expanded');
	});

	// Custom Checkboxes and Radios
	if($('input[type=checkbox], input[type=radio]').length) {
		$('input').iCheck();
	}

	// Toggleable Switch component
	var $sWitch = $('.switch');
	$sWitch.on('click', function(){

	  var clicks = $(this).data('clicks'),
	  		inputVal = $(this).find('input').attr('value');

		if (clicks && inputVal == 'off') {
			$(this).find('input').attr('value', 'on');
			$(this).addClass('on');
		} else if (clicks && inputVal == 'on') {
			$(this).find('input').attr('value', 'off');
			$(this).removeClass('on');
		} else if (!clicks && inputVal == 'off') {
			$(this).find('input').attr('value', 'on');
			$(this).addClass('on');
		} else if (!clicks && inputVal == 'on') {
			$(this).find('input').attr('value', 'off');
			$(this).removeClass('on');
		}

		$(this).data("clicks", !clicks);

	});

	// Count Input
	$('.count-input .incr-btn').on('click', function(e) {
		var $button = $(this);
		var oldValue = $button.parent().find('.quantity').val();
		$button.parent().find('.incr-btn[data-action="decrease"]').removeClass('inactive');
		if ($button.data('action') == "increase") {
			var newVal = parseFloat(oldValue) + 1;
		} else {
		 // Don't allow decrementing below 1
			if (oldValue > 1) {
				var newVal = parseFloat(oldValue) - 1;
			} else {
				newVal = 1;
				$button.addClass('inactive');
			}
		}
		$button.parent().find('.quantity').val(newVal);
		e.preventDefault();
	});

	// Feature Tabs (Changing screens of Tablet and Phone)
  $('.feature-tabs .nav-tabs li a').on('click', function() {
	  var currentPhoneSlide = $(this).data("phone");
	  var currentTabletSlide = $(this).data("tablet");
	  $(".devices .phone .screens li").removeClass("active");
	  $(".devices .tablet .screens li").removeClass("active");
	  $(currentPhoneSlide).addClass("active");
	  $(currentTabletSlide).addClass("active");
  });

  // Feature Tabs Autoswitching
	if($('.feature-tabs .nav-tabs[data-autoswitch]').length > 0) {
    var changeInterval = $('.feature-tabs .nav-tabs').data('interval');
		var tabCarousel = setInterval(function() {
	        var tabs = $('.feature-tabs .nav-tabs > li'),
	            active = tabs.filter('.active'),
	            next = active.next('li'),
	            toClick = next.length ? next.find('a') : tabs.eq(0).find('a');

	        toClick.trigger('click');
	  }, changeInterval);
	}

	// Tooltips
	var $tooltip = $('[data-toggle="tooltip"]');
	if ( $tooltip.length > 0 ) {
		$tooltip.tooltip();
	}

	// Tile Tabs Switching Class
	var $tileTab = $('.tile-tabs .tab');
	$tileTab.on('click', function(){
		$tileTab.removeClass('active');
		$(this).addClass('active');
	});

	// Domain Types Dropdown
	var $domainDropdown = $('.domain-dropdown > span'),
			$domainDropdownWrap = $('.domain-dropdown');
	$domainDropdown.on('click', function() {
		$(this).parent().toggleClass('active');
	});
	$domainDropdownWrap.on('click', function(e) {
    e.stopPropagation();
	});
	$(document).on('click', function(e) {
		$domainDropdownWrap.removeClass('active');
	});

	// Shop Filters Dropdown
	var $shopDropdown = $('.shop-filter-dropdown > span'),
			$shopDropdownWrap = $('.shop-filter-dropdown');
	$shopDropdown.on('click', function() {
		$shopDropdown.parent().removeClass('active');
		$(this).parent().addClass('active');
	});
	$shopDropdownWrap.on('click', function(e) {
    e.stopPropagation();
	});
	$(document).on('click', function(e) {
		$shopDropdownWrap.removeClass('active');
	});

	// Progress Bars on Scroll Animation
	function pbOnScrollAnimation( items, trigger ) {
	  items.each( function() {
	    var pbElement = $(this),
	        curVal = pbElement.find('.progress-bar').attr('data-valuenow');

	    var pbTrigger = ( trigger ) ? trigger : pbElement;

	    pbTrigger.waypoint(function() {
	      	pbElement.find('.progress-bar').css({'width': curVal + '%'});
	    },{
	        offset: '90%'
	    });
	  });
	}
	pbOnScrollAnimation( $('.progress-animated') );

	// Counters (Animated Digits)
	function counterOnScrollAnimation( items, trigger ) {
	  items.each( function() {
	    var counterElement = $(this),
	        decimals = $(this).data('decimals'),
	        duration = $(this).data('duration');

	    var counterTrigger = ( trigger ) ? trigger : counterElement;

	    counterTrigger.waypoint(function(direction) {
				  	if(direction == 'down') {
			      	counterElement.find('.digits').spincrement({
									from: 0.0,
									decimalPlaces: decimals,
									duration: duration
							});
				  	} else {
				  		this.destroy();
				  	}
	    },{
	        offset: '95%'
	    });
	  });
	}
	counterOnScrollAnimation( $('.counter') );

	// Countdown Function
	function countDownFunc( items, trigger ) {
		items.each( function() {
			var countDown = $(this),
					dateTime = $(this).data('date-time');

			var countDownTrigger = ( trigger ) ? trigger : countDown;
			countDownTrigger.downCount({
		      date: dateTime,
		      offset: +10
		  });
		});
	}
	countDownFunc( $('.countdown') );


	// On window load functions
	$(window).on('load', function(){

		// Isotope Grid
		var $grid = $('.isotope-masonry-grid, .isotope-grid');
		if($grid.length > 0) {
		  $grid.isotope({
			  itemSelector: '.grid-item',
			  transitionDuration: '0.7s',
			  masonry: {
			    columnWidth: '.grid-sizer',
			    gutter: '.gutter-sizer'
			  }
		  });
		}

		// Filtering
		if($('.filter-grid').length > 0) {
		  var $filterGrid = $('.filter-grid');
			$('.nav-filters').on( 'click', 'a', function(e) {
				e.preventDefault();
				$('.nav-filters li').removeClass('active');
				$(this).parent().addClass('active');
			  var $filterValue = $(this).attr('data-filter');
			  $filterGrid.isotope({ filter: $filterValue });
			});
		}

		/** Background Parallax **/
		if ( ! Modernizr.touch && ! $('html.ie').length ) {
			if ( $( "body.parallax" ).length > 0 ) {
				$.stellar( {
					scrollProperty: 'scroll',
					verticalOffset: 0,
					horizontalOffset: 0,
					horizontalScrolling: false,
					responsive: true
				} );
				$grid.bind("transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd", function(){
					$.stellar('refresh');
				});
			}
		}
	});

	// Scroll Reveal Animations
	if($('.scrollReveal').length && ! $('html.ie9').length) {
		$('.scrollReveal').parent().css('overflow', 'hidden');
		window.sr = ScrollReveal({
			reset: true,
			distance: '32px',
			mobile: true,
			duration: 850,
			scale: 1,
			viewFactor: 0.3,
			easing: 'ease-in-out'
		});
		sr.reveal('.sr-top', { origin: 'top' });
		sr.reveal('.sr-bottom', { origin: 'bottom' });
		sr.reveal('.sr-left', { origin: 'left' });
		sr.reveal('.sr-long-left', { origin: 'left', distance: '70px', duration: 1000 });
		sr.reveal('.sr-right', { origin: 'right' });
		sr.reveal('.sr-scaleUp', { scale: '0.8' });
		sr.reveal('.sr-scaleDown', { scale: '1.15' });

		sr.reveal('.sr-delay-1', { delay: 200 });
		sr.reveal('.sr-delay-2', { delay: 400 });
		sr.reveal('.sr-delay-3', { delay: 600 });
		sr.reveal('.sr-delay-4', { delay: 800 });
		sr.reveal('.sr-delay-5', { delay: 1000 });
		sr.reveal('.sr-delay-6', { delay: 1200 });
		sr.reveal('.sr-delay-7', { delay: 1400 });
		sr.reveal('.sr-delay-8', { delay: 1600 });

		sr.reveal('.sr-ease-in-out-quad', { easing: 'cubic-bezier(0.455,  0.030, 0.515, 0.955)' });
		sr.reveal('.sr-ease-in-out-cubic', { easing: 'cubic-bezier(0.645,  0.045, 0.355, 1.000)' });
		sr.reveal('.sr-ease-in-out-quart', { easing: 'cubic-bezier(0.770,  0.000, 0.175, 1.000)' });
		sr.reveal('.sr-ease-in-out-quint', { easing: 'cubic-bezier(0.860,  0.000, 0.070, 1.000)' });
		sr.reveal('.sr-ease-in-out-sine', { easing: 'cubic-bezier(0.445,  0.050, 0.550, 0.950)' });
		sr.reveal('.sr-ease-in-out-expo', { easing: 'cubic-bezier(1.000,  0.000, 0.000, 1.000)' });
		sr.reveal('.sr-ease-in-out-circ', { easing: 'cubic-bezier(0.785,  0.135, 0.150, 0.860)' });
		sr.reveal('.sr-ease-in-out-back', { easing: 'cubic-bezier(0.680, -0.550, 0.265, 1.550)' });
	}

	// Contacts Slider (Master Slider)
	if($('#contact-slider').length) {
		var contactSlider = new MasterSlider();

		contactSlider.control('arrows');

		contactSlider.setup('contact-slider' , {
			width:1140,
			height:480,
			space:0,
			loop:true,
			view:'basic',
			layout:'partialview',
	    filters: {
	      opacity: 0.1
	    }
		});
	}

	// Conference Slider (Master Slider)
	if($('#conference-slider').length) {
		var conferSlider = new MasterSlider();

		conferSlider.control('arrows', {hideUnder: 800});
		conferSlider.control("bullets", {autohide:false});
		conferSlider.control('timebar', {color: 'rgba(255,255,255,.5)', align: 'top'});

		conferSlider.setup('conference-slider' , {
			width: 1920,
			height: 10,
			space: 0,
			layout: "fillwidth",
      autoHeight: true,
      loop: true,
      view: 'flow',
      autoplay: true
		});
	}

	// Intro Page Slider (Master Slider)
	if($('#intro-slider').length) {
		var introSlider = new MasterSlider();

		introSlider.control('arrows', {hideUnder: 800});
		introSlider.control("bullets", {autohide:false});

		introSlider.setup('intro-slider' , {
			width: 1920,
			height: 10,
			space: 0,
			layout: "fillwidth",
      autoHeight: true,
      loop: true,
      view: 'stack'
		});
	}

	// Image Carousel
	var $imageCarousel = $( '.image-carousel .inner' );
	if ( $imageCarousel.length > 0 ) {
		$imageCarousel.each( function () {

			var dataLoop 	 = $( this ).parent().data( 'loop' ),
					autoPlay   = $( this ).parent().data( 'autoplay' ),
					timeOut    = $( this ).parent().data( 'interval' ),
					autoheight = $( this ).parent().data( 'autoheight' );

			$( this ).owlCarousel( {
				items: 1,
				loop: dataLoop,
				margin: 0,
				nav: true,
				dots: false,
				navText: [ , ],
				autoplay: autoPlay,
				autoplayTimeout: timeOut,
				autoHeight: autoheight
			} );
		} );
	}

	// Logo Carousel
	var $logoCarousel = $( '.logo-carousel .inner' );
	if ( $logoCarousel.length > 0 ) {
		$logoCarousel.each( function () {

			var dataLoop 	 = $( this ).parent().data( 'loop' ),
					autoPlay = $( this ).parent().data( 'autoplay' ),
					timeOut = $( this ).parent().data( 'interval' );

			$( this ).owlCarousel( {
				loop: dataLoop,
				margin: 20,
				nav: false,
				dots: false,
				autoplay: autoPlay,
				autoplayTimeout: timeOut,
				responsiveClass: true,
				responsive: {
					0: { items: 2 },
					480: { items: 3 },
					700: { items: 4 },
					1000: { items: 5 },
					1200: { items: 6 },
				}
			} );
		} );
	}

	// Gallery Popup
	var $gallItem = $( '.gallery-item' );
	if( $gallItem.length > 0 ) {
		$gallItem.magnificPopup( {
		  type: 'image',
		  mainClass: 'mfp-fade',
		  gallery: {
		    enabled: true
		  },
		  removalDelay: 500,
		  image: {
		  	titleSrc: 'data-title'
		  }
		} );
	}

	// Video Popup
	var $videoBtn = $( '.video-popup-btn > .play-btn, .video-popup-tile .play-btn' );
	if( $videoBtn.length > 0 ) {
		$videoBtn.magnificPopup( {
		  type: 'iframe',
		  mainClass: 'mfp-fade',
		  removalDelay: 500
		} );
	}


	// Google Maps API
	var $googleMap = $('.google-map');
	if($googleMap.length > 0) {
		$googleMap.each(function(){
			var mapHeight = $(this).data('height'),
					address = $(this).data('address'),
					zoom = $(this).data('zoom'),
					controls = $(this).data('disable-controls'),
					scrollwheel = $(this).data('scrollwheel'),
					marker = $(this).data('marker'),
					markerTitle = $(this).data('marker-title'),
					styles = $(this).data('styles');
			$(this).height(mapHeight);
			$(this).gmap3({
          marker:{
            address: address,
            data: markerTitle,
            options: {
            	icon: marker
            },
            events: {
              mouseover: function(marker, event, context){
                var map = $(this).gmap3("get"),
                  	infowindow = $(this).gmap3({get:{name:"infowindow"}});
                if (infowindow){
                  infowindow.open(map, marker);
                  infowindow.setContent(context.data);
                } else {
                  $(this).gmap3({
                    infowindow:{
                      anchor:marker,
                      options:{content: context.data}
                    }
                  });
                }
              },
              mouseout: function(){
                var infowindow = $(this).gmap3({get:{name:"infowindow"}});
                if (infowindow){
                  infowindow.close();
                }
              }
            }
          },
          map:{
            options:{
              zoom: zoom,
              disableDefaultUI: controls,
              scrollwheel: scrollwheel,
              styles: styles
            }
          }
			});
		});
	}

});/*Document Ready End*/
