<?php
//вид конкретної новини
if(is_array($text)){
foreach ($text as $v) {
    echo '<h3>'.$v['title_'.$this->language].'</h3>';
    echo '<p>'.$v['fulltext_'.$this->language].'</p>';
    echo '<p>Author: '.$v['name_user'].'</p>';
    echo  c_base::tr('Date', $this->language).': '.date('d-m-Y',$v['date']);;
}
}else    echo $text;

