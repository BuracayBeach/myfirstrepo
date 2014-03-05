<!--li id="loginform" class="
	<?php
		if(isset($_SESSION['login_notif']) && $_SESSION['login_notif'] == "not_exists" ){
			echo 'invalid_user';
			echo "<script> alert('Username does not exists!'); </script>";
			unset($_SESSION['login_notif']);
		}
	?>
"-->
<form id="login" class="" action = "<?php echo base_url();?>index.php/user_account/login" method = "post">
	<table>
		<tr>
			<td><label for="username">Username</label></td>
			<td><label for="password">Password</label></td>
		</tr>
		<tr>
			<td><input class="error" type = "text" name="username"/></td>
			<td><input type = "password" name="password"/></td>
			<td><input type = "submit" name="submit" value="login"/></td>
		</tr>
		<tr>
			<td><a href="<?php echo base_url();?>create_account" >Create Account</a></td>
		</tr>
	</table>
</form>
<!--/li-->



