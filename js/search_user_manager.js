//Script Author : Cyril Justine D. Bravo
//Description : a JQuery script that changes the field/s depending on the search category

var filepath = "http://localhost/myfirstrepo/"				

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

/* 
	Script Author : Carl Adrian P. Castueras
	Description : AJAX module for searching users from the database
*/

function search_user(e)
{
	//get the value of the currently selected radio button
	var search_category = $('input[name=field]:checked').val();
	var json_data;
	switch(search_category){
		//create a JSON object to be passed to the AJAX call with the appropriate attributes
		//the JSON object gets values from the forms using the .val() function
		case "name" : 
			json_data = {

				'field' : 'name',
				'firstname' : $('#enterFname').val(),
				'middlename' : $('#enterMname').val(),
				'lastname' : $('#enterLname').val(),
				'status' : $('input[name=status]:checked').val()
			};
			break;
		case "stdno" :
			json_data = {
				'field' : 'stdno',
				'studentno' : $('#enterStdno').val(),
				'status' : $('input[name=status]:checked').val()
			};
			break;

		case "empno" : 
			json_data = {
				'field' : 'empno',
				'employeeno' : $('#enterEmpno').val(),
				'status' : $('input[name=status]:checked').val()
			};
			break;

		case "uname" :
			json_data = {
				'field' : 'uname',
				'username' : $('#enterUname').val(),
				'status' : $('input[name=status]:checked').val()
			};
			break;
		case "email" :
			json_data = {
				'field' : 'email',
				'emailadd' : $('#enterEmail').val(),
				'status' : $('input[name=status]:checked').val()
			};	
			break;
		default :  
			json_data = {

				'field' : 'name',
				'firstname' : $('#enterFname').val(),
				'middlename' : $('#enterMname').val(),
				'lastname' : $('#enterLname').val() ,
				'status' : $('input[name=status]:checked').val()
			};
	}

	$.ajax({
		url : filepath+'enable_disable/search/'+e.data.page, 
		type : 'POST',
		dataType : "html",
		data : json_data,
		async : true,
		success: function(data) {
			//since the data returned is html, parse it into JSON format
			json_results = JSON.parse(data);
			var result_array = [];

			//since the search may return null, set a handler to set the num_results to 0 when null
			if(json_results != null){
				var num_results = json_results.length;
			} else {
				var num_result = 0;
			}

			//display the data only if there are results
			if(num_results > 0){
				var headers = "<tr class='result_row'>";
				headers += "<th>Username</th>";
				headers += "<th>Email</th>";
				headers += "<th>User Type</th>";
				headers += "<th>First Name</th>";
				headers += "<th>Middle Name</th>";
				headers += "<th>Last Name</th>";
				headers += "<th>College</th>";
				headers += "<th>Action</th>";
				headers += "</tr>";
				result_array.push(headers);
				
				//push each result as a row in a table
				for(var i=0;i<num_results;i+=1)
				{
					var row = "<tr class='log_row'>";
					row += "<td class='log_col'>"+json_results[i].username+"</td>";
					row += "<td class='log_col'>"+json_results[i].email+"</td>";
					row += "<td class='log_col'>"+json_results[i].usertype+"</td>";
					row += "<td class='log_col'>"+json_results[i].name_first+"</td>";
					row += "<td class='log_col'>"+json_results[i].name_middle+"</td>";
					row += "<td class='log_col'>"+json_results[i].name_last+"</td>";
					row += "<td class='log_col'>"+json_results[i].college+"</td>";
					row += "<td class='log_col'>";
					switch(json_results[i].status) //creates a button depending on user status
					{
						case "pending" :  //creates a button named activate
						{
							row += "<input type='button' value='Activate' class='Activate_button' usertype='"+json_results[i].usertype+"' username='"+json_results[i].username+"' student_no='"+json_results[i].student_no+"' emp_no='"+json_results[i].emp_no+"' email='"+json_results[i].email+"'/>";
							break;
						}
						case "enabled" : //creates a button named disable
						{ 
							row += "<input type='button' value='Enable' class='Enable_button' usertype='"+json_results[i].usertype+"' username='"+json_results[i].username+"' student_no='"+json_results[i].student_no+"' emp_no='"+json_results[i].emp_no+"' email='"+json_results[i].email+"'/>";
							break;
						}
						case "disabled" : //creates a button named enable
						{ 
							row += "<input type='button' value='Disable' class='Disable_button' usertype='"+json_results[i].usertype+"' username='"+json_results[i].username+"' student_no='"+json_results[i].student_no+"' emp_no='"+json_results[i].emp_no+"' email='"+json_results[i].email+"'/>";
							break;
						}
					}
					row += "</td>";

					row += "</tr>";
					result_array.push(row);
				}
				//add the result array to the result table to convert the array of strings into table rows 
				$('#result_table').html(result_array);
			}

			else {
				$('#result_table').html("<p>No Results</p>");
			}
		}
	}); 
}

//bind the function the the search button on page load
$(document).ready(function(){
	$('#submitButton').on('click',{page : 0},search_user);
});

	