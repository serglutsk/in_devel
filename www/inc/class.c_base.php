<?php
require_once('inc/class.controller.php');

//
// Базовий контроллер сайта.
//
 class c_base extends controller
{
	protected $title;		// заголовок сторінки
	protected $content;		// зміст сторінки
        public $model;		        //екземпляр класу моделі
        protected $needLogin;	        // необхідність авторизації
	protected $user;		// авторизованний користувач
        public  $language;              //мова за замовчуванням
        protected $id_role;             //ідентифікатор доступу
        public static $l;
        public static $mass;
        //
	// Конструктор.
	//
	function __construct()
	{     $this->needLogin = false;
              $this->user = null;
            
	}
        public static function tr($text,$lang) {
            $a=array(
                'Home'=>'Главная', 
                'News'=>'Новости',
                'Contact'=>'Контакты',
                'Language'=>'Язык',
                'Login'=>'Авторизация',
                'Logout'=>'Выход',
                'Registration'=>'Регистрация',
                'Created'=>'Дата создания',
                'Read more'=>'Читать полностью',
                'technology'=>'технологии',
                'Date'=>'Дата написания',
                'Write login'=>'Введите логин',
                'Password'=>'Пароль',
                'Remember'=>'Запомнить меня',
                'Send'=>'Отправить',
                'Fill in the fields for registration'=>'Заполните поля для регистрации',
                'Name'=>'Имя',
                'Email'=>'Ел. почта',
                'Admin'=>'Админ',
                'Error Authorization'=>'Ошибка при авторизации',
                'User with the login name already exists'=>'Пользователь с таким логином уже есть',
                'Incorrect Email'=>'Некорректный Email',
                'Please complete all fields marked with *'=>'Заполните все поля помечены *',
                'Forgot password'=>'Забыли пароль',
                'To recover a password, enter Email'=>'Чтобы восстановить пароль, введите адрес эл. почты',
                'Said Email not found'=>'Указаный Email не найден',
                'Sent to the specified Email new login and password'=>'На указанный Email отправлено новый логин и пароль',
                'You have not provided Email'=>'Вы не указали Emai',
                
            );
            
            if($lang=='ru'){
                foreach ($a as $key=>$w) {
                    if($text==$key){
                        $rez=$w;
                        break;
                    }
                }
           }  else {
              $rez=$text; 
           }
           return $rez; 
        }

	
	// віртуальний обробник запиту
	protected function OnInput()
	{     $this->model=model::Instance();
		$this->model->ClearSessions();
		$this->user=$this->model->user();
		$this->title = '';
		$this->content = '';
		// перенаправлення на сторінку авторизації при необхідності.
		if ($this->user == null && $this->needLogin)
		{
			header("Location: index.php?c=login");
			die();
		}
                $rez=  $this->model->get_users($this->user);
                foreach ($rez as $v) {
                    $this->id_role=$v['id_role'];
                }
                if(!empty(self::$l)){
                  $this->language=  self::$l;  
                }elseif (isset($_COOKIE['lang'])) {
                  $this->language= $_COOKIE['lang'];
                }
                else {$this->language='ru';}
                
	}

	//
	// віртуальний генератор HTML.
	//
	protected function OnOutput()
	{
		$vars = array('title' => $this->title, 'content' => $this->content);
		$page = $this->Template('theme/v_main.php', $vars);
		echo $page;
	}
}
