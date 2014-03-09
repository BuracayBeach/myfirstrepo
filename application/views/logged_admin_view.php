<a href="<?php echo base_url();?>index.php/admin_account/logout">
	<div class="menulinks">
		Log-out
	</div>
</a>
<a href='<?php echo base_url();?>update_admin'>
	<div class="menulinks">
		Update Profile
	</div>
</a>
<?php
$url1 = base_url()."home/delete_admins";
$url2 = base_url()."home/create_admin";
 if($_SESSION['admin_username'] == "admin") echo "
<a href='{$url1}'> 
	<div class='menulinks'> 
		Delete an Admin 
	</div>
</a>
<a href='".base_url()."create_admin_account'>
	<div class='menulinks'>
		Create New Admin
	</div>
</a>";
?>
