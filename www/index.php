<?php
session_start();
include_once('inc/class.c_base.php');
include_once('inc/class.c_view.php');

include_once ('inc/class.controller.php');
if($_POST['lan_ru']){
    c_base::$l=$_POST['lang'];
    setcookie('lang',$_POST['lang'], time()+3600*24*30);
    header('Location:'.$_POST['url']);
}
elseif ($_POST['lan_en']) {
    c_base::$l=$_POST['lang'];
    setcookie('lang',$_POST['lang'], time()+3600*24*30);
    header('Location:'.$_POST['url']);
}
if($_POST['log']){
   
    c_login::tryLogin($_POST);
}

//розбираємо URL
$url=$_SERVER["REQUEST_URI"];
$w= parse_url($url);

$path=$w['path'];    
$e=explode('/',$w['query']);

if(isset($e[1]))$i=$e[1];

if($w['path']=='/index.php' && $w['query']==''){
    $controller = new c_view();
}elseif($w['path']=='/' && $w['query']==''){
    $controller = new c_view(); 
}else{

switch ($e[0])
{
case 'c=news': $controller = new c_news($i);
	break;
case "c=admin": $controller= new c_admin();
	break;
case "c=contact": $controller= new c_contact();
	break;
case "c=onenews": $controller= new c_onenews($i);
	break;
case "c=registration": $controller= new c_registration();
	break;
case "c=login": $controller= new c_login();
	break;
case "c=logout": $controller= new c_logout();
	break;
case "c=recover": $controller= new c_recover();
	break;
default:
       
	$controller = new c_error();
}

}
$id=$GET['id'];

$controller->Request($id);


