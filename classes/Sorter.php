<?
/**
* Sorter
* Класс, сортирующий разными методами сетку из свойства $arField 
* 
* @author Sword Dancer
* @version 2.0.0
*/

class Sorter
{
	private $arField;
	private $obConfig;
	private $arMethods;
	private $arSortedField;

	public function __construct($obConfig, $arField)
	{
		$this->obConfig = $obConfig;
		$this->arField = $arField;
		$this->arMethods = array(
			"changeVerticalSquares",
			"changeHorizontalSquares",
			"changeColumnsInSquare",
			"changeLinesInSquare",
			"transposing"
		);
		
		$randCount = rand(0, 20);
		for ($i=0; $i<=$randCount; $i++)
		{
			$randSortMethod = $this->arMethods[array_rand($this->arMethods)];
			$arField = $this->$randSortMethod($arField);
		}
		$this->arSortedField = $arField;
	}
	
	/**
	 * getChangedVerticalSquaresFromField
	 * Меняет местами две случайных колонки из квадратов
	 * @param array Исходная сетка
	 * @return array Отсортированная сетка
	 */
	public function changeVerticalSquares($arField)
	{
		list($square1, $square2) = $this->getRandSquare();

		$arColumns1 = $this->getPosFromSquare($square1);
		$arColumns2 = $this->getPosFromSquare($square2);

		foreach ($arColumns1 as $column_num => $column_val)
		{
			foreach ($arField as &$arLine)
			{
				$arLine = $this->changeTwoElementsInArr($arLine, $arColumns1[$column_num], $arColumns2[$column_num]);
			}
		}

		return $arField;
	}

	/**
	 * getChangedHorizontalSquaresFromField
	 * Меняет местами две случайных линии из квадратов
	 * @param array Исходная сетка
	 * @return array Отсортированная сетка
	 */
	public function changeHorizontalSquares($arField)
	{
		list($square1, $square2) = $this->getRandSquare();

		$arLines1 = $this->getPosFromSquare($square1);
		$arLines2 = $this->getPosFromSquare($square2);

		foreach ($arLines1 as $line_num => $line_val)
		{
			$arField = $this->changeTwoElementsInArr($arField, $arLines1[$line_num], $arLines2[$line_num]);
		}

		return $arField;
	}
	private function getRandSquare()
	{
		$arAllowRange = array();
		for ($i = 0;   $i <= $this->obConfig->getSquareQuantity();   $i++)
		{ 
			$arAllowRange[$i] = $i;
		}

		$arSquare = array_rand($arAllowRange, 2);

		return $arSquare;
	}
	private function getPosFromSquare($square)
	{
		$pos = $square*$this->obConfig->getSquareSize();
		$arPos = array();
		for ($i = $pos;   $i <= $pos+$this->obConfig->getSquarePosMax();   $i++)
		{ 
			$arPos[] = $i;
		}

		return $arPos;
	}

	/**
	 * getChangedIntoSquareColumnsField
	 * Меняет местами две случайных колонки в пределах квадрата
	 * @param array Исходная сетка
	 * @return array Отсортированная сетка
	 */
	public function changeColumnsInSquare($arField)
	{
		list($column1, $column2) = $this->getRandPositions();

		foreach ($arField as &$arLine)
		{
			$arLine = $this->changeTwoElementsInArr($arLine, $column1, $column2);
		}

		return $arField;
	}

	/**
	 * getChangedIntoSquareLinesField
	 * Меняет местами две случайных линии в пределах квадрата
	 * @param array Исходная сетка
	 * @return array Отсортированная сетка
	 */
	public function changeLinesInSquare($arField)
	{
		list($line1, $line2) = $this->getRandPositions();

		$arChangedField = $this->changeTwoElementsInArr($arField, $line1, $line2);

		return $arChangedField;
	}
	private function getRandPositions()
	{
		$square = rand(0, $this->obConfig->getSquareQuantity());
		$start = $square*$this->obConfig->getSquareSize();

		$arAllowRange = array();
		for ($i = $start;   $i <= $start + $this->obConfig->getSquarePosMax();    $i++)
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
	 * getTransposingField
	 * Транспорнирует сетку
	 * @param array Исходная сетка
	 * @return array Отсортированная сетка
	 */
	public function transposing($arField)
	{
		$arTransposingField = array();
		foreach ($arField as $line_count => $arLine)
		{
			foreach ($arLine as $num_count => $num)
			{
				$arTransposingField[$num_count][$line_count] = $num;
			}
		}
		return $arTransposingField;
	}

	public function getSortedField()
	{
		return $this->arSortedField;
	}
}
