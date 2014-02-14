<?php
// контролер який відповідає за виведення головної сторінки
 function __autoload($c_name){
   	require_once("class.{$c_name}.php");
   	}
 require_once("class.model.php");

class c_view extends c_base
{
	private $text;	// текст
        private $news; //новини
        
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
		$this->title = 'WEB-technology '.c_base::tr('Home', $this->language);
		$this->text=$this->model->sql();
                $this->news=  $this->model->getNews();
                if(count($this->text)==0 or count($this->news)==0){
                    $this->text='404 Page not found!';
                    $this->news=FALSE;
                }

	}

	//
	// віртуальний генератор HTML.
	//
	protected function OnOutput()
	{
		$vars = array('text' => $this->text,
                            'news'=> $this->news,
                            );
		$this->content = $this->Template('theme/v_view.php', $vars);
		parent::OnOutput();
	}
}

