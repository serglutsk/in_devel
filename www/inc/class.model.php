<?php
//
// головна модель для роботи з базою даних
//
require_once("inc/startup.php");

  class model {
 	public static $instance; 	//  экземпляр класса
	

        private $sid;				// ідентифікатор текущої сессії
	private $uid;				// права доступу до сайту
	

	//
	// Получение единственного экземпляра (одиночка)
	// отримання единого екземпляру(одиночка)
	public static function Instance()
	{
		if (self::$instance == null)
			self::$instance = new model();

		return self::$instance;
	}

	//
	// Конструктор
	//
	public function __construct()
	{   $this->sid = null;
		$this->uid = null;
		
		$this->msql = new startup();
	}


    //
    //функція для вибірки даних для головної сторінки
    //
        public function sql($id=NULL){
            if($id==NULL){

                    $q="SELECT * FROM `main_page`";
            }else{

                    $q="SELECT * FROM `stati` WHERE `id`='".$id."'";
                    }

            $db=$this->msql->connect();
            $rov=$db->query($q)->fetchAll(PDO::FETCH_ASSOC);
            if(! $rov) die("Oшибка при получеии даных!".mysqli_error($this->connect));
            else {

                return $rov;
                    }
            }
            //
            //новини
            //*******************************
            //
            //отримання кількості записів 
            public function getCountNews() {
                try{
                    $db=$this->msql->connect();
                     $q='SELECT count(*) from tb_news';
             $rov=$db->query($q)->fetchAll(PDO::FETCH_ASSOC);
             return $rov;
                    
                }  catch (PDOException $e){
                      return $e->getMessage();
                }
                
            }
            
            
            //зміна новини
            public function updateNews($t_ru,$t_en,$a_ru, $a_en, $f_ru,$f_en, $d, $id,$id_a) {
                try{
                      $db=$this->msql->connect();
                     
                     $sql=$db->prepare("UPDATE `tb_news` SET `date`=:d,`title_ru`=:t_ru,"
                             . "`title_en`=:t_en,`about_ru`=:a_ru,`about_en`=:a_en,"
                             . "`fulltext_ru`=:f_ru,`fulltext_en`=:f_en,`id_author`=:id_a WHERE id=:id");
                     $sql->bindParam(':d',$d,PDO::PARAM_INT);
                     $sql->bindParam(':id',$id,PDO::PARAM_INT);
                     $sql->bindParam(':id_a',$id_a,PDO::PARAM_INT);
                     $sql->bindParam(':t_ru',$t_ru,PDO::PARAM_STR);
                     $sql->bindParam(':t_en',$t_en,PDO::PARAM_STR);
                     $sql->bindParam(':a_ru',$a_ru,PDO::PARAM_STR);
                     $sql->bindParam(':a_en',$a_en,PDO::PARAM_STR);
                     $sql->bindParam(':f_en',$f_en,PDO::PARAM_STR);
                     $sql->bindParam(':f_ru',$f_ru,PDO::PARAM_STR);
                     

                      $sql->execute();
                      //отримання останьoго id
                      //$rov=$db->lastInsertId();
                      return TRUE;
                  }
                  catch(PDOException $e){
                      return $e->getMessage();
                  }
            }
         //видалення новини
            public function delNews($id) {
                try{
                      $db=$this->msql->connect();
                      $sql=$db->prepare("DELETE FROM `tb_news` WHERE id=:id");
                      $sql->bindParam(':id',$id,PDO::PARAM_INT);
                      $rez=$sql->execute();
                      return $rez;
                }
                catch(PDOException $e){
                      return $e->getMessage();
                }
            }  
         //створення новини
            public function createNews($t_ru,$t_en,$a_ru,$a_en,$f_ru,$f_en,$d) {
                try{
                      $db=$this->msql->connect();
                     
                      $sql=$db->prepare("INSERT INTO `tb_news`(`date`,
                                          `title_ru`, `title_en`, `about_ru`,
                                          `about_en`, `fulltext_ru`, `fulltext_en`)
                                          VALUES
                                          (:d,:t_ru,:t_en,:a_ru,:a_en,:f_ru,:f_en)");
                     $sql->bindParam(':d',$d,PDO::PARAM_INT);
                     $sql->bindParam(':t_ru',$t_ru,PDO::PARAM_STR);
                     $sql->bindParam(':t_en',$t_en,PDO::PARAM_STR);
                     $sql->bindParam(':a_ru',$a_ru,PDO::PARAM_STR);
                     $sql->bindParam(':a_en',$a_en,PDO::PARAM_STR);
                     $sql->bindParam(':f_en',$f_en,PDO::PARAM_STR);
                     $sql->bindParam(':f_ru',$f_ru,PDO::PARAM_STR);
                     

                      $sql->execute();
                      //отримання останьoго id
                      $rov=$db->lastInsertId();
                      return $rov;
                  }
                  catch(PDOException $e){
                      return $e->getMessage();
                  }
            }   
         //отримання всіх новин   
         public function getAllNews() {
              try{
                $q='SELECT `id` , `date` , `title_ru` , `title_en` , `about_ru` , `about_en` , `name_user`
                    FROM `tb_news` , `users`
                    WHERE `id_author` = users.id_user
                    ORDER BY date DESC';

            
             $db=$this->msql->connect();
             $rov=$db->query($q)->fetchAll(PDO::FETCH_ASSOC);
             return $rov;
             }  catch (PDOException $e){
                 return $e->getMessage();
             }
         }
        
        //отримання конкретної новини
        public function getOneNews($param) {
            try{
              $q='SELECT *
                    FROM `tb_news` , `users`
                    WHERE `id_author` = users.id_user and `id`='.$param;

            
                $db=$this->msql->connect();
                $rov=$db->query($q)->fetchAll(PDO::FETCH_ASSOC);
             return $rov;
             }  catch (PDOException $e){
                 return  $e->getMessage();
               
            }
        }
        //отримання десяти новин
        public function getListNews($s,$p) {
              try{
                $db=$this->msql->connect();
                $sql=$db->prepare("SELECT * FROM tb_news ORDER BY date DESC LIMIT :s , :p");
                $sql->bindParam(':p',$p,PDO::PARAM_INT);
                $sql->bindParam(':s',$s,PDO::PARAM_INT);
                $sql->execute();
                $rov= $sql->fetchAll();
            
             return $rov;
             }  catch (PDOException $e){
                 return $e->getMessage();
             }
        }
        //отримати три останні новини 
         public function getNews() {
             try{
           
            $q='SELECT * FROM tb_news ORDER BY date DESC LIMIT 0 , 3';

            
             $db=$this->msql->connect();
             $rov=$db->query($q)->fetchAll(PDO::FETCH_ASSOC);
             return $rov;
             }  catch (PDOException $e){
                 return $e->getMessage();
             }
         }
//користувачі
//*****************************************
//
	//отримання всіх користувачів
        public function getAllUsers() {
            try{
                $db=$this->msql->connect();
                $sql="SELECT * FROM users";
                $rov=$db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
                return $rov;
                
            }
            catch(PDOException $e){
                 return $e->getMessage();
            }
        }
        //видалення користувача
        public function delUser($id) {
                try{
                      $db=$this->msql->connect();
                      $sql=$db->prepare("DELETE FROM `users` WHERE id_user=:id");
                      $sql->bindParam(':id',$id,PDO::PARAM_INT);
                      $rez=$sql->execute();
                      return $rez;
                }
                catch(PDOException $e){
                      return $e->getMessage();
                }
            } 

    //функція для реєстрації  користувачів та вертає id
        public function set_user($n,$l,$e,$p){
            try{
                $db=$this->msql->connect();
                 //хешуємо пароль
                $r=sha1($p);
                $sql=$db->prepare("INSERT INTO `users`(`name_user`,
                                    `password`, `login`, `email`) VALUES
                                     (:n,:p,:l,:e)");
                $sql->bindParam(':n',$n,PDO::PARAM_STR);
                $sql->bindParam(':l',$l,PDO::PARAM_STR);
                $sql->bindParam(':p',$r);
                $sql->bindParam(':e',$e,PDO::PARAM_STR);

                 $sql->execute();
                 //отримання останьoго id
                 $rov=$db->lastInsertId();
                 return $rov;
             }
             catch(PDOException $e){
                 return $e->getMessage();
             }
	}
       
	//вибірка користувачів
	public function get_users($login){
		$db=$this->msql->connect();
		
                $login=mysql_escape_string($login);
                $sql="SELECT * FROM `users` WHERE `login`='".$login."'";
		
		$rov=$db->query($sql);
		if(! $rov) die("Oшибка при получеии даных!".mysqli_error($this->connect));
                else {

                    return $rov;
                }
	}

	//функція для запису сесійних даних
	function set_sission($id_user){
		$db=$this->msql->connect();
		$sid=$this->generateStr();
		$now=date('Y-m-d H:i:s');
		$time_start=$now;
		$time_last=$now;
		$sql="INSERT INTO `sessions`( `id_user`, `sid`, `time_start`, `time_last`) VALUES ('".$id_user."',
		'".$sid."','".$time_start."','".$time_last."')";
		$rov=$db->query($sql);
		if(! $rov) die("Oшибка при получеии даных!".mysqli_error($this->connect));
                else {
                    return $sid;
                        }

	}
	//генепація випадкової строки
	function generateStr($length = 10)
	{
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPRQSTUVWXYZ0123456789";
		$code = "";
		$clen = strlen($chars) - 1;

		while (strlen($code) < $length)
                $code .= $chars[mt_rand(0, $clen)];

		return $code;
	}
	//
	// Вихід з авторизації
	//
	public function logout()
	{
		setcookie('login', '', time() - 1);
		setcookie('password', '', time() - 1);
		unset($_COOKIE['login']);
		unset($_COOKIE['password']);
		unset($_SESSION['sid']);
		$this->sid = null;
		$this->uid = null;
	}
	//
	// Очистка сессій що не використовуються
	//
	public function clearSessions()
	{   $db=$this->msql->connect();
		$min = date('Y-m-d H:i:s', time() - 60 * 20);
  		$sql="DELETE FROM `sessions` WHERE time_last < '".$min."'";
		$db->query($sql);
	}
	//
	// Авторизація
	// $login 		- логин
	// $password 	- пароль
	// $remember 	- порібно записувати в куках
	// результат	- true или false
	//
	public function login($login, $password, $remember = true)
	{
		// витягуємо користувача з БД
		$data=$this->get_users($login);
                foreach($data as $w){
                    if($w['login']== $login){
                            $user=true;
                            break;
                    }else $user=NULL;
                }

		if ($user == null)
                    return false;

		$id_user = $w['id_user'];

		// провіряємо пароль
		if (!$w['password'] == sha1($password))
                    return false;

		// запоминаем имя и sha1(пароль)
		if ($remember)
		{
                    $expire = time() + 3600 * 24 * 100;
                    setcookie('login', $login, $expire);
                    setcookie('password', sha1($password), $expire);
		}
                else{
		// откриваєм сессію і записуємо SID
		$this->sid = $this->set_sission($id_user);
                session_start();
                $_SESSION['sid']= 789;//$this->sid;
                $time=3600;
                setcookie("login",$login,time()+$time);
                setcookie("password",sha1($password),time()+$time);
                
                
                }
		return true;
	}
	//
	//метод отримує користувача
	//
	function user(){
		//якщо $id_user невказаний тоді берем його з сесії
		 
                     if (isset($_COOKIE['login']))
		{
                $user = $this->get_users($_COOKIE['login']);
                foreach($user as $w){
                  if($w['password']==$_COOKIE['password']){
                        $sid = $this->set_sission($w['id_user']);
                        $r=$w['login'];
                        break;
                  }
		
                }	
               }
		return $r;

	}
	public function getEmail($e) {
             try{
                $db=$this->msql->connect();
                
                $sql=$db->prepare("SELECT * FROM `users` WHERE `email`=:e");
                
                $sql->bindParam(':e',$e,PDO::PARAM_STR);

                 $sql->execute();
                 $rov=$sql->fetch(PDO::FETCH_ASSOC);
                
                 return $rov;
             }
             catch(PDOException $e){
                 return $e->getMessage();
             }
        }
        public function updateUser($l, $p, $e) {
             try{
                $db=$this->msql->connect();
                 //хешуємо пароль
                $r=sha1($p);
                $sql=$db->prepare("UPDATE `users` SET `login`=:l,`password`=:p WHERE `email`=:e");
                
                $sql->bindParam(':l',$l,PDO::PARAM_STR);
                $sql->bindParam(':p',$r);
                $sql->bindParam(':e',$e,PDO::PARAM_STR);

                 $sql->execute();
                 //отримання останьoго id
                 $rov=$db->lastInsertId();
                 return $rov;
             }
             catch(PDOException $e){
                 return $e->getMessage();
             }
        }  
	
        
	
 }


