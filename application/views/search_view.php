<?php //for search settings preset
	$s_stext =  '';
	$s_sby =  'book_title';
	$order_by = 'search_relevance';

	$sr = '';$bn = '';$bt = '';$ds =  '';$pb =  '';$na =  '';$dp = '';

	$book = $journal = $sp = $thesis = $other = " checked";
	$ava = $res = $bor = " checked";

	if (isset($_SESSION['search_data'])){
		// var_dump($_SESSION['search_data']);

		$sss = $_SESSION['search_data'];
		if (isset($sss['search'])) $s_stext =  $sss['search'];
		if (isset($sss['search_by'])) $s_sby = htmlspecialchars(stripslashes(trim($sss['search_by'])));

		if (isset($sss['order_by'])) $order_by = $sss['order_by'];

		if (!isset($sss['type_book'])) $book = '';
		if (!isset($sss['type_journal'])) $journal = '';
		if (!isset($sss['type_sp'])) $sp = '';
		if (!isset($sss['type_thesis'])) $thesis = '';
		if (!isset($sss['type_other'])) $other = '';

		if (!isset($sss['available'])) $ava = '';
		if (!isset($sss['reserved'])) $res = '';
		if (!isset($sss['borrowed'])) $bor = '';

		if (isset($sss['order_by'])){
			$sr = $sss['order_by']=='search_relevance'?'selected':'';
			$bn  = $sss['order_by']=='book_no'?'selected':'';
			$bt  = $sss['order_by']=='book_title'?'selected':'';
			$ds  = $sss['order_by']=='description'?'selected':'';
			$pb  = $sss['order_by']=='publisher'?'selected':'';
			$na  = $sss['order_by']=='name'?'selected':'';
			$dp  = $sss['order_by']=='date_published'?'selected':'';
		}
	}
?>

			<div id="search" class="">
				<form id="search_form" name="search_form" method="post">

				<div class="form-group"><input class="form-control" searchby="<?=$s_sby?>" id="search_text" type="search" name='search' autofocus='true' placeholder='Keywords...' maxlength='99' spellcheck='true' tagSearch='false' value="<?=$s_stext?>" /></div>
				<input class="btn btn-primary" id='submit_search' type="submit" name="submit_search" value="Search"/><br/>
					<hr>
					

					<div id="sidebar-wrapper">
				        <ul class="sidebar-nav">
				            <a class="menu-toggle" href="javascript:void(0)"><li class="menu-toggle <?=$s_sby=='book_title'?'active':''?>"  searchby="book_title">Title, Desc &nbsp; <img src="<?php echo base_url();?>images/icon/title1.png" alt="">&nbsp;&nbsp;</li></a>
				            <a class="menu-toggle" href="javascript:void(0)"><li class="menu-toggle <?=$s_sby=='book_no'?'active':''?>" searchby="book_no">Call No, ISBN &nbsp; <img src="<?php echo base_url();?>images/icon/number.png" alt="">&nbsp;&nbsp;</li></a>
				            <a class="menu-toggle" href="javascript:void(0)"><li class="menu-toggle <?=$s_sby=='author'?'active':''?>" searchby="author">Author &nbsp; <img src="<?php echo base_url();?>images/icon/user32.png" alt="">&nbsp;&nbsp;</li></a>
				            <a class="menu-toggle" href="javascript:void(0)"><li class="menu-toggle <?=$s_sby=='publisher'?'active':''?>" searchby="publisher">Publisher &nbsp; <img src="<?php echo base_url();?>images/icon/printer32.png" alt="">&nbsp; &nbsp;</li></a>
				            <a class="menu-toggle" href="javascript:void(0)"><li class="menu-toggle <?=$s_sby=='date_published'?'active':''?>" searchby="date_published">Year Published &nbsp; <img src="<?php echo base_url();?>images/icon/calendar.png" alt="">&nbsp;&nbsp;</li></a>
				            <a class="menu-toggle" href="javascript:void(0)"><li class="menu-toggle <?=$s_sby=='abstract'?'active':''?>" searchby="abstract">Abstract &nbsp; <img src="<?php echo base_url();?>images/icon/star32.png" alt="">&nbsp; &nbsp;</li></a>
				            <a class="menu-toggle" href="javascript:void(0)"><li class="menu-toggle <?=$s_sby=='any'?'active':''?>" searchby="any">Any &nbsp; <img src="<?php echo base_url();?>images/icon/wand32.png" alt="">&nbsp; &nbsp;</li></a>
				           
				            <hr>
				        </ul>
					</div>
					<div id="dropdown_container">
								<div id="book_type_div" class="dropdown-check-list">
						        <span class="anchor">Type</span>
						        <ul class="items">
						            <li> &nbsp;&nbsp;<input class="check" id = "type_book" type="checkbox" name = "type_book"  <?=$book?> > 
										<label class="labelC" for="type_book">Book</label></li>
						            <li> &nbsp;&nbsp;<input class="check" id = "type_journal" type="checkbox" name = "type_journal" <?=$journal?>>
										<label class="labelC" for="type_journal">Journal</label></li>
						            <li> &nbsp;&nbsp;<input class="check" id = "type_sp" type="checkbox" name = "type_sp" <?=$sp?>>
										<label class="labelC" for="type_sp">SP</label></li>
						            <li> &nbsp;&nbsp;<input class="check" id = "type_thesis" type="checkbox" name = "type_thesis" <?=$thesis?>>
										<label class="labelC" for="type_thesis">Thesis</label></li>
						            <li> &nbsp;&nbsp;<input class="check" id = "type_other" type="checkbox" name = "type_other" <?=$other?>>
										<label class="labelC" for="type_other">Other</label></li>
						        </ul>
						    </div>

							<?php
								if (isset($_SESSION['type']) && $_SESSION['type'] == "admin"){


									echo '
									<div id="status" class="dropdown-check-list">
									        <span class="anchor">Status</span>
									        <ul class="items">
									            <li> <input class="check" id = "available" type="checkbox" name = "available" ' . $ava . ' >
												<label for="available">Available</label></li>
									            <li>  <input class="check" id = "reserved" type="checkbox" name = "reserved" ' . $res . ' >
												<label for="reserved">Reserved</label></li>
									            <li>  <input class="check" id = "borrowed" type="checkbox" name = "borrowed" ' . $bor . ' >
												<label for="borrowed" style="clear:right;">Borrowed</label></li>
									        </ul>
									    </div>
									';
								}
							?>
							<br>
							<hr/>
							<?php
						// if (isset($_SESSION['type']) && $_SESSION['type'] == "admin"){
							echo '
							 &nbsp;	 &nbsp; sort by: <br>
							<select class="form-control" name="order_by" class="order_by">
								<option value="search_relevance" ' . $sr . '> Search Relevance</option>
								<option value="book_no" ' . $bn . '> Book Number </option>
								<option value="book_title" ' . $bt . '> Title </option>
								<option value="description" ' . $ds . '> Description </option>
								<option value="publisher" ' . $pb . '> Publisher</option>
								<option value="name" ' . $na . '> Author</option>
								<option value="date_published" ' . $dp . '> Year Published</option>
							</select><br/><hr>
							';
						// }
					?>
						</div>	
				</form>
			</div>


<?php 
	$awto = null;
	if (isset($_SESSION['search_data']) && isset($_SESSION['search_data']['autoSubmitSearch'])) $awto = $_SESSION['search_data']['autoSubmitSearch'];
	echo "<div id='autoSubmitSearchDiv' balyu='{$awto}''></div>";
?>


<script type="text/javascript" src= "<?php echo base_url()?>js/search/resultsPerPageManager.js"></script>
<script type="text/javascript" src= "<?php echo base_url()?>js/search/searchByMenuToggle.js"></script>
<script type="text/javascript" src= "<?php echo base_url()?>js/search/typeStatusDropDown.js"></script>

<script type="text/javascript" src= "<?php echo base_url()?>js/search/searchResults.js"></script>
<script type="text/javascript" src= "<?php echo base_url()?>js/search/searchRedirection.js"></script>


<div id="rightbody">











