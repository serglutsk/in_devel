<?php
/*шаблон головної сторінки
 * $text - масив який отримуємо з бази даних
 */
if(is_array($text)){
 foreach($text as $w){
 echo "<br>";
 echo "<hr><br><h3>".$w['name_article_'.$this->language]."</h3><br>";
 echo "<p>".nl2br($w['ocherk_'.$this->language]).".......</p>";
 echo "<b>".c_base::tr('Created', $this->language).":</b> ".$w['date']."<br>";
 
}}
else    echo $text;?>
</div>

      <!-- Example row of columns -->
      <div class="row">
          <?php 
          if(is_array($news)){
              foreach ($news as $n){?>
        <div class="span4">
          <h2><?=$n['title_'.$this->language];?></h2>
          <p><?=$n['about_'.$this->language];?> </p>
          <?=date('d-m-Y',$n['date']);?>
          <p><a class="btn" href="index.php?c=onenews/<?=$n['id'];?>"><?php echo  c_base::tr('Read more', $this->language);?> &raquo;</a></p>
        </div>
          <?php }
          
          }
          ?>
      