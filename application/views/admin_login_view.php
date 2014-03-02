<link rel="stylesheet" href="<?php echo base_url();?>css/style_admin_login.css">

<div id="wrapper_admin">

	<div id="login_box">

		<form action = "<?php echo base_url();?>index.php/admin_account/admin_login" method = "post">

			<div class="login_container">
				<input class="login_input" type = "text" name="username" placeholder="username" size="27"/>
			</div>

			<div class="login_container">
				<input class="login_input" type = "password" name="password" placeholder="password" size="27"/>
			</div>

			<div class="login_container" id="submit_box">
				<input type = "submit" name="submit" value="Login" id="submit_button" />
			</div>

		</form>

	</div>

</div>