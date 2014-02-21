Hi <?php
if (isset($_SESSION['admin_username']))
	 echo $_SESSION['admin_username']; 
	
?> </br>

<ul>
	<li>
		<a href="<?php echo base_url();?>index.php/admin_account/update">Update</a>
	</li>
	<li>
		<a href="<?php echo base_url();?>index.php/admin_account/logout">Log-out</a>
	</li>
</ul>
