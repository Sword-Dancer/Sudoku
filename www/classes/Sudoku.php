<?

/**
 * Sudoku
 * Базовый класс, генерирующий сетку с числами, отвечающими
 * правилам игры "судоку" и содержащий основные параметры этой сетки
 *
 * @author Sword Dancer
 * @version 2.0.0
 */
class Sudoku
{
    private $arField;
    private $obConfig;

    /**
     * __construct Вызывает класс, считывающий настройки, затем генератор
     * базовой сетки, потом сортировщик
     * @param string $ini_file_path Путь до файла с конфигурацией
     */
    public function __construct($ini_file_path, $level)
    {
        $this->obConfig = new Config($ini_file_path);

        $obBasicField = new BasicField($this->obConfig);
        $arField = $obBasicField->getField();

        $obSorter = new Sorter($this->obConfig, $arField);
        $arField = $obSorter->getSortedField();

        $obTask = new Task($this->obConfig, $arField, $level);
        $arField = $obTask->getTaskField();

        $this->arField = $arField;
    }

    public function getField()
    {
        return $this->arField;
    }
}
