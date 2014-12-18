<?php 
class Matrix
{
    public $arr, $rows, $cols;

	function __construct($row, $col)
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

	function setElem($x, $y, $val)
	{
	  if ($x > -1 && $x < $this->rows)
	  {
      if ($y > -1 && $y < $this->cols)
        $this->arr[$x][$y] = $val;
    }
  }

  function getElem($x, $y)
  {
    if ($x > -1 && $x < $this->rows)
    {
      if ($y > -1 && $y < $this->cols)
        return ($this->arr[$x][$y]);
    }
  }

  function add($matrix)
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

  function multiply($matrix)
  {
    if ($this->cols == $matrix->rows)
    {
      $rslt = new Matrix($this->rows, $matrix->cols);
	      for ($a=0; $a < $rslt->rows; $a++) {
          for ($b=0; $b < $rslt->cols; $b++) {
            $total = 0;
              for ($c=0; $c < $matrix->rows; $c++) {
                $total += $this->getElem($a,$c) * $matrix->getElem($c,$b);
              }
            $rslt->setElem($a,$b,$total);
          }
      	}
    return ($rslt);
  	}
		else
			return ("Invalid matrix format");
  }
		
	function transpose()
	{
		$rslt = new Matrix($this->cols, $this->rows);
			
		for ($i = 0; $i < $this -> rows; $i++) {
			for ($j = 0; $j < $this->cols; $j++) 
				$rslt->setElem($j, $i, $this->getElem($i, $j));
		}
		return ($rslt);
	}
		
	function trace()
	{
		if ($this -> cols == $this -> rows)
		{
			$tr = 0;
			for ($i = 0; $i < $this -> rows; $i++)
				$tr += $this->getElem($i, $i);
		}
		return ($tr);
	}
		
		function getSize($type = "rows") { return ($this->$type); }

}
?>