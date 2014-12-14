<?
/**
* BasicField
* Класс, строящий при инициализации базовую сетку и записывающий её в $arField
* 
* @author Sword Dancer
* @version 2.0.0
*/

class BasicField
{
	private $obConfig;
	private $arField;
	
	public function __construct($obConfig)
	{
		$this->obConfig = $obConfig;
		$this->arField = $this->generateBasicField();
	}
	
	/**
	* getBasicField 
	* Генерирует базовую сетку
	* @return array Базовая сетка
	*/
	private function generateBasicField()
	{
		$arBasicField = array();
		$num_start = $this->obConfig->getNumMin();
		for ($line_count = $this->obConfig->getPosMin();  $line_count <= $this->obConfig->getPosMax();  $line_count++)
		{
			$arBasicField[$line_count] = self::generateLine($num_start);
			$num_start = self::getNextNumStart($arBasicField[$line_count]);
		}

		return $arBasicField;
	}
	private function generateLine($num)
	{
		$arLine = array();
		for ($i=$this->obConfig->getPosMin(); $i<=$this->obConfig->getPosMax(); $i++)
		{
			$arLine[] = $num;

			if (++$num > $this->obConfig->getNumMax())
			{
				$num = $this->obConfig->getNumMin();
			}
		}
		return $arLine;
	}
	private function getNextNumStart($arLine)
	{
		$diff = $this->obConfig->getSquareSize() + 1;
		$last_num = end($arLine);
		
		if ($last_num == $this->obConfig->getNumMax())
		{
			$num_start = $diff;
		}
		elseif ($last_num + $diff > $this->obConfig->getNumMax())
		{
			$num_start = $last_num - $diff;
		}
		else
		{
			$num_start = $last_num + $diff;
		}

		return $num_start;
	}

	public function getField()
	{
		return $this->arField;
	}
}