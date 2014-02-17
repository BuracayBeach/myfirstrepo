<form action = "<?php echo base_url();?>index.php/user_account/login" method = "post">
	<input type = "text" name="username"/>
	<input type = "password" name="password"/>
	<input type = "submit" name="submit"/>
</form>
<a href="<?php echo base_url();?>index.php/user_account/create" >Create Account</a>