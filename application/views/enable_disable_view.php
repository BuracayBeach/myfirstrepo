<?php 
	  //Author: Cyril Bravo
	  //Description: This document is the actual view of enable/disable
?>
		<div id="results">
			
			<div id ="pagination_controller">

          	</div>

          	<table id="result_table">	
          		
          	</table>

          	
		</div>

		<!-- start edit by Carl Adrian P. Castueras -->
		<div id="account_log">
			<h4>Account Log</h4>
			<div id="logsPerPage">
				<label for="log_page_size">Logs Per Page</label>
				<input type= "number" id="log_page_size" min="1" value="5" style="width:40px"/>
			</div>
			<br>
			<div id="logs_pagination" page='1' pagecount='1'>
				
			</div>
			<table id="log_table">

			</table>
			
		</div>
		<!-- end edit -->
		<script type = "text/javascript" src = "<?php echo base_url() ?>js/search_user_manager.js"></script>
		<script type = "text/javascript" src = "<?php echo base_url() ?>js/account_status_manager.js"></script>
		

<?php //end of file enable_disable_view ?>
