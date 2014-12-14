<?
/**
* AutoLoading
* Автозагрузка файлов классов при их вызове 
*
* @version 1.0.1
*/

class AutoLoading 
{
	private static $class_path = "classes/";
	private static $extension = ".php";

	public static function loadingClasses($class)
	{
		try
		{
			self::doInclude($class);
		} 
		catch (Exception $e)
		{
		    echo 'Выброшено исключение: ',  $e->getMessage(), "\n";
		}
	}

	private static function doInclude($class)
	{
		$file = self::$class_path . $class . self::$extension;
	    if (!file_exists($file))
	    {
	        throw new Exception('файла с классом нет');
	    }
    	require_once $file;
	}
}

spl_autoload_register(array('AutoLoading', 'loadingClasses'));
?>