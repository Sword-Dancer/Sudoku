<?php
/**
 * Application
 * Класс каркаса приложения - меню и прочее
 *
 * @author Sword Dancer
 * @version 1.0.0
 */

class Application
{
	private $top_menu;
	private $top_menu_template;
	private $footer_template;


	public function __construct($top_menu_template, $footer_template)
	{
		$this->top_menu_template = $top_menu_template;
		$this->footer_template = $footer_template;

		$this->top_menu = array(
			"about" => array(
				"href" => "/about.php",
				"name" => "О проекте",
				"css_class" => ""
			),
			"index" => array(
				"href" => "/",
				"name" => "Судоку",
				"css_class" => ""
			),
			"auto" => array(
				"href" => "/auto.php",
				"name" => "Судоку с произвольным условием",
				"css_class" => ""
			),
			"contacts" => array(
				"href" => "/contacts.php",
				"name" => "Контакты",
				"css_class" => ""
			),
		);
        $arUrl = explode("?", $_SERVER["REQUEST_URI"]);
		$url = $arUrl[0];

		foreach ($this->top_menu as &$arItem)
			if ($arItem["href"] == $url)
				$arItem["css_class"] = "select";
	}


	public function getTopMenu()
	{
		return $this->top_menu;
	}

	public function getTopMenuTemplate()
	{
		return $this->top_menu_template;
	}

	public function getFooterTemplate()
	{
		return $this->footer_template;
	}
}