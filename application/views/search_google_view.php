<div id="default_home">
	<?php
		if (!isset($_SESSION)) session_start();

		$_SESSION['search_data']['type_book'] = 'on'; 
		$_SESSION['search_data']['type_journal'] = 'on'; 
		$_SESSION['search_data']['type_sp'] = 'on'; 
		$_SESSION['search_data']['type_thesis'] = 'on'; 
		$_SESSION['search_data']['type_other'] = 'on'; 
		$_SESSION['search_data']['search_by'] = 'book_title';
	?>

	<form method="POST" action="<?php echo base_url()?>ihome">

		<div id="bg"><img src="<?php echo base_url();?>images/chibi1.png" id="chibi1"/><img src="<?php echo base_url();?>images/chibi2.png" id="chibi2"/></div>
		<div id="logcon"><img src="<?php echo base_url();?>images/logo_full3_ws_min.png" id="logoogle"></div>
		<div class="form-group" id="google_bg"><input class="form-control" id="google_search_text" type="search" name='home_search_text' autofocus='true' placeholder='Keywords...' maxlength='99'  />
		<br/><input class="btn btn-primary" id='google_submit_search' type="submit" name="submit_search" value="Search"/>
		</div>

	</form>