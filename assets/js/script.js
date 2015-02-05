// GO! 
// This ready handler passes the $ alias in to avoid conflict with other libraries.
// ------------------------------------------------------------
jQuery(document).ready(function($) {

	$('.info-nav, .home-nav, .share-nav').hide();
		
	$('#fullpage').fullpage({
		//Navigation
        menu: true,
        anchors:['intro', 'send', 'share', 'info'],
        navigation: true,
        navigationPosition: 'right',
        //navigationTooltips: ['intro', 'send', 'share', 'info'],
		//Scrolling
		css3: true,
		scrollingSpeed: 1000,
        loopBottom: false,
        loopTop: false,
        scrollOverflow: true,
        // Design
        fixedElements: '.info-nav, .home-nav, .share-nav',
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
			$('#send-tweet').idealforms({
				iconHtml: false
			});
        }
	});

	$('.prev').click(function(){
      	$('.prev').show();
      	$('#send-tweet').idealforms('prevStep');
    });

    $('.next').click(function(){
      	$('.next').show();
      	$('#send-tweet').idealforms('nextStep');
    });

});