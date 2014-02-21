<?php 
	  //Author: Cyril Bravo
	  //Description: This document is the actual view of enable/disable
?>
		<div id="container">
			<h1>ICS Library</h1>
		  	<div id="body">
		  		<?php echo form_open('enable_disable/search'); //creates a form?>
			  		<select name="field" onchange='changeTextBox(value)'>
						<option value="name">Name</option>
						<option value="stdno">Student Number</option>
						<option value="empno">Employee Number</option>
						<option value="uname">Username</option>
						<option value="email">Email Address</option>
					</select>
					<div id="divtext">
	            		<input type="text" placeholder="Enter first name" name="firstname"/>
	            		<input type="text" placeholder="Enter middle name" name="middlename"/>
	            		<input type="text" placeholder="Enter last name" name="lastname"/>
	            	</div>
	            	</br><input type = "radio" name = "status" value = "all" checked = "true"/>All
	            	<input type = "radio" name = "status" value = "pending"/>Pending
	            	<input type = "radio" name = "status" value = "enabled"/>Enabled
	            	<input type = "radio" name = "status" value = "disabled"/>Disabled

	            	</br><button type="submit" id="submitButton"> Search </button>
          	</div>
          	<div id="result">
          		<?php
          			if(isset($result))//checks if $result not null
          			{
	          			echo "<table border='1'><tr><th>Username</th><th>Email</th><th>User Type</th><th>First name</th><th>Middle name</th><th>Last name</th><th>Course</th><th>College</th><th>action</th></tr>";
						foreach ($result as $row)
						{
							echo "<tr>";
							echo "<td>".$row->username."</td>";
							echo "<td>".$row->email."</td>";
							echo "<td>".$row->usertype."</td>";
							echo "<td>".$row->name_first."</td>";
							echo "<td>".$row->name_middle."</td>";
							echo "<td>".$row->name_last."</td>";
							echo "<td>".$row->course."</td>";
							echo "<td>".$row->college."</td>";
							echo "<td>";
							switch($row->status)//creates a button depending on user status
							{
								case "pending":
								{
									echo  "<input type='button' value='Activate' class='Activate_button' usertype='{$row->usertype}' username='{$row->username}' student_no='{$row->student_no}' emp_no='{$row->emp_no}' email='{$row->email}'/>";//creates a button named activate
									break;
								}
								case "enabled":
								{
									echo "<input type='button' value='Disable' class='Disable_button' usertype='{$row->usertype}' username='{$row->username}' student_no='{$row->student_no}' emp_no='{$row->emp_no}'  email='{$row->email}'/>";//creates a button named disable
									break;
								}
								case "disabled":
								{
									echo "<input type='button' value='Enable' class='Enable_button' usertype='{$row->usertype}' username='{$row->username}' student_no='{$row->student_no}' emp_no='{$row->emp_no}' email='{$row->email}'/>";//creates a button named enable
									break;
								}
							}
							echo "</td>";
							echo "</tr>";
						}
						echo "</table>";
					}
				?>
          	</div>
		</div>

		<div id="account_log">

		</div>

		<script type = "text/javascript" src = "<?php echo base_url() ?>js/search_user_manager.js"></script>
		<script type = "text/javascript" src = "<?php echo base_url() ?>js/account_status_manager.js"></script>

		<script>
			$(document).load(function(){
				$.ajax({
					url : "http://localhost/myfirstrepo/index.php/enable_disable/get_logs/",
					type : 'POST',
					dataType : "html",
					async : true,
					success: function(data) {

						alert('ajax success');
					}
				});
			});

			
		</script>
<?php //end of file enable_disable_view ?>
