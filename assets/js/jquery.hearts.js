(function($){
	$.fn.hearts = function(options){
		var	$heart = $('<div id="heart" />').css({'display': 'block', 'position': 'absolute', 'top': '-25px'}).html('&#10084;'),
			defaults = {
				boxTarget	: '#intro',
				minSize		: 10,
				maxSize		: 20,
				intMs		: 500,
				heartColour	: "#FFCC00"
			},
			options = $.extend({}, defaults, options);
		var	boxHeight = $(options.boxTarget).height(),
			boxWidth = $(options.boxTarget).width();
		var interval = setInterval(function(){
			var startPositionLeft = Math.random() * boxWidth - 100,
				startOpacity = 0.5 + Math.random(),
				sizeHeart = options.minSize + Math.random() * options.maxSize,
				endPositionTop = boxHeight + 40,
				endPositionLeft = startPositionLeft - 100 + Math.random() * 200,
				durationFall = boxHeight * 10 + Math.random() * 5000;
			$heart
				.clone()
				.appendTo(options.boxTarget)
				.css({
					left: startPositionLeft,
					opacity: startOpacity,
					'font-size': sizeHeart,
					color: options.heartColour
				})
				.animate(
					{
						top: endPositionTop,
						left: endPositionLeft,
						opacity: 0.2
					},
					durationFall,
					'linear',
					function(){
						$(this).remove();
					}
				);
		}, options.intMs);
	}
})(jQuery);