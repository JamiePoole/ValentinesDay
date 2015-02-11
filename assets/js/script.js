// GO! 
// This ready handler passes the $ alias in to avoid conflict with other libraries.
// ------------------------------------------------------------
jQuery(document).ready(function($) {

	// SVG Fallbacks
	if (!Modernizr.svg) {
	    var imgs = document.getElementsByTagName('img');
	    var svgExtension = /.*\.svg$/
	    var l = imgs.length;
	    for(var i = 0; i < l; i++) {
	        if(imgs[i].src.match(svgExtension)) {
	            imgs[i].src = imgs[i].src.slice(0, -3) + 'png';
	            //console.log(imgs[i].src);
	        }
	    }
	}

	$('#fullpage').fullpage({
		//Navigation
        menu: true,
        anchors:['intro', 'send', 'share', 'info'],
        navigation: true,
        navigationPosition: 'right',
		//Scrolling
		css3: true,
		scrollingSpeed: 1000,
        loopBottom: true,
        loopTop: false,
        scrollOverflow: true,
        // Events
        onLeave: function(index, nextIndex, direction){
        	$('.scroll-btn').addClass('fadeOutUp');
        	if(index == 2){
        		
        	}
            if(index == 3){
                
            }
        },
        afterLoad: function(anchorLink, index){
        	$('.scroll-btn').removeClass('fadeOutUp').addClass('fadeInDown');
        	if(index == 2){
            	$('#submit-tweet').removeClass('flyOff fadeOutUp').addClass('animated fadeInDown');
         	}
         	if(index == 3){
         		odometer.innerHTML = '1529';
         	}
        }
	});

	$('.scroll-btn').click(function(e) {
		e.preventDefault();
		$.fn.fullpage.moveSectionDown();
	});


	// SVG Animations
	// ------------------------------------------------------------
	var	s = Snap('#birds');

	s.attr({ viewBox: "0 0 1600 890" }); // Need this for responsive svg - its the aspect ratio

	Snap.load('assets/img/intro-birds.svg', function ( loadedBirds ) {

		s.append( loadedBirds );

		// Timings
		var tHead 		= 500,
			tWing  		= 1000,
			tHeart 		= 500;

		// Elements
		var LoveHeart 	= s.select('#LoveHeart'),
			LeftHead 	= s.select('#LeftHead'),
			RightHead 	= s.select('#RightHead'),
			LeftEye 	= s.select('#LeftEye'),
			RightEye 	= s.select('#RightEye'),
			LeftBody 	= s.select('#LeftBody'),
			RightBody 	= s.select('#RightBody'),
			LeftWing	= s.select('#LeftWing'),
			RightWing 	= s.select('#RightWing');

		// LeftHead.animate({
		// 	transform: 't0,150'
		// }, tHead, mina.ease );

	});

	
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
					$('#thanks').html('Aw, thanks for spreading the love.<br>You just helped us donate £1 to Save the Children. See your tweet <a href="https://twitter.com/mytweetercrush" target="_blank">here</a>');
					$.fn.fullpage.moveSectionDown();
					ga('send', 'event', 'Form', 'Submit', 'send-tweet');
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
    });

    // Twitter share


    // Google+ share


    // Google Analytics Events
	// ------------------------------------------------------------

	// Send tweet button
    $('#submit-tweet').on('click', function() {
  		ga('send', 'event', 'button', 'click', 'Form Submit');
	});

});