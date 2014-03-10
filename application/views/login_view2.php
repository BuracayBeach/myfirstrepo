<form id="login" action = "<?php echo base_url();?>index.php/user_account/login" method = "post">
	<input type = "text" name="username" placeholder="username"/></div></li>
	<input type = "password" name="password" placeholder="password"/></div></li>
	<input type = "submit" name="submit" value="login"/></div></li>
</form>

<li class="right"><a href="<?php echo base_url();?>create_account" >Create Account</a></li>

<?php 
	if(isset($_SESSION['login_notif']) && $_SESSION['login_notif'] == "not_exists" ){
			echo "<script> alert('That username does not exist!'); </script>";
	}

	else if(isset($_SESSION['login_notif']) && $_SESSION['login_notif'] == "wrong_password" ){
			echo "<script> alert('Your password is incorrect!'); </script>";
	}

	unset($_SESSION['login_notif']);