<a href="<?php echo base_url();?>index.php/admin_account/logout">
	<div class="menulinks ">
		Log-out
	</div>
</a>
<a href='<?php echo base_url();?>update_admin'>
	<div class="menulinks <?php if(isset($title) && $title == 'ComLib Update') echo 'menulinks-active';?>">
		Update Profile
	</div>
</a>
<?php
 if($_SESSION['admin_username'] == "admin"){ 

 	echo "
	<a href='".base_url()."delete_admins'> 
		<div class='menulinks ";

		if(isset($title) && $title == 'ComLib Admin Delete') echo 'menulinks-active';

	echo "'> 
			Delete an Admin 
		</div>
	</a>
	<a href='".base_url()."create_admin_account'>
		<div class='menulinks ";

		if(isset($title) && $title == 'ComLib Admin Create') echo 'menulinks-active';

	echo "'>
			Create New Admin
		</div>
	</a>";
}