(jQuery)(function($){

	$("#inputNameReal").autocomplete({
		source: function(request, response) {
			var search = request.term,
				XHR = new XMLHttpRequest(),
				data = new FormData();
			$.ajax({
				url: "film/getReal",
				method: "post",
				dataType: "json",
				data: {
					term: search
				},
				success: function(data) {
					if(data !== "") {
						response($.map(data, function(item){
							return {
								label : data.nom,
								value : data.nom
							};
						}));
					}
				}
			})

		}
	});

	document.querySelector("#search").addEventListener("click", function(e){

		e.preventDefault();

		var data = {};
		console.log(document.forms["search"].elements);
		
		// $.ajax({
		// 	url: "film/search",
		// 	method: "post",
		// 	data: data,
		// 	success: function(data){
		// 		$("tr:not(#head)").remove();
		// 		$("#film").append(data);
		// 	}
		// });

	});
});