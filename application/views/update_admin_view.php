<div id="update_admin_profile_container">
<form role="form" name="adminForm" action="<?php echo base_url();?>index.php/admin_account/update_admin_account" method="post">
	<div class="form-group">First Name: <input class="form-control" type="text" name="name_first" value="<?php echo $name_first; ?>" required/><span name="span name_first"></span></div>
	<div class="form-group">Middle Name: <input class="form-control" type="text" name="name_middle" value="<?php echo $name_middle; ?>" required/><span name="span name_middle"></span></div>
	<div class="form-group">Last Name: <input class="form-control" type="text" name="name_last" value="<?php echo $name_last; ?>" required/><span name="span name_last"></span></div>
	<input type="submit" value="Submit" class="btn btn-default" />
</form>
<form name="adminPasswordForm" action="<?php echo base_url();?>index.php/admin_account/admin_change_password" method="post">
	<div class="form-group">Current password : <input class="form-control" type="password" name="currentPassword" required/><span name="span currentpassword"></span></div>
	<div class="form-group">New password : <input class="form-control" type="password" name="newPassword" required/><span name="span newpassword"></span></div>
	<div class="form-group">Re-enter new password : <input class="form-control" type="password" name="newRePassword" required/><span name="span newrepassword"></span></div>
	<input type="submit" value="Change" class="btn btn-default" />
</form>
</div>
<script src="<?php echo base_url(); ?>js/update_admin.js"></script>
<script src="<?php echo base_url();?>js/vendor/jquery.js"></script>