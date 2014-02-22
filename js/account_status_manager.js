	//Script Author : Carl Adrian P. Castueras
	//Description : AJAX functions used for to call the activate,enable and disable controllers and then update the page dynamically

	function log_users()
	{
		$.ajax({
			url : "get_log/", //ASSUMPTION : the page is in the enable_disable controller
			type : 'POST',
			dataType : "html",
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
					$('#account_log #log_table').html(result_array);
				} else {
					$('#account_log #log_table').before('<p>No logs yet</p>');

				}
				
			}
		});
	}

	function activate_handler()
	{
		//save $(this) to a variable $this to make it accessible in the success section of the ajax call
		$this = $(this);
		var username = $(this).attr('username');
		var email = $(this).attr('email');
		var usertype = $(this).attr('usertype');

		//generate a prompt based on the user type
		if($(this).attr('student_no')){
			var number = $(this).attr('student_no');
			var constr = "Are you sure you want to Activate this account?\nUsername: "+username+"\nStudent Number: "+number+"\nE-mail: "+email;
		} else {
			var number = $(this).attr('emp_no');
			var constr = "Are you sure you want to Activate this account?\nUsername: "+username+"\nEmployee Number: "+number+"\nE-mail: "+email;
		}

		if(confirm(constr))
		{
			$.ajax({
				url : "activate/"+ username +"/"+ usertype +"/"+ number + "/" + email, //ASSUMPTION : this function will only be called from the enable_disable controller
				type : 'POST',
				dataType : "html",
				async : true,
				success: function(data) {
					
					//parse the data to JSON since it is of type html
					var json_data = JSON.parse(data);

					//activate the user only if the call to the activate function succeeded
					if(json_data.success)
					{
						//change the button into a disable button by changing its value,class and binded function
						$this.val("Disable");
						$this.off("click").on("click",disable_handler);
						$this.removeClass("Activate_button").addClass("Disable_button");
						alert("Successfully activated the account");
						//update the account log at the bottom of the page
						log_users();
					}

					else
					{
						alert("Invalid user! Account automatically deleted");
						//ASSUMPTION : the user has already been deleted from the database
						//remove the row closes to the button pressed
						$this.closest('tr').remove();
					}
				}
			});
		}
	}

	function disable_handler()
	{
		$this = $(this); //save $(this) to another variable to make it accessible in the success section of the ajax call
		var username = $(this).attr('username');
		var email = $(this).attr('email');

		//create a prompt based on the user type
		if($(this).attr('student_no'))
		{
			var number = $(this).attr('student_no');
			var constr = "Are you sure you want to Disable this account?\nUsername: "+username+"\nStudent Number: "+number+"\nE-mail: "+email;
		}
		else 
		{
			var number = $(this).attr('emp_no');
			var constr = "Are you sure you want to Disable this account?\nUsername: "+username+"\nEmployee Number: "+number+"\nE-mail: "+email;
		}
		if(confirm(constr))
		{
			$.ajax({
				url : "disable/"+ username + "/" + email,  //ASSUMPTION : this function is called from the enable_disable controller
				type : 'POST',
				dataType : "html",
				async : true,
				success: function(data) {

					var json_data = JSON.parse(data); //parse the data as JSON since it is of type html

					if(json_data.success)
					{
						//change the button into an enable button by changing its value,class and binded function
						$this.val("Enable");
						$this.off("click").on("click",enable_handler);
						$this.removeClass("Disable_button").addClass("Enable_button");
						alert("Successfully disabled the account");
						//update the user log
						log_users();
					}
				}
			});
		}
	}

	/* this function is the same as the disable handler except that it does the reverse operation (Section to be optimized) */
	function enable_handler()
	{
		$this = $(this);
		var username = $(this).attr('username');
		var email = $(this).attr('email');
		if($(this).attr('student_no'))
		{
			var number = $(this).attr('student_no');
			var constr = "Are you sure you want to Enable this account?\nUsername: "+username+"\nStudent Number: "+number+"\nE-mail: "+email;
		}
		else 
		{
			var number = $(this).attr('emp_no');
			var constr = "Are you sure you want to Enable this account?\nUsername: "+username+"\nEmployee Number: "+number+"\nE-mail: "+email;
		}
		if(confirm(constr))
		{
			$.ajax({
				url : "enable/"+ username + "/" + email,
				type : 'POST',
				dataType : "html",
				async : true,
				success: function(data) {

					var json_data = JSON.parse(data);

					if(json_data.success)
					{
						$this.val("Disable");
						$this.off("click").on("click",disable_handler);
						$this.removeClass("Enable_button").addClass("Disable_button");
						alert("Successfully enabled the account");
						log_users();
					}
				}
			});
		}
	}

	

	function main()
	{
		//bind the corresponding functions to the click events of the appropriate buttons
		$('.Activate_button').on("click",activate_handler);
		$('.Enable_button').on("click",enable_handler);
		$('.Disable_button').on("click",disable_handler);
		log_users();
	}	

	$(document).ready(main);