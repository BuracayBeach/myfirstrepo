<h1>ICS Library</h1>
  	<div id="body" style="margin-left: 250px;">
  		
				<input id="f_name" type="radio" name="field" value="name" onclick='changeTextBox(value)' checked="true"/>
          <label for="f_name">Name</label>
				<input id="f_studno" type="radio" name="field" value="stdno" onclick='changeTextBox(value)'/>
          <label for="f_studno">Student No.</label>
				<input id="f_empno" type="radio" name="field" value="empno" onclick='changeTextBox(value)'/>
          <label for="f_empno">Employee No.</label>
				<input id="f_username" type="radio" name="field" value="uname" onclick='changeTextBox(value)'/>
          <label for="f_username">Username</label>
				<input id="f_email" type="radio" name="field" value="email" onclick='changeTextBox(value)' />
          <label for="f_email">Email</label>
			
			<div id="divtext">
        		<input type="text" placeholder="Enter first name" id="enterFname" name="firstname"/>
        		<input type="text" placeholder="Enter middle name" id="enterMname" name="middlename"/>
        		<input type="text" placeholder="Enter last name" id = "enterLname" name="lastname"/>
        	</div>
        	</br>
          <input id="r_all" type = "radio" name = "status" value = "all" checked = "true"/>
            <label for="r_all">All</label>
        	<input id="r_pending" type = "radio" name = "status" value = "pending"/>
            <label for="r_pending">Pending</label>
        	<input id="r_enabled" type = "radio" name = "status" value = "enabled"/>
            <label for="r_enabled">Enabled</label>
        	<input id="r_disabled" type = "radio" name = "status" value = "disabled"/>
            <label for="r_disabled">Disabled</label>

        	</br><button type="submit" id="submitButton"> Search </button>
          <input type="number" id="page_size" min="1" value="10" />
  	</div>

<script type = "text/javascript" src = "<?php echo base_url() ?>js/search_user_manager.js"></script>