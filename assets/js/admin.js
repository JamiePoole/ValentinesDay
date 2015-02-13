jQuery(document).ready(function($){
	
	$('.full-view table .actions a').on('click', function(e){
		e.preventDefault();
		var tag = $(this);
		$.ajax({
			url: tag.attr('href'),
			success: function(){
				$(tag).animate({backgroundColor: ''})
				$(tag).closest('tr').fadeOut(400, function(){
					$(this).remove();
				});
			},
		});
	});

	var refreshTime = 1000;
	refresh = setInterval(function(){
		var loc = window.location.pathname;
		$.ajax({
			url: loc,
			success: function(data){
				var fullView = data.find('.full-view');
				$('.full-view').replace(fullView);
			},
		});
	}, refreshTime);

});