	<li> <a> Hi <?php echo $_SESSION['username']; ?> </a> </li>

	<li>
		<a href="<?php echo base_url();?>index.php/user_account/update_account">Update your profile</a>
	</li>
	<li>
		<a href="<?php echo base_url();?>index.php/user_account/logout">Log-out</a>
	</li>
