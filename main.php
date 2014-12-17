<?php
	header('Content-type:application/json');
	include 'matrix.php';
	/*
	$_POST = array(
	  "calcul" => "somme",
	  "matrix" => array(
	  	array(
	  		"x" => 3,
	  		"y" => 2,
	  		"values" => array(1, 2, 3, 3, 2, 17)
	  	),
	  	array(
	  		"x" => 3,
	  		"y" => 2,
	  		"values" => array(1, 2, 3, 3, 2, 17)
	  	)
	  )
	 );
	*/
	$calcul = $_POST['calcul'];
	$mat = array();
	
	if ($calcul && !empty($_POST['matrix']))
	{
		
		$matrix = $_POST['matrix'];

		# Matrix instantiation
		foreach($matrix as $m)
			$mat[] = new Matrix($m['x'], $m['y']);

		# now populate 1 by 1
			# matrix 1
		$max["x"] = $mat[0]->getSize();
		$max["y"] = $mat[0]->getSize("cols");
		$x = 0;
		$y = 0;
		$i = 0;
		
		while($max['y'] > $y)
		{
			$mat[0]->setElem($x, $y, $matrix[0]['values'][$i]);
			$x++;
			if ($x == $max['x'])
			{
				$x = 0;
				$y++;
			}
			$i++;
		}
		
		if ($mat[1])
		{
				# matrix 2
			$max["x"] = $mat[1]->getSize();
			$max["y"] = $mat[1]->getSize("cols");
			$x = 0;
			$y = 0;
			$i = 0;
			
			while($max['y'] > $y)
			{
				$mat[1]->setElem($x, $y, $matrix[1]['values'][$i]);
				$x++;
				if ($x == $max['x'])
				{
					$x = 0;
					$y++;
				}
				$i++;
			}
		}

		// made calcul
		if ($calcul == "somme")
			die(json_encode($mat[0]->add($mat[1])));
		else if ($calcul == "produit")
			die(json_encode($mat[0]->multiply($mat[1])));
		else if ($calcul == 'transposé')
			die(json_encode($mat[0]->transpose()));
		else if ($calcul == 'trace')
			die(json_encode($mat[0]->trace()));
		else 
			die(json_encode(array('Unknown action try again')));
		
	}
	echo json_encode(array('No calcul method send'));
	/*
	 * Structure des POST matrix
	 * array(
	 * "calcul" => "somme"
	 * "matrix" =>array(
	 * 	[0] => array(
	 * 		"x" => 3,
	 * 		"y" => 2,
	 * 		"values" => array(1, 2, 3, 3, 2, 17)
	 * 	)
	 * 	[1] => array(
	 * 		"x" => 2,
	 * 		"y" => 4,
	 * 		"values" => array(3, 4, 3, 4, 3, 4, 3, 4)
	 * 	)
	 * )
	 * )
	 * 
	 * 
	 */
?>