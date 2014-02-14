<?php
//вид сорінки відновлення авторизації

?>
<h4><?php echo  c_base::tr('To recover a password, enter Email', $this->language);?>
 </h4>
<?php if(isset($mass)){ ?><p><h3 style="color: red"><?php echo  c_base::tr($mass, $this->language);?>!!!</h3></p><?php }?>

<form action="#" method="POST">
    <input type="email" name="email"><br>
    <input type="submit" name="recover" value=<?php echo  c_base::tr('Send', $this->language);?>>
</form>
