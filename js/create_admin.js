window.onload=function(){
	adminForm.username.onkeyup=validateUsername;
	adminForm.password.onkeyup=validatepasswords;
	adminForm.repassword.onkeyup=validatepasswords;
	adminForm.name_first.onkeyup=validateFirstName;
	adminForm.name_middle.onkeyup=validateMiddleName;
	adminForm.name_last.onkeyup=validateLastName;
	adminForm.onsubmit=validateAll;
}

function validateAll(){
	if(validateUsername() && validateallpasswords() && validateFirstName() && validateMiddleName() && validateLastName())
		return true;
	else
		return false;
}

function validateallpasswords(){
	if(validatePassword() && validateRepassword())
		return true;
	else return false;
}

function validateUsername(){
	str=adminForm.username.value;
	msg="";

	if (str=="") msg+="Required";
	else if (!str.match(/^[0-9a-zA-Z]{6,18}$/))  msg+="Must be 6-18 characters long";
	document.getElementsByName("span username")[0].innerHTML=msg;

	if(msg==""){
		$('input[name=username]').removeClass().addClass("valid");
		$("span[name~='username']").removeClass().addClass("valid");
		return true;
	}

	else{
		$('input[name=username]').removeClass().addClass("invalid");
		$("span[name~='username']").removeClass().addClass("invalid");
	}
}

function validatepasswords(){
	validatePassword();
	validateRepassword();
}

function validatePassword(){
	str=adminForm.password.value;
	msg="";

	if(str=="")msg+="Required";
	else if (!str.match(/^[0-9a-zA-Z]{5,18}$/))  msg+="Must be 5-18 characters long.";
	else{
		if(str.match(/^(([a-z]+)|(\d+))$/)) msg+="Weak";
		else if(str.match(/^[a-z0-9]+$/)) msg+="Fair";
		else if(str.match(/^[a-zA-Z0-9]+$/)) msg+="Strong";

	}
	document.getElementsByName("span password")[0].innerHTML=msg;

	if(msg!="Required"&&msg!="Must be 5-18 characters long."){
		$('input[name=password]').removeClass().addClass("valid");
		$("span[name~='password']").removeClass().addClass("valid");
		return true;
	}

	else{
		$('input[name=password]').removeClass().addClass("invalid");
		$("span[name~='password']").removeClass().addClass("invalid");
	}

}

//Validate the re-entered password if it matches the previous password entered.
function validateRepassword(){
	str=adminForm.repassword.value;
	str2=adminForm.password.value;
	msg="";
	if(str=="")msg+="Required";
	else if(str==str2)msg+="Valid";
	else if(str!=str2)msg="Your passwords do not match.";
	document.getElementsByName("span repassword")[0].innerHTML=msg;
	
	if(msg=="Valid"){
		$('input[name=repassword]').removeClass().addClass("valid");
		$("span[name~='repassword']").removeClass().addClass("valid");
		return true;
	}

	else{
		$('input[name=repassword]').removeClass().addClass("invalid");
		$("span[name~='repassword']").removeClass().addClass("invalid");
	}
}

//Validate the first name field.
//The first name field is required and must be of valid format.
function validateFirstName(){
	str=adminForm.name_first.value;
	msg="";

	if (str=="") msg+="Required";
	else if (!str.match(/^[\w\-'\s]+$/))  msg+="Invalid Input";
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
	else if (!str.match(/^[\w\-'\s]+$/))  msg+="Invalid Input";
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