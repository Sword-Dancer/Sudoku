<?
/**
* SortBuilder
* Класс, сортирующий разными методами сетку из свойства $arField 
* 
* @author Sword Dancer
* @version 1.0.1
*/

class SortBuilder extends Sudoku
{
	protected $arField;
	
	public function __construct($arField)
	{
		$this->arField = $arField;
	}

	/**
	* getChangedVerticalSquaresFromField 
	* Меняет местами две случайных колонки из квадратов
	* @return array Отсортированная сетка
	*/
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

	/**
	* getChangedHorizontalSquaresFromField 
	* Меняет местами две случайных линии из квадратов
	* @return array Отсортированная сетка
	*/
	protected function getChangedHorizontalSquaresFromField()
	{
		list($square1, $square2) = $this->getSquareToChange();

		$arLines1 = $this->getPosFromSquare($square1);
		$arLines2 = $this->getPosFromSquare($square2);

		$arChangedField = $this->arField;
		foreach ($arLines1 as $line_num => $line_val)
		{
			$arChangedField = $this->changeTwoElementsInArr($arChangedField, $arLines1[$line_num], $arLines2[$line_num]);
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

	/**
	* getChangedIntoSquareColumnsField 
	* Меняет местами две случайных колонки в пределах квадрата
	* @return array Отсортированная сетка
	*/
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

	/**
	* getChangedIntoSquareLinesField 
	* Меняет местами две случайных линии в пределах квадрата
	* @return array Отсортированная сетка
	*/
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

	/**
	* getTransponingField 
	* Транспорнирует сетку
	* @return array Отсортированная сетка
	*/
	protected function getTransponingField()
	{
		$arTransponingField = array();
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
?>