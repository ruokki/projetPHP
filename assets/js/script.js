(jQuery)(function($){
	$('#submit').click(function(e){
		e.preventDefault();
		$('form').getInputs();

		// $.ajax({
		// 	url: 'film/search',
		// 	method: 'post',
		// 	data: data,
		// 	success: function(data){
		// 	}
		// })
	})
});