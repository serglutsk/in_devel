<?php
// контролер який відповідає за виведення контактів
 require_once("class.model.php");


class c_contact extends c_base
{
	private $text;	// текст
        
	
	function __construct()
	{   $this->needLogin = FALSE;
	}

	//
	// віртуальний обробник запиту
	//
	
	 function OnInput()
	{
		parent::OnInput();
		$this->title = 'WEB-technology '.c_base::tr('Contact', $this->language);
		     $this->text=$this->model->sql();
                    if(count($this->text)==0)
                    $this->text='404 Page not found!'; 

	}

	//
	// віртуальний генератор HTML.
	//
	protected function OnOutput()
	{
		$vars = array('text' => $this->text,
                                );
		$this->content = $this->Template('theme/v_contact.php', $vars);
		parent::OnOutput();
	}
}




