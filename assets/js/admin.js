jQuery(document).ready(function($){
	
	$('.full-view table .actions a').on('click', function(e){
		e.preventDefault();
		var this = $(this);
		$.ajax({
			url: this.attr('href'),
			success: function(this)){
				console.log(this);
				this.closest('tr').remove();
			},
		});
	});

});