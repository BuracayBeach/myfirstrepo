
			<div id="search">

				<?php
					if(isset($home))
						echo "<img class='logo_main' src='" . base_url() . "images/logo5.png'";
				?>
				<br>

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
				

					&nbsp;SEARCH<input searchby="book_title" id="search_text" type="text" name='search' autofocus='true' placeholder='Keywords...' maxlength='99'/>
					<input id='submit_search' type="submit" name="submit_search" value="Search" /><br/>
		            <hr>
					<div id="results_per_page_div" hidden>
						<input id='results_per_page' style="width:45px" type="number" min='1' max='500' value='10'/>
						<span>Results per page</span>
					</div>
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
				            <a href=""><li class="menu-toggle" searchby="book_title"><img src="<?php echo base_url();?>images/icon/title1.png" alt="">&nbsp; Title</li></a>
				            <a href=""><li class="menu-toggle" searchby="book_no"><img src="<?php echo base_url();?>images/icon/number.png" alt="">&nbsp; Book Number</li></a>
				            <a href=""><li class="menu-toggle" searchby="author"><img src="<?php echo base_url();?>images/icon/user32.png" alt="">&nbsp; Author</li></a>
				            <a href=""><li class="menu-toggle" searchby="publisher"><img src="<?php echo base_url();?>images/icon/printer32.png" alt="">&nbsp; Publisher</li></a>
				            <a href=""><li class="menu-toggle" searchby="date_published"><img src="<?php echo base_url();?>images/icon/calendar.png" alt="">&nbsp; Date Published</li></a>
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

			<div id='result_container'>

			</div>



			<script type="text/javascript">

				function research(){
					newSearch = $('#suggestion_text').html();
					newSearch = newSearch.replace("<strong>","");
					newSearch = newSearch.replace("</strong>","");
					$('#search_text').val(newSearch);

					$('#submit_search').click();
				}

				$(document).ready(function() {
				    $('#sidebar-wrapper').on('click', 'li', ajax_results);


					function ajax_results(event){
						event.preventDefault();

						my_input = $('#search_form').serialize();

						if ($(this).attr('searchby') == null) {
							my_input += "&search_by=" + $('#search_text').attr('searchby');
						}else {
							search_by = $(this).attr('searchby');
							my_input += "&search_by=" + search_by;
							$('#search_text').attr('searchby', search_by);
						}

						my_input += "&page=1";
						my_input += "&rows_per_page=" + $('#results_per_page').val();

						console.log(my_input);
						$.ajax({
							type: "post",
							data: my_input, 
							url: "http://localhost/myfirstrepo/index.php/book/search",
							success: function(data, jqxhr, status){
								$("#result_container").html(data);
							}
			 			});

						$('#search').removeClass('home');
						$('.logo_main').hide();
						$('#results_per_page_div').show();
						return false;
					}

					$('#search_form').submit(ajax_results); //prevent form from submitting/refreshing

				
					// when favorites/unfavorites/reserve/unreserve button is clicked on each row
					$("#result_container").on("click", ".book_action", function() {

						var info = new Array();
						info[0] = $(this).attr('book_no');

						var action_type = $(this).text();
						var controller = action_type;

						if (action_type == "favorite" || action_type == "reserve")
							var method = "add"; 
						else if (action_type == "unfavorite" || action_type == "unreserve")
							var method = "remove";

						if (action_type == "unfavorite")
							controller = "favorite";
						else if (action_type == "unreserve")
							controller = "reserve";

						$.ajax({
							url : "http://localhost/myfirstrepo/index.php/" + controller + "/" + method,
							data : { arr : info },
							type : 'POST',
							dataType : "html",
							async : true,
							success: function(data) {
							}
						});

						if (action_type == "favorite") 
							$(this).text("unfavorite");
						else if (action_type == "unfavorite") 	
							$(this).text("favorite");
						else if (action_type == "reserve") 
							$(this).text("unreserve");
						else if (action_type == "unreserve") 
							$(this).text("reserve");
						
					});
				});


			</script>


    <script>
	    $(".menu-toggle").click(function(e) {
	        e.preventDefault();
	        $("li.active").toggleClass("active")
	        $(this).toggleClass("active");
	      
	    });
    </script>