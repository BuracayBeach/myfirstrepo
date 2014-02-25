<div class="signup small-7 column">
<form name="adminForm" action="<?php echo base_url();?>index.php/admin_account/update_admin_account" method="post">
	First Name: <input type="text" name="name_first" value="<?php echo $name_first; ?>" required/><span name="span name_first"></span><br/>
	Middle Name: <input type="text" name="name_middle" value="<?php echo $name_middle; ?>" required/><span name="span name_middle"></span><br/>
	Last Name: <input type="text" name="name_last" value="<?php echo $name_last; ?>" required/><span name="span name_last"></span><br/>
	<input type="submit" value="Submit"/>
</form>
<form name="adminPasswordForm" action="<?php echo base_url();?>index.php/admin_account/admin_change_password" method="post">
	Current password : <input type="password" name="currentPassword" required/><span name="span currentpassword"></span><br/>
	New password : <input type="password" name="newPassword" required/><span name="span newpassword"></span><br/>
	Re-enter new password : <input type="password" name="newRePassword" required/><span name="span newrepassword"></span><br/>
	<input type="submit" value="Change"/>
</form>
</div>
<script src="<?php echo base_url(); ?>js/update_admin.js"></script>
<script src="<?php echo base_url();?>js/vendor/jquery.js"></script>