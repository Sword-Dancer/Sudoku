<?
/**
* AutoLoading
* Автозагрузка файлов классов при их вызове 
*
* @version 1.0.1
*/

class AutoLoading 
{
	private static $class_path = "/classes/";
	private static $extension = ".php";

	public static function loadingClasses($class)
	{
		require_once  self::$class_path . $class . self::$extension;
	}
}

spl_autoload_register(array('AutoLoading', 'loadingClasses'));
?>