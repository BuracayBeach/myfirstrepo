<div id="default_home">
	<?php
		if (!isset($_SESSION)) session_start();
		$_SESSION['search_data']['autoSubmitSearch'] = 'true';
		$_SESSION['search_data']['type_book'] = 'on'; 
		$_SESSION['search_data']['type_journal'] = 'on'; 
		$_SESSION['search_data']['type_sp'] = 'on'; 
		$_SESSION['search_data']['type_thesis'] = 'on'; 
		$_SESSION['search_data']['type_other'] = 'on'; 
		$_SESSION['search_data']['search_by'] = 'book_title';
	?>

	<form method="POST" action="<?php echo base_url()?>ihome">
		<div class="form-group"><input class="form-control" id="search_text" type="search" name='home_search_text' autofocus='true' placeholder='Keywords...' maxlength='99'  /></div>
		<input class="btn btn-primary" id='submit_search' type="submit" name="submit_search" value="Search"/><br/>
	</form>