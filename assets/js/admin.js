jQuery(document).ready(function($){
	
	$('.full-view table .actions').on('click', function(e){
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

});