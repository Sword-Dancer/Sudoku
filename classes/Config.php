<?php
/**
 * Config
 * Считывает конфигурацию из ini-файла, возвращает настройки
 *
 * @author Sword Dancer
 * @version 1.0.0
 */

class Config
{
	private $num_max;
	private $num_min;
	private $pos_max;
	private $pos_min;
	private $square_quantity;
	private $square_size;
	private $square_pos_max;

	public function __construct($ini_file_path)
	{
		$arConfig = parse_ini_file($ini_file_path);
		
		$this->num_max = (int)$arConfig['num_max'];
		$this->num_min = (int)$arConfig['num_min'];
		$this->pos_max = (int)$arConfig['pos_max'];
		$this->pos_min = (int)$arConfig['pos_min'];
		$this->square_quantity = (int)$arConfig['square_quantity'];
		$this->square_size =     (int)$arConfig['square_size'];
		$this->square_pos_max =  (int)$arConfig['square_pos_max'];
	}

	public function getConfig()
	{
		return array(
			'num_max' => $this->num_max,
			'num_min' => $this->num_min,
			'pos_max' => $this->pos_max,
			'pos_min' => $this->pos_min,
			'square_quantity' => $this->square_quantity,
			'square_size' => $this->square_size,
			'square_pos_max' => $this->square_pos_max,
		);
	}

	public function getNumMax()
	{
		return $this->num_max;
	}

	public function getNumMin()
	{
		return $this->num_min;
	}

	public function getPosMax()
	{
		return $this->pos_max;
	}

	public function getPosMin()
	{
		return $this->pos_min;
	}

	public function getSquareQuantity()
	{
		return $this->square_quantity;
	}

	public function getSquareSize()
	{
		return $this->square_size;
	}

	public function getSquarePosMax()
	{
		return $this->square_pos_max;
	}
}