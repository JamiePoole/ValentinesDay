// GO! 
// This ready handler passes the $ alias in to avoid conflict with other libraries.
// ------------------------------------------------------------
jQuery(document).ready(function($) {
	
	// Default fit text setting
	$('.fit-text').fitText(2);

	$('.heading.fit-text').fitText(0.9).height( $('.heading.fit-text .fallback').height() );
	$('.heading.fit-text .fallback').hide();

	// Type it out effect
	// http://codepen.io/voronianski/pen/aicwk
    // text {String} - printing text
 	// n {Number} - from what letter to start
 	// tweet your twitter crush anonymously
	function typeWriter(text, n) {
	  if (n < (text.length)) {
	    $('.test').html(text.substring(0, n+1));
	    n++;
	    setTimeout(function() {
	      typeWriter(text, n)
	    }, 100);
	  }
	}
	$('.start').click(function(e) {
	  e.stopPropagation();
	  var text = $('.test').data('text');
	  typeWriter(text, 0);
	});

	$('#fullpage').fullpage({
		//Navigation
        menu: true,
        anchors:['intro', 'send', 'share', 'info'],
        navigation: true,
        navigationPosition: 'right',
        navigationTooltips: ['intro', 'send', 'share', 'info'],
		//Scrolling
        loopBottom: false,
        loopTop: false,
        // Design
        fixedElements: '.info-nav, .home-nav, .share-nav',
        // Events
        // afterLoad: function(anchorLink, index){
        // 	// if(index == 1){
            	
        //  	//}
        //     // if(index == 1 || index == 2){
        //     // 	$('.home-nav').removeClass('fadeInDown').addClass('fadeOutUp');
        //     // 	$('.info-nav, .share-nav').removeClass('fadeInUp').addClass('fadeOutDown');
        //     // }
        // }
	});

	// $('.intro-page').click(function(e) {
	// 	$.fn.fullpage.moveSectionDown();
	// });

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

	$('.intro-page .heading').hover(
		function() {
    		$('.intro-page').addClass('heart')
	  	}, function() {
	    	$('.intro-page').removeClass('heart')
	  	}
	);

});