<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Input Forms</title>

		<style type="text/css">

		::selection{ background-color: #E13300; color: white; }
		::moz-selection{ background-color: #E13300; color: white; }
		::webkit-selection{ background-color: #E13300; color: white; }

		body {
			background-color: #fff;
			margin: 40px;
			font: 13px/20px normal Helvetica, Arial, sans-serif;
			color: #4F5155;
		}

		a {
			color: #003399;
			background-color: transparent;
			font-weight: normal;
		}

		h1 {
			color: #444;
			background-color: transparent;
			border-bottom: 1px solid #D0D0D0;
			font-size: 19px;
			font-weight: normal;
			margin: 0 0 14px 0;
			padding: 14px 15px 10px 15px;
		}

		code {
			font-family: Consolas, Monaco, Courier New, Courier, monospace;
			font-size: 12px;
			background-color: #f9f9f9;
			border: 1px solid #D0D0D0;
			color: #002166;
			display: block;
			margin: 14px 0 14px 0;
			padding: 12px 10px 12px 10px;
		}

		#body{
			margin: 0 15px 0 15px;
		}
		
		p.footer{
			text-align: right;
			font-size: 11px;
			border-top: 1px solid #D0D0D0;
			line-height: 32px;
			padding: 0 10px 0 10px;
			margin: 20px 0 0 0;
		}
		
		#container{
			margin: 10px;
			border: 1px solid #D0D0D0;
			-webkit-box-shadow: 0 0 8px #D0D0D0;
		}
		</style>
	</head>
	
		<script type="text/javascript">
			//JS validation
			window.onload=function(){
				disablefield();
				document.getElementById('student').onchange = disablefield;
				document.getElementById('employee').onchange = disablefield;

				userForm.username.onblur=validateUsername;
				userForm.password.onblur=validatePassword;
				userForm.repassword.onblur=validateRepassword;
				userForm.email.onblur=validateEmail;
				userForm.emp_no.onblur=validateEmployeeNumber;
				userForm.student_no.onblur=validateStudentNumber;
				userForm.name_first.onblur=validateFirstName;
				userForm.name_middle.onblur=validateMiddleName;
				userForm.name_last.onblur=validateLastName;
				userForm.mobile_no.onblur=validateMobileNumber;
				userForm.course.onfocus=filterCourses;
				userForm.college.onblur=filterCourses;
				userForm.college.onchange=filterCourses;
				userForm.college.onchange=filterCourses2;
				userForm.onsubmit=validateAll;
			}

			//Disable the employee textbox if the usertype is a student, else vice versa.
			function disablefield()
			{
				if ( document.getElementById('student').checked == true ){
				document.getElementById('emp_no').value = '';
				document.getElementById('emp_no').style.visibility='hidden';
				document.getElementById('student_no').style.visibility='visible';
				document.getElementsByName("spanEmp_no")[0].innerHTML='';
				}

				else if (document.getElementById('employee').checked == true ){		
				document.getElementById('student_no').value = '';
				document.getElementById('student_no').style.visibility='hidden';
				document.getElementById('emp_no').style.visibility='visible';
				document.getElementsByName("spanStudent_no")[0].innerHTML='';
				}
			}

			//Validate all fields on submition of form.
			function validateAll(){
				if( validateUsername()&&
					validatePassword()&&validateRepassword&&validateEmail()&&
					(validateEmployeeNumber()||validateStudentNumber())&&
					validateFirstName()&&validateMiddleName()&&
					validateLastName()&&validateMobileNumber()){
					return true;
				}
				else return false;
				<?php echo "error" ?>
			}
			
			//Validate the username field.
			//The username field is required and must be 6-18 characters long.
			function validateUsername(){
				str=userForm.username.value;
				msg="";

				if (str=="") msg+="Required";
				else if (!str.match(/^[0-9a-zA-Z]{6,18}$/))  msg+="Must be 6-18 characters long";
				else if(msg="Invalid input") msg="";
				document.getElementsByName("spanUsername")[0].innerHTML=msg;

				if(msg=="") return true;
			}

			//Validate the password field.
			//The password's strength is categorized: weak, fair or strong.
			////The password field is required and must be 6-18 characters long.
			function validatePassword(){
				str=userForm.password.value;
				msg="";

				if(str=="")msg+="Required";
				else if (!str.match(/^[0-9a-zA-Z]{6,18}$/))  msg+="Must be 6-18 characters long.";
				else{
					if(str.match(/^(([a-z]+)|(\d+))$/)) msg+="Weak";
					else if(str.match(/^[a-z0-9]+$/)) msg+="Fair";
					else if(str.match(/^[a-zA-Z0-9]+$/)) msg+="Strong";

				}
				document.getElementsByName("spanPassword")[0].innerHTML=msg;

				if(msg!="Required"&&msg!="Must be 6-18 characters long.") return true;
			}

			//Validate the re-entered password if it matches the previous password entered.
			function validateRepassword(){
				str=userForm.repassword.value;
				str2=userForm.password.value;
				msg="";
				if(str=="")msg+="Required";
				else if(str==str2)msg+="Valid";
				else if(str!=str2)msg="Your passwords do not match.";
				document.getElementsByName("spanRepassword")[0].innerHTML=msg;
				if(msg=="Valid")return true;
			}

			//Validate the email field.
			//The email field is required and must be of valid format.
			function validateEmail(){
				str=userForm.email.value;
				msg="";

				if (str=="") msg+="Required";
				else if (!str.match(/^[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+\.[a-zA-Z]{2,4}$/))  msg+="Invalid Input";
				else if(msg="Invalid input") msg="";
				document.getElementsByName("spanEmail")[0].innerHTML=msg;

				if(msg=="") return true;
			}

			//Validate the employee number field.
			//The employee number field is required (if usertype='employee') and must be 12-digit combination.
			function validateEmployeeNumber(){
				str=userForm.emp_no.value;
				msg="";

				if (str=="") msg+="Required";
				else if (!str.match(/^[0-9]{12}$/))  msg+="Input must be 12-digit combination";
				else if(msg="Invalid input") msg="";
				document.getElementsByName("spanEmp_no")[0].innerHTML=msg;

				if(msg=="") return true;
			}	

			//Validate the student number field.
			//The student number field is required (if usertype='student') and must be of XXXX-XXXXX format.
			function validateStudentNumber(){
				str=userForm.student_no.value;
				msg="";

				if (str=="") msg+="Required";
				else if (!str.match(/^[0-9]{4}-[0-9]{5}$/))  msg+="Input format is XXXX-XXXXX";
				else if(msg="Invalid input") msg="";
				document.getElementsByName("spanStudent_no")[0].innerHTML=msg;

				if(msg=="") return true;
			}

			//Validate the first name field.
			//The first name field is required and must be of valid format.
			function validateFirstName(){
				str=userForm.name_first.value;
				msg="";

				if (str=="") msg+="Required";
				else if (!str.match(/^[\w\-'\s]+$/))  msg+="Invalid Input";
				else if(msg="Invalid input") msg="";
				document.getElementsByName("spanName_first")[0].innerHTML=msg;

				if(msg=="") return true;
			}

			//Validate the middle name field.
			//The middle name field is required and must be of valid format.
			function validateMiddleName(){
				str=userForm.name_middle.value;
				msg="";

				if (str=="") msg+="Required";
				else if (!str.match(/^[\w\-'\s]+$/))  msg+="Invalid Input";
				else if(msg="Invalid input") msg="";
				document.getElementsByName("spanName_middle")[0].innerHTML=msg;

				if(msg=="") return true;
			}

			//Validate the last name field.
			//The last name field is required and must be of valid format.
			function validateLastName(){
				str=userForm.name_last.value;
				msg="";

				if (str=="") msg+="Required";
				else if (!str.match(/^[\w\-'\s]+$/))  msg+="Invalid Input";
				else if(msg="Invalid input") msg="";
				document.getElementsByName("spanName_last")[0].innerHTML=msg;

				if(msg=="") return true;
			     document.getElementById('BSVM').disabled = false;
			}

			//Validate the mobile number field.
			//The mobile number field is required and must be of 639XXXXXXXXX format.
			function validateMobileNumber(){
				str=userForm.mobile_no.value;
				msg="";

				if (str=="") msg+="Required";
				else if (!str.match(/^[0-9]{12}$/))  msg+="The format must be 639XXXXXXXXX";
				else if(msg="Invalid input") msg="";
				document.getElementsByName("spanMobile_no")[0].innerHTML=msg;

				if(msg=="") return true;
			}		

			//Validate the college and courses fields.
			//The courses field is group according to college.
			function filterCourses(){
				 document.getElementById('BACA').hidden = true;
				 document.getElementById('BAP').hidden = true;
				 document.getElementById('BAS').hidden = true;
 				 document.getElementById('BSAM').hidden = true;
 				 document.getElementById('BSAP').hidden = true;
 				 document.getElementById('BSB').hidden = true;
 				 document.getElementById('BSC').hidden = true;
 				 document.getElementById('BSCS').hidden = true;
 				 document.getElementById('BSM').hidden = true;
 				 document.getElementById('BSMST').hidden = true; 				 
 				 document.getElementById('BSS').hidden = true; 
				 document.getElementById('BSA').hidden = true;
				 document.getElementById('BSFT').hidden = true;
				 document.getElementById('BSABT').hidden = true;
				 document.getElementById('BSAC').hidden = true; 
				 document.getElementById('BSDC').hidden = true;
				 document.getElementById('BSE').hidden = true;
				 document.getElementById('BSABM').hidden = true;
				 document.getElementById('BSAE').hidden = true;
				 document.getElementById('BSABE').hidden = true;
				 document.getElementById('BSEE').hidden = true;
				 document.getElementById('BSCE').hidden = true;
				 document.getElementById('BSIE').hidden = true;
				 document.getElementById('BSChE').hidden = true;
    			 document.getElementById('BSF').hidden = true;
				 document.getElementById('BSN').hidden = true;
				 document.getElementById('BSHE').hidden = true;
			     document.getElementById('BSVM').hidden = true;

				 if(userForm.college.value=="CAS"){
				 document.getElementById('BACA').hidden = false;
				 document.getElementById('BAP').hidden = false;
				 document.getElementById('BAS').hidden = false;
 				 document.getElementById('BSAM').hidden = false;
 				 document.getElementById('BSAP').hidden = false;
 				 document.getElementById('BSB').hidden = false;
 				 document.getElementById('BSC').hidden = false;
 				 document.getElementById('BSCS').hidden = false;
 				 document.getElementById('BSM').hidden = false;
 				 document.getElementById('BSMST').hidden = false; 				 
 				 document.getElementById('BSS').hidden = false; 				 
 				 }
 				 else if(userForm.college.value=="CA"){
				 document.getElementById('BSA').hidden = false;
				 document.getElementById('BSFT').hidden = false;
				 document.getElementById('BSABT').hidden = false;
				 document.getElementById('BSAC').hidden = false;
 				 }
 				 else if(userForm.college.value=="CDC"){
				 document.getElementById('BSDC').hidden = false;
 				 }
  				 else if(userForm.college.value=="CEM"){
				 document.getElementById('BSE').hidden = false;
				 document.getElementById('BSABM').hidden = false;
				 document.getElementById('BSAE').hidden = false;
 				 }
   				 else if(userForm.college.value=="CEAT"){
				 document.getElementById('BSABE').hidden = false;
				 document.getElementById('BSEE').hidden = false;
				 document.getElementById('BSCE').hidden = false;
				 document.getElementById('BSIE').hidden = false;
				 document.getElementById('BSChE').hidden = false;
 				 }
    			 else if(userForm.college.value=="CFNR"){
    			 document.getElementById('BSF').hidden = false;
    			 }
   				 else if(userForm.college.value=="CHE"){
				 document.getElementById('BSN').hidden = false;
				 document.getElementById('BSHE').hidden = false;
   				 }
   				 else if(userForm.college.value=="CVM"){
				 document.getElementById('BSVM').hidden = false;
   				 }
 			}

 			//Selects a default course for every college.
 			function filterCourses2(){
 				if(userForm.college.value=="CAS"){
				 document.getElementById('BSAM').selected=true;				 
 				 }
 				 else if(userForm.college.value=="CA"){
 				 document.getElementById('BSABT').selected=true;
 				 }
 				 else if(userForm.college.value=="CDC"){
 				 document.getElementById('BSDC').selected = true;
 				 }
  				 else if(userForm.college.value=="CEM"){
  				 document.getElementById('BSABM').selected = true;
 				 }
   				 else if(userForm.college.value=="CEAT"){
   				 document.getElementById('BSABE').selected = true;
 				 }
    			 else if(userForm.college.value=="CFNR"){
    			 document.getElementById('BSF').selected = true;
    			 }
   				 else if(userForm.college.value=="CHE"){
   				 document.getElementById('BSHE').selected = true;
   				 }
   				 else if(userForm.college.value=="CVM"){
   				 document.getElementById('BSVM').selected = true;
   				 }
 			}
		</script>
	</head>
	
	<body>
		<form name="userForm" action="<?php echo base_url();?>index.php/user_account/getUserInfo" method="post" >
			
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
				<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
			</div>
		</form>
		<a href="<?php echo base_url();?>index.php/user_account/backtologin">Back</a>
	</body>
</html>