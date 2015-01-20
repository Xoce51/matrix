<?php 
class Matrix
{
    public 	$arr, $rows, $cols;
		private $step, $identity;
		private $matrix_step = array();
		private $mat = array();

	public function __construct($row, $col)
	{
    if ($row > 0 && $col > 0)
    {
      $arr        = array();
      $this->rows = $row;
      $this->cols = $col;
      for ($a = 0; $a < $this->rows; $a++)
      {
        array_push($arr,array());
        for ($b = 0; $b < $this->cols; $b++)
          array_push($arr[$a],0);
      }
    }
  }

	public function setElem($x, $y, $val)
	{
	  if ($x > -1 && $x < $this->rows)
	  {
      if ($y > -1 && $y < $this->cols)
        $this->arr[$x][$y] = $val;
    }
  }

  public function getElem($x, $y)
  {
    if ($x > -1 && $x < $this->rows)
    {
      if ($y > -1 && $y < $this->cols)
        return ($this->arr[$x][$y]);
    }
  }

  public function add($matrix)
  {
  	if ($this->rows == $matrix->rows && $this->cols == $matrix->cols)
  	{
      $rslt = new Matrix($this->rows,$this->cols);
        for ($a=0; $a < $this->rows; $a++)
        {
          for ($b=0; $b < $this->cols; $b++)
            $rslt->setElem($a,$b,$this->getElem($a,$b) + $matrix->getElem($a,$b));
      	}
  		return ($rslt);
    }
		else
			return ("Invalid matrix format");
  }

  public function multiply($matrix)
  {
    if ($this->cols == $matrix->rows)
    {
      $rslt = new Matrix($this->rows, $matrix->cols);
	      for ($a = 0; $a < $rslt->rows; $a++)
	      {
          for ($b = 0; $b < $rslt->cols; $b++)
          {
            $total = 0;
              for ($c = 0; $c < $matrix->rows; $c++)
              {
                $total += $this->getElem($a, $c) * $matrix->getElem($c, $b);
              }
						$rslt->setElem($a,$b,$total);
          }
      	}
    return ($rslt);
  	}
		else
			return ("Invalid matrix format");
  }
		
	public function transpose()
	{
		$rslt = new Matrix($this->cols, $this->rows);
			
		for ($i = 0; $i < $this->rows; $i++) {
			for ($j = 0; $j < $this->cols; $j++) 
				$rslt->setElem($j, $i, $this->getElem($i, $j));
		}
		return ($rslt);
	}
		
	public function trace()
	{
		if ($this->cols == $this->rows)
		{
			$tr = 0;
			for ($i = 0; $i < $this->rows; $i++)
				$tr += $this->getElem($i, $i);
		}
		return ($tr);
	}
		
	public function getSize($type = "rows") { return ($this->$type); }
	
	public function gauss($mat_ref)
	{
		$this->getIdentity();
		$this->matrix_step["A"][0] = $this;
		$this->matrix_step["Y"][0] = $mat_ref;
		for ($i = 1; $i <= $this->cols; $i++)
		{
			$this->matrix_step["G"][$i] = $this->getG($this->matrix_step["A"][$i - 1], $i); // => G(1)
			$this->matrix_step["A"][$i] = $this->getMatrixStep($this->matrix_step["G"][$i], $this->matrix_step["A"][$i - 1]); // A(2) = G(1)A(1)
			$this->matrix_step["Y"][$i] = $this->getMatrixStep($this->matrix_step["G"][$i], $this->matrix_step["Y"][$i - 1]); // Y(2) = G(1)Y(1)
		}
		return ($this->matrix_step);
	}
	
	private function getG($ref, $step)
	{
		$position = $step - 1;
		$mat = clone $this->identity;

		while (($coef = $ref->getElem($position, $position)) == 0)
			$position++;
		for ($i = 1 + $position; $i < $ref->rows; $i++)
		{
			$val = - ($ref->getElem($i, $position) / $coef);
			$mat->setElem($i, $position, $val);
		}
		return ($mat);
	}
	
	private function getMatrixStep($m, $ma)
	{
		return ($m->multiply($ma));
	}
	
	private function getIdentity()
	{
		$this->identity = new Matrix($this->cols, $this->cols);
		for ($i = 0; $i < $this->cols; $i++)
		{
			for ($j = 0; $j < $this->cols; $j++)
			{
				if ($i === $j)
					$this->identity->setElem($i, $j, 1);
				else
					$this->identity->setElem($i, $j, 0);
			}
		}
	}

}
?>