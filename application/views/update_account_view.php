<div id="update_profile_container">

<form role="form" class="<?php
		if(isset($_SESSION['update_account_notif']) && $_SESSION['update_account_notif'] == "email")
			echo 'email';
	?>" name="userForm" action="<?php echo base_url();?>index.php/user_account/update" method="post" >
	<div id="container">
		<h1>Update Form</h1>

		<div id="body">
			Sex: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				 <input type="radio" name="sex" value="male" id="male"<?php if($sex=="male") echo " checked"; ?>/>
				 <label for="male">Male</label>&nbsp;&nbsp;&nbsp;
				 <input type="radio" name="sex" value="female" id="female"<?php if($sex=="female") echo " checked"; ?>/>
				 <label for="female">Female</label><br/>
			<div class="form-group">Email: <input class="form-control" type="text" name="email" value="<?php echo $email; ?>" required/><span name="span email"></span></div>
			<div class="form-group">First Name: <input class="form-control" type="text" name="name_first" value="<?php echo $name_first; ?>" required/><span name="span name_first"></span></div>
			<div class="form-group">Middle Name: <input class="form-control" type="text" name="name_middle" value="<?php echo $name_middle; ?>" required/><span name="span name_middle"></span></div>
			<div class="form-group">Last Name: <input class="form-control" type="text" name="name_last" value="<?php echo $name_last; ?>" required/><span name="span name_last"></span></div>
			<div class="form-group">Mobile Number: <input class="form-control" type="text" name="mobile_no" name="name_last" value="<?php echo $mobile_no; ?>" required /><span name="span mobile_no"></span></div>
			College: 
			<select class="form-control" name="college" >	
				<option value="GS"<?php if($college=="GS") echo " selected"; ?>>GS (Graduate School)</option>					
				<option value="CA"<?php if($college=="CA") echo " selected"; ?>>CA (College of Agriculture)</option>
				<option value="CAS"<?php if($college=="CAS") echo " selected"; ?>>CAS (College of Arts and Sciences)</option> 
				<option value="CDC"<?php if($college=="CDC") echo " selected"; ?>>CDC (College of Development Communication)</option>
				<option value="CEM"<?php if($college=="CEM") echo " selected"; ?>>CEM (College of Economics and Management)</option>
				<option value="CEAT"<?php if($college=="CEAT") echo " selected"; ?>>CEAT (College of Engineering and Agro-Industrial Technology)</option>
				<option value="CFNR"<?php if($college=="CFNR") echo " selected"; ?>>CFNR (College of Forestry and Natural Resources)</option>	
				<option value="CHE"<?php if($college=="CHE") echo " selected"; ?>>CHE (College of Human Ecology)</option>	
				<option value="CVM"<?php if($college=="CVM") echo " selected"; ?>>CVM (College of Veterinary Medicine)</option>
				<option value="NA"<?php if($college=="NA") echo " selected"; ?>>Not Available</option>
			</select><br/>
			Course:
			<select class="form-control" name="course" id="course">
				<option value="MVE" id="MVE"<?php if($course=="MVE") echo " selected"; ?>>Master in Veterinary Epidemiology</option>
				<option value="MF" id="MF"<?php if($course=="MF") echo " selected"; ?>>Master of Forestry</option>
				<option value="MIT" id="MIT"<?php if($course=="MIT") echo " selected"; ?>>Master of Information Technology</option>
				<option value="MA" id="MA"<?php if($course=="MA") echo " selected"; ?>>Master of Arts</option>
				<option value="MCA" id="MCA"<?php if($course=="MCA") echo " selected"; ?>>Master of Communication Arts</option>
				<option value="MAg" id="MAg"<?php if($course=="MAg") echo " selected"; ?>>Master of Agriculture</option>
				<option value="MM" id="MM"<?php if($course=="MM") echo " selected"; ?>>Master of Management</option>
				<option value="MDMG" id="MDMG"<?php if($course=="MDMG") echo " selected"; ?>>Master of Development Management and Governance</option>
				<option value="MPA" id="MPA"<?php if($course=="MPA") echo " selected"; ?>>Master in Public Affairs</option>
				<option value="MPS" id="MPS"<?php if($course=="MPS") echo " selected"; ?>>Master in Professional Studies</option>
				<option value="MS" id="MS"<?php if($course=="MS") echo " selected"; ?>>Master of Science</option>
				<option value="PhD" id="PhD"<?php if($course=="PhD") echo " selected"; ?>>Doctor of Philosophy</option>
				<option value="PhDR" id="PhDR"<?php if($course=="PhDR") echo " selected"; ?>>Doctor of Philosophy by Research</option>
				<option value="BSABT" id="BSABT"<?php if($course=="BSABT") echo " selected"; ?>>BS Agricultural Biotechnology</option>
				<option value="BSABM" id="BSABM"<?php if($course=="BSABM") echo " selected"; ?>>BS Agribusiness Management</option>
				<option value="BSABE" id="BSABE"<?php if($course=="BSABE") echo " selected"; ?>>BS Agricultural and Biosystems Engineering</option>
				<option value="BSAC" id="BSAC"<?php if($course=="BSAC") echo " selected"; ?>>BS Agricultural Chemistry</option>	
				<option value="BSAE" id="BSAE"<?php if($course=="BSAE") echo " selected"; ?>>BS Agricultural Economics</option>
				<option value="BSA" id="BSA"<?php if($course=="BSA") echo " selected"; ?>>BS Agriculture</option>
				<option value="BSAM" id="BSAM"<?php if($course=="BSAM") echo " selected"; ?>>BS Applied Mathematics</option>
				<option value="BSAP" id="BSAP"<?php if($course=="BSAP") echo " selected"; ?>>BS Applied Physics</option>
				<option value="BSB" id="BSB"<?php if($course=="BSB") echo " selected"; ?>>BS Biology</option>
				<option value="BSChE" id="BSChE"<?php if($course=="BSChE") echo " selected"; ?>>BS Chemical Engineering</option>
				<option value="BSC" id="BSC"<?php if($course=="BSC") echo " selected"; ?>>BS Chemistry</option>
				<option value="BSCE" id="BSCE"<?php if($course=="BSCE") echo " selected"; ?>>BS Civil Engineering</option>
				<option value="BACA" id="BACA"<?php if($course=="BACA") echo " selected"; ?>>BA Communication Arts</option>
				<option value="BSCS" id="BSCS"<?php if($course=="BSCS") echo " selected"; ?>>BS Computer Science</option>
				<option value="BSDC" id="BSDC"<?php if($course=="BSDC") echo " selected"; ?>>BS Development Communication</option>
				<option value="BSE" id="BSE"<?php if($course=="BSE") echo " selected"; ?>>BS Economics</option>
				<option value="BSEE" id="BSEE"<?php if($course=="BSEE") echo " selected"; ?>>BS Electrical Engineering</option>
				<option value="BSF" id="BSF"<?php if($course=="BSF") echo " selected"; ?>>BS Forestry</option>
				<option value="BSFT" id="BSFT"<?php if($course=="BSFT") echo " selected"; ?>>BS Food Technology</option>
				<option value="BSHE" id="BSHE"<?php if($course=="BSHE") echo " selected"; ?>>BS Human Ecology</option>
				<option value="BSIE" id="BSIE"<?php if($course=="BSIE") echo " selected"; ?>>BS Industrial Engineering</option>
				<option value="BSM" id="BSM"<?php if($course=="BSM") echo " selected"; ?>>BS Mathematics</option>
				<option value="BSMST" id="BSMST"<?php if($course=="BSMST") echo " selected"; ?>>BS Mathematics and Science Teaching</option>
				<option value="BSN" id="BSN"<?php if($course=="BSN") echo " selected"; ?>>BS Nutrition</option>
				<option value="BAP" id="BAP"<?php if($course=="BAP") echo " selected"; ?>>BA Philosophy</option>
				<option value="BAS" id="BAS"<?php if($course=="BAS") echo " selected"; ?>>BA Sociology</option>						
				<option value="BSS" id="BSS"<?php if($course=="BSS") echo " selected"; ?>>BS Statistics</option>
				<option value="BSVM" id="BSVM"<?php if($course=="BSVM") echo " selected"; ?>>BS Vetererary Medicine</option>
				<option value="NA" id="None"<?php if($course=="NA") echo " selected"; ?>>Not Available</option>
			</select></br>
			<input class="btn btn-default" type="submit" value="Submit" />
		</div>
	</div>
</form>

<?php 
	if(isset($_SESSION['update_account_notif']) && $_SESSION['update_account_notif'] == "email"){
		echo "<script> alert('Email input already exists.'); </script>";
		unset($_SESSION['update_account_notif']);
	}
	else if(isset($_SESSION['update_account_notif']) && $_SESSION['update_account_notif'] == "account_updated"){
		echo "<script> alert('Successfully updated account!'); </script>";
		unset($_SESSION['update_account_notif']);
	}
?>

<form role="form" class="<?php
		if(isset($_SESSION['change_password_notif']) && $_SESSION['change_password_notif'] == "pass")
			echo 'pass';
	?>" name="changePasswordForm" action="<?php echo base_url();?>index.php/user_account/change_password" method="post" >	
	<div id="container">
		<h1>Change Password</h1>
		<div id="body">
			<div class="form-group">Current Password: <input class="form-control" type="password" name="currentpassword" value="" required/><span name="span currentpassword"></span></div>
			<div class="form-group">New Password: <input class="form-control" type="password" name="newpassword" value=""required/><span name="span newpassword"></span></div>
			<div class="form-group">Retype New Password: <input class="form-control" type="password" name="renewpassword" value="" required/><span name="span renewpassword"></span></div>
			<input class="btn btn-default" type="submit" value="Change" />
		</div>
	</div>
</form>

<?php 
	if(isset($_SESSION['change_password_notif']) && $_SESSION['change_password_notif'] == "pass"){
		echo "<script> alert('Current password incorrect!'); </script>";
		unset($_SESSION['change_password_notif']);
	}
	else if(isset($_SESSION['change_password_notif']) && $_SESSION['change_password_notif'] == "password_changed"){
		echo "<script> alert('Successfully changed password!'); </script>";
		unset($_SESSION['change_password_notif']);
	}
?>

</div>

<script src="<?php echo base_url(); ?>js/update_account.js"></script>