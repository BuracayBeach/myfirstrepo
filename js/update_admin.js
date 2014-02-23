window.onload=function(){
	adminForm.name_first.onblur=validateFirstName;
	adminForm.name_middle.onblur=validateMiddleName;
	adminForm.name_last.onblur=validateLastName;
	adminForm.onsubmit=validateAll;

	adminPasswordForm.currentPassword.onkeyup=validateCurrentPassword;
	adminPasswordForm.newPassword.onkeyup=validatePasswords;
	adminPasswordForm.newRePassword.onkeyup=validatePasswords;
	adminForm.onsubmit=validateAllPasswords;
}

function validatePasswords(){
	validateNewPassword();
	validateReNewPassword();
}

function validateAll(){
	if(validateFirstName && validateMiddleName && validateLastName)
		return true
	else return false;
}

function validateAllPasswords(){
	if(validateCurrentPassword && validateNewPassword && validateReNewPassword)
		return true;
	else return false;
}

//Validate the first name field.
//The first name field is required and must be of valid format.
function validateFirstName(){
	str=adminForm.name_first.value;
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
	str=adminForm.name_middle.value;
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
	str=adminForm.name_last.value;
	msg="";

	if (str=="") msg+="Required";
	else if (!str.match(/^[\w\-'\s]+$/))  msg+="Invalid Input";
	else if(msg="Invalid input") msg="";
	document.getElementsByName("spanName_last")[0].innerHTML=msg;

	if(msg=="") return true;
}

//Validate the current password field.
//The current password's strength is categorized: weak, fair or strong.
////The current password field is required and must be 6-18 characters long.
function validateCurrentPassword(){
	str=adminPasswordForm.currentPassword.value;
	msg="";

	if(str=="")msg+="Required";
	else if (!str.match(/^[0-9a-zA-Z]{5,18}$/))  msg+="Must be 5-18 characters long.";

	document.getElementsByName("span_currentpassword")[0].innerHTML=msg;
	if(msg!="Required"&&msg!="Must be 5-18 characters long.") return true;
}

//Validate the new password field.
//The new password's strength is categorized: weak, fair or strong.
////The new password field is required and must be 6-18 characters long.
function validateNewPassword(){
	str=adminPasswordForm.newPassword.value;
	msg="";

	if(str=="")msg+="Required";
	else if (!str.match(/^[0-9a-zA-Z]{5,18}$/))  msg+="Must be 5-18 characters long.";
	else{
		if(str.match(/^(([a-z]+)|(\d+))$/)) msg+="Weak";
		else if(str.match(/^[a-z0-9]+$/)) msg+="Fair";
		else if(str.match(/^[a-zA-Z0-9]+$/)) msg+="Strong";
	}
	
	document.getElementsByName("span_newpassword")[0].innerHTML=msg;
	if(msg!="Required"&&msg!="Must be 5-18 characters long.") return true;
}

//Validate the re-entered password if it matches the previous password entered.
function validateReNewPassword(){
	str=adminPasswordForm.newRePassword.value;
	str2=adminPasswordForm.newPassword.value;
	msg="";
	
	if(str=="")msg+="Required";
	else if(str==str2)msg+="Valid";
	else if(str!=str2)msg="Your passwords do not match.";
	
	document.getElementsByName("span_newrepassword")[0].innerHTML=msg;
	if(msg=="Valid")return true;
}