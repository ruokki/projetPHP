(jQuery)(function($){

	/**
	* Fonction permettant l'affichage des informations complémentaires d'un film au click de l'un d'eux
	* 
	* @return void
	*/
	var tr = document.querySelectorAll("table#film tr");
	var maxTr = tr.length;
	for(var i = 0; i < maxTr; i++) {
		tr[i].addEventListener("click",function(e){
			var td = this.querySelector(".hidden");
			var id = (td) ? td.textContent : "";
			if(id !== "") {
				$("body").append('<div id="modal"></div>');
			}
		});
	}

	/**
	* Fonction récupérant les films correspondant à la recherche
	* Le HTML est généré en PHP (meilleures performances)
	* @return void
	*/
	document.querySelector("#search").addEventListener("click", function(e){
		e.preventDefault();
		var data = {};
		$(document.forms["search"]).find("input:not([type=checkbox],[type=submit]),select,:checked").each(function(index, elem){
			var name = $(elem).attr("name");
			if( name !== undefined) {
				data[name] = $(elem).val();
			}
		});

		$.ajax({
			url: "http://localhost/projetPHP/film/search",
			method: "post",
			data: data,
			success: function(data){
				$("tr:not(#head)").remove();
				$("#film").append(data);
			}
		});
	});

});