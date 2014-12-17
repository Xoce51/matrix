
"use strict";

jQuery(function($){
	
	// initial var
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
	
	// display matrix size tab
	$choice.on("click", function(e){
		$('.matrix.first').fadeIn();
	});
	
	// Check matrix value and set the array if value are ok
	$(".matrix_value").on("blur", function(e){
		totalNumber++;
		var $dom = $(e.target);
		if ($dom.val() > 0 && $dom.val() <= 6)
		{
			matrixSize[$dom.attr("data-matrix")][$dom.attr("data-matrixType")] = $dom.val();
		}
		else
		{
			$dom.val(1);
			alert('invalid Number please enter a number between 1 and 5');
		}
		
	});

	// Check if matrix number are OK and display the array
	$(document).on("click", "#display_matrix", function(e){
			console.log(matrixSize);
			var $res = $("#res");
			var html = '<table>';
			var i = 0;
			var j = 0;

			// fill first tab...
			for(i; i < matrixSize.a.y; i++)
			{
				html += '<tr>';
				for(j; j < matrixSize.a.x; j++)
				{
					html += '<td><input type="text" placeholder="X" name="a_'+ j +'_' + i + '" /></td>';
				}
				j = 0;
				html += "</tr>";
			}
			html += '</table>';
			$res.find(".first").append(html);
			
			// second array
			html = '<table>';
			for(i = 0; i < matrixSize.b.y; i++)
			{
				html += '<tr>';
				for(j = 0; j < matrixSize.b.x; j++)
				{
					html += '<td><input type="text" placeholder="X" name="b_'+ j +'_' + i + '" /></td>';
				}
				j = 0;
				html += "</tr>";
			}
			$(".matrix.second").fadeIn();
			// display and append html content
			$res.fadeIn().find(".second").append(html);
		});
});