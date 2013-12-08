<?
echo "<pre>";

/**
* 
*/
class Sudoku
{
	public $field;

	protected $num_max = 9;
	protected $num_min = 1;
	protected $pos_max = 8;
	protected $pos_min = 0;
	protected $square_quantity = 2; // from 0
	protected $square_size = 3;
	protected $square_pos_max = 2;

	public function __construct()
	{
		$arAllMethods = get_class_methods("SortBuilder");
		//print_r($arAllMethods);
		$construct = array_search("__construct", $arAllMethods);
		unset($arAllMethods[$construct]);

		$obBasicField = new BasicFieldBuilder();
		$arField = $obBasicField->arBasicField;

		$randCount = rand(0,20);
		for ($i=0; $i<=$randCount; $i++)
		{
			$randSortMethod = $arAllMethods[array_rand($arAllMethods)];

			$obSorts = new SortBuilder($arField);
			$arField = $obSorts->$randSortMethod();
		}

		$this->field = $arField;
	}
}



class SortBuilder extends Sudoku
{
	protected $arField;
	
	public function __construct($arField)
	{
		$this->arField = $arField;
	}

	protected function getChangedVerticalSquaresFromField()
	{
		list($square1, $square2) = $this->getSquareToChange();

		$arColumns1 = $this->getPosFromSquare($square1);
		$arColumns2 = $this->getPosFromSquare($square2);

		$arChangedField = $this->arField;
		foreach ($arColumns1 as $column_num => $column_val)
		{
			foreach ($arChangedField as &$arLine)
			{
				$arLine = $this->changeTwoElementsInArr($arLine, $arColumns1[$column_num], $arColumns2[$column_num]);
			}
		}

		return $arChangedField;
	}
	protected function getChangedHorizontalSquaresFromField()
	{
		list($square1, $square2) = $this->getSquareToChange();

		$arLines1 = $this->getPosFromSquare($square1);
		$arLines2 = $this->getPosFromSquare($square2);

		$arChangedField = $this->arField;
		foreach ($arLines1 as $key => $val)
		{
			$arChangedField = $this->changeTwoElementsInArr($arChangedField, $arLines1[$key], $arLines2[$key]);
		}

		return $arChangedField;
	}
	private function getSquareToChange()
	{
		$arAllowRange = array();
		for ($i = 0;   $i <= $this->square_quantity;   $i++)
		{ 
			$arAllowRange[$i] = $i;
		}

		$arSquareToChange = array_rand($arAllowRange, 2);

		return $arSquareToChange;
	}
	private function getPosFromSquare($square)
	{
		$pos = $square*$this->square_size;
		for ($i = $pos;   $i <= $pos+$this->square_pos_max;   $i++)
		{ 
			$arPos[] = $i;
		}

		return $arPos;
	}

	protected function getChangedIntoSquareColumnsField()
	{
		list($column1, $column2) = $this->getPositionToChange();

		$arChangedField = $this->arField;
		foreach ($arChangedField as &$arLine)
		{
			$arLine = $this->changeTwoElementsInArr($arLine, $column1, $column2);
		}

		return $arChangedField;
	}
	protected function getChangedIntoSquareLinesField()
	{
		list($line1, $line2) = $this->getPositionToChange();

		$arChangedField = $this->changeTwoElementsInArr($this->arField, $line1, $line2);

		return $arChangedField;
	}
	private function getPositionToChange()
	{
		$square = rand(0, $this->square_quantity);
		$start = $square*$this->square_size;

		$arAllowRange = array();
		for ($i = $start;   $i <= $start + $this->square_pos_max;    $i++)
		{ 
			$arAllowRange[$i] = $i;
		}

		$arPositionToChange = array_rand($arAllowRange, 2);

		return $arPositionToChange;
	}

	private function changeTwoElementsInArr($arr, $pos1, $pos2)
	{
		list($arr[$pos1], $arr[$pos2]) = array($arr[$pos2], $arr[$pos1]);
		return $arr;
	}


	protected function getTransponingField()
	{
		$arTransponingField = array();
		//$arBasicField = $this->arBasicField;
		foreach ($this->arField as $line_count => $arLine)
		{
			foreach ($arLine as $num_count => $num)
			{
				$arTransponingField[$num_count][$line_count] = $num;
			}
		}
		return $arTransponingField;
	}
}


class BasicFieldBuilder extends Sudoku
{
	protected $arBasicField;

	public function __construct()
	{
		$this->arBasicField = $this->getBasicField();
	}

	private function getBasicField()
	{
		$arBasicField = array();
		$num_start = $this->num_min;
		for ($line_count = $this->pos_min;  $line_count <= $this->pos_max;  $line_count++)
		{
			$arBasicField[$line_count] = $this->getLine($num_start);
			$num_start = $this->getNextNumStart($arBasicField[$line_count]);
		}

		return $arBasicField;
	}
	private function getLine($num_start)
	{
		$arLine = array();
		$num = $num_start;

		for ($i=$this->pos_min; $i<=$this->pos_max; $i++)
		{
			$arLine[] = $num;

			if (++$num > $this->num_max)
			{
				$num = $this->num_min;
			}
		}
		return $arLine;
	}
	private function getNextNumStart($arLine)
	{
		$diff = $this->square_size + 1;
		$last_num = end($arLine);
		
		if ($last_num == $this->num_max)
		{
			$num_start = $diff;
		}
		elseif ($last_num + $diff > $this->num_max)
		{
			$num_start = $last_num - $diff;
		}
		else
		{
			$num_start = $last_num + $diff;
		}

		return $num_start;
	}
}




/*

	private $allX = array(0,1,2,3,4,5,6,7,8);
	private $allY = array(0,1,2,3,4,5,6,7,8);
	private $allSquare = array("00","03","06",  "30","33","36",  "60","63","66");

	//public function __construct()
	private $num_max = 6;


	private function getSquare($x, $y)
	{
		$x = $x - $x%3;
		$y = $y - $y%3;

		$square = $x.$y;

		return $square;
	}
	private function getCanCoordinateFromSquare($square, $coord, $canCoord)
	{
		$canCoord_from_square = array();

		if ($coord == "x")
		{
			$square_coord = (int)substr($square,0,1);
		}
		else
		{
			$square_coord = (int)substr($square,1,1);
		}

		for ($i=0; $i<=2; $i++)
		{ 
			if (is_int(array_search($square_coord+$i, $canCoord)))
			{
				$canCoord_from_square[] = $square_coord+$i;
			}
		}

		return $canCoord_from_square;
	}
	private function getCanPair_from_square($canX_from_square, $canY_from_square)
	{
		$canPair_from_square = array();

		foreach ($canX_from_square as $x)
		{
			foreach ($canY_from_square as $y)
			{
				if (!$this->field[$x][$y])
				{
					$canPair_from_square[] = array('x'=>$x, 'y'=>$y);
				}
			}
		}		

		return $canPair_from_square;
	}
	public function setField()
	{
		for ($num=1; $num<=$this->num_max; $num++)
		{
			$canX = $this->allX;
			$canY = $this->allY;

			foreach ($this->allSquare as $square)
			{
				$canX_from_square = $this->getCanCoordinateFromSquare($square, "x", $canX);
				$canY_from_square = $this->getCanCoordinateFromSquare($square, "y", $canY);

				$canPair_from_square = $this->getCanPair_from_square($canX_from_square, $canY_from_square);

				if (count($canPair_from_square)!==0)
				{
					$rez = $canPair_from_square[array_rand($canPair_from_square)];

					$x = $rez[x];
					$y = $rez[y];					

					$this->field[$x][$y] = $num;

					unset($canX[$x]);
					unset($canY[$y]);
				}
				else
				{
					$num = 0;
					break;
				}
			}
		}
	}*/





			//$canSquare = $this->allSquare;

			/*for ($i=0; $i<=8; $i++)
			//foreach ($this->allSquare as $square)
			{ 
				$canPair = array();
				foreach ($canX as $x)
				{
					foreach ($canY as $y)
					{
						if (!$this->field[$x][$y] && is_int(array_search($this->getSquare($x, $y), $canSquare)) )
						{
							$canPair[] = array('x'=>$x, 'y'=>$y);
						}
					}
				}

				if(count($canPair))
				{
					$rez = $canPair[array_rand($canPair)];


					$x = $rez[x];
					$y = $rez[y];					

					$this->field[$x][$y] = $num;

					unset($canX[$x]);
					unset($canY[$y]);

					$square = $this->getSquare($x, $y);
					unset($canSquare[array_search($square, $canSquare)]);
				}
				else
				{
					//echo "string!";
				}
				/*foreach ($canPair as &$pair)
				{
					$pair_square = $this->getSquare($pair[x], $pair[y]);
					if ($pair_square = $square)
					{
						unset($pair);
					}
				}*/

				//echo "$square";


				/*$square_x = (int)substr($square,0,1);
				$square_y = (int)substr($square,1,1);

				$canPair_from_square = array();
				foreach ($canPair as $pair)
				{
					if ($pair[x]>=$square_x && $pair[x]<=$square_x+2 && $pair[y]>=$square_y && $pair[y]<=$square_y+2)
					{
						$canPair_from_square[] = $pair;
					}
				}

				if (count($canPair_from_square)!==0)
				{
					$rez = $canPair_from_square[array_rand($canPair_from_square)];

					$x = $rez[x];
					$y = $rez[y];					

					$this->field[$x][$y] = $num;

					unset($canX[$x]);
					unset($canY[$y]);
					unset($x);
					unset($y);
				}
				else
				{
					echo "string!";
				}*/


				/*foreach ($this->allSquare as $square)
				{
					$square_x = (int)substr($square,0,1);
					$square_y = (int)substr($square,1,1);
				}*/





				//$this->field[$x][$y] = $num;

				//unset($canX[$x]);
				//unset($canY[$y]);
			//}








			/*foreach ($this->allSquare as $square)
			{
				$square_x = (int)substr($square,0,1);
				$square_y = (int)substr($square,1,1);

				for ($i=0; $i<=2; $i++)
				{ 
					if (is_int(array_search($square_x+$i, $canX)))
					{
						$canX_from_square[] = $square_x+$i;
					}
				}

				for ($i=0; $i<=2; $i++)
				{ 
					if (is_int(array_search($square_y+$i, $canY)))
					{
						$canY_from_square[] = $square_y+$i;
					}
				}

				foreach ($canX_from_square as $x)
				{
					foreach ($canY_from_square as $y)
					{
						if (!$this->field[$x][$y])
						{
							$canPair_from_square[] = array('x'=>$x, 'y'=>$y);
						}
					}
				}
				if (count($canPair_from_square)!==0)
				{
					$rez = $canPair_from_square[array_rand($canPair_from_square)];

					$x = $rez[x];
					$y = $rez[y];					

					$this->field[$x][$y] = $num;

					unset($canX[$x]);
					unset($canY[$y]);
				}
				else
				{
					echo "string!";
				}

				$canX_from_square = array();
				$canY_from_square = array();
				$canPair_from_square = array();
			}*/

	/*function getSquare($x, $y)
	{
		$x = $x - $x%3;
		$y = $y - $y%3;

		$square = $x.$y;

		return $square;
	}

	function getRandFromAr($arr)
	{
		$rand_index = rand(0,count($arr)-1);
		return $arr[$rand_index];
	}*/


	/*
	$cashedX = array();
	$cashedY = array();
	$cashedSquare = array();

	for ($num=1; $num<=2; $num++)
	{
		for ($i=0; $i<9; $i++)
		{
			do
			{
				do
				{
					do
					{
						$x = getRand();
					} while (is_int(array_search($x, $cashedX)));
					do
					{
						$y = getRand();
					} while (is_int(array_search($y, $cashedY)));
				} while (isset($table[$x][$y]));

				$square = getSquare($x, $y);

			} while (is_int(array_search($square,$cashedSquare)));

			$cashedX[] = $x;
			$cashedY[] = $y;

			$cashedSquare[] = $square;

			$table[$x][$y] = $num;
		}
		$cashedX = array();
		$cashedY = array();
		$cashedSquare = array();
	}

	function getSquare($x, $y)
	{
		$x = $x - $x%3;
		$y = $y - $y%3;

		$square = $x.$y;

		return $square;
	}

	function getRand()
	{
		return rand(0,8);
	}
*/


$sudoku = new Sudoku();
//$sudoku->setField();

echo "</pre>";
?>

<html>
<head>
	<title>Судоку</title>

	<style type="text/css">
		body {font-family:Tahoma; font-size: 14px; color: #666;}

		.sudoku_table {border-collapse: collapse;}
		.sudoku_table td {padding: 5px 10px; border: 1px dotted #999}
		.sudoku_table td:nth-child(3n+3) {border-right: 2px solid #000;}
		.sudoku_table tr:nth-child(3n+3) {border-bottom: 2px solid #000;}
		.sudoku_table td:nth-child(1) {border-left: 2px solid #000;}
		.sudoku_table tr:nth-child(1) {border-top: 2px solid #000;}
	</style>
</head>
<body>

<table class="sudoku_table">
	<?foreach ($sudoku->field as $x):?>
	<tr>
		<?foreach ($x as $y):?>
		<td><?=$y?></td>
		<?endforeach;?>
	</tr>
	<?endforeach;?>
</table>

</body>
</html>

