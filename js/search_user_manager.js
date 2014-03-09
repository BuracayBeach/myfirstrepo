//Script Author : Cyril Justine D. Bravo
//Description : a JQuery script that changes the field/s depending on the search category

var filepath = icejjfish;				

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

function search_user(min_index)
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
				'status' : $('input[name=status]:checked').val(),
				'pagesize' : $('#page_size').val()
			};
			break;
		case "stdno" :
			json_data = {
				'field' : 'stdno',
				'studentno' : $('#enterStdno').val(),
				'status' : $('input[name=status]:checked').val(),
				'pagesize' : $('#page_size').val()
			};
			break;

		case "empno" : 
			json_data = {
				'field' : 'empno',
				'employeeno' : $('#enterEmpno').val(),
				'status' : $('input[name=status]:checked').val(),
				'pagesize' : $('#page_size').val()
			};
			break;

		case "uname" :
			json_data = {
				'field' : 'uname',
				'username' : $('#enterUname').val(),
				'status' : $('input[name=status]:checked').val(),
				'pagesize' : $('#page_size').val()
			};
			break;
		case "email" :
			json_data = {
				'field' : 'email',
				'emailadd' : $('#enterEmail').val(),
				'status' : $('input[name=status]:checked').val(),
				'pagesize' : $('#page_size').val()
			};	
			break;
		default :  
			json_data = {

				'field' : 'name',
				'firstname' : $('#enterFname').val(),
				'middlename' : $('#enterMname').val(),
				'lastname' : $('#enterLname').val() ,
				'status' : $('input[name=status]:checked').val(),
				'pagesize' : $('#page_size').val()
			};
	}

	$.ajax({
		url : filepath+'enable_disable/search/'+min_index, 
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
				var num_results = json_results.results.length;
			} else {
				var num_results = 0;
			}
			var num_pages = json_results.search_details.num_pages;
			var page_size = json_results.search_details.page_size;

			//display the data only if there are results
			if(num_results > 0){
				var headers = "<tr class='result_row'>";
				headers += "<th>Username</th>";
				headers += "<th>Id Number</th>";
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
					row += "<td class='log_col'>"+json_results.results[i].username+"</td>";

					if(json_results.results[i].usertype === "student") row += "<td class='log_col'>"+json_results.results[i].student_no+"</td>";
					else if(json_results.results[i].usertype === "employee") row += "<td class='log_col'>"+json_results.results[i].emp_no+"</td>";
					row += "<td class='log_col'>"+json_results.results[i].email+"</td>";
					row += "<td class='log_col'>"+json_results.results[i].usertype+"</td>";
					row += "<td class='log_col'>"+json_results.results[i].name_first+"</td>";
					row += "<td class='log_col'>"+json_results.results[i].name_middle+"</td>";
					row += "<td class='log_col'>"+json_results.results[i].name_last+"</td>";
					row += "<td class='log_col'>"+json_results.results[i].college+"</td>";
					row += "<td class='log_col'>";
					switch(json_results.results[i].status) //creates a button depending on user status
					{
						case "pending" :  //creates a button named activate
						{
							row += "<input type='button' value='Activate' class='Activate_button' usertype='"+json_results.results[i].usertype+"' username='"+json_results.results[i].username+"' student_no='"+json_results.results[i].student_no+"' emp_no='"+json_results.results[i].emp_no+"' email='"+json_results.results[i].email+"'/>";
							break;
						}
						case "enabled" : //creates a button named disable
						{ 
							row += "<input type='button' value='Disable' class='Disable_button' usertype='"+json_results.results[i].usertype+"' username='"+json_results.results[i].username+"' student_no='"+json_results.results[i].student_no+"' emp_no='"+json_results.results[i].emp_no+"' email='"+json_results.results[i].email+"'/>";
							break;
						}
						case "disabled" : //creates a button named enable
						{ 
							row += "<input type='button' value='Enable' class='Enable_button' usertype='"+json_results.results[i].usertype+"' username='"+json_results.results[i].username+"' student_no='"+json_results.results[i].student_no+"' emp_no='"+json_results.results[i].emp_no+"' email='"+json_results.results[i].email+"'/>";
							break;
						}
					}
					row += "</td>";

					row += "</tr>";
					result_array.push(row);
				}
				//add the result array to the result table to convert the array of strings into table rows 
				$('#result_table').html(result_array);
				//generate pagination only if there is more than 1 page
				if(num_pages > 1){
					generatePagination(num_pages,min_index,page_size);
				} else {
					//if no pagination is needed, destroy the pagination from a previous search to prevent errors
					$('#pagination_controller').removeAttr();
					$('#pagination_controller').html('');
				}


			}

			else {
				$('#result_table').html("<p>No Results</p>");
			}
		}
	}); 
}

//bind the function the the search button on page load
$(document).ready(function(){
	$('#submitButton').on('click',function(){
		search_user(0);
	});
});

//PARAMETER DETAILS
//num_pages -> the number of pages in this pagination
//min_index -> index of the first element (in the search results) of the current page (starts at index 0)

function generatePagination(num_pages,min_index,page_size)
{
	
	var pc = $('#pagination_controller');
	//set the pagination controller's attributes for control over the generation of page links
	$(pc).attr({
		'num_pages' : num_pages,
		'curr_page' : (min_index/page_size)+1		//NOTE : pages start at index 1 while min_indices start at index 0
	});

	var curr_page = $(pc).attr('curr_page');
	var num_pages = $(pc).attr('num_pages');
	var page_scale = 10; //must always be an even integer
	var pagination_links = '';

	//generate anchor tags, that do not link to any page, in string form
	pagination_links += "<a id='prevpage' href='javascript:void(0)'> < Prev&nbsp;&nbsp; </a>";
	for(var i=0;i<num_pages;i+=1)
	{
		//subtract 1 from curr_page because this i in this loop is in terms of min_index
		//skip adding links to lower pages when they are out of the page scale
		if(curr_page-1 > page_scale/2 && (curr_page-1) - page_scale/2 > i) continue;
		//skip adding links to upper pages when they are out of the page scale
		if(i > (curr_page-1) + page_scale/2 && i > page_scale) continue;

		//enclose the current page in <strong> tags to emphasize it as the current page
		if(i === curr_page-1){
			pagination_links += "<strong><a class='page_link' min_index = '"+(i*page_size)+"' href='javascript:void(0)'>&nbsp;"+(i+1)+"&nbsp;</a></strong>";
		} else {
			pagination_links += "<a class='page_link' min_index ='"+(i*page_size)+"' href='javascript:void(0)'>&nbsp;"+(i+1)+"&nbsp;</a>";
		}
	}
	pagination_links += "<a id='nextpage' href='javascript:void(0)'> &nbsp;&nbsp;Next > </a>";

	//convert the string tags into html code
	$(pc).html(pagination_links);

	var linkers = $('.page_link');
	
	//bind a listener to each link (except the prev and next links) to change page on click
	$(linkers).on('click',function(){
		search_user($(this).attr('min_index'));		
	});

	//bind a listener to the previous page link only if not on the first page
	if(curr_page > 1)
	{
		$('a#prevpage').on('click',function(){
			//get the current page and subtract it by 1 since search uses a zero-based parameter while pages are a one-based
			var index = $(pc).attr('curr_page')-1;
			//decrement the page by 1 to go to the previous page
			search_user((index-1)*page_size);
		});
	}

	//bind a listener to the next page link only if not on the last page
	if(curr_page != num_pages)
	{
		$('a#nextpage').on('click',function(){
			var index = $(pc).attr('curr_page')-1;
			//increment the page by 1 to go to the next page
			search_user((index+1)*page_size);
		});
	}
	
}

	