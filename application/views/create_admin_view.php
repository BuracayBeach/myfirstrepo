<form name="adminForm" action="<?php echo base_url();?>index.php/admin_account/create_admin_account" method="post" >
	Username: <input type="text" name="username" required/><span name="span username"></span><br/>
	Password: <input type="password" name="password" required/><span name="span password"></span><br/>
	Retype Password: <input type="password" name="repassword" required/><span name="span repassword"></span><br/>
	First Name: <input type="text" name="name_first" required/><span name="span name_first"></span><br/>
	Middle Name: <input type="text" name="name_middle" required/><span name="span name_middle"></span><br/>
	Last Name: <input type="text" name="name_last" required/><span name="span name_last"></span><br/>
	<input type="Submit" value="Submit"/>
</form>
<a href="<?php echo base_url();?>index.php/admin_account/adminlogin">Back</a>
<script src="<?php echo base_url(); ?>js/create_admin.js"></script>
<script src="<?php echo base_url();?>js/vendor/jquery.js"></script>