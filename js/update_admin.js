window.onload=function(){
	adminForm.name_first.onkeyup=validateFirstName;
	adminForm.name_middle.onkeyup=validateMiddleName;
	adminForm.name_last.onkeyup=validateLastName;
	adminForm.onsubmit=validateAll;

	adminPasswordForm.currentPassword.onkeyup=validateCurrentPassword;
	adminPasswordForm.newPassword.onkeyup=validatePasswords;
	adminPasswordForm.newRePassword.onkeyup=validatePasswords;
	adminPasswordForm.onsubmit=validateAllPasswords;
}

function validatePasswords(){
	validateNewPassword();
	validateReNewPassword();
}

function validateAll(){
	if(validateFirstName() && validateMiddleName() && validateLastName())
		return true
	else return false;
}

function validateAllPasswords(){
	if(validateCurrentPassword() && validateNewPassword() && validateReNewPassword())
		return true;
	else return false;
}

//Validate the first name field.
//The first name field is required and must be of valid format.
function validateFirstName(){
	str=adminForm.name_first.value;
	msg="";

	if (str=="") msg+="Required";
	else if (!str.match(/^[A-Za-z\-\'\s]+$/))  msg+="Invalid Input. ";
	else if(!str.match(/^([A-Z]+[\w\-\s\']*(\s)*)+$/) && str!="")	msg+="Start with a capital letter.";
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
	str=adminForm.name_middle.value;
	msg="";

	if (str=="") msg+="Required";
	else if (!str.match(/^[A-Za-z\-\'\s]+$/))  msg+="Invalid Input. ";
	else if(!str.match(/^([A-Z]+[\w\-\s\']*(\s)*)+$/) && str!="")	msg+="Start with a capital letter.";
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
	str=adminForm.name_last.value;
	msg="";

	if (str=="") msg+="Required";
	else if (!str.match(/^[A-Za-z\-\'\s]+$/))  msg+="Invalid Input. ";
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

//Validate the current password field.
//The current password's strength is categorized: weak, fair or strong.
////The current password field is required and must be 6-18 characters long.
function validateCurrentPassword(){
	str=adminPasswordForm.currentPassword.value;
	msg="";

	if(str=="")msg+="Required";
	else if (!str.match(/^[0-9a-zA-Z]{5,18}$/))  msg+="Must be 5-18 characters long.";

	document.getElementsByName("span currentpassword")[0].innerHTML=msg;
	
	if(msg!="Required"&&msg!="Must be 5-18 characters long."){
		$('input[name=currentPassword]').removeClass().addClass("valid");
		$("span[name~='currentpassword']").removeClass().addClass("valid");
		return true;
	}

	else{
		$('input[name=currentPassword]').removeClass().addClass("invalid");
		$("span[name~='currentpassword']").removeClass().addClass("invalid");
	}
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
	
	document.getElementsByName("span newpassword")[0].innerHTML=msg;
	
	if(msg!="Required"&&msg!="Must be 5-18 characters long."){
		$('input[name=newPassword]').removeClass().addClass("valid");
		$("span[name~='newpassword']").removeClass().addClass("valid");
		return true;
	}

	else{
		$('input[name=newPassword]').removeClass().addClass("invalid");
		$("span[name~='newpassword']").removeClass().addClass("invalid");
	}
}

//Validate the re-entered password if it matches the previous password entered.
function validateReNewPassword(){
	str=adminPasswordForm.newRePassword.value;
	str2=adminPasswordForm.newPassword.value;
	msg="";
	
	if(str=="")msg+="Required";
	else if(str==str2)msg+="Valid";
	else if(str!=str2)msg="Your passwords do not match.";
	
	document.getElementsByName("span newrepassword")[0].innerHTML=msg;
	
	if(msg=="Valid"){
		$('input[name=newRePassword]').removeClass().addClass("valid");
		$("span[name~='newrepassword']").removeClass().addClass("valid");
		return true;
	}

	else{
		$('input[name=newRePassword]').removeClass().addClass("invalid");
		$("span[name~='newrepassword']").removeClass().addClass("invalid");
	}
}