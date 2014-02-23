
			<div id="search">
				<form id="search_form" name="search_form" method="post">
					<?php
						if (isset($_SESSION['type']) && $_SESSION['type'] == "admin"){
							echo '
							<h4>Status</h4>
							<div id="status">
								<input id = "available" type="checkbox" name = "available" checked>
									<label for="available">Available</label>
								<input id = "reserved" type="checkbox" name = "reserved" checked>
									<label for="reserved">Reserved</label>
								<input id = "borrowed" type="checkbox" name = "borrowed" checked >
									<label for="borrowed" style="clear:right;">Borrowed</label>
							</div>
							';
						}
					?>

					<div id="book_type_div">
						<h4>Type</h4>
						<input id = "type_book" type="checkbox" name = "type_book" checked>
							<label for="type_book">Book</label>
						<input id = "type_journal" type="checkbox" name = "type_journal" checked>
							<label for="type_journal">Journal</label>
						<input id = "type_sp" type="checkbox" name = "type_sp" checked>
							<label for="type_sp">SP</label>
						<input id = "type_thesis" type="checkbox" name = "type_thesis" checked>
							<label for="type_thesis">Thesis</label>
					</div>
				

					<input searchby="book_title" id="search_text" type="search" name='search' autofocus='true' placeholder='Keywords...' maxlength='99' spellcheck='true'/>
					<input id='submit_search' type="submit" name="submit_search" value="Search" /><br/>
		            <hr>
					
					<?php
						if (isset($_SESSION['type']) && $_SESSION['type'] == "admin"){
							echo '
							<select name="order_by">
								<option value="search_relevance"> Search Relevance </option>
								<option value="book_no"> Book Number </option>
								<option value="book_title"> Title </option>
								<option value="description"> Description </option>
								<option value="publisher"> Publisher</option>
								<option value="name"> Author</option>
								<option value="date_published"> Date Published</option>
							</select><br/>
							';
						}
					?>

					<div id="sidebar-wrapper">
				        <ul class="sidebar-nav">
				            <a href=""><li class="menu-toggle active" searchby="book_title"><img src="<?php echo base_url();?>images/icon/title1.png" alt="">&nbsp; Title</li></a>
				            <a href=""><li class="menu-toggle" searchby="book_no"><img src="<?php echo base_url();?>images/icon/number.png" alt="">&nbsp; Book Number</li></a>
				            <a href=""><li class="menu-toggle" searchby="author"><img src="<?php echo base_url();?>images/icon/user32.png" alt="">&nbsp; Author</li></a>
				            <a href=""><li class="menu-toggle" searchby="publisher"><img src="<?php echo base_url();?>images/icon/printer32.png" alt="">&nbsp; Publisher</li></a>
				            <a href=""><li class="menu-toggle" searchby="date_published"><img src="<?php echo base_url();?>images/icon/calendar.png" alt="">&nbsp; Year Published</li></a>
				            <a href=""><li class="menu-toggle" searchby="abstract"><img src="<?php echo base_url();?>images/icon/star32.png" alt="">&nbsp; Abstract</li></a>
				            <a href=""><li class="menu-toggle" searchby="any"><img src="<?php echo base_url();?>images/icon/wand32.png" alt="">&nbsp; Any</li></a>
				           
				            <hr>
				        </ul>
					</div>
	

					<div id='suggestion'>
						<!-- search suggestion go here -->
					</div>
				</form>
			</div>




    <script>
	    $(".menu-toggle").click(function(e) {
	        e.preventDefault();
	        $("li.active").toggleClass("active")
	        $(this).toggleClass("active");
	      
	    });
    </script>