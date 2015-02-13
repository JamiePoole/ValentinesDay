jQuery(document).ready(function($){
	
	$('.full-view table .actions a').click(function(e){
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