<?php
//контроллер виходу з авторизації

class c_logout extends c_base
{
	
	// Конструктор.
	//
	function __construct()
	{
	}

	//
	
	//
	//protected
	 function OnInput()
	{
                
                   
                parent::OnInput();
                $this->model->logout();
                $this->user=NULL;
                $this->id_role=NULL;
		unset($_SESSION['log']);
                unset($_SESSION['mass']);
                header("Location:index.php?c=login");

	}

	
}

