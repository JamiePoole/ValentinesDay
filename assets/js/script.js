// GO! 
// This ready handler passes the $ alias in to avoid conflict with other libraries.
// ------------------------------------------------------------
jQuery(document).ready(function($) {
	
	$('.heading').fitText(0.9);
	$('.fit-text').fitText(2);
	
	$('.nav-btn').hide();

	$('#fullpage').fullpage({
		//Navigation
        menu: true,
        anchors:['intro', 'what', 'send', 'info'],
        navigation: false,
        navigationPosition: 'right',
        navigationTooltips: ['intro', 'what', 'send', 'info'],
		//Scrolling
        loopBottom: false,
        loopTop: false,
        // Design
        fixedElements: '.info-nav, .home-nav, .share-nav',
        // Events
        afterLoad: function(anchorLink, index){
        	if(index == 3){
            	$('.home-nav').removeClass('fadeOutUp').addClass('fadeInDown').show();
            	$('.info-nav, .share-nav').removeClass('fadeOutDown').addClass('fadeInUp').show();
            }
            if(index == 1 || index == 2){
            	$('.home-nav').removeClass('fadeInDown').addClass('fadeOutUp');
            	$('.info-nav, .share-nav').removeClass('fadeInUp').addClass('fadeOutDown');
            }
        }
	});

	$('.intro-page, .what-page').click(function(e) {
		$.fn.fullpage.moveSectionDown();
	});

	$('.step-2').addClass('inactive');
	$('.step-1 .next-step').click(function(e){
		e.preventDefault();
		$('.step-1').removeClass('active').addClass('inactive');
		$('.step-2').removeClass('inactive').addClass('active');
	});
	$('.step-2 .prev-step').click(function(e){
		e.preventDefault();
		$('.step-2').removeClass('active').addClass('inactive');
		$('.step-1').removeClass('inactive').addClass('active');
	});

});