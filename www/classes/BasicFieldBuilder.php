<?
/**
* BasicFieldBuilder
* Класс, строящий при инициализации базовую сетку и записывающий её в $arBasicField 
* 
* @author Sword Dancer
* @version 1.0.1
*/

class BasicFieldBuilder extends Sudoku
{
	protected $arBasicField;

	public function __construct()
	{
		$this->arBasicField = $this->getBasicField();
	}

	/**
	* getBasicField 
	* Генерирует базовую сетку
	* @return array Базовая сетка
	*/
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
?>