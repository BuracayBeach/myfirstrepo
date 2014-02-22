window.onload=function(){
	disablefield();
	document.getElementById('student').onchange = disablefield;
	document.getElementById('employee').onchange = disablefield;

	userForm.username.onblur=validateUsername;
	userForm.password.onkeyup=validatepasswords;
	userForm.repassword.onkeyup=validatepasswords;
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

function validatepasswords(){
	validatePassword();
	validateRepassword();
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
		validateFirstName()&&validateMiddleName()&&
		validateLastName()&&validateMobileNumber()){
		if(document.getElementById('student').checked == true && validateStudentNumber())
			return true;
		else if(document.getElementById('employee').checked == true && validateEmployeeNumber())
			return true;
		else
			return false;
	}
	else return false;
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

// Empty the re-password form when password form changes
function emptifypassword(){
	userForm.repassword.value="";
	document.getElementsByName("spanRepassword")[0].innerHTML="";				
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