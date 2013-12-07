(function($)
{

	$.fn.getInputs = function() {

		var $inputs = $(this).find("input, select,textarea");
		var $values = {};

		$($inputs).each(function(index, elem){
			var tag = $(elem).prop("tagName");
			if(tag === "INPUT") {

			}
			else if(tag === "SELECT") {

			}
			else if (tag === "TEXTAREA") {

			}
		});

	}

})(jQuery);