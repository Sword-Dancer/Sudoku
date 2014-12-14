<?php
/**
 * @author Sword Dancer
 * @version 1.0.0
 */

class Task
{
    private $obConfig;
    private $arTaskField;

    public function __construct($obConfig, $arField, $level)
    {
        $this->obConfig = $obConfig;

        $level_count = array(
            1 => array("min" => 50, "max" => 55),
            2 => array("min" => 60, "max" => 65),
            3 => array("min" => 70, "max" => 75),
       );

        $delete_count = rand($level_count[$level]['min'], $level_count[$level]['max']);


        for ($i=0; $i<=$delete_count; $i++)
        {
            $rand_line = rand($obConfig->getPosMin(), $obConfig->getPosMax());
            $rand_row = rand($obConfig->getPosMin(), $obConfig->getPosMax());

            $arField[$rand_line][$rand_row] = "";
        }

        $this->arTaskField = $arField;



        echo "<pre>";
        //print_r($obConfig);
        echo "</pre>";
        //$arField
    }

    public function getTaskField()
    {
        return $this->arTaskField;
    }
} 