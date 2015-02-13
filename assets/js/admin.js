jQuery(document).ready(function($){
	
	$('.full-view table .actions a').on('click', function(e){
		e.preventDefault();
		$.ajax({
			url: $(this).attr('href'),
			success: function(){
				alert('CLICKED!');
				$(this).closest('tr').remove();
			},
		});
	});

});