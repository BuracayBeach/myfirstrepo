Hi <?php echo $_SESSION['username']; ?> </br>

<ul>
	<li>
		<a href="<?php echo base_url();?>index.php/user_account/getData">Update your profile</a>
	</li>
	<li>
		<a href="<?php echo base_url();?>index.php/user_account/logout">Log-out</a>
	</li>
</ul>
