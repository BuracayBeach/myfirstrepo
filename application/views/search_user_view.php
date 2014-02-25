<h1>ICS Library</h1>
  	<div id="body" style="margin-left: 250px;">
  		
				<input type="radio" name="field" value="name" onclick='changeTextBox(value)' checked="true"/>
				<input type="radio" name="field" value="stdno" onclick='changeTextBox(value)'/>
				<input type="radio" name="field" value="empno" onclick='changeTextBox(value)'/>
				<input type="radio" name="field" value="uname" onclick='changeTextBox(value)'/>
				<input type="radio" name="field" value="email" onclick='changeTextBox(value)' />
			
			<div id="divtext">
        		<input type="text" placeholder="Enter first name" id="enterFname" name="firstname"/>
        		<input type="text" placeholder="Enter middle name" id="enterMname" name="middlename"/>
        		<input type="text" placeholder="Enter last name" id = "enterLname" name="lastname"/>
        	</div>
        	</br><input type = "radio" name = "status" value = "all" checked = "true"/>All
        	<input type = "radio" name = "status" value = "pending"/>Pending
        	<input type = "radio" name = "status" value = "enabled"/>Enabled
        	<input type = "radio" name = "status" value = "disabled"/>Disabled

        	</br><button type="submit" id="submitButton"> Search </button>
  	</div>

<script type = "text/javascript" src = "<?php echo base_url() ?>js/search_user_manager.js"></script>