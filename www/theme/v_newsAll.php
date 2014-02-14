<?php
//вид для всіх новин
//var_dump($text);
if(is_array($text)){
 foreach ($text as $n){?>

          <h2><?=$n['title_'.$this->language];?></h2>
          <p><?=$n['about_'.$this->language];?> </p>
          <p>Author: <?=$n['name_user'];?></p>
          <?=date('d-m-Y',$n['date']);?>
          <p><a class="btn" href="index.php?c=onenews/<?=$n['id'];?>"><?php echo  c_base::tr('Read more', $this->language);?> &raquo;</a></p>
                 
 <?php }
 echo '<p style="text-align:center">'. $pervpage.$page2left.$page1left.'<b>'.$i.'</b>'.$page1right.$page2right.$nextpage.'</p>'; 
 }else    echo $text;
 ?>

