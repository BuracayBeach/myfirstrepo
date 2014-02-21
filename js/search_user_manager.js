			//Script Author : Cyril Justine D. Bravo
			//Description : a JQuery script that changes the field/s depending on the search category

			function changeTextBox(value){ 
				if(value=='name'){
					string = "<input id='enterFname'/> <input id='enterMname'/> <input id='enterLname'/>"; //creates 3 fields for name
	            	$('#divtext').html(string); // innerhtml equivalent in jquery
	            	$('#divtext #enterFname').attr({ // set attributes for name
 						'name': 'firstname',
 						'type': 'text',
 						'placeholder': 'Enter first name'
 					});
	            	$('#divtext #enterMname').attr({
 						'name': 'middlename',
 						'type': 'text',
 						'placeholder': 'Enter middle name'
 					});
	            	$('#divtext #enterLname').attr({
 						'name': 'lastname',
 						'type': 'text',
 						'placeholder': 'Enter last name'
 					});
				}
				else if(value=='stdno'){
					string = "<input id='enterStdno'/>"; //creates field for studno
	            	$('#divtext').html(string);
	            	$('#divtext #enterStdno').attr({ // set attributes for studno
 						'name': 'studentno',
 						'type': 'text',
 						'placeholder': 'Enter student number'
 					});
				}
				else if(value=='empno'){
					string = "<input id='enterEmpno'/>"; //creates field for studno
	            	$('#divtext').html(string);
	            	$('#divtext #enterEmpno').attr({ // set attributes for empno
 						'name': 'employeeno',
 						'type': 'text',
 						'placeholder': 'Enter employee number'
 					});
				}
				else if(value=='uname'){
					string = "<input id='enterUname'/>"; //creates field for username
	            	$('#divtext').html(string);
	            	$('#divtext #enterUname').attr({ // set attributes for username
 						'name': 'username',
 						'type': 'text',
 						'placeholder': 'Enter username'
 					});
				}
				else if(value=='email'){
					string = "<input id='enterEmail'/>"; //creates field for email
	            	$('#divtext').html(string);
	            	$('#divtext #enterEmail').attr({ // set attributes for email
 						'name': 'emailadd',
 						'type': 'text',
 						'placeholder': 'Enter email address'
 					});
				}
			}

			
				