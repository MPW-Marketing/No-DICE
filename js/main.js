jQuery(document).ready(function() {
	
	/* METADATA OBJECT */
	// It is a bridge between HTML/PHP and JavaScript to pass some user settings from admin panel
	var metadata = jQuery('#metadata.metadata').metadata();
	
	var templateUrl = metadata.template_url;
	var enableIndicatorAnimation = true;
	var enableFontReplacement = (metadata.style_font_replacement_enable && metadata.style_font_replacement_enable == 'true') ? true : false;

	
	/* FONT REPLACEMENT */	
	if ( enableFontReplacement ) {
		var selectors = new Array(
				'h1:not(:has(img))',
				'h2',
				'h3',
				'h4',
				'h5',				
				'h6:not(.entry-terms:parent h6)',
				'#primary-nav-menu > li > a',
				'.button',
				'.price.big', 
				'.countdown_section',
				'.page-intro',
				'span.dropcap'
		).join(", ");
		Cufon.replace(selectors, { hover: 'true' });
	}
	
	
		
	/* SEARCH FORM */
	jQuery('#searchsubmit').remove();
	jQuery('#s').each(function(){
		
		/* Defaul behavior */
		if(jQuery(this).val() == '' && jQuery(this).attr('title') != '')
			jQuery(this).val( jQuery(this).attr('title') ).addClass('meta');		
		if(jQuery(this).val() == jQuery(this).attr('title') )
			jQuery(this).addClass('meta');		
		
		/* On focus */
		jQuery(this).focus(function(){
		    if(jQuery(this).val() == jQuery(this).attr('title'))
		        jQuery(this).val('').removeClass('meta');
		});
		
		/* On blur */
		jQuery(this).blur(function(){
		    if(jQuery(this).val() == '' && jQuery(this).attr('title') != '')
		       jQuery(this).val( jQuery(this).attr('title') ).addClass('meta');
		});		
	});
	
	
	
	
	
	
	
	
	
		
	
	
		
	
	
	
	
	/* DROPDOWN MENU */
	jQuery('.dd-menu li:has(ul) > a').addClass('dd-submenu-title').append('<span class="dd-arrow"><span class="css-shape"></span></span>');	
	jQuery('.dd-menu li').hover(function(){	
			// HOVER IN HANDLER
	
			jQuery('ul:first', this).css({visibility: "visible",display: "none"}).slideDown(250);									
			var path_set = jQuery(this).parents('.dd-menu li').find('a:first');
			jQuery(path_set).addClass('dd-path');						
			jQuery('.dd-menu li a.dd-path').not(path_set).removeClass('dd-path');
			
		},function(){			
			// HOVER OUT HANDLER		
			jQuery('ul:first', this).css({visibility: "hidden"});				
	});
	jQuery('.dd-menu').hover(function() {
			// HOVER IN HANDLER
			
		}, function() {			
			// HOVER OUT HANDLER		
			jQuery('a.dd-path', this).removeClass('dd-path');			
	});
	
	
	
	

	/* INDICATORS */
	if ( enableIndicatorAnimation && !jQuery.browser.msie ) {
		jQuery('a .indicator').hide();
		jQuery('a:has(.indicator)').hover(function(){	
			// HOVER IN HANDLER
			jQuery('.indicator', this).stop(true, true).fadeIn('slow');
			
		},function(){			
			// HOVER OUT HANDLER
			jQuery('.indicator', this).stop(true, true).fadeOut('slow');
							
		});
	}	
	
	
	// BIG DICE SLIDER IN PRECONTENT 
	jQuery('#precontent-inner:has(#slider.slider-dice)').each(function(){
		var xml = jQuery(this).diceXML();		
		//alert(xml);
		
		var flashvars = {
			input:				encodeURIComponent(xml),	
			css:				encodeURIComponent( templateUrl + '/css/dice-slider.css' ), 
			fonts:				encodeURIComponent( templateUrl + '/css/TitilliumText25L_250wt.swf' )
		};
		var params = {
			menu: 				"false",
			scale: 				"noScale",
			allowFullscreen: 	"true",
			allowScriptAccess: 	"always",
			bgcolor: 			"#FFFFFF",
			wmode: 				"transparent"
		};
		var attributes = {
			id:					"precontent-dice-slider"
		};

		//var playerVersion = swfobject.getFlashPlayerVersion();
		//var majorVersion = playerVersion.major;
		//alert(majorVersion);
		
		swfobject.embedSWF( encodeURI(templateUrl + "/preview.swf"), "slider", "967", "400", "10.0.0", encodeURI(templateUrl + "/expressInstall.swf"), flashvars, params, attributes, function(e){
			if(e.success === true ) {				
				jQuery(e.ref).wrap('<div id="slider" style="visibility: visible;"></div>');
			}	
		});
	
	});	

	
	/* DICE SLIDER */
	jQuery('.slider-dice-alt-content').each(function(){	
		
		var localMetadata = jQuery('.metadata', this).metadata();
		
		var _altContentId = jQuery(this).attr('id');
		
		var _width 		= localMetadata.width ? parseInt(localMetadata.width) : 100;
		var _height		= localMetadata.height ? parseInt(localMetadata.height) : 100;
		
		var xml = jQuery(this).diceXML();
		//alert(xml);
		
		var flashvars = {
			input:				encodeURIComponent(xml),	
			css:				encodeURIComponent( templateUrl + '/css/dice-slider.css' ), 
			fonts:				encodeURIComponent( templateUrl + '/css/TitilliumText25L_250wt.swf' )			
		};
		var params = {
			menu: 				"false",
			scale: 				"noScale",
			allowFullscreen: 	"true",
			allowScriptAccess: 	"always",
			bgcolor: 			"#FFFFFF",
			wmode: 				"transparent"
		};
		
		var attributes = {
			id:					encodeURIComponent( _altContentId )
		};
		
		swfobject.embedSWF( encodeURI(templateUrl + "/preview.swf"), _altContentId, _width, _height, "10.0.0", encodeURI(templateUrl + "/expressInstall.swf"), flashvars, params, attributes, function(e){
			if(e.success === true ) {				
				jQuery(e.ref).wrap('<div class="slider" style="visibility: visible;"><div class="viewport"></div></div>');
			}	
		});
	});
	
	
	
	
	
	/* CYCLE SLIDERS */
	jQuery('.slider-cycle').each(function(){
		
		/* Slider makes sense when there are more than 2 slides */
		if(jQuery('.slides li').length < 2 ) {
			return;
		}	
		
		/* Remove empty slide descriptions */
		jQuery('.slide-description', this).filter(function (index) { 
		    return jQuery(this).children().length < 1; 
		}).remove();
				
		
		jQuery('.slides li', this).show();		
		var slider = this;
		
		var localMetadata = jQuery('.metadata', this).metadata();
		
		/* Compose configuration variables */		
		var _fx 		= localMetadata.fx ? localMetadata.fx : 'fade';
		var _easing		= localMetadata.easing ? localMetadata.easing : null;
		var _speed 		= localMetadata.speed ? parseInt(localMetadata.speed) : 1000;
		var _timeout 	= localMetadata.timeout ? parseInt(localMetadata.timeout) : 4000;
		var _pause 		= (localMetadata.pause && localMetadata.pause == 'true') ? true : false;
		
		/* Build slider navigation */
		var sliderNav = new Array(
			'<div class="nav">',
				'<p class="prev-slide"><a class="" href="#"></a><span></span></p>',
				'<ul>',
				'</ul>',
				'<p class="next-slide"><span></span><a class="" href="#"></a></p>',
			'</div>'
		).join("\n");
		jQuery(this).append(sliderNav);
			
		// Start slider
		jQuery('.slides', this).cycle({
			activePagerClass: 	'current-slide',
			fx:					_fx,
			easing:				_easing,
			speed:				_speed,
			timeout:			_timeout,
			pause:				_pause,
			prev:				jQuery('.prev-slide', this),
			next:				jQuery('.next-slide', this),
			pager:				jQuery('.nav ul', slider),					
			pagerAnchorBuilder: function(idx, slide) {            
				return '<li><a class="coin" href="#"></a></li>';
		   	}		
		});
	});
	
	
	
	
	
	/* KWICKS SLIDER */  
	jQuery('.slider-kwicks').each(function(){		
		
		/* Calculate width of each kwick */
		var nbKwicks = jQuery('.slides li', this).length;	
		
		if( nbKwicks < 3 || nbKwicks > 5 )
			return;	
		
		var _width;
		var _spacing;
		
		/* Some browsers don't handle half-pixels well, so we need to play with negative spacing to make it look good */
		switch ( nbKwicks ) {
			case 3:
				_width 	= 323; 
				_spacing = -1;
				break;
			case 4:
				_width	= 244;
				_spacing = -3;
				break;
			case 5:
				_width 	= 195;
				_spacing = -2;
				break;		
		}

				
		jQuery('.slides li', this).show().css('width', _width + 'px');
		
		var localMetadata = jQuery('.metadata', this).metadata();
		/* Compose configuration variables */
		var _duration	= localMetadata.duration ? parseInt(localMetadata.duration) : 200;
		var _easing		= localMetadata.easing ? localMetadata.easing : null;
		
		
		/* Add visual divider for each slide */
		jQuery('.slide', this).append('<span class="kwicks-divider"></span>');
		
		
		jQuery('.slide-description', this).filter(function (index) { 
		    return jQuery(this).children().length < 1; 
		}).remove();

		
		/* Start slider */
		jQuery('.slides', this).kwicks({  
			max : 			802,
			min:			55,
			duration: 		_duration,
		    spacing : 		_spacing,
		    easing:			_easing,
		    sticky:			false,
		    defaultKwick:	0	    
		});
		
		
		jQuery('.slide-description h3', this).css('width', '802px');
		jQuery('.slide-description p', this).css('width', '802px').hide();
		
		jQuery('.slides li', this).hover(function(){
			// HOVER IN			
			//jQuery('.slide-description',this).stop(true, true).fadeTo(500, 1);
			jQuery('.slide-description h3', this).stop(true, true).slideDown(500);
			jQuery('.slide-description p', this).stop(true, true).slideDown(500);
			
			jQuery(this).siblings('li').each(function(){
				//jQuery('.slide-description', this).stop(true, true).fadeTo(500, 0);
				jQuery('.slide-description h3', this).stop(true, true).slideUp(500);
				jQuery('.slide-description p', this).stop(true, true).slideUp(500);
			});
			
		}, function(){
			// HOVER OUT			
		});
		
		jQuery('.slides', this).hover(function(){
			// HOVER IN
		}, function(){
			// HOVER OUT
			//jQuery('.slide-description', this).stop(true, true).fadeTo(500, 1);
			jQuery('.slide-description h3', this).stop(true, true).slideDown(500);
			jQuery('.slide-description p', this).stop(true, true).slideUp(500);
		});
		
	});
	
	
	
	
	
	
	/* Helpers for togglers and accordions */
	var plusHelper = '<span class="plus"><span class="css-line-hor"></span><span class="css-line-ver"></span></span>';
	var minusHelper = '<span class="minus"><span class="css-line-hor"></span><span class="css-line-ver"></span></span>';
		
	/* TOGGLES */
	/* Collapse 'off' togglers */
	jQuery('.toggle-off .toggle-content').hide();
	jQuery('.toggle-off .toggle-title').prepend(plusHelper);
	jQuery('.toggle-on .toggle-title').prepend(minusHelper);
	
	jQuery('.toggle .toggle-title').click(function() {		
		jQuery('span', this).eq(0).toggleClass('plus').toggleClass('minus');
		// Switch toggle (from 'off' to 'on' or from 'on' to 'off' ) on mouseclick
		jQuery(this).parent('.toggle').toggleClass('toggle-on').toggleClass('toggle-off');		
		// Show or hide content
		jQuery(this).parent('.toggle').find('.toggle-content').slideToggle();
		
	});
	
	/* ACCORDIONS */
	jQuery('.accordion').each(function(){
		// Remove empty paragraphs
		jQuery('p:empty', this).remove();
		
		jQuery('.accordion-panel', this).each(function(index){
			
			// Non-first accordion panels should be collapsed
			if(index){
				jQuery(this).addClass('accordion-panel-off');
				jQuery('.accordion-panel-title', this).prepend(plusHelper);
				jQuery('.accordion-panel-content', this).hide();
			}
			// First accordion panel should be expanded
			else {
				jQuery(this).addClass('accordion-panel-on');
				jQuery('.accordion-panel-title', this).prepend(minusHelper);
			}
		});
		
		jQuery('.accordion-panel-title', this).click(function(){				
			jQuery(this).parent('.accordion-panel-off').each(function(){				
				// Expand => Collapse
				jQuery(this).siblings('.accordion-panel-on').each(function(){
					jQuery(this).toggleClass('accordion-panel-on').toggleClass('accordion-panel-off');
					jQuery('.accordion-panel-title span', this).eq(0).toggleClass('plus').toggleClass('minus');
					jQuery('.accordion-panel-content', this).slideUp(500);
				});				
				
				// Collapse => Expand
				jQuery(this).toggleClass('accordion-panel-on').toggleClass('accordion-panel-off');
				jQuery('.accordion-panel-title span', this).eq(0).toggleClass('plus').toggleClass('minus');		
				jQuery('.accordion-panel-content', this).slideDown(500);
				
			});											
		});			
	});
	
	/* TABS */
	jQuery('.tabs').each(function(){
		
		var navigation = jQuery('<ul class="tab-nav"></ul>');
		var viewport = jQuery('<div class="tab-viewport"></div>');
		
		var tabs = jQuery(this);
		
		jQuery('.tab-title', this).each(function(){
			var li = jQuery('<li class="tab-nav-item">' + jQuery(this).text()  + '</li>');98
			var div = jQuery('<div class="tab-viewport-item"></div>').append(jQuery(this).next('.tab-content').detach().contents());
			
			navigation.append(li).append('<li class="gap"></li>');			
			viewport.append(div);
			
			li.click(function() {	
				tabs.find('.tab-nav-item').removeClass('current');
				jQuery(this).addClass('current');
				tabs.find('.tab-viewport-item').hide();
				div.show();				
			});
			
			jQuery(this).remove();
		
		});
		
		navigation.prepend('<li class="helper-1"></li>');
		jQuery('li.gap:last', navigation).toggleClass('gap').toggleClass('helper-2');
		
		tabs.find('*').remove();
		
		tabs.prepend(viewport);
		tabs.prepend(navigation);
		
		tabs.find('.tab-nav-item:first').addClass('current');
		tabs.find('.tab-viewport-item').hide();
		tabs.find('.tab-viewport-item:first').show();
		
		
	});

	
		
		
	
	
	
	
	
		
	/* REPLACE SUBMIT BUTTONS WITH SOMETHING EASIER TO STYLE:) */
	jQuery('input[type=submit]').each(function() {		
	
		var val = jQuery(this).val();
		var a = jQuery('<a class="button primary small"><span>' + val + '</span></a>');
		var input = jQuery(this);
		
		input.after(a);
		input.hide();
		
		a.click(function() {			
			input.trigger('click');
		});
	});

	
 
	
		
	

	
	
	
	/* COUNTDOWNS */
	if(jQuery.countdown){	
		jQuery('.countdown').each(function(){
			var countdownHandler = this;			
			var countdownMetadata = jQuery('.metadata', this).metadata();
			
			var untilDate  = new Date(
					parseInt(countdownMetadata.until_year),
					parseInt(countdownMetadata.until_month) - 1,
					parseInt(countdownMetadata.until_day),
					parseInt(countdownMetadata.until_hours),
					parseInt(countdownMetadata.until_minutes),
					parseInt(countdownMetadata.until_seconds)
			);			
			
			/* Refresh Cufon mechanism upon every thick */
			var onTickFunction = function(){
				if(enableFontReplacement) {	
					Cufon.replace('.countdown_section');
				}	
			};
			
			/* If there is some expiry text, show it and hide countdown sections */
			var onExpiryFunction = function() {			
				jQuery('.countdown-expiry-text', countdownHandler).each(function() {
					jQuery(this).show();
					jQuery('.countdown-inner', countdownHandler).remove();
				});
			};	
			/* By default expiry text is hidden */
			jQuery('.countdown-expiry-text', this).hide();
			
			/* Start countdown */
			jQuery('.countdown-inner', this).countdown({
				until: 			untilDate,
				alwaysExpire:	true,
				onExpiry:  		onExpiryFunction,		
				onTick: 		onTickFunction
			});
			
		});
	}
		
	
	
	

	/* LINKS OPENED IN NEW WINDOW */
	jQuery('a[class~=new-window]').attr('target', '_blank');
	
	
	
	
	
	
	/* PRETTYPHOTO PLUGIN */
	jQuery("a[rel^='prettyPhoto']").prettyPhoto({
		animation_speed: 'fast', /* fast/slow/normal */
		slideshow: false, /* false OR interval time in ms */
		autoplay_slideshow: false, /* true/false */
		opacity: 0.80, /* Value between 0 and 1 */
		show_title: true, /* true/false */
		allow_resize: true, /* Resize the photos bigger than viewport. true/false */
		default_width: 500,
		default_height: 344,		
		counter_separator_label: '/', /* The separator for the gallery counter 1 "of" 2 */
		theme: 'dice', /* light_rounded / dark_rounded / light_square / dark_square / facebook */
		hideflash: false, /* Hides all the flash object on a page, set to TRUE if flash appears over prettyPhoto */
		wmode: 'opaque', /* Set the flash wmode attribute */
		autoplay: true, /* Automatically start videos: True/False */
		modal: false, /* If set to true, only the close button will close the window */
		overlay_gallery: true, /* If set to true, a gallery will overlay the fullscreen image on mouse over */
		keyboard_shortcuts: true /* Set to false if you open forms inside prettyPhoto */	
	});	
	
	
	
	
	/* PREHADER */
	if(metadata.general_preheader_enable && metadata.general_preheader_enable == 'true'){
		jQuery('#preheader-toggle .arrow').each(function(){
			// By default preheader is collapsed
			if(window.location.href.indexOf('preheader=on') == -1){				
				jQuery(this).addClass('arrow-down');
				jQuery('#preheader-inner').addClass('off');
			}
			// But you can expand it by adding 'preheader=on' to the query string
			else {
				jQuery(this).addClass('arrow-up');
				jQuery('#preheader-inner').addClass('on').show();
			}	
			
			jQuery(this).click(function(){ 				
				jQuery(this).toggleClass('on').toggleClass('off').toggleClass('arrow-up').toggleClass('arrow-down');
				jQuery('#preheader-inner').slideToggle();
			  
			});
		});	
	}	
	
	  
	
	
	
	
	
	/* ----------------------------------------------------------------------------------------- 
	 * Internet Explorer doesn't understand some CSS selectors, so we need some helpful classes
	 * ----------------------------------------------------------------------------------------- 
	 */
	if(jQuery.browser.msie) {
		jQuery('input[type=text]').addClass('input-text');
		jQuery('input[type=password]').addClass('input-password');
		jQuery('input[type=checkbox]').addClass('input-checkbox');
		jQuery('input[type=radio]').addClass('input-radio');
		jQuery('input[type=submit]').addClass('input-submit');
		jQuery('input[type=image]').addClass('input-image');
		jQuery('input[type=file]').addClass('input-file');
	}
	
	   
});


/**
 * Parse HTML and build string representation of a dice slide 
 */
(function( $ ){	
	$.fn.diceXML = function() {
	  
		var xml = new String();
		
		$('.slider', this).each(function(){
			xml += '<div class="' + $(this).attr('class') + '">';
			
			$(this).children('.metadata').each(function(){
				xml += '<div class="' + $(this).attr('class') + '"></div>';
			});
			
			$('.viewport', this).each(function(){
				xml += '<div class="' + $(this).attr('class')  +'">';
				
				$('.slides', this).each(function(){
					xml += '<ul class="' + $(this).attr('class')  +'">';
					
					
					$('li', this).each(function(){							
						xml += '<li>';
							xml += '<div class="slide">';
						
							$('.slide', this).each(function(){
							
								$(this).children('.metadata').each(function(){
									xml += '<div class="' + $(this).attr('class') + '"></div>';
								});
								
								$('.slide-description', this).each(function(){
									xml += '<div class="' + $(this).attr('class')  +'">';
										
										$('h3', this).each(function(){
											xml += '<h3>' + $(this).text()  + '</h3>';
										});	
										$('p', this).each(function(){
											xml += '<p>' + $(this).text()  + '</p>';
										});
									xml += '</div>';
								});	
								
								$('.slide-media', this).each(function(){
									xml += '<div class="' + $(this).attr('class')  +'">';
									
																			
										$('a:has(img)', this).each(function(){
											xml += '<a href="' + $(this).attr('href') + '" '; 
											if($(this).hasClass('new-window'))
												xml += 'class="new-window" '
											xml += ' >';		
											
											$(this).children('img').each(function(){
												xml += '<img src="' + $(this).attr('src') + '" alt="" />';
											});
											
											xml += '</a>';
										});	
										
										$(this).children('img').each(function(){
											xml += '<img src="' + $(this).attr('src') + '" alt="" />'; 
											
										});
										
										
									xml += '</div>';
								});
								
							});
						
							xml += '</div>';
						xml += '</li>';
					});
										
					xml += '</ul>';
				});				
				
				xml += '</div>';
			});
			
			xml += '</div>';
		});

		return xml;
	};	
})( jQuery );
