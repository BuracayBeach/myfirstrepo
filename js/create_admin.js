window.onload=function(){
	adminForm.username.onblur=validateUsername;
	adminForm.password.onkeyup=validatepasswords;
	adminForm.repassword.onkeyup=validatepasswords;
	adminForm.name_first.onblur=validateFirstName;
	adminForm.name_middle.onblur=validateMiddleName;
	adminForm.name_last.onblur=validateLastName;
	adminForm.onsubmit=validateAll;
}

function validateAll(){

}

function validateUsername(){
	str=adminForm.username.value;
	msg="";

	if (str=="") msg+="Required";
	else if (!str.match(/^[0-9a-zA-Z]{6,18}$/))  msg+="Must be 6-18 characters long";
	else if(msg="Invalid input") msg="";
	document.getElementsByName("spanUsername")[0].innerHTML=msg;

	if(msg=="") return true;
}

function validatepasswords(){
	validatePassword();
	validateRepassword();
}

function validatePassword(){
	str=adminForm.password.value;
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
	str=adminForm.repassword.value;
	str2=adminForm.password.value;
	msg="";
	if(str=="")msg+="Required";
	else if(str==str2)msg+="Valid";
	else if(str!=str2)msg="Your passwords do not match.";
	document.getElementsByName("spanRepassword")[0].innerHTML=msg;
	if(msg=="Valid")return true;
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