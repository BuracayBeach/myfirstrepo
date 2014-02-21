	//Script Author : Carl Adrian P. Castueras
	//Description : AJAX functions used for to call the activate,enable and disable controllers and then update the page dynamically

	function activate_handler()
	{
		$this = $(this);
		var username = $(this).attr('username');
		var email = $(this).attr('email');
		var usertype = $(this).attr('usertype');
		if($(this).attr('student_no'))
		{
			var number = $(this).attr('student_no');
			var constr = "Are you sure you want to Activate this account?\nUsername: "+username+"\nStudent Number: "+number+"\nE-mail: "+email;
		}
		else 
		{
			var number = $(this).attr('emp_no');
			var constr = "Are you sure you want to Activate this account?\nUsername: "+username+"\nEmployee Number: "+number+"\nE-mail: "+email;
		}
		if(confirm(constr))
		{
			$.ajax({
				url : "http://localhost/mysecondrepoV2/index.php/enable_disable/activate/"+ username +"/"+ usertype +"/"+ number + "/" + email,
				type : 'POST',
				dataType : "html",
				async : true,
				success: function(data) {
					
					var json_data = JSON.parse(data);
					if(json_data.success)
					{
						$this.val("Disable");
						$this.off("click").on("click",disable_handler);
						$this.removeClass("Activate_button").addClass("Disable_button");
						alert("Successfully activated the account");
					}

					else
					{
						alert("Invalid user! Account automatically deleted");
						$this.closest('tr').remove();
					}
				}
			});
		}
	}

	function disable_handler()
	{
		$this = $(this);
		var username = $(this).attr('username');
		var email = $(this).attr('email');
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
				url : "http://localhost/mysecondrepoV2/index.php/enable_disable/disable/"+ username + "/" + email,
				type : 'POST',
				dataType : "html",
				async : true,
				success: function(data) {

					var json_data = JSON.parse(data);

					if(json_data.success)
					{
						$this.val("Enable");
						$this.off("click").on("click",enable_handler);
						$this.removeClass("Disable_button").addClass("Enable_button");
						alert("Successfully disabled the account");
					}
				}
			});
		}
	}

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
				url : "http://localhost/mysecondrepoV2/index.php/enable_disable/enable/"+ username + "/" + email,
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
					}
				}
			});
		}
	}

	//bind the corresponding functions to the click events of the appropriate buttons
	$('.Activate_button').on("click",activate_handler);
	$('.Enable_button').on("click",enable_handler);
	$('.Disable_button').on("click",disable_handler);