<?php
//
 //Шаблон сторінки з статею
 //* $text - масив який отримуємо з бази даних
if(is_array($text)){
 foreach($text as $w){
 echo "<p>".nl2br($w['contact_'.$this->language]);

 }
}else    echo $text;
