jQuery(document).ready(function($){
	
	$('.full-view table .actions a').click(function(e){
		e.preventDefault();
		$.ajax({
			url: $(this).attr('href'),
		}).done(function(){
			$(this).parent('tr').remove();
		});
	});

});