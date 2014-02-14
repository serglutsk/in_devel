<?php

 require_once("class.model.php");
 
  
// контроллер новини конкретної або останніх 3 новин 
//
class c_onenews extends c_base
{
	private $text;	// текст
        private $i;//ідентифікатор статті
        //
	// Конструктор.
	//
	function __construct($i)
	{    $this->needLogin = FALSE;
             $this->i=$i;
             
	}

	//
	// 
	//
	
	 function OnInput($id)
	{
		parent::OnInput();
		$this->title ='WEB-technology '.c_base::tr('News', $this->language);
		     $this->text=$this->model->getOneNews($this->i);
                     if(count($this->text)==0)$this->text='404 Page not found!';

	}

	//
	// 
	//
	protected function OnOutput()
	{
		$vars = array('text' => $this->text);
		$this->content = $this->Template('theme/v_news.php', $vars);
		parent::OnOutput();
	}
}

