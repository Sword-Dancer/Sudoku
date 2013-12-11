<?
/**
* Sudoku
* Базовый класс, генерирующий сетку с числами, отвечающими
* правилам игры "судоку" и содержащий основные параметры этой сетки
* 
* @author Sword Dancer
* @version 1.0.1
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
	private $iteration_count = 20;

	/**
	* __construct Вызывает построитель базовой сетки BasicFieldBuilder, 
	* затем в случайном порядке несколько раз её сортирует и записывает
	* результат в $this->field 
	*/
	public function __construct()
	{
		$arAllMethods = get_class_methods("SortBuilder");
		$construct = array_search("__construct", $arAllMethods);
		unset($arAllMethods[$construct]);

		$obBasicField = new BasicFieldBuilder();
		$arField = $obBasicField->arBasicField;

		$obSorts = new SortBuilder($arField);

		$randCount = rand(0, $this->iteration_count);
		for ($i=0; $i<=$randCount; $i++)
		{
			$randSortMethod = $arAllMethods[array_rand($arAllMethods)];
			$arField = $obSorts->$randSortMethod();
			$obSorts->arField = $arField;
		}

		$this->field = $arField;
	}
}
?>