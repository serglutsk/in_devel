<?php
//вид сорінки адміна
$masss=$_SESSION['mass'];

?>
<div id='accordion'>  
    <h3><a href="#">Менеджер новостей</a></h3>
  <div>
        <table class="ad">
            <?php foreach($text as $t){?>
            <tr>
                <td>ID:<?=$t['id'];?></td><td>Название:<?=$t['title_ru'];?> </td>
                <td>Дата публикации: <?=date('d-m-Y',$t['date']);?></td>
                <td>
                    <form action="#" method="POST">
                        <input type="hidden" value="<?=$t['id'];?>" name="id">
                        <input type="submit" name="delnews" value="Удалить">
                    </form>
                </td>
                <td>
                    <form action="#" method="POST">
                        <input type="hidden" value="<?=$t['id'];?>" name="id">
                        <input type="submit" name="upnews" value="Изменить">
                    </form>
                    
                </td>

                
            </tr>
            <?php }?>
        </table>
    </div>

    <h3><a href="#">Менеджер пользователей</a></h3>
    <div>
        <table class="ad">
            <?php foreach($users as $t){?>
            <tr >
                <td>Логин:<?=$t['login'];?> </td>
                <td>Статус: <?=$t['id_role'];?></td>
                <td>
                    <form action="#" method="POST">
                        <input type="hidden" value=<?=$t['id_user'];?> name="id">
                        <input type="submit" name="deluser" value="Удалить">
                    </form>
                </td>

                   
            </tr>
            <?php }?>
        </table>
    </div>
    <h3><a href="#">Добавить(Изменить) новость</a></h3>
    <div>
            <?php if(isset($mass)){
                 echo '<h3 style="color:red">'.$mass.'</h3><br>';
                
            }?>
            <form  action="#" method="POST">
                <table class="ad">
                    <tr>
                        <td><label>Назва*:</label></td><td><input type="text" name="title_ru" value="<?php print $arr['title_ru']; ?>"></td>
                    </tr>
                    <tr>
                        <td><label>Title*:</label></td><td><input type="text" name="title_en" value="<?php print $arr['title_en']; ?>"></td>
                    </tr>
                     <tr>
                         <td><label>Краткое описание*:</label></td><td><textarea style="width: 600px; height: 200px" name="about_ru" ><?php print $arr['about_ru']; ?></textarea></td>
                    </tr>
                    <tr>
                        <td><label>About*:</label></td><td><textarea name="about_en" style="width: 600px; height: 200px" ><?php print $arr['about_en']; ?></textarea></td>
                    </tr>
                     <tr>
                         <td><label>Полный текст*:</label></td><td><textarea style="width: 600px; height: 200px" name="fulltext_ru" ><?php print $arr['fulltext_ru']; ?></textarea></td>
                    </tr>
                    <tr>
                        <td><label>Fulltext*:</label></td><td><textarea style="width: 600px; height: 200px" name="fulltext_en" ><?php print $arr['fulltext_ru']; ?></textarea></td>
                    </tr>
                    <tr>
                        <td><label>Дата*:</label></td><td><input type="text" name="date" id="datepicker" value="<?php print date('d.m.Y',$arr['date']);?>"></td>
                    </tr>
                    <tr>
                        <td><input type="submit" name="<?php print $but;?>" value="Сохранить"></td><td><input type="hidden" name="id" value="<?php print $arr['id']; ?>"><input type="hidden" name="id_author" value="<?php print $arr['id_author']; ?>"></td>
                    </tr>
                </table>
            </form>
    </div>
</div>
<script src="js/js.js"></script> 