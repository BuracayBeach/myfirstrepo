<form action = "<?php echo base_url();?>index.php/admin_account/admin_login" method = "post">
	<input type = "text" name="username" placeholder="username"/>
	<input type = "password" name="password" placeholder="password"/>
	<input type = "submit" name="submit"/>
</form>
<a href="<?php echo base_url();?>index.php/admin_account/create_admin" >Create Admin</a>