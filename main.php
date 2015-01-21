<?php
	include 'matrix.php';
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
		
		while($max['x'] > $x)
		{
			$mat[0]->setElem($x, $y, $matrix[0]['values'][$i]);
			$y++;
			if ($y == $max['y'])
			{
				$y = 0;
				$x++;
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
			while($max['x'] > $x)
			{
				$mat[1]->setElem($x, $y, $matrix[1]['values'][$i]);
				$y++;
				if ($y == $max['y'])
				{
					$y = 0;
					$x++;
				}
				$i++;
			}
		}
		// made calcul
		if ($calcul == "somme")
			die(json_encode($mat[0]->add($mat[1])));
		else if ($calcul == "produit")
			die(json_encode($mat[0]->multiply($mat[1])));
		else if ($calcul == 'transposee')
			die(json_encode($mat[0]->transpose()));
		else if ($calcul == 'trace')
			die(json_encode($mat[0]->trace()));
		else if($calcul == 'gauss')
			die(json_encode($mat[0]->gauss($mat[1])));
		else 
			die(json_encode(array('Unknown action try again')));
		
	}
	echo json_encode(array('No calcul method send'));
?>