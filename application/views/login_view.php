<form  id="login" class="" action = "<?php echo base_url();?>index.php/user_account/login" method = "post">
	<div class="form-input">
		<input class="error form-control" type = "text" name="username" placeholder="Enter Username"/>
	</div>

	<div class="form-input">
		<input type = "password" name="password" class="form-control" placeholder="Enter Password" />
	</div>

	<input type = "submit" name="submit" value="login" class="btn btn-default" />
	<a href="<?php echo base_url();?>create_account" >Create Account</a></td>
	
</form>