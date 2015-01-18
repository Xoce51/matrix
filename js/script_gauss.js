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
			var gaussSize = Object.keys(msg['G']).length;
			var html = '<table align="center">';
			var $res = $("#resCalc");
			
			// get Gauss matrix by step
			for (var i = 1; i <= gaussSize; i++)
			{
				html += '<tr><td colspan="' + msg['G'][i]['cols'] + '">Matrice G <sup>(' + i + ')</sup></td></tr>';
				for (var j = 0; j < msg['G'][i]['rows']; j++)
				{
					html += '<tr>';
					for (var k = 0; k < msg['G'][i]['cols']; k++)
					{
						html += "<td>" + msg['G'][i]['arr'][j][k] + "</td>"; 
					}
					html += "</tr>";
				}
			}
			
			// get Original matrix transformation by step
			for (var i = 1; i <= gaussSize; i++)
			{
				html += '<tr><td colspan="' + msg['A'][i]['cols'] + '">Matrice A <sup>(' + i + ')</sup></td></tr>';
				for (var j = 0; j < msg['A'][i]['rows']; j++)
				{
					html += '<tr>';
					for (var k = 0; k < msg['A'][i]['cols']; k++)
					{
						html += '<td>' + msg['A'][i]['arr'][j][k] + '</td>'; 
					}
					html += "</tr>";
				}
			}
			
			// get Y matrix transformation by step
			for (var i = 1; i <= gaussSize; i++)
			{
				html += '<tr><td colspan="' + msg['A'][i]['cols'] + '">Matrice Y <sup>(' + i + ')</sup></td></tr>';
				for (var j = 0; j < msg['Y'][i]['rows']; j++)
				{
					html += '<tr>';
					for (var k = 0; k < msg['Y'][i]['cols']; k++)
					{
						html += '<td colspan="' + msg['A'][i]['cols'] + '">' + msg['Y'][i]['arr'][j][k] + '</td>'; 
					}
					html += "</tr>";
				}
			}
			html += '</table>';
			
			// display result
			$res.html(html);
		}).fail(function(jqXHR, textStatus) {
			console.log(textStatus);
			console.log(jqXHR);
		});
			
	});
});
