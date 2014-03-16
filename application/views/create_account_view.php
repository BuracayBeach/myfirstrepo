<div class="create_acc_container" id="container">

	<form role="form" class="<?php
		if(isset($_SESSION['create_account_notif'])){
			echo $_SESSION['create_account_notif'];
			}?>" name="userForm" action="<?php echo base_url();?>index.php/user_account/createaccount" method="post" >
		<h1>Sign Up</h1>
		<div id="body">
			Username: <div class="form-group"><input class="form-control" type="text" name="username" title="6 to 18 characters only." required/><span name="span username"></span></div>
			Password: <div class="form-group"><input class="form-control" type="password" name="password" title="6 to 18 characters only." required/><span name="span password"></span></div>
			Retype Password: <div class="form-group"><input class="form-control" type="password" name="repassword" title="6 to 18 characters only." required/><span name="span repassword"></span></div>
			Sex: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="radio" name="sex" value="male" id="male" checked/>
				 <label for="male">Male</label>&nbsp;&nbsp;
				 <input type="radio" name="sex" value="female" id="female"/>
					 <label for="female">Female</label><br/>
			Email: <div class="form-group"><input class="form-control" type="text" name="email" placeholder="e.g. student@school.com" required/><span name="span email"></span></div><br>
			User Type: &nbsp;&nbsp;&nbsp; 
				<input type="radio" name="usertype" value="student" id="student" checked/>
				 <label for="student">Student</label> &nbsp;&nbsp;
				 <input type="radio" name="usertype" value="employee" id="employee" />
				 <label for="employee">Employee</label><br/>
			<div class="form-group">Employee Number:<input class="form-control" type="text" name="emp_no" id="emp_no" placeholder="e.g. 048183948" /><span name="span emp_no"></span><div>
			<div class="form-group">Student Number: <input class="form-control" type="text" name="student_no" id="student_no" placeholder="e.g. 2012-24871" /><span name="span student_no"></span><div>
			<div class="form-group">First Name: <input class="form-control" type="text" name="name_first" required/><span name="span name_first"></span><div>
			<div class="form-group">Middle Name: <input class="form-control" type="text" name="name_middle" required/><span name="span name_middle"></span><div>
			<div class="form-group">Last Name: <input class="form-control" type="text" name="name_last" required/><span name="span name_last"></span><div>
			<div class="form-group">Mobile Number: <input class="form-control" type="text" name="mobile_no" placeholder="e.g. 639351678372" required /><span name="span mobile_no"></span><div>
			College: 
			<select name="college" class="form-control">
				<option value="GS">GS (Graduate School)</option>
				<option value="CA">CA (College of Agriculture)</option>
				<option value="CAS">CAS (College of Arts and Sciences)</option> 
				<option value="CDC">CDC (College of Development Communication)</option>
				<option value="CEM">CEM (College of Economics and Management)</option>
				<option value="CEAT">CEAT (College of Engineering and Agro-Industrial Technology)</option>
				<option value="CFNR">CFNR (College of Forestry and Natural Resources)</option>	
				<option value="CHE">CHE (College of Human Ecology)</option>	
				<option value="CVM">CVM (College of Veterinary Medicine)</option>
				<option value="NA" id="NA">Not Available</option>
			</select><br>
			Course:
			<select name="course" id="course" class="form-control">
				<option value="MVE" id="MVE" >Master in Veterinary Epidemiology</option>
				<option value="MF" id="MF" >Master of Forestry</option>
				<option value="MIT" id="MIT" >Master of Information Technology</option>
				<option value="MA" id="MA" >Master of Arts</option>
				<option value="MCA" id="MCA" >Master of Communication Arts</option>
				<option value="MAg" id="MAg" >Master of Agriculture</option>
				<option value="MM" id="MM" >Master of Management</option>
				<option value="MDMG" id="MDMG" >Master of Development Management and Governance</option>
				<option value="MPA" id="MPA" >Master in Public Affairs</option>
				<option value="MPS" id="MPS" >Master in Professional Studies</option>
				<option value="MS" id="MS" >Master of Science</option>
				<option value="PhD" id="PhD" >Doctor of Philosophy</option>
				<option value="PhDR" id="PhDR" >Doctor of Philosophy by Research</option>
				<option value="BSABT" id="BSABT" >BS Agricultural Biotechnology</option>
				<option value="BSABM" id="BSABM" >BS Agribusiness Management</option>
				<option value="BSABE" id="BSABE" >BS Agricultural and Biosystems Engineering</option>
				<option value="BSAC" id="BSAC" >BS Agricultural Chemistry</option>	
				<option value="BSAE" id="BSAE" >BS Agricultural Economics</option>
				<option value="BSA" id="BSA" >BS Agriculture</option>
				<option value="BSAM" id="BSAM" >BS Applied Mathematics</option>
				<option value="BSAP" id="BSAP" >BS Applied Physics</option>
				<option value="BSB" id="BSB" >BS Biology</option>
				<option value="BSChE" id="BSChE" >BS Chemical Engineering</option>
				<option value="BSC" id="BSC" >BS Chemistry</option>
				<option value="BSCE" id="BSCE" >BS Civil Engineering</option>
				<option value="BSAC" id="BACA" >BA Communication Arts</option>
				<option value="BSCS" id="BSCS" >BS Computer Science</option>
				<option value="BSDC" id="BSDC" >BS Development Communication</option>
				<option value="BSE" id="BSE" >BS Economics</option>
				<option value="BSEE" id="BSEE" >BS Electrical Engineering</option>
				<option value="BSF" id="BSF" >BS Forestry</option>
				<option value="BSFT" id="BSFT" >BS Food Technology</option>
				<option value="BSHE" id="BSHE" >BS Human Ecology</option>
				<option value="BSIE" id="BSIE" >BS Industrial Engineering</option>
				<option value="BSM" id="BSM" >BS Mathematics</option>
				<option value="BSMST" id="BSMST" >BS Mathematics and Science Teaching</option>
				<option value="BSN" id="BSN" >BS Nutrition</option>
				<option value="BAP" id="BAP" >BA Philosophy</option>
				<option value="BAS" id="BAS" >BA Sociology</option>						
				<option value="BSS" id="BSS" >BS Statistics</option>
				<option value="BSVM" id="BSVM" >BS Vetererary Medicine</option>
				<option value="NA" id="None" >Not Available</option>
			</select></br>
			<input type="Submit" value="Submit" class="btn btn-default" />
		</div>

	</form>
</div>

<script src="<?php echo base_url(); ?>js/create_account.js"></script>

<?php 
	if(isset($_SESSION['create_account_notif'])){
		$duplicates = explode(" ", $_SESSION['create_account_notif']);
		$duplicates = array_filter(array_map('trim', $duplicates));
		
		for ($i=1; $i<count($duplicates)+1; $i++) {
			if($duplicates[$i] == "student_no")
				$duplicates[$i] = "student number";
			else if($duplicates[$i] == "emp_no")
				$duplicates[$i] = "employee number";
		}

		$duplicates = array_reverse($duplicates);
		$duplicates_comma_separated = implode(", ", $duplicates).".";

		echo"<script> alert('The following input/s already taken: $duplicates_comma_separated'); </script>";
		unset($_SESSION['create_account_notif']);
	}