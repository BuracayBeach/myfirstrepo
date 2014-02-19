			<div id="search" <?php if(isset($home)) echo "class = 'home'";?> >

				<?php
					if(isset($home))
						echo "<img class='logo_main' src='" . base_url() . "images/logo4.png'";
				?>
				<br>

				<form id="search_form" name="search_form" method="post">
					<?php
						if (isset($_SESSION['type']) && $_SESSION['type'] == "admin"){
							echo '
							<div id="status">
								<input id = "available" type="checkbox" name = "available" checked>
								<div class= "statuslabel" ><label for="available">Available</label></div>
								<input id = "reserved" type="checkbox" name = "reserved" checked>
								<div class= "statuslabel" ><label for="reserved">Reserved</label></div>
								<input id = "borrowed" type="checkbox" name = "borrowed" checked >
								<div class= "statuslabel" ><label for="borrowed" style="clear:right;">Borrowed</label></div>
							</div>
							';
						}
					?>

					<select name="search_by">
						<option value="book_title">Title / Description</option>
						<option value="book_no"> Book Number </option>
						<option value="status"> Status </option>
						<option class="select-dash" disabled ="disabled">----------</option>
						<option value="publisher"> Publisher</option>
						<option value="name"> Author</option>
						<option value="date_published"> Date Published</option>
						<option class="select-dash" disabled ="disabled">----------</option>
						<option value="any"> Any </option>
					</select>

					<input id="search_text" type="text" name='search' autofocus='true' placeholder='Keywords...'/>
					<input id='submit_search' type="submit" name="submit_search" value="Search" /><br/>

					<?php
						if (isset($_SESSION['type']) && $_SESSION['type'] == "admin"){
							echo '
							<select name="order_by">
								<option value="search_relevance"> Search Relevance </option>
								<option value="book_no"> Book Number </option>
								<option value="book_title"> Title </option>
								<option value="status"> Status </option>
								<option value="description"> Description </option>
								<option value="publisher"> Publisher</option>
								<option value="name"> Author</option>
								<option value="date_published"> Date Published</option>
							</select><br/>
							';
						}

					?>

					<div id='suggestion'>
						<!-- search suggestion go here -->
					</div>
				</form>
			</div>

			<div id='result_container'>

			</div>

			<script type="text/javascript">

				function research(){
					$('#search_text').val($('#suggestion_text').html());
					$('#submit_search').click();
				}

				$(document).ready(function() {
					
					function ajax_results(event){
						event.preventDefault();
		
						my_input = $('#search_form').serialize();

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
						return false;
					}

					$('#search_form').submit(ajax_results); //prevent form from submitting/refreshing

				
					// when favorites/unfavorites/reserve/unreserve button is clicked on each row
					$("#result_container").on("click", ".book_action", function() {

						var info = new Array();
						info[0] = $(this).attr('book_no');

						var action_type = $(this).text();
						var controller = action_type;

						if (action_type == "favorites" || action_type == "reserve")
							var method = "add"; 
						else if (action_type == "unfavorites" || action_type == "unreserve")
							var method = "remove";

						if (action_type == "unfavorites")
							controller = "favorites";
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

						if (action_type == "favorites") 
							$(this).text("unfavorites");
						else if (action_type == "unfavorites") 	
							$(this).text("favorites");
						else if (action_type == "reserve") 
							$(this).text("unreserve");
						else if (action_type == "unreserve") 
							$(this).text("reserve");
						
					});
				});


			</script>