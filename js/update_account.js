window.onload=function(){
	userForm.email.onkeyup=validateEmail;
	userForm.name_first.onkeyup=validateFirstName;
	userForm.name_middle.onkeyup=validateMiddleName;
	userForm.name_last.onkeyup=validateLastName;
	userForm.mobile_no.onkeyup=validateMobileNumber;
	userForm.course.onfocus=filterCourses;
	userForm.college.onblur=filterCourses;
	userForm.college.onchange=filterCourses;
	userForm.college.onchange=filterCourses2;
	userForm.onsubmit=validateAll;

	changePasswordForm.currentpassword.onkeyup=validateCurrentPassword;
	changePasswordForm.newpassword.onkeyup=validateNewPasswords;
	changePasswordForm.renewpassword.onkeyup=validateNewPasswords;
	changePasswordForm.onsubmit=validateAllPassword;
}

function validateNewPasswords(){
	validateCurrentPassword();
	validateNewPassword();
	validateReNewPassword();
}

//Validate all fields on submition of form.
function validateAll(){
	if(validateEmail() && validateFirstName() &&validateMiddleName() && validateLastName() && validateMobileNumber())
		return true;
	else return false;
}

//Validate the password form.
function validateAllPassword(){
	if( validateReNewPassword()&&validateNewPassword())
		return true;
	else return false;
}
			
//Validate the email field.
//The email field is required and must be of valid format.
function validateEmail(){
	str=userForm.email.value;
	msg="";

	if (str=="") msg+="Required";
	else if (!str.match(/^[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+\.[a-zA-Z]{2,4}$/))  msg+="Invalid Input";
	document.getElementsByName("span email")[0].innerHTML=msg;

	if(msg==""){
		$('input[name=email]').removeClass().addClass("valid");
		$("span[name~='email']").removeClass().addClass("valid");
		return true;
	}

	else{
		$('input[name=email]').removeClass().addClass("invalid");
		$("span[name~='email']").removeClass().addClass("invalid");
	}
}
			
//Validate the first name field.
//The first name field is required and must be of valid format.
function validateFirstName(){
	str=userForm.name_first.value;
	msg="";

	if (str=="") msg+="Required. ";
	else if (!str.match(/^[\w\-'\s]+$/))  msg+="Invalid Input. ";
	else if(!str.match(/^([A-Z]+[\w]*(\s)*)+$/) && str!="")	msg+="Start with a capital letter.";
	document.getElementsByName("span name_first")[0].innerHTML=msg;

	if(msg==""){
		$('input[name=name_first]').removeClass().addClass("valid");
		$("span[name~='name_first']").removeClass().addClass("valid");
		return true;
	}

	else{
		$('input[name=name_first]').removeClass().addClass("invalid");
		$("span[name~='name_first']").removeClass().addClass("invalid");
	}
}

//Validate the middle name field.
//The middle name field is required and must be of valid format.
function validateMiddleName(){
	str=userForm.name_middle.value;
	msg="";

	if (str=="") msg+="Required. ";
	else if (!str.match(/^[\w\-'\s]+$/))  msg+="Invalid Input. ";
	else if(!str.match(/^([A-Z]+[\w]*(\s)*)+$/) && str!="")	msg+="Start with a capital letter.";
	document.getElementsByName("span name_middle")[0].innerHTML=msg;

	if(msg==""){ 
		$('input[name=name_middle]').removeClass().addClass("valid");
		$("span[name~='name_middle']").removeClass().addClass("valid");
		return true;
	}

	else{
		$('input[name=name_middle]').removeClass().addClass("invalid");
		$("span[name~='name_middle']").removeClass().addClass("invalid");
	}
}

//Validate the last name field.
//The last name field is required and must be of valid format.
function validateLastName(){
	str=userForm.name_last.value;
	msg="";

	if (str=="") msg+="Required";
	else if (!str.match(/^[\w\-'\s]+$/))  msg+="Invalid Input";
	document.getElementsByName("span name_last")[0].innerHTML=msg;

	if(msg==""){
		$('input[name=name_last]').removeClass().addClass("valid");
		$("span[name~='name_last']").removeClass().addClass("valid");
		return true;
	}

	else{
		$('input[name=name_last]').removeClass().addClass("invalid");
		$("span[name~='name_last']").removeClass().addClass("invalid");
	}
}

//Validate the mobile number field.
//The mobile number field is required and must be of 639XXXXXXXXX format.
function validateMobileNumber(){
	str=userForm.mobile_no.value;
	msg="";

	if (str=="") msg+="Required";
	else if (!str.match(/^[0-9]{12}$/))  msg+="The format must be 639XXXXXXXXX";
	document.getElementsByName("span mobile_no")[0].innerHTML=msg;

	if(msg==""){
		$('input[name=mobile_no]').removeClass().addClass("valid");
		$("span[name~='mobile_no']").removeClass().addClass("valid");
		return true;
	}

	else{
		$('input[name=mobile_no]').removeClass().addClass("invalid");
		$("span[name~='mobile_no']").removeClass().addClass("invalid");
	}
}

//Validate the college and courses fields.
//The courses field is group according to college.
function filterCourses(){
	document.getElementById('MVE').hidden = true;
	document.getElementById('MF').hidden = true;
	document.getElementById('MIT').hidden = true;
	document.getElementById('MA').hidden = true;
	document.getElementById('MCA').hidden = true;
	document.getElementById('MAg').hidden = true;
	document.getElementById('MM').hidden = true;
	document.getElementById('MDMG').hidden = true;
	document.getElementById('MPA').hidden = true;
	document.getElementById('MPS').hidden = true;
	document.getElementById('MS').hidden = true;
	document.getElementById('PhD').hidden = true;
	document.getElementById('PhDR').hidden = true;
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
	document.getElementById('None').hidden = true;

	document.getElementById('MVE').disabled = true;
	document.getElementById('MF').disabled = true;
	document.getElementById('MIT').disabled = true;
	document.getElementById('MA').disabled = true;
	document.getElementById('MAg').disabled = true;
	document.getElementById('MCA').disabled = true;
	document.getElementById('MM').disabled = true;
	document.getElementById('MDMG').disabled = true;
	document.getElementById('MPA').disabled = true;
	document.getElementById('MPS').disabled = true;
	document.getElementById('MS').disabled = true;
	document.getElementById('PhD').disabled = true;
	document.getElementById('PhDR').disabled = true;
	document.getElementById('BACA').disabled = true;
	document.getElementById('BAP').disabled = true;
	document.getElementById('BAS').disabled = true;
	document.getElementById('BSAM').disabled = true;
	document.getElementById('BSAP').disabled = true;
	document.getElementById('BSB').disabled = true;
	document.getElementById('BSC').disabled = true;
	document.getElementById('BSCS').disabled = true;
	document.getElementById('BSM').disabled = true;
	document.getElementById('BSMST').disabled = true;
	document.getElementById('BSS').disabled = true; 
	document.getElementById('BSA').disabled = true;
	document.getElementById('BSFT').disabled = true;
	document.getElementById('BSABT').disabled = true;
	document.getElementById('BSAC').disabled = true; 
	document.getElementById('BSDC').disabled = true;
	document.getElementById('BSE').disabled = true;
	document.getElementById('BSABM').disabled = true;
	document.getElementById('BSAE').disabled = true;
	document.getElementById('BSABE').disabled = true;
	document.getElementById('BSEE').disabled = true;
	document.getElementById('BSCE').disabled = true;
	document.getElementById('BSIE').disabled = true;
	document.getElementById('BSChE').disabled = true;
	document.getElementById('BSF').disabled = true;
	document.getElementById('BSN').disabled = true;
	document.getElementById('BSHE').disabled = true;
	document.getElementById('BSVM').disabled = true;
	document.getElementById('None').disabled = true;

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

		document.getElementById('BACA').disabled = false;
	 	document.getElementById('BAP').disabled = false;
	 	document.getElementById('BAS').disabled = false;
		document.getElementById('BSAM').disabled = false;
		document.getElementById('BSAP').disabled = false;
		document.getElementById('BSB').disabled = false;
		document.getElementById('BSC').disabled = false;
		document.getElementById('BSCS').disabled = false;
		document.getElementById('BSM').disabled = false;
		document.getElementById('BSMST').disabled = false;
		document.getElementById('BSS').disabled = false;			 
	}
		 
	else if(userForm.college.value=="CA"){
		document.getElementById('BSA').hidden = false;
		document.getElementById('BSFT').hidden = false;
		document.getElementById('BSABT').hidden = false;
		document.getElementById('BSAC').hidden = false;

		document.getElementById('BSA').disabled = false;
		document.getElementById('BSFT').disabled = false;
		document.getElementById('BSABT').disabled = false;
		document.getElementById('BSAC').disabled = false;
	}
		 
	else if(userForm.college.value=="CDC"){
		document.getElementById('BSDC').hidden = false;

		document.getElementById('BSDC').disabled = false;
	}
		 
	else if(userForm.college.value=="CEM"){
		document.getElementById('BSE').hidden = false;
	 	document.getElementById('BSABM').hidden = false;
	 	document.getElementById('BSAE').hidden = false;

	 	document.getElementById('BSE').disabled = false;
	 	document.getElementById('BSABM').disabled = false;
	 	document.getElementById('BSAE').disabled = false;
	}
		 
	else if(userForm.college.value=="CEAT"){
		document.getElementById('BSABE').hidden = false;
	 	document.getElementById('BSEE').hidden = false;
	 	document.getElementById('BSCE').hidden = false;
	 	document.getElementById('BSIE').hidden = false;
	 	document.getElementById('BSChE').hidden = false;

	 	document.getElementById('BSABE').disabled = false;
	 	document.getElementById('BSEE').disabled = false;
	 	document.getElementById('BSCE').disabled = false;
	 	document.getElementById('BSIE').disabled = false;
	 	document.getElementById('BSChE').disabled = false;
	}
	
	else if(userForm.college.value=="CFNR"){
		document.getElementById('BSF').hidden = false;

		document.getElementById('BSF').disabled = false;
	}
	
	else if(userForm.college.value=="CHE"){
		document.getElementById('BSN').hidden = false;
		document.getElementById('BSHE').hidden = false;

		document.getElementById('BSN').disabled = false;
		document.getElementById('BSHE').disabled = false;
	}
		 
	else if(userForm.college.value=="CVM"){
		document.getElementById('BSVM').hidden = false;

		document.getElementById('BSVM').disabled = false;
	}

	else if(userForm.college.value=="GS"){
 		document.getElementById('MVE').hidden = false;
 		document.getElementById('MF').hidden = false;
 		document.getElementById('MIT').hidden = false;
 		document.getElementById('MA').hidden = false;
 		document.getElementById('MCA').hidden = false;
 		document.getElementById('MAg').hidden = false;
 		document.getElementById('MM').hidden = false;
 		document.getElementById('MDMG').hidden = false;
 		document.getElementById('MPA').hidden = false;
 		document.getElementById('MPS').hidden = false;
 		document.getElementById('MS').hidden = false;
 		document.getElementById('PhD').hidden = false;
 		document.getElementById('PhDR').hidden = false;

 		document.getElementById('MVE').disabled = false;
 		document.getElementById('MF').disabled = false;
 		document.getElementById('MIT').disabled = false;
 		document.getElementById('MA').disabled = false;
 		document.getElementById('MCA').disabled = false;
 		document.getElementById('MAg').disabled = false;
 		document.getElementById('MM').disabled = false;	
 		document.getElementById('MDMG').disabled = false;
 		document.getElementById('MPA').disabled = false;
 		document.getElementById('MPS').disabled = false;
 		document.getElementById('MS').disabled = false;
 		document.getElementById('PhD').disabled = false;
 		document.getElementById('PhDR').disabled = false;
 	}

	else if(userForm.college.value=="NA"){
 		document.getElementById('None').hidden = false;

 		document.getElementById('None').disabled = false;
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

   	else if(userForm.college.value=="GS"){
 		document.getElementById('MVE').selected = true;
 	}

 	else if(userForm.college.value=="NA"){
 		document.getElementById('None').selected = true;
 	}  	
}

//Validate the current password field.
//The current password's strength is categorized: weak, fair or strong.
////The current password field is required and must be 6-18 characters long.
function validateCurrentPassword(){
	str=changePasswordForm.currentpassword.value;
	msg="";

	if(str=="")msg+="Required";
	else if (!str.match(/^[0-9a-zA-Z]{6,18}$/))  msg+="Must be alpha characters only and 6-18 characters long.";

	document.getElementsByName("span currentpassword")[0].innerHTML=msg;
	if(msg!="Required" && msg!="Must be alpha characters only and 6-18 characters long."){
		$('input[name=currentpassword]').removeClass().addClass("valid");
		$("span[name~='currentpassword']").removeClass().addClass("valid");
		return true;
	}

	else{
		$('input[name=currentpassword]').removeClass().addClass("invalid");
		$("span[name~='currentpassword']").removeClass().addClass("invalid");
	}
}

//Validate the new password field.
//The new password's strength is categorized: weak, fair or strong.
////The new password field is required and must be 6-18 characters long.
function validateNewPassword(){
	str=changePasswordForm.newpassword.value;
	msg="";

	if(str=="")msg+="Required";
	else if (!str.match(/^[0-9a-zA-Z]{6,18}$/))  msg+="Must be 6-18 characters long.";
	else{
		if(str.match(/^(([a-z]+)|(\d+))$/)) msg+="Weak";
		else if(str.match(/^[a-z0-9]+$/)) msg+="Fair";
		else if(str.match(/^[a-zA-Z0-9]+$/)) msg+="Strong";
	}
	
	document.getElementsByName("span newpassword")[0].innerHTML=msg;
	if(msg!="Required"&&msg!="Must be 6-18 characters long."){
		$('input[name=newpassword]').removeClass().addClass("valid");
		$("span[name~='newpassword']").removeClass().addClass("valid");
		return true;
	}

	else{
		$('input[name=newpassword]').removeClass().addClass("invalid");
		$("span[name~='newpassword']").removeClass().addClass("invalid");
	}
}

//Validate the re-entered password if it matches the previous password entered.
function validateReNewPassword(){
	str=changePasswordForm.renewpassword.value;
	str2=changePasswordForm.newpassword.value;
	msg="";
	
	if(str=="")msg+="Required";
	else if(str==str2)msg+="Valid";
	else if(str!=str2)msg="Your passwords do not match.";
	
	document.getElementsByName("span renewpassword")[0].innerHTML=msg;
	if(msg=="Valid"){
		$('input[name=renewpassword]').removeClass().addClass("valid");
		$("span[name~='renewpassword']").removeClass().addClass("valid");
		return true;
	}

	else{
		$('input[name=renewpassword]').removeClass().addClass("invalid");
		$("span[name~='renewpassword']").removeClass().addClass("invalid");
	}
}