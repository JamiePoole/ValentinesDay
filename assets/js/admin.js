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

	function getUrlParameter(sParam){
		var sPageURL = window.location.search.substring(1);
		var sURLVariables = sPageURL.split('&');
		for(var i = 0; i < sURLVariables.length; i++){
			var sParameterName = sURLVariables[i].split('=');
			if(sParameterName[0] == sParam){
				return sParameterName[1];
			}
		}
	}

	if(getURLParameter('page') == 'dash' || getURLParameter('page') == 'queue' || typeof getURLParameter('page') != 'undefined'){
		var refreshTime = 5000;
		refresh = setInterval(function(){
			var loc = window.location;
			$.ajax({
				url: loc,
				success: function(response){
					var fullView = $(response).find('#main-section');
					$('#main-section').replaceWith(fullView);
				},
			});
		}, refreshTime);
	}

});