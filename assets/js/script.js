// GO! 
// This ready handler passes the $ alias in to avoid conflict with other libraries.
// ------------------------------------------------------------
jQuery(document).ready(function($) {

	// SVG Fallbacks
	if (!Modernizr.svg) {
		// Replace <img> with an .svg set as src
	    var imgs = document.getElementsByTagName('img');
	    var svgExtension = /.*\.svg$/
	    var l = imgs.length;
	    for(var i = 0; i < l; i++) {
	        if(imgs[i].src.match(svgExtension)) {
	            imgs[i].src = imgs[i].src.slice(0, -3) + 'png';
	            //console.log(imgs[i].src);
	        }
	    }
	    // Replace the intro bird animation
	    $('.intro-page .artwork #birds').hide();
	    $('.intro-page .artwork').html("<img src='assets/img/intro-birds.png'>");
	}

	$('#fullpage').fullpage({
		//Navigation
        menu: true,
        anchors:['intro', 'send', 'share'],
        navigation: true,        navigationPosition: 'right',
		//Scrolling
		css3: true,
		scrollingSpeed: 1000,
        loopBottom: true,
        loopTop: false,
        scrollOverflow: false,
        // Events
        onLeave: function(index, nextIndex, direction){
        	$('.scroll-btn').addClass('fadeOutUp');
        	if (index == 1) {
        		//resetIntroBirdAnim();
        	}
        },
        afterLoad: function(anchorLink, index){
        	$('.scroll-btn').removeClass('fadeOutUp').addClass('fadeInDown');
        	if (index == 1) {
        		introBirdAnim();
        	}
        	if (index == 2) {
        		ga('send', 'event', 'Virtual page view', 'Scroll', 'Send');
            	$('#submit-tweet').removeClass('flyOff fadeOutUp').addClass('animated fadeInDown');
         	}
         	if (index == 3) {
         		ga('send', 'event', 'Virtual page view', 'Scroll', 'Share');
         	}
        }
	});

	$('.scroll-btn').click(function(e) {
		e.preventDefault();
		$.fn.fullpage.moveSectionDown();
	});


	// SVG Animations
	// ------------------------------------------------------------

	// Set the stage
	var	s = Snap('#birds');
	s.attr({ viewBox: "0 0 1600 890" }); // Need this for responsive svg - its the aspect ratio
	Snap.load('assets/img/intro-birds.svg', function (loadedBirds) {
		// Place the SVG on the page
		g = loadedBirds.select('g');
		s.append(g);
		// Play the intro bird animation
		introBirdAnim();
	});

	// Intro bird animation
	function introBirdAnim() {
		// Elements
		var loveHeart 		= s.select('#LoveHeart'),
			leftHead 		= s.select('#LeftHead'),
			rightHead 		= s.select('#RightHead'),
			leftBeak 		= s.select('#LeftBeak'),
			rightBeak 		= s.select('#RightBeak'),
			leftBeakShadow 	= s.select('#LeftBeakShadow'),
			rightBeakShadow = s.select('#RightBeakShadow'),
			leftEye 		= s.select('#LeftEye'),
			rightEye 		= s.select('#RightEye'),
			leftBody 		= s.select('#LeftBody'),
			rightBody 		= s.select('#RightBody'),
			leftWing		= s.select('#LeftWing'),
			rightWing 		= s.select('#RightWing'),
			leftWingShadow	= s.select('#LeftWingShadow'),
			rightWingShadow = s.select('#RightWingShadow');

		// Groups
		var leftHeadGroup	= s.group(leftHead, leftBeak, leftBeakShadow, leftEye),
			rightHeadGroup 	= s.group(rightHead, rightBeak, rightBeakShadow, rightEye),
			leftWingGroup	= s.group(leftWingShadow, leftWing),
			rightWingGroup 	= s.group(rightWingShadow, rightWing),
			leftBirdGroup 	= s.group(leftBody, leftHeadGroup, leftWingGroup),
			rightBirdGroup 	= s.group(rightBody, rightHeadGroup, rightWingGroup);

		// Animations
		var headAnim = [
			{ animation: { transform: 't0,12' }, dur: 120, ease: mina.easeout },
            { animation: { transform: 't0,0' }, dur: 120, ease: mina.easeout }
        ];

        var leftWingAnim = [
			{ animation: { transform: 'r7,531,233' }, dur: 60, ease: mina.easeout },
            { animation: { transform: 'r0,531,233' }, dur: 60, ease: mina.easeout },
            { animation: { transform: 'r7,531,233' }, dur: 60, ease: mina.easeout },
            { animation: { transform: 'r0,531,233' }, dur: 60, ease: mina.easeout }
        ];

        var rightWingAnim = [
			{ animation: { transform: 'r-7,1071,235' }, dur: 60, ease: mina.easeout },
            { animation: { transform: 'r0,1071,235' }, dur: 60, ease: mina.easeout },
            { animation: { transform: 'r-7,1071,235' }, dur: 60, ease: mina.easeout },
            { animation: { transform: 'r0,1071,235' }, dur: 60, ease: mina.easeout }
        ];

        var leftBirdTiltAnim = [
			{ animation: { transform: 't25,10r10,383,292' }, dur: 75, ease: mina.easeout },
			{ animation: { transform: 't25,10r10,383,292' }, dur: 250, ease: mina.easeout },
            { animation: { transform: 't0,0r0,383,292' }, dur: 25, ease: mina.easeout }
        ];

        var rightBirdTiltAnim = [
			{ animation: { transform: 't-25,10r-10,1218,292' }, dur: 75, ease: mina.easeout },
			{ animation: { transform: 't-25,10r-10,1218,292' }, dur: 250, ease: mina.easeout },
            { animation: { transform: 't0,0r0,1218,292' }, dur: 25, ease: mina.easeout }
        ];

        var loveHeartAnim = [
			{ animation: { opacity: '0', transform: 's0,800,64' }, dur: 0, ease: mina.easeout },
			{ animation: { opacity: '1', transform: 's0.9,800,64' }, dur: 150, ease: mina.easeout },
			{ animation: { opacity: '1', transform: 's0.9,800,64' }, dur: 200, ease: mina.easeout },
			{ animation: { transform: 's1,800,64' }, dur: 100, ease: mina.easeout },
			{ animation: { transform: 's0.9,800,64' }, dur: 100, ease: mina.easeout }
        ];

        // Playu the animation frames
        function playFrames(el, frameArray, whichFrame) {
        	if( whichFrame >= frameArray.length ) { return }
        	el.animate( frameArray[ whichFrame ].animation, frameArray[ whichFrame ].dur, frameArray[ whichFrame ].ease, playFrames.bind( null, el, frameArray, whichFrame + 1 ) );
    	}

    	// Chain the animations
		var initAnim = function() {
			playFrames(leftHeadGroup, headAnim, 0); 				// 240 
			playFrames(leftWing, leftWingAnim, 0); 					// 240
			window.setTimeout(function() {							// 300 Timeout
		    	playFrames(rightHeadGroup, headAnim, 0); 			// 240
				playFrames(rightWing, rightWingAnim, 0);			// 240
			}, 300);												// TOTAL 1260
			window.setTimeout(function() {							// 1260 Timeout					
		    	playFrames(leftBirdGroup, leftBirdTiltAnim, 0);		// 350
				playFrames(rightBirdGroup, rightBirdTiltAnim, 0);
			}, 1260);												// TOTAL 1610
			window.setTimeout(function() { 							
		    	playFrames(loveHeart, loveHeartAnim, 0);
			}, 1610);
		}

		// Set the animation off just after page load
		window.setTimeout(initAnim, 1000);
	}

	// Reset the intro bird animation
	// function resetIntroBirdAnim() {
	// 	var $loveHeart = s.select('#LoveHeart');
	// 	$loveHeart.attr({ opacity: 0 });
	// }

	
	// Send Tweet Form
	// ------------------------------------------------------------

	// Process the form
	function processForm(e){ 
		$.ajax({ 
			url: 'post.php', 
			dataType: 'text', 
			type: 'post', 
			contentType: 'application/x-www-form-urlencoded', 
			data: $(this).serialize(), 
			success: function( data, textStatus, jQxhr ){ 
				console.log(data);
				var json = $.parseJSON(data);
				if (typeof(json.error) != "undefined") {
					$('#response').html( json.error.message );
				} else {
					$('#response').html( json.tweet.status );
					$('#submit-tweet').removeClass('animated fadeInDown').addClass('flyOff');
					$('#tweet-target, #tweet-message').val('');
					$('#char-count').text('');
					$('#tweet-message').attr('maxlength', 120);
					$('#thanks').html('Aw, thanks');
					$('#thanks-sub').html('Thanks for spreading the love. See your tweet <a href="https://twitter.com/mytweetercrush" target="_blank">here</a>');
					$.fn.fullpage.moveSectionDown();
					ga('send', 'event', 'Forms', 'Submit', 'Send Tweet');
				}
			}, 
			error: function( jqXhr, textStatus, errorThrown ){ 
				console.error( jqXhr );
				console.error( textStatus );
				console.log( errorThrown );
				$('#response').html( errorThrown );
			}
		}); 
		e.preventDefault(); 
	} 

	$('#send-tweet').submit(processForm);

	// Tweet character countdown	
	$('#tweet-target').on('keyup', function(event){
		var len = $(this).val().length;
		$('#tweet-message').attr('maxlength', 139-len);
	});
    $('#tweet-message').on('keyup', function(event){
    	var max = $(this).attr('maxlength');
    	var len = $(this).val().length;
  		if (len >= max) {
    		$('#char-count').text("You've have reached the character limit!");
  		} else {
    		var characters = max - len;
    		$('#char-count').text(characters + ' characters left');
  		}
    });


    // Social Share Buttons
	// ------------------------------------------------------------

	// Facebook share
    $('.fb-btn').on('click', function(e) {
    	e.preventDefault();
    	FB.ui({
			method: 'share',
		  	href: 'http://www.mytwittercrush.com',
		}, function(response){});
		ga('send', 'event', 'Social', 'Click', 'Facebook');
    });

    // Twitter share
    $('.tw-btn').on('click', function(e) {
    	ga('send', 'event', 'Social', 'Click', 'Twitter');
    });

    // Google+ share
    $('.gp-btn').on('click', function(e) {
    	ga('send', 'event', 'Social', 'Click', 'Google +');
    });

});