<form name="adminForm" action="<?php echo base_url();?>index.php/admin_account/update_admin_account" method="post">
First Name: <input type="text" name="name_first" value="<?php echo $name_first; ?>" required/><span name="spanName_first"></span><br/>
Middle Name: <input type="text" name="name_middle" value="<?php echo $name_middle; ?>" required/><span name="spanName_middle"></span><br/>
Last Name: <input type="text" name="name_last" value="<?php echo $name_last; ?>" required/><span name="spanName_last"></span><br/>
<input type="submit" value="Submit"/>
</form>
<a href="<?php echo base_url();?>index.php/user_account/backtohome">Back</a>