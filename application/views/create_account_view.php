<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Input Forms</title>
	</head>
	
	<body>
		<form name="userForm" action="<?php echo base_url();?>index.php/user_account/createaccount" method="post" >
			
			<div id="container">
				<h1>Input Forms</h1>

				<div id="body">
					Username: <input type="text" name="username" required/><span name="spanUsername"></span><br/>
					Password: <input type="password" name="password" required/><span name="spanPassword"></span><br/>
					Retype Password: <input type="password" name="repassword" required/><span name="spanRepassword"></span><br/>
					Sex: <input type="radio" name="sex" value="male" id="male" checked/>
						 <label for="male">Male</label>
						 <input type="radio" name="sex" value="female" id="female"/>
						 <label for="female">Female</label><br/>

					Email: <input type="text" name="email" required/><span name="spanEmail"></span><br/>
					User Type: <input type="radio" name="usertype" value="student" id="student" checked/>
						 <label for="student">Student</label>
						 <input type="radio" name="usertype" value="employee" id="employee" />
						 <label for="employee">Employee</label><br/>
					Employee Number:<input type="text" name="emp_no" id="emp_no" /><span name="spanEmp_no"></span><br/>
					Student Number: <input type="text" name="student_no" id="student_no" /><span name="spanStudent_no"></span><br/>
					First Name: <input type="text" name="name_first" required/><span name="spanName_first"></span><br/>
					Middle Name: <input type="text" name="name_middle" required/><span name="spanName_middle"></span><br/>
					Last Name: <input type="text" name="name_last" required/><span name="spanName_last"></span><br/>
					Mobile Number: <input type="text" name="mobile_no" required /><span name="spanMobile_no"></span><br/>
					College: 
					<select name="college">
						<option value="CA">CA (College of Agriculture)</option>
						<option value="CAS">CAS (College of Arts and Sciences)</option> 
						<option value="CDC">CDC (College of Development Communication)</option>
						<option value="CEM">CEM (College of Economics and Management)</option>
						<option value="CEAT">CEAT (College of Engineering and Agro-Industrial Technology)</option>
						<option value="CFNR">CFNR (College of Forestry and Natural Resources)</option>	
						<option value="CHE">CHE (College of Human Ecology)</option>	
						<option value="CVM">CVM (College of Veterinary Medicine)</option>
					</select>
					Course:
					<select name="course" id="course" >
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
					</select></br>

					<input type="Submit" value="Submit" />
				</div>
			</div>
		</form>
		<a href="<?php echo base_url();?>index.php/user_account/backtohome">Back</a>
		<script src="<?php echo base_url(); ?>js/create_account.js"></script>
	</body>
</html>