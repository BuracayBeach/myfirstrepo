<li id="loginform" class="
	<?php
		if(isset($_SESSION['login_notif'])){
			echo 'invalid_user';
			unset($_SESSION['login_notif']);
		}
	?>
">
<form id="login" class="small-20" action = "<?php echo base_url();?>index.php/user_account/login" method = "post">
	<li><div class="column"><input class="error"type = "text" name="username" placeholder="username"/></div></li>
	<li><div class="column"><input type = "password" name="password" placeholder="password"/></div></li>
	<li><div class="column"><input type = "submit" name="submit" value="login"/></div></li>
</form>
</li>

<li class="right"><a href="<?php echo base_url();?>create_account" >Create Account</a></li>

