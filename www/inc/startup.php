<?php
//
//клас для підключення до бази даних
//
require_once("inc/config.php");
class startup extends config{
static function connect(){
 	try{

	        $db = new PDO('mysql:host='.self::HOST.';dbname='.self::DB,self::USER,self::PASS);
         	//виставляємо роботу з помилками
         	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         	//встановлюємо кодування
         	$db->query("SET NAMES utf8");
			
			}
		catch(PDOException $e){
			die("Error: ".$e->getMessage());
	 }
	return $db;
  	}
  }

