<?php
//контроллер авторизації




class c_login extends c_base
{
	private $text;	// текст
         //повідомлення
        //
	// Конструктор.
	//
	function __construct()
	{
	}

        
        public static function tryLogin($arr){
             $model=model::Instance();
             $model->ClearSessions();
            //
            //вихід
            //
            $model->Logout();
            if(!empty($arr['login']) && !empty($arr['password']) ){
                if ($model->login($arr['login'],
                               $arr['password'],
                                               isset($arr['remember'])))
                 {   
                    header('Location: index.php');
                    die();
                    }else {
                        session_start();
                        $_SESSION['mass']="Error Authorization";
                        $_SESSION['log']=$arr['login'];
                        header('Location: index.php?c=login');
                               
            }
            
                    }else{
                        session_start();
                        $_SESSION['mass']="Error Authorization";
                        $_SESSION['log']=$arr['login'];
                        header('Location: index.php?c=login');
                    }
          }
          //
	
	//
	//protected
	 function OnInput()
	{
                
                   
                parent::OnInput();
		$this->title = 'WEB-technology '.c_base::tr('Login', $this->language);
		     $this->text="";

	}

	//
	
	//
	protected function OnOutput()
	{
		$vars = array('text' => $this->text,
                                );
		$this->content = $this->Template('theme/v_login.php', $vars);
		parent::OnOutput();
	}
}
if($_POST['log']){
    
    c_login::tryLogin($_POST);
}
