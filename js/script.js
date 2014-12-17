
"use strict";

jQuery(function($){
	var $choice = $("input[name=choice]");
	
	$choice.on("click", function(e){
		$('.matrix.first').fadeIn();
	});
	console.log($choice);
});