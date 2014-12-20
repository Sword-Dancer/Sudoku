<?php
/**
 * Task
 * Класс создаёт игру на базе отсортированной заполненной сетки
 * посредством удаления некоторого количества цифр. Количество зависит
 * от уровня сложности.
 *
 * @author Sword Dancer
 * @version 1.0.0
 */

class Task
{
    private $obConfig;
    private $arTaskField;
    private $level;
    private $level_count;

    public function __construct($obConfig, $arField, $level)
    {
        $this->obConfig = $obConfig;
        $this->level = $level;
        $this->level_count = array(
            1 => array("min" => 50, "max" => 55),
            2 => array("min" => 60, "max" => 65),
            3 => array("min" => 70, "max" => 75),
        );

        $this->arTaskField = $this->createTaskField($arField);
    }

    private function createTaskField($arField)
    {
        $arTaskField = $this->deleteRandomNums($arField);
        while ($this->getSolveCount($arTaskField) != 1)
        {
            $arTaskField = $this->deleteRandomNums($arField);
        }

        return $arTaskField;
    }

    private function deleteRandomNums($arField)
    {
        $delete_count = rand(
            $this->level_count[$this->level]['min'],
            $this->level_count[$this->level]['max']
        );

        for ($i=0; $i<=$delete_count; $i++)
        {
            $rand_line = rand($this->obConfig->getPosMin(), $this->obConfig->getPosMax());
            $rand_row = rand($this->obConfig->getPosMin(), $this->obConfig->getPosMax());

            $arField[$rand_line][$rand_row] = "";
        }
        return $arField;
    }

    /**
     * TODO Метод, считающий количество решений
     * @param $arField
     * @return int
     */
    private function getSolveCount($arField)
    {
        return 1;
    }

    public function getTaskField()
    {
        return $this->arTaskField;
    }

}