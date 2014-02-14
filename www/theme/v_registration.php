<?php
//
//файл який виводить форму для регістрації
//


?>
<div id=regist >
    <?php if(isset($mass)){ ?><p><h3 style="color: red"><?php echo  c_base::tr($mass, $this->language);?>!!!</h3></p><?php }?>
  <p><?php echo  c_base::tr('Fill in the fields for registration', $this->language);?>:</p>
<form  action='#' method='post'>
  <table>
  <tr>
  <td>
      <label><?php echo  c_base::tr('Name', $this->language);?>: </label></td><td><input class='input' name='name' type='text'></td>
  </tr>
  <tr>
  <td>
      <label><?php echo  c_base::tr('Write login', $this->language);?>*:</label></td><td> <input class='input' name='login' type='text'></td>
  </tr>
  <tr>
  <td>
      <label><?php echo  c_base::tr('Email', $this->language);?>*:</label></td><td> <input class='input' name='email' type='email'></td>
  </tr>
  <tr>
  <td>
      <label><?php echo  c_base::tr('Password', $this->language);?>*: </label></td><td><input class='input' name='password' type='password'></td>
  </tr>
  <tr><td>
          <input  class='sub'  type='submit' name='submit' value="<?php echo  c_base::tr('Send', $this->language);?>"></td><td></td></tr>
  </table>
</form></div><div id=rez></div>

