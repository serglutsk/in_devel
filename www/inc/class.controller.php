<?php
require_once("inc/class.model.php");
//
// Базовий класс контроллера.
//
 class controller extends model
{
	//
	// Конструктор.
	//
	function __construct()
	{
	}

	//
	//  обробка HTTP запиту.
	//
	public function Request($id=NULL)
	{
		$this->OnInput($id);
		$this->OnOutput();
	}

	
	//віртуальний обробник запиту
	protected function OnInput()
	{
	}

	//
	// віртуальний генератор HTML.
	//
	protected function OnOutput()
	{
	}

	
	// якщо запит зроблений методом GET
	protected function IsGet()
	{
		return $_SERVER['REQUEST_METHOD'] == 'GET';
	}

	
	// якщо запит зроблений методом POST
	protected function IsPost()
	{
		return $_SERVER['REQUEST_METHOD'] == 'POST';
	}

	//
	// генерація HTML шаблона в строку.
	//
	protected function Template($fileName, $vars = array())
	{
		// встановлення перемінних для шаблона.
		foreach ($vars as $k => $v)
		{
			$$k = $v;
		}

		// генерація HTML в строку.
		ob_start();
		include $fileName;
		return ob_get_clean();
	}
}

