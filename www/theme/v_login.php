<?php

$mass=$_SESSION['mass'];


?>
 <?php if(isset($mass)){ ?><p><h3 style="color: red"><?php echo  c_base::tr($mass, $this->language);?>!!!</h3></p><?php }?>
<form method="POST" action="#">
<table>
<tr>
    <td><?php echo  c_base::tr('Write login', $this->language);?>:</td><td><input value="<?=$_SESSION['log'];?>" type="text" name="login" class="input"/></td>
</tr>
<tr>
	<td><?php echo  c_base::tr('Password', $this->language);?>:</td><td><input type="password" name="password" class="input"/></td>
</tr>
<tr>
    <td><input type="checkbox" value="on" name="remember"/> <?php echo  c_base::tr('Remember', $this->language);?></td><td></td>
</tr>
<tr>
    <td><input class="sub" name="log" type="submit" value="<?php echo  c_base::tr('Send', $this->language);?>"></td><td><a href="index.php?c=recover"><?php echo  c_base::tr('Forgot password', $this->language);?>?</a></td>
</tr>
</table>
</form>

