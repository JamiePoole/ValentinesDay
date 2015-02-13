jQuery(document).ready(function($){
	
	$('.full-view table .actions').click(function(e){
		e.preventDefault();
		$.ajax({
			url: $(this).attr('href'),
		}).done(function(){
			$(this).animate({background: 'red'}, 'slow', function(){
				$(this).remove();
			});
		});
	});

});