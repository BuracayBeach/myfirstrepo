
			<div id="search" class="">
				<form id="search_form" name="search_form" method="post">


					<div id="dropdown_container">
						<div id="book_type_div" class="dropdown-check-list">

					        <span class="anchor">Type</span>
					        <ul class="items">
					            <li> &nbsp;&nbsp;<input class="check" id = "type_book" type="checkbox" name = "type_book" checked> 
									<label class="labelC" for="type_book">Book</label></li>
					            <li> &nbsp;&nbsp;<input class="check" id = "type_journal" type="checkbox" name = "type_journal" checked>
									<label class="labelC" for="type_journal">Journal</label></li>
					            <li> &nbsp;&nbsp;<input class="check" id = "type_sp" type="checkbox" name = "type_sp" checked>
									<label class="labelC" for="type_sp">SP</label></li>
					            <li> &nbsp;&nbsp;<input class="check" id = "type_thesis" type="checkbox" name = "type_thesis" checked>
									<label class="labelC" for="type_thesis">Thesis</label></li>
					            <li> &nbsp;&nbsp;<input class="check" id = "type_other" type="checkbox" name = "type_other" checked>
									<label class="labelC" for="type_other">Other</label></li>
					        </ul>
					    </div>

						<?php
							if (isset($_SESSION['type']) && $_SESSION['type'] == "admin"){
								echo '
								<div id="status" class="dropdown-check-list">
								        <span class="anchor">Status</span>
								        <ul class="items">
								            <li> <input class="check" id = "available" type="checkbox" name = "available" checked>
											<label for="available">Available</label></li>
								            <li>  <input class="check" id = "reserved" type="checkbox" name = "reserved" checked>
											<label for="reserved">Reserved</label></li>
								            <li>  <input class="check" id = "borrowed" type="checkbox" name = "borrowed" checked > 
											<label for="borrowed" style="clear:right;">Borrowed</label></li>
								        </ul>
								    </div>
								';
							}
						?>

						<hr>
					</div>

					<input searchby="book_title" id="search_text" type="search" name='search' autofocus='true' placeholder='Keywords...' maxlength='99' spellcheck='true' tagSearch='false'/>
				<input id='submit_search' type="submit" name="submit_search" value="Search"/><br/>
					<hr>
					<?php
						// if (isset($_SESSION['type']) && $_SESSION['type'] == "admin"){
							echo '
							 &nbsp;	 &nbsp; sort by
							 </br></br>
							<select name="order_by" class="order_by">
								<option value="search_relevance"> Search Relevance</option>
								<option value="book_no"> Book Number </option>
								<option value="book_title"> Title </option>
								<option value="description"> Description </option>
								<option value="publisher"> Publisher</option>
								<option value="name"> Author</option>
								<option value="date_published"> Year Published</option>
							</select><br/><hr>
							';
						// }
					?>

					<div id="sidebar-wrapper">
				        <ul class="sidebar-nav">
				            <a href=""><li class="menu-toggle" searchby="book_title">Title / Description &nbsp; <img src="<?php echo base_url();?>images/icon/title1.png" alt="">&nbsp;&nbsp;</li></a>
				            <a href=""><li class="menu-toggle" searchby="book_no">Book Number &nbsp; <img src="<?php echo base_url();?>images/icon/number.png" alt="">&nbsp;&nbsp;</li></a>
				            <a href=""><li class="menu-toggle" searchby="author">Author &nbsp; <img src="<?php echo base_url();?>images/icon/user32.png" alt="">&nbsp;&nbsp;</li></a>
				            <a href=""><li class="menu-toggle" searchby="publisher">Publisher &nbsp; <img src="<?php echo base_url();?>images/icon/printer32.png" alt="">&nbsp; &nbsp;</li></a>
				            <a href=""><li class="menu-toggle" searchby="date_published">Year Published &nbsp; <img src="<?php echo base_url();?>images/icon/calendar.png" alt="">&nbsp;&nbsp;</li></a>
				            <a href=""><li class="menu-toggle" searchby="abstract">Abstract &nbsp; <img src="<?php echo base_url();?>images/icon/star32.png" alt="">&nbsp; &nbsp;</li></a>
				            <a href=""><li class="menu-toggle" searchby="any">Any &nbsp; <img src="<?php echo base_url();?>images/icon/wand32.png" alt="">&nbsp; &nbsp;</li></a>
				           
				            <hr>
				        </ul>
					</div>
	
				</form>
			</div>




<script type="text/javascript" src= "<?php echo base_url()?>js/search/resultsPerPageManager.js"></script>
<script type="text/javascript" src= "<?php echo base_url()?>js/search/searchByMenuToggle.js"></script>
<script type="text/javascript" src= "<?php echo base_url()?>js/search/typeStatusDropDown.js"></script>