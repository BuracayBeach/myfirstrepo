<?php 
	  //Author: Cyril Bravo
	  //Description: This document is the actual view of enable/disable
?>
		<div id="results">
			
          	<table id="result_table">	
          		
          	</table>
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
		<script type = "text/javascript" src = "<?php echo base_url() ?>js/search_user_manager.js"></script>
		<script type = "text/javascript" src = "<?php echo base_url() ?>js/account_status_manager.js"></script>
		

<?php //end of file enable_disable_view ?>
