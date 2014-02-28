	//Script Author : Carl Adrian P. Castueras
	//Description : AJAX functions used for to call the activate,enable and disable controllers and then update the page dynamically

	var filepath = "http://localhost/myfirstrepo/"

	function log_users()
	{
		page = $('#logs_pagination').attr('page');
		mydata = {'page':page};
		
		$.ajax({
			url : filepath+"enable_disable/get_log/", //ASSUMPTION : the page is in the enable_disable controller
			type : 'POST',
			dataType : "html",
			data: mydata,
			async : true,
			success: function(data) {

				json_data = JSON.parse(data); //parse the data as JSON since it is in html format
				var result_array = [];
				if(json_data != null){
					var num_results = json_data.length;
				} else {
					var num_result = 0;
				}

				//display the data only if there are results
				if(num_results > 0){
					
					//build the string of table headers 
					var headers = "<tr class='log_row'>";
					headers+="<th>Username_user</th>";
					headers+="<th>Username_admin</th>";
					headers+="<th>Email</th>";
					headers+="<th>Date</th>";
					headers+="<th>Action</th>";
					headers+="</tr>";
					result_array.push(headers);


					//push each result as a row in a table
					for(var i=0;i<num_results;i+=1)
					{
						var row = "<tr class='log_row'>";
						row += "<td class='log_col'>"+json_data[i].username_user+"</td>";
						row += "<td class='log_col'>"+json_data[i].username_admin+"</td>";
						row += "<td class='log_col'>"+json_data[i].email+"</td>";
						row += "<td class='log_col'>"+json_data[i].date+"</td>";
						row += "<td class='log_col'>"+json_data[i].action+"</td>";
						row += "</tr>";
						result_array.push(row);
					}




					//replace the entire table with an updated table
					$('#log_table').html(result_array);
				} else {
					$('#log_table').before('<p>No logs yet</p>');

				}
				
			}
		});
	}


/* Refactor By Rey Benedicto 2014-02-25 11.38*/
	function action_handler(){
		var thisClass = $(this).attr('class');

		var activate = "Activate";
		var enable = "Enable";
		var disable = "Disable";

		var username = $(this).attr('username')
		var email = $(this).attr('email')

		$this = $(this);

		//set the action of the button
		thisAction = activate //default action for users
		if 		(thisClass == 'Enable_button') thisAction = enable //check if action needs to be changed
		else if (thisClass == 'Disable_button') thisAction = disable


		//set the number of the user
		var number = $(this).attr('student_no');  //default number
		var numberType = "Student Number: "  //default number type
		if ($(this).attr('usertype') === 'employee') { //check if type and number need to be changed
			number = $(this).attr('emp_no')
			numberType = "Employee Number: "
		}

		//message to be given to the admin
		var constr = "Are you sure you want to " + thisAction + " this account?\nUsername: "+username+"\n" + numberType +number+"\nE-mail: "+email;
		
		if(confirm(constr))
		{		
			var controllerFunction = thisAction.toLowerCase()
			var newUrl = filepath+"enable_disable/" + controllerFunction + "/"+ username

			//if action is activate
			var actionIsActivate = controllerFunction == activate.toLowerCase()
			if (actionIsActivate) newUrl += "/" + $(this).attr('usertype') +"/"+ number 

			$.ajax({
				url : newUrl + "/" + email,
				type : 'POST',
				dataType : "html",
				async : true,
				success: function(data) {

					var json_data = JSON.parse(data)

					var nextAction = enable //default value for next resulting Action of the button
					var nextClass = 'Enable_button' //default value for the next resulting class of the button
					if (thisAction==enable || thisAction==activate) nextAction = disable //if next action needs to be changed
					if (thisClass=='Activate_button' || thisClass=='Enable_button') nextClass = 'Disable_button' //if next class needs to be changed

					if(json_data.success)
					{
						$this.val(nextAction);
						$this.removeClass(thisClass).addClass(nextClass);
						alert("Successfully " + thisAction +"d the account");
						log_users();
					} else {
						if (actionIsActivate){
							alert("Invalid user! Account automatically deleted");
							//ASSUMPTION : the user has already been deleted from the database
							//remove the row closes to the button pressed
							$this.closest('tr').remove();
						}
					}
				}
			});
		}
	}




	

	function main()
	{
		/* Refactor By Rey Benedicto 2014-02-25 11.38*/
		/* bind the handlers only when the user performs a search */ 
		$('#result_table').on("click",'.Activate_button',action_handler);
		$('#result_table').on("click",'.Enable_button',action_handler);
		$('#result_table').on("click",'.Disable_button',action_handler);
		log_users();
	}	

	$(document).ready(main);

