jQuery(document).ready(function($){
	
	$('.full-view table .actions a').on('click', function(e){
		e.preventDefault();
		$.ajax({
			url: $(this).attr('href'),
			success: function(){
				console.log($(this));
				$(this).closest('tr').remove();
			},
		});
	});

});