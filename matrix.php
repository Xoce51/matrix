<?php 
class Matrix {
    private $arr, $rows, $cols;

    function Matrix($row, $col) {
        if ($row > 0 && $col > 0) {
            $arr        = array();
            $this->rows = $row;
            $this->cols = $col;

            for ($a=0; $a < $this->rows; $a++) {
                array_push($arr,array());

                for ($b=0; $b < $this->cols; $b++) {
                    array_push($arr[$a],0);
                }
            }
        }
    }

    function setElem($x, $y, $val) {
        if ($x > -1 && $x < $this->rows) {
            if ($y > -1 && $y < $this->cols) {
                $this->arr[$x][$y] = $val;
            }
        }
    }

    function getElem($x, $y) {
        if ($x > -1 && $x < $this->rows) {
            if ($y > -1 && $y < $this->cols) {
                return ($this->arr[$x][$y]);
            }
        }
    }

    function add($matrix) {
        if ($this->rows == $matrix->rows && $this->cols == $matrix->cols) {
            $rslt = new Matrix($this->rows,$this->cols);

            for ($a=0; $a < $this->rows; $a++) {
                for ($b=0; $b < $this->cols; $b++) {
                    $rslt->SetElem($a,$b,$this->GetElem($a,$b) + $matrix->GetElem($a,$b));
                }
            }

            return ($rslt);
        }
    }

    function multiply($matrix) {
        if ($this->cols == $matrix->rows) {
            $rslt = new Matrix($this->rows, $matrix->cols);

            for ($a=0; $a < $rslt->rows; $a++) {
                for ($b=0; $b < $rslt->cols; $b++) {
                    $total = 0;

                    for ($c=0; $c < $matrix->rows; $c++) {
                        $total += $this->GetElem($a,$c) * $matrix->GetElem($c,$b);
                    }

                    $rslt->SetElem($a,$b,$total);
                }
            }

            return ($rslt);
        }
    }
		
		function transpose()
		{
			return ($this->arr);
		}
		
		function trace()
		{
			return ($this->arr);
		}
		
		function getSize($type = "row") { return ($this->$type); }

}
?>