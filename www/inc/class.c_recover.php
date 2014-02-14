<?php
//контроллер відновлення паролю
require_once("class.model.php");


class c_recover extends c_base
{
	private $text;	// текст
        public static $mass;
                
	function __construct()
	{   $this->needLogin = FALSE;
	}

	//
	// віртуальний обробник запиту
	//
	public static function sendEmail($arr) {
            if(!$arr['email']==''){
                $model=model::Instance();
                //перевіряємо чи є таке Email  
                $rez=$model->getEmail($arr['email']);
                
                
                if($rez){
                    //якщо є то генеруємо пароль та логін
                    $login=  $model->generateStr();
                    $pass=  $model->generateStr();
                    $message='login:'.$login.'---password:'.$pass;
                    $subject='in_devel';
                    mail($arr['email'],$subject, $message);
                    //міняємо пароль та логін в базі
                    $model->updateUser($login, $pass, $arr['email']);
                   self::$mass='Sent to the specified Email new login and password';
                   
                }else{
                   self::$mass='Said Email not found';
                  
                }
            }else{
               
            self::$mass='You have not provided Email';
            }
            
        }
	 function OnInput()
	{
		parent::OnInput();
		$this->title = 'WEB-technology '.c_base::tr('Recover', $this->language);
		    
                     

	}

	//
	// віртуальний генератор HTML.
	//
	protected function OnOutput()
	{
		$vars = array('text' => $this->text,
                               'mass'=> self::$mass );
		$this->content = $this->Template('theme/v_recover.php', $vars);
		parent::OnOutput();
	}
}
if($_POST['recover']){
   
    c_recover::sendEmail($_POST);
}


