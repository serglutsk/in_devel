<?php
unset($_SESSION['arr']);
unset($_SESSION['mass']);
 require_once("class.model.php");
 
  
// контроллер новин
//
class c_news extends c_base
{
	private $text;	// текст
        private $num = 2; //число новин на сорінку
        private $page;//  кількість сторінок
        private $p=1;//активна сторінка
        private $pervpage;
        private $nextpage;
        private $page2left;
        private $page1left;
        private $page2right;
        private $page1right;
        private $i;
        //
	// Конструктор.
	//
	function __construct($i)
	{       $this->needLogin = FALSE;
                $this->i=$i;
             
	}

	//
	// 
	//
	
	 function OnInput()
	{
		parent::OnInput();
		$this->title ='WEB-technology '.c_base::tr('News', $this->language);
                //перевіряємо скільки є записів в базі
                $rez=  $this->model->getCountNews();
                foreach ($rez as $q){
                    $n=(int)$q['count(*)'];
                }
                if($n>$this->num){
                    //якщо записів більше виводим тільки перші $this->num
                   
                    if($this->i==0){
                        $start=0;
                        $this->i=1;
                    } 
                    else{
                        //вичисляємо з якого номера виводити новини
                    $start =$this->i * $this->num - $this->num; }
                    
                   $this->text=  $this->model->getListNews($start,$this->num);
                   //добавляємо пейджинг
                   if($n%$this->num==0){$this->page=intval($n/$this->num);}
                   else{$this->page=intval($n/$this->num)+1;}
                   
                   if ($this->i != 1){
                       $this->pervpage = "<a href=' ./index.php?c=news/1'>&lt;&lt;</a> 
                        <a href= './index.php?c=news/". ($this->i - 1) ."'>&lt;</a> ";}
                   if($this->i !=$this->page){
                       $this->nextpage = " <a href= './index.php?c=news/". ($this->i + 1) ."'>&gt;</a> 
                       <a href= './index.php?c=news/" .$this->page. "'>&gt;&gt; </a>";}
                   if($this->i - 2 > 0){
                       $this->page2left = " <a href= './index.php?c=news/". ($this->i - 2) ."'>". ($this->i - 2) ."</a> | "; }
                    if($this->i - 1 > 0){
                        $this->page1left = "<a href= './index.php?c=news/". ($this->i - 1) ."'>". ($this->i- 1) ."</a> | ";} 
                   if($this->i + 2 <= $this->page){
                       $this->page2right = " | <a href=' ./index.php?c=news/". ($this->i + 2) ."'>". ($this->i + 2) ."</a>";} 
                   if($this->i + 1 <= $this->page){
                       $this->page1right = " | <a href= './index.php?c=news/". ($this->i + 1) ."'>". ($this->i + 1) ."</a>";} 
                }else{
		     $this->text=$this->model->getAllNews();
                     $this->i=null;
                    if(count($this->text)==0) $this->text='404 Page not found!';
                
                }
	}

	//
	// 
	//
	protected function OnOutput()
	{
		$vars = array('text' => $this->text,
                                'i'=>  $this->i,
                                'pervpage'=>  $this->pervpage,
                                'nextpage'=>  $this->nextpage,
                                'page2left'=>  $this->page2left,
                                'page1left'=>  $this->page1left,
                                'page2right'=>  $this->page2right,
                                'page1right'=>  $this->page1right);
		$this->content = $this->Template('theme/v_newsAll.php', $vars);
		parent::OnOutput();
	}
}

