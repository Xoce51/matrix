
"use strict";

jQuery(function($){
	
	// initial var
	var $choice = $("input[name=choice]");
	var totalNumber = 0;
	var mod = '';
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
		mod = $(this).val();
		$('.matrix.first').fadeIn();
	});
	
	// Check matrix value and set the array if value are ok
	$(".matrix_value").on("blur", function(e){
		totalNumber++;
		var $dom = $(e.target);
		if ($dom.val() > 0 && $dom.val() < 6)
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
			var $res = $("#res");
			var html = '<table>';
			var i = 1;
			var j = 1;

			// fill first tab...
			for(i; i <= matrixSize.a.x; i++)
			{
				html += '<tr>';
				for(j; j <= matrixSize.a.y; j++)
				{
					html += '<td><input type="text" class="matrixData-first" placeholder="X" name="a_'+ i +'_' + j + '" /></td>';
				}
				j = 1;
				html += "</tr>";
			}
			html += '</table>';
			$res.find(".first").append(html);
			
			// second array
			html = '<table>';
			for(i = 1; i <= matrixSize.b.x; i++)
			{
				html += '<tr>';
				for(j = 1; j <= matrixSize.b.y; j++)
				{
					html += '<td><input type="text" class="matrixData-second" placeholder="X" name="b_'+ i +'_' + j + '" /></td>';
				}
				j = 1;
				html += "</tr>";
			}
			$(".matrix.second").fadeIn();
			// display and append html content
			$res.fadeIn().find(".second").append(html);
		});
		
		// send data with ajax
		$(document).on("click", "#calc", function(e){
			var dataSend = {
				0: {
					x: 1,
					y: 1,
					values: Array()
				},
				1: {
					x: 1,
					y: 1,
					values: Array()
				}
			};
			
			// fill the data for matrix 1 & 2
			var $dataDom = $(".matrixData-first");
			dataSend[0].x = matrixSize.a.x;
			dataSend[0].y = matrixSize.a.y;
			$dataDom.each(function(el){
				dataSend[0].values.push($(this).val());
			});

			var $dataDom = $(".matrixData-second");
			dataSend[1].x = matrixSize.b.x;
			dataSend[1].y = matrixSize.b.y;
			$dataDom.each(function(el){
				dataSend[1].values.push($(this).val());
			});
			
			// finally send data to php
			var d = {
				"calcul": mod,
				"matrix": dataSend
			};
			var $req = $.ajax({
				url: 'main.php',
				type: 'POST',
				dataType: 'json',
				data: d
			}).done(function(msg){
				console.log(msg);
			}).fail(function(jqXHR, textStatus){
				console.log(textStatus);
				console.log(jqXHR);
			});
		});
});