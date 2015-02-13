jQuery(document).ready(function($){
	
	$('.full-view table .actions a').on('click', function(e){
		e.preventDefault();
		var tag = $(this);
		$.ajax({
			url: tag.attr('href'),
			success: function(){
				console.log($(tag));
				$(tag).closest('tr').remove();
			},
		});
	});

});