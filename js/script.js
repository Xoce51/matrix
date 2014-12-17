
"use strict";

jQuery(function($){
	var $choice = $("input[name=choice]");
	var totalNumber = 0;
	var matrixSize = {
		a: {
			x: 1,
			y: 1
		},
		b: {
			x: 1,
			y: 1
		}
	};
	
	$choice.on("click", function(e){
		$('.matrix.first').fadeIn();
	});
	
	$(".matrix_value").on("blur", function(e){
		totalNumber++;
		var $dom = $(e.target);
		if ($dom.val() > 0 && $dom.val() <= 6)
		{
			matrixSize.push($dom.val());
		}
		else
		{
			$dom.val(1);
			alert('invalid Number please enter a number between 1 and 5');
		}
		
		console.log(matrixSize);
		
		console.log($dom.val());
	});
	
});