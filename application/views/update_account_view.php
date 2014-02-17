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
				userForm.email.onblur=validateEmail;
				userForm.name_first.onblur=validateFirstName;
				userForm.name_middle.onblur=validateMiddleName;
				userForm.name_last.onblur=validateLastName;
				userForm.mobile_no.onblur=validateMobileNumber;
				userForm.course.onfocus=filterCourses;
				userForm.college.onblur=filterCourses;
				userForm.college.onchange=filterCourses;
				userForm.college.onchange=filterCourses2;
				userForm.onsubmit=validateAll;

				changePasswordForm.currentPassword.onblur=validateCurrentPassword;
				changePasswordForm.newPassword.onblur=validateNewPassword;
				changePasswordForm.reNewPassword.onblur=validateReNewPassword;
				changePasswordForm.onsubmit=validateAllPassword;
			}

			//Validate all fields on submition of form.
			function validateAll(){
				if( validatePassword()&&validateEmail()&&
					validateFirstName()&&validateMiddleName()&&
					validateLastName()&&validateMobileNumber()){
					return true;
				}
				else return false;
				<?php echo "error" ?>
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

 			//Validate the current password field.
			//The current password's strength is categorized: weak, fair or strong.
			////The current password field is required and must be 6-18 characters long.
 			function validateCurrentPassword(){
				str=changePasswordForm.currentPassword.value;
				msg="";
				

				if(str=="")msg+="Required";
				else if (!str.match(/^[0-9a-zA-Z]{6,18}$/))  msg+="Must be 6-18 characters long.";
				else{
					if(str.match(/^(([a-z]+)|(\d+))$/)) msg+="Weak";
					else if(str.match(/^[a-z0-9]+$/)) msg+="Fair";
					else if(str.match(/^[a-zA-Z0-9]+$/)) msg+="Strong";

				}
				document.getElementsByName("spanCurrentPassword")[0].innerHTML=msg;

				if(msg!="Required"&&msg!="Must be 6-18 characters long.") return true;
 			}

 			//Validate the new password field.
			//The new password's strength is categorized: weak, fair or strong.
			////The new password field is required and must be 6-18 characters long.
 			function validateNewPassword(){
				str=changePasswordForm.newPassword.value;
				msg="";

				if(str=="")msg+="Required";
				else if (!str.match(/^[0-9a-zA-Z]{6,18}$/))  msg+="Must be 6-18 characters long.";
				else{
					if(str.match(/^(([a-z]+)|(\d+))$/)) msg+="Weak";
					else if(str.match(/^[a-z0-9]+$/)) msg+="Fair";
					else if(str.match(/^[a-zA-Z0-9]+$/)) msg+="Strong";

				}
				document.getElementsByName("spanNewPassword")[0].innerHTML=msg;

				if(msg!="Required"&&msg!="Must be 6-18 characters long.") return true;
 			}

 			//Validate the re-entered password if it matches the previous password entered.
 			function validateReNewPassword(){
				str=changePasswordForm.reNewPassword.value;
				str2=changePasswordForm.newPassword.value;
				msg="";
				if(str=="")msg+="Required";
				else if(str==str2)msg+="Valid";
				else if(str!=str2)msg="Your passwords do not match.";
				document.getElementsByName("spanReNewPassword")[0].innerHTML=msg;
				if(msg=="Valid")return true;
 			}

 			//Validate the password form.
			function validateAllPassword(){
				if( validateReNewPassword()&&
					validateNewPassword()){
					return true;
				}
				else return false;
				<?php echo "error" ?>
			}
		</script>
	</head>
	
	<body>
		<form name="userForm" action="<?php echo base_url();?>index.php/user_account/update" method="post" >
			
			<div id="container">
				<h1>Update Form</h1>

				<div id="body">
					Sex: <input type="radio" name="sex" value="male" id="male" 
						<?php
							if($sex=="male")
								echo "checked";
						?> />
						 <label for="male">Male</label>
						 <input type="radio" name="sex" value="female" id="female"
						 <?php
							if($sex=="female")
								echo "checked";
						?> />
						 <label for="female">Female</label><br/>

					Email: <input type="text" name="email" value="<?php echo $email; ?>" required/><span name="spanEmail"></span><br/>
					First Name: <input type="text" name="name_first" value="<?php echo $name_first; ?>" required/><span name="spanName_first"></span><br/>
					Middle Name: <input type="text" name="name_middle" value="<?php echo $name_middle; ?>" required/><span name="spanName_middle"></span><br/>
					Last Name: <input type="text" name="name_last" value="<?php echo $name_last; ?>" required/><span name="spanName_last"></span><br/>
					Mobile Number: <input type="text" name="mobile_no" name="name_last" value="<?php echo $mobile_no; ?>" required /><span name="spanMobile_no"></span><br/>
					College: 
					<select name="college" value="<?php echo $college; ?>">						
						<option value="CA"
							<?php
								if($college=="CA")
									echo "selected";
							?>
						>CA (College of Agriculture)</option>
						<option value="CAS"
							<?php
								if($college=="CAS")
									echo "selected";
							?>
						>CAS (College of Arts and Sciences)</option> 
						<option value="CDC"
							<?php
								if($college=="CDC")
									echo "selected";
							?>
						>CDC (College of Development Communication)</option>
						<option value="CEM"
							<?php
								if($college=="CEM")
									echo "selected";
							?>
						>CEM (College of Economics and Management)</option>
						<option value="CEAT"
							<?php
								if($college=="CEAT")
									echo "selected";
							?>
						>CEAT (College of Engineering and Agro-Industrial Technology)</option>
						<option value="CFNR"
							<?php
								if($college=="CFNR")
									echo "selected";
							?>
						>CFNR (College of Forestry and Natural Resources)</option>	
						<option value="CHE"
							<?php
								if($college=="CHE")
									echo "selected";
							?>
						>CHE (College of Human Ecology)</option>	
						<option value="CVM"
							<?php
								if($college=="CVM")
									echo "selected";
							?>
						>CVM (College of Veterinary Medicine)</option>
					</select>
					Course:
					<select name="course" id="course" value="<?php echo $course; ?>" >
						<option value="BSABT" id="BSABT" 
							<?php
								if($course=="BSABT")
									echo "selected";
							?>
						>BS Agricultural Biotechnology</option>
						<option value="BSABM" id="BSABM" 
							<?php
								if($course=="BSABM")
									echo "selected";
							?>
						>BS Agribusiness Management</option>
						<option value="BSABE" id="BSABE" 
							<?php
								if($course=="BSABE")
									echo "selected";
							?>
						>BS Agricultural and Biosystems Engineering</option>
						<option value="BSAC" id="BSAC" 
							<?php
								if($course=="BSAC")
									echo "selected";
							?>
						>BS Agricultural Chemistry</option>	
						<option value="BSAE" id="BSAE" 
							<?php
								if($course=="BSAE")
									echo "selected";
							?>
						>BS Agricultural Economics</option>
						<option value="BSA" id="BSA" 
							<?php
								if($course=="BSA")
									echo "selected";
							?>
						>BS Agriculture</option>
						<option value="BSAM" id="BSAM" 
							<?php
								if($course=="BSAM")
									echo "selected";
							?>
						>BS Applied Mathematics</option>
						<option value="BSAP" id="BSAP" 
							<?php
								if($course=="BSAP")
									echo "selected";
							?>
						>BS Applied Physics</option>
						<option value="BSB" id="BSB" 
							<?php
								if($course=="BSB")
									echo "selected";
							?>
						>BS Biology</option>
						<option value="BSChE" id="BSChE" 
							<?php
								if($course=="BSChE")
									echo "selected";
							?>
						>BS Chemical Engineering</option>
						<option value="BSC" id="BSC" 
							<?php
								if($course=="BSC")
									echo "selected";
							?>
						>BS Chemistry</option>
						<option value="BSCE" id="BSCE" 
							<?php
								if($course=="BSCE")
									echo "selected";
							?>
						>BS Civil Engineering</option>
						<option value="BACA" id="BACA" 
							<?php
								if($course=="BACA")
									echo "selected";
							?>
						>BA Communication Arts</option>
						<option value="BSCS" id="BSCS" 
							<?php
								if($course=="BSCS") 
									echo "selected";
							?>
						>BS Computer Science</option>
						<option value="BSDC" id="BSDC" 
							<?php
								if($course=="BSDC")
									echo "selected";
							?>
						>BS Development Communication</option>
						<option value="BSE" id="BSE" 
							<?php
								if($course=="BSE")
									echo "selected";
							?>
						>BS Economics</option>
						<option value="BSEE" id="BSEE" 
							<?php
								if($course=="BSEE")
									echo "selected";
							?>
						>BS Electrical Engineering</option>
						<option value="BSF" id="BSF" 
							<?php
								if($course=="BSF")
									echo "selected";
							?>
						>BS Forestry</option>
						<option value="BSFT" id="BSFT" 
							<?php
								if($course=="BSFT")
									echo "selected";
							?>
						>BS Food Technology</option>
						<option value="BSHE" id="BSHE" 
							<?php
								if($course=="BSHE")
									echo "selected";
							?>
						>BS Human Ecology</option>
						<option value="BSIE" id="BSIE" 
							<?php
								if($course=="BSIE")
									echo "selected";
							?>
						>BS Industrial Engineering</option>
						<option value="BSM" id="BSM" 
							<?php
								if($course=="BSM")
									echo "selected";
							?>
						>BS Mathematics</option>
						<option value="BSMST" id="BSMST" 
							<?php
								if($course=="BSMST")
									echo "selected";
							?>
						>BS Mathematics and Science Teaching</option>
						<option value="BSN" id="BSN" 
							<?php
								if($course=="BSN")
									echo "selected";
							?>
						>BS Nutrition</option>
						<option value="BAP" id="BAP" 
							<?php
								if($course=="BAP")
									echo "selected";
							?>
						>BA Philosophy</option>
						<option value="BAS" id="BAS" 
							<?php
								if($course=="BAS")
									echo "selected";
							?>
						>BA Sociology</option>						
						<option value="BSS" id="BSS" 
							<?php
								if($course=="BSS")
									echo "selected";
							?>
						>BS Statistics</option>
						<option value="BSVM" id="BSVM" 
							<?php
								if($course=="BSVM")
									echo "selected";
							?>
						>BS Vetererary Medicine</option>
					</select></br>

					<input type="Submit" value="Submit" />
				</div>

				<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
			</div>
		</form>

		<form name="changePasswordForm" action="<?php echo base_url();?>index.php/user_account/changePassword" method="post" >	
			<div id="container">
				<h1>Change Password</h1>

				<div id="body">
					Current Password: <input type="password" name="currentPassword" value="" required/><span name="spanCurrentPassword"></span><br/>
					New Password: <input type="password" name="newPassword" value=""required/><span name="spanNewPassword"></span><br/>
					Retype New Password: <input type="password" name="reNewPassword" value="" required/><span name="spanReNewPassword"></span><br/>
					<input type="submit" value="Save Changes" />
				</div>
			</div>
		</form>
		<a href="<?php echo base_url();?>index.php/user_account/usernav">Back</a>
	</body>
</html>