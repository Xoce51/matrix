/**
 * @author Aubin Gerard
 */
"use strict";

jQuery(function($){
	
	// global var
	var $prep 	= $("#prep");
	var $res 		= $("#res");
	var size 		= 2;
	
	
	// event
	$("#display_matrix_gauss").on('click', function(e){
		e.preventDefault();
		var i, j;
		var html = '<table><tr>';
		size = $(e.currentTarget).prev().val();
		
		$prep.find("table").remove();
		
		// generate matrix A
		for (i = 1; i <= size; i++)
		{
			for (j = 1; j <= size; j++)
			{
				html += '<td><input type="text" class="matrixData-first" placeholder="X" name="a_' + i + '_' + j + '" />';
			}
			j = 1;
			html += '</tr>';
		}
		html += '</table>';
		$prep.find(".first").append(html);
		
		// Generate Matrix B
		html = '<table>';
		for (i = 1; i <= size; i++)
			html += '<tr><td><input type="text" class="matrixData-second" name=="Y_' + i + '" placeholder="X" />';
		$prep.find(".second").append(html);
		
		// display form !!
		$prep.fadeIn();
		$(".matrix.second").fadeIn();
	});
	
	// prepare data and send it
	$(".matrix.second").on('click', function(e){
		e.preventDefault();
		
		var dataSend = {
				0 : {
					x : size,
					y: size,
					values : Array()
				},
				1 : {
					x : size,
					y : 1,
					values: Array()
				}
		};
		var i;
		var $dataDom = $(".matrixData-first");
		
		$dataDom.each(function(el)
		{
			dataSend[0].values.push($(this).val());
		});
		
		$dataDom = $(".matrixData-second");
		$dataDom.each(function(el)
		{
			dataSend[1].values.push($(this).val());
		});
		
		var d = {
			"calcul" : "gauss",
			"matrix" : dataSend
		};
		
		var $req = $.ajax({
			url : 'main.php',
			type : 'POST',
			dataType : 'json',
			data : d
		}).done(function(msg) {
			console.log(msg)
		}).fail(function(jqXHR, textStatus) {
			console.log(textStatus);
			console.log(jqXHR);
		});
			
	});
});
