<?php
//
class c_error extends c_base
{
	private $text;	// текст
       
        
        //
	// Конструктор.
	//
	function __construct()
	{
	}

	
	// віртуальний обробник запиту
	
	 function OnInput()
	{
		parent::OnInput();
		$this->title = 'WEB-technology '.c_base::tr('Error', $this->language);
		$this->text='404 Page not found!';
                

	}

	//
	// віртуальний генератор HTML.
	//
	protected function OnOutput()
	{
		$vars = array('text' => $this->text,
                           
                            );
		$this->content = $this->Template('theme/v_error.php', $vars);
		parent::OnOutput();
	}
}



