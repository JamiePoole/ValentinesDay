// GO! 
// This ready handler passes the $ alias in to avoid conflict with other libraries.
// ------------------------------------------------------------
jQuery(document).ready(function($) {
		
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
            if(index == 1){
                $('.info-nav, .home-nav, .share-nav').show();
                $('.info-nav, .share-nav').removeClass('fadeOutDown').addClass('fadeInUp');
            }
        },
        afterLoad: function(anchorLink, index){
        	if(index == 1){
            	//$('.info-nav, .share-nav').removeClass('fadeInUp').addClass('fadeOutDown');
         	}
        },
        afterRender: function(){
			
        }
	});

	$('.scroll-btn').click(function(e) {
		e.preventDefault();
		$.fn.fullpage.moveSectionDown();
	});

	// Submit the form
	function processForm(e){ 
		$.ajax({ 
			url: 'post.php', 
			dataType: 'text', 
			type: 'post', 
			contentType: 'application/x-www-form-urlencoded', 
			data: $(this).serialize(), 
			success: function( data, textStatus, jQxhr ){ 
				//$('#response').html( data );
				$('#tweet-target, #tweet-message').val('');
				$('#char-count').text('');
				$('#tweet-message').attr('maxlength', 120);
				$('#thanks').html('Aw, thanks for spreading the love.<br>You just helped us donate £1 to Save the Children.');
				$.fn.fullpage.moveSectionDown();
			}, 
			error: function( jqXhr, textStatus, errorThrown ){ 
				console.log( errorThrown );
			} 
		}); 
		e.preventDefault(); 
	} 
	$('#send-tweet').submit( processForm );

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

});