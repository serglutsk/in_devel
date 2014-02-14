<?php

class c_admin extends c_base
{
	private $text;	// текст
        private $users;//користувачі
        public static $mass;//повідомлення
        public static $arr; //масив з даними
        public static $but='nnews';//кнопка
        //
	// Конструктор.
	//
	function __construct()
	{
            $this->needLogin = true;//необхідність авторизації
           
            
	}
        public static function update_News($arr) {
           
            if(!empty($arr['title_ru'])&& !empty($arr['title_en']) && !empty($arr['about_ru']) && !empty($arr['about_en']) && !empty($arr['fulltext_ru'])&&
                !empty($arr['fulltext_en']) && !empty($arr['date'])){
                        if(strlen($arr['title_ru'])>100){
                            self::$mass='Поле: Название должно бить короче за 100 символов ';
                            self::$arr=$arr;
                            self::$but='update';
                           
                        }elseif (strlen($arr['title_en'])>100) {
                            self::$mass='Поле: Название должно бить короче за 100 символов ';
                            self::$arr=$arr;
                            self::$but='update';
                        }
                        
                          
                           
                          else {
                            
                                if(strlen($arr['about_en'])>150){
                                   $arr['about_en']= implode(array_slice(explode('<br>',wordwrap($arr['about_en'],150,'<br>',false)),0,1)).'...';
                                }
                                if(strlen($arr['about_ru'])>150){
                                   $arr['about_ru']= implode(array_slice(explode('<br>',wordwrap($arr['about_ru'],150,'<br>',false)),0,1)).'...';
                                }
                                $date= strtotime($arr['date']);;


                                $model=model::Instance();
                                $rez= $model->updateNews($arr['title_ru'],$arr['title_en'],$arr['about_ru'],
                                        $arr['about_en'], $arr['fulltext_ru'],$arr['fulltext_en'], $date, $arr['id'],$arr['id_author']);
                            if($rez){
                                header('Location:index.php?c=news'); 
                            }else{
                                self::$mass='Ошибка при добавлении даних в базу!';
                                  self::$arr=$arr; 
                                  self::$but='update';
                                 }
                        
                   }
        }
        else{
            self::$mass='Заполните все поля с * !!!';
            self::$arr=$arr;
            self::$but='update';
        }
        }
        
        //метод для загрезки даних про статю в форму
        public static function down_load($a) {
            $model=model::Instance();
            $rez=$model->getOneNews($a['id']);
            foreach ($rez as $key ) {
                self::$arr=$key;
                self::$but='update';
            }
        }
        
        public static function create_News($arr) {
            
        if(!empty($arr['title_ru'])&& !empty($arr['title_en']) && !empty($arr['about_ru']) && !empty($arr['about_en']) && !empty($arr['fulltext_ru'])&&
                !empty($arr['fulltext_en']) && !empty($arr['date'])){
                        if(strlen($arr['title_ru'])>100){
                            self::$mass='Поле: Название должно бить короче за 100 символов ';
                             self::$arr=$arr;
                            self::$arr=$arr;
                        }elseif (strlen($arr['title_en'])>100) {
                            self::$mass='Поле: Название должно бить короче за 100 символов ';
                             self::$arr=$arr;
                        }
                        
                          
                           
                          else {
                            
                                if(strlen($arr['about_en'])>150){
                                   $arr['about_en']= implode(array_slice(explode('<br>',wordwrap($arr['about_en'],150,'<br>',false)),0,1)).'...';
                                }
                                if(strlen($arr['about_ru'])>150){
                                   $arr['about_ru']= implode(array_slice(explode('<br>',wordwrap($arr['about_ru'],150,'<br>',false)),0,1)).'...';
                                }
                                $date= strtotime($arr['date']);;


                                $model=model::Instance();
                                $rez= $model->createNews($arr['title_ru'],$arr['title_en'],$arr['about_ru'],
                                        $arr['about_en'], $arr['fulltext_ru'],$arr['fulltext_en'], $date);
                            if($rez){
                                header('Location:index.php?c=news'); 
                            }else{
                                self::$mass='Ошибка при добавлении даних в базу!';
                                  self::$arr=$arr;    
                                 }
                        
                   }
        }
        else{
            self::$mass='Заполните все поля с * !!!';
            self::$arr=$arr;
        }
    }
    
    public function delNews($arr) {
        $this->model=model::Instance();
        
        $id=$arr['id'];
        $rez=$this->model->delNews($id);
        if($rez==TRUE){
        header('Location:index.php?c=admin'); }
    }
    public function delUser($arr) {
        $this->model=model::Instance();
        
        $id=$arr['id'];
        $rez=$this->model->delUser($id);
        if($rez==TRUE){
        header('Location:index.php?c=admin'); }
    }
    

	//
	
	//
	//protected
	 function OnInput()
	{
                
                   
                parent::OnInput();
                
                
               if ($this->id_role == 0 )//перевіряємо права доступу
		{
			header("Location: index.php?c=login");
                        setcookie('mass','У Вас недостаточно прав доступа!');
			die();
		}
                
		$this->title = 'WEB-технології Адмін';
                $this->text=$this->model->getAllNews();
                $this->users=  $this->model->getAllUsers();
                     

	}

	//
	
	//
	protected function OnOutput()
	{
		$vars = array('text' => $this->text,
                                'users'=>  $this->users,
                                'mass'=>  self::$mass,
                                'arr'=>  self::$arr,
                                 'but'=>  self::$but);
		$this->content = $this->Template('theme/v_admin.php', $vars);
		parent::OnOutput();
	}
}
if($_POST['nnews']){
	
	c_admin::create_News($_POST);
     
}
elseif ($_POST['delnews']) {
        $n=new c_admin();
	$n->delNews($_POST);
}
elseif ($_POST['deluser']) {
        $n=new c_admin();
	$n->delUser($_POST);
}
elseif ($_POST['upnews']) {
    c_admin::down_load($_POST);
}
elseif ($_POST['update']) {
    c_admin::update_News($_POST);
}