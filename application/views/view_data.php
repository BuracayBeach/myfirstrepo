<!DOCTYPE html>
<html>
	<head>
		<title> ICS eLib </title>
		<meta charset="utf-8" />
		<link rel="stylesheet" href="index.css" />
	</head>
	<body>
		<form action="<?php echo base_url();?>index.php/user_account/getData" method="post" >
			<h1>View Data</h1>
		<?php
			//Display user details.
			echo $username."<br/>";
			echo $sex."<br/>";
			echo $email."<br/>";
			echo $usertype."<br/>";
			echo $emp_no."<br/>";
			echo $student_no."<br/>";
			echo $name_first."<br/>";			
			echo $name_middle."<br/>";
			echo $name_last."<br/>";
			echo $mobile_no."<br/>";
			echo $course."<br/>";
			echo $college."<br/>";
		?>
		</form>
		<a href="<?php echo base_url();?>index.php/user_account/getData">Update</a><br/>
	</body>
</html>