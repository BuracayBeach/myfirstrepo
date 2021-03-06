<style rel="stylesheet">
	h1 {
		text-align: center;
	}

	div#create-admin-wrapper {
		width: 768px;
		margin: 0 auto;
	}

	form#create-admin {
		width: 480px;
		margin: 0 auto;
		padding-top: 50px;
	}
</style>

<div id="create-admin-wrapper">

	<h1>Create Admin</h1>
	<hr>

	<form role="form" name="adminForm" id="create-admin" action="<?php echo base_url();?>index.php/admin_account/create_admin_account" method="post" >

		<div class="form-group">
			Username:
			<input class="form-control" type="text" name="username" required/><span name="span username"></span>
		</div>

		<div class="form-group">
			Password:
			<input class="form-control" type="password" name="password" required/><span name="span password"></span>
		</div>

		<div class="form-group">
			Retype Password:
			<input class="form-control" type="password" name="repassword" required/><span name="span repassword"></span>
		</div>

		<div class="form-group">
			First Name:
			<input class="form-control" type="text" name="name_first" required/><span name="span name_first"></span>
		</div>

		<div class="form-group">
			Middle Name:
			<input class="form-control" type="text" name="name_middle" required/><span name="span name_middle"></span>
		</div>

		<div class="form-group">
			Last Name:
			<input class="form-control" type="text" name="name_last" required/><span name="span name_last"></span>
		</div>

		<input class="btn btn-default" type="Submit" value="Submit"/>

		<br><br>
	</form>

</div>


<script src="<?php echo base_url(); ?>js/create_admin.js"></script>

<?php 
	if(isset($_SESSION['create_admin_notif']) && $_SESSION['create_admin_notif'] == "create_admin_success") 
		echo "<script> alert('Successfully created admin!') </script>";
	
	else if(isset($_SESSION['create_admin_notif']) && $_SESSION['create_admin_notif'] == "username_exist")
		echo "<script> alert('Username already taken!') </script>";
	
	unset($_SESSION['create_admin_notif']);