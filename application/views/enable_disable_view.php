<?php 
	  //Author: Cyril Bravo
	  //Description: This document is the actual view of enable/disable
?>
		<div id="container">
			
          	<div id="result">	
          		<?php
          			//var_dump($result);
          			if(isset($result) && count($result) > 0)//checks if $result not null
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


						echo "<div id='links_container'>".$links."</div>";
					}

					else
					{
						echo '<p>No results</p>';
					}
				?>
          	</div>
		</div>

		<!-- start edit by Carl Adrian P. Castueras -->
		<div id="account_log">
			<h4>Account Log</h4>
			<table id="log_table">
			</table>
			<div id="logs_pagination" page='1' pagecount='1'>
			<span><a href='javascript:void(0)'>< Prev</a>    This is the amazing pagination for logs <a href='javascript:void(0)'>Next ></a></span>
			</div>
		</div>
		<!-- end edit -->

		<script type = "text/javascript" src = "<?php echo base_url() ?>js/account_status_manager.js"></script>

<?php //end of file enable_disable_view ?>
