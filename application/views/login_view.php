<form id="login" action = "<?php echo base_url();?>index.php/user_account/login" method = "post">
	<div><label>Username</label><br/><input type = "text" name="username" placeholder="username"/></div>
	<div><label>Password</label><br/><input type = "password" name="password" placeholder="password"/></div>
	<div style ="padding-top: 24px; height:75%"><br/><input type = "submit" name="submit" value="login"/></div>
</form>
<a href="<?php echo base_url();?>index.php/user_account/create_account" >Create Account</a>