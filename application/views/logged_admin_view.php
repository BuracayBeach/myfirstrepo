<a href="<?php echo base_url();?>index.php/admin_account/logout">
	<div class="menulinks">
		Log-out
	</div>
</a>
<a href="<?php echo base_url();?>update_admin">
	<div class="menulinks">
		Update Profile
	</div>
</a>
<?php if($_SESSION['admin_username'] == "admin") echo "
<a href='#'> 
	<div class='menulinks'> 
		Delete an Admin 
	</div>
</a>"
?>
<a href="<?php echo base_url();?>admin_account/create_admin">
	<div class="menulinks">
		Create New Admin
	</div>
</a>