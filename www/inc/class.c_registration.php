<?php
//
//require_once("class.model.php");


class c_registration extends c_base
{
	private $text;	// текст
        public static $mass;//повідомлення
        //
	// Конструктор.
	//
	function __construct()
	{
	}
        
        public static function tryRegistration($arr) {
            if(!$arr['login']=='' && !$arr['email']=='' && !$arr['password']==''){
			if(!$arr['name']=='') $name=htmlspecialchars(trim($arr['name']));
			else $name="";
			$login=htmlspecialchars(trim($arr['login']));
			$email=htmlspecialchars(trim($arr['email']));
			//перевіряємо коректність електронної пошти
			if(preg_match("~^([a-z0-9_\-\.])+@([a-z0-9_\-\.])+\.([a-z0-9])+$~i", $email) == 0) $email='';

			$password=htmlspecialchars(trim($arr['password']));
			//створюємо екземпляр  об"єкта модель
			$model=model::Instance();
			//перевіримо чи є користувач з таким логіном
			$data=$model->get_users($login);
			foreach ($data as $w){
                        if($w['login'] == $login){
                                $login="";
                                break;
                        }
                        }
			if($login==""){
                            self::$mass= "User with the login name already exists";
                              
			}elseif($email==''){
				self::$mass= "Incorrect Email";
                              
			}else{
				//якщо дані були коректними тоді записуємо їх в базу даних
				$id_user=$model->set_user($name,$login,$email,$password);
                                //записуємо дані в таблицю з сесіями та отримуємо унікальний індитифікатор
                                $sid=$model->set_sission($id_user);
                                session_start();
                                $time=3600;
                                setcookie("login",$login,time()+$time);
                                setcookie("password",sha1($password),time()+$time);
                                $_SESSION['sid']=$sid;
                                header("Location:index.php");
			
		}
            }else {
                self::$mass= "Please complete all fields marked with *";
               
            }
        }
	//
	// Виртуальный обработчик запроса.
	//
	//protected
	 function OnInput()
	{
		parent::OnInput();
		$this->title = 'WEB-technology '.c_base::tr('Registration', $this->language);
		     $this->text="";

	}

	//
	// Виртуальный генератор HTML.
	//
	protected function OnOutput()
	{
		$vars = array('text' => $this->text,
                                'mass'=>self::$mass);
		$this->content = $this->Template('theme/v_registration.php', $vars);
		parent::OnOutput();
	}
}
if($_POST['submit']){
    
    c_registration::tryRegistration($_POST);
}
