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
			var thos = this;
			var td = this.querySelector(".hidden");
			var originalTitle = this.querySelector(":nth-child(2)").innerHTML;
			var frenchTitle = this.querySelector(":nth-child(3)").innerHTML;
			var id = (td) ? td.textContent : "";
			if(id !== "") {
				$("#titreFilm").text(frenchTitle);
				$.ajax({
					url: "http://localhost/projetPHP/film/infoFilm",
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
		});
	}

	// $("table#film tr").popover({
	// 	title: function() {
	// 		return this.querySelector("td:nth-child(3)").innerHTML;
	// 	},
	// 	placement: "auto",
	// 	html: true,
	// 	content: function() {
	// 		var id = this.querySelector(".hidden").innerHTML;
	// 		var title = this.querySelector("td:nth-child(2)").innerHTML;
	// 		var thos = this;

	// 		$.ajax({
	// 			url: "http://localhost/projetPHP/film/infoFilm",
	// 			method: "post",
	// 			data: {
	// 				id: id
	// 			},
	// 			success: function(data) {
	// 				$(thos).next(".popover").find('.popover-content').html(data);
	// 			}
	// 		});

	// 		$.ajax({
	// 			url:"http://www.imdbapi.com/",
	// 			method: "get",
	// 			dataType: "JSON",
	// 			data: {
	// 				i: "",
	// 				t: title.toLowerCase()
	// 			},
	// 			success: function(data) {
	// 				$(thos).next(".popover").find('.popover-content img').attr("src",data.Poster);
	// 			}
	// 		});
	// 	}
	// });

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