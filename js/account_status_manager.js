	//Script Author : Carl Adrian P. Castueras
	//Description : AJAX functions used for to call the activate,enable and disable controllers and then update the page dynamically

	var filepath = "http://localhost/myfirstrepo/"

	function log_users()
	{
		page = $('#logs_pagination').attr('page');
		page_size = $('#log_page_size').val();
		mydata = {
			'page' : page,
			'page_size' : page_size
		};
		
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
					var num_results = json_data.results.length;
				} else {
					var num_results = 0;
				}

				var num_pages = json_data.log_data.num_pages;

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
						row += "<td class='log_col'>"+json_data.results[i].username_user+"</td>";
						row += "<td class='log_col'>"+json_data.results[i].username_admin+"</td>";
						row += "<td class='log_col'>"+json_data.results[i].email+"</td>";
						row += "<td class='log_col'>"+json_data.results[i].date+"</td>";
						row += "<td class='log_col'>"+json_data.results[i].action+"</td>";
						row += "</tr>";
						result_array.push(row);
					}
					//replace the entire table with an updated table
					$('#log_table').html(result_array);

					if(num_pages > 1){
						generateLogPagination(num_pages)
					} else {
						//empty the log pagination div if there is no need for pagination
						$('#logs_pagination').removeAttr();
						$('#logs_pagination').html('');
					}
				} else {
					$('#log_table').before('<p>No logs yet</p>');

				}
				
			}
		});
	}

	function generateLogPagination(num_pages)
	{
		var lp = $('#logs_pagination');

		$(lp).attr({
			'pagecount' : num_pages
		});

		var curr_page = $(lp).attr('page')*1; //multiply by 1 to "force" it into an integer
		var pagination_links = '';
		var page_scale = 10; //this should always be an even integer

		pagination_links += "<a href='javascript:void(0)' id='prev_log_page'> < Prev&nbsp;&nbsp;</a>";
		for(var i=1;i<=num_pages;i+=1)
		{
			//skip adding links to lower pages when they are out of the page scale
			if(curr_page > page_scale/2 && curr_page - page_scale/2 > i) continue;
			//skip adding links to upper pages when they are out of the page scale
			if(i > curr_page + page_scale/2 && i > page_scale) continue;

			if(i === curr_page) pagination_links += "<strong>";
			pagination_links += "<a href='javascript:void(0)' page='"+i+"' class='log_page'>&nbsp;"+i+"&nbsp;</a>";
			if(i === curr_page) pagination_links += "</strong>"
		}
		pagination_links += "<a href='javascript:void(0)' id='next_log_page'> &nbsp;&nbsp;Next > </a>";

		$(lp).html(pagination_links);

		//when you click a page link, the current page attribute and the displayed results should update
		$('.log_page').on('click',function(){
			$(lp).attr({
				'page' : $(this).attr('page')
			});
			log_users();
		});

		//bind functionality to the prev button only if not on page 1
		if(curr_page > 1){

			$('#prev_log_page').on('click',function(){
				var prev_page = ($(lp).attr('page')*1)-1;
				$(lp).attr({
					'page' : prev_page
				});
				log_users();
			});
			
		}

		//bind functionality to the next button only if not on the last page
		if(curr_page !== num_pages){

			$('#next_log_page').on('click',function(){
				var next_page = ($(lp).attr('page')*1)+1;
				$(lp).attr({
					'page' : next_page
				});
				log_users();
			});
			
		}
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
						//return to page 1 of the pagination each time the log updates
						$('#logs_pagination').attr({
							'page' : "1"
						});
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

		//bind a function that triggers the log function when the value in the logs per page form changes
		$('#log_page_size').change(function(){
			$('#logs_pagination').attr({
				'page' : 1
			});
			log_users();
		})
	}	

	$(document).ready(main);

