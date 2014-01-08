(jQuery)(function($){

	var cookies = document.cookie;
	var url = decodeURIComponent(cookies.split("=")[1]);

	/**
	* Fonction permettant l'affichage des informations complémentaires d'un film au click de l'un d'eux
	* 
	* @return void
	*/
	var tr = document.querySelectorAll("table#film tr");
	var maxTr = tr.length;
	for(var i = 0; i < maxTr; i++) {
		tr[i].addEventListener("click",clickFilm);
	}

	function clickFilm(e){
		var thos = this;
		var td = this.querySelector(".hidden");
		var originalTitle = this.querySelector(":nth-child(2)").innerHTML;
		var frenchTitle = this.querySelector(":nth-child(3)").innerHTML;
		var id = (td) ? td.textContent : "";
		if(id !== "") {
			$("#titreFilm").text(frenchTitle);
			$.ajax({
				url: url + "film/infoFilm",
				method: "post",
				data: {
					id: id
				},
				success: function(data) {
					$("#filmInfo").find(".modal-body").html(data);
				}
			});

			$.ajax({
				url:"http://www.imdbapi.com/",
				method: "get",
				dataType: "JSON",
				data: {
					i: "",
					t: originalTitle.toLowerCase()
				},
				success: function(data) {
					$("#filmInfo").find('.modal-body img').attr("src",data.Poster);
					$("#filmInfo").modal("show");
				}
			});
		}
		else {
			console.log("La variable id est vide");
		}
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
			url: url + "film/search",
			method: "post",
			data: data,
			success: function(data){
				$("tr:not(#head)").remove();
				$("#film").append(data);
				var tr = document.querySelectorAll("table#film tr");
				var maxTr = tr.length;
				for(var i = 0; i < maxTr; i++) {
					tr[i].addEventListener("click",clickFilm);
				}
			}
		});
	});

});