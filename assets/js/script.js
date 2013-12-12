(jQuery)(function($){
	$("#submit").click(function(e){

		e.preventDefault();

		var data = {};
		$("input:not([type=submit],[type=checkbox]),:checked,select").each(function(index, elem){
			if($(elem).attr("name") !== undefined){
				data[$(elem).attr("name")] = $(elem).val();
			}
		});

		$.ajax({
			url: "film/search",
			method: "post",
			data: data,
			success: function(data){
				console.log(data);
			}
		});

	});
});