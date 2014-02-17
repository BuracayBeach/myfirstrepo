			<div id="search"><br>

				<form id="search_form" name="search_form" method="post">
					<?php
						if ($is_admin){
							echo '
							<div id="status">
								<input id = "available" type="checkbox" name = "available" checked>
								<label for="available">Available</label><br/>
								<input id = "reserved" type="checkbox" name = "reserved" checked>
								<label for="reserved">Reserved</label><br/>
								<input id = "borrowed" type="checkbox" name = "borrowed" checked>
								<label for="borrowed">Borrowed</label><br/><br/>
							</div>
							';
						}
					?>

					<a>Search by:</a>
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

					<input id="search_text" type="text" name='search' placeholder='Keywords...'/>
					<input id='submit_search' type="submit" name="submit_search" value="Search" /><br/>

					<?php
						if ($is_admin){
							echo '
							<a>Order by:</a>
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


			<script src="<?=base_url('js/jquery-1.11.0.js')?>"></script>



			<script>

				function research(){
					$('#search_text').val($('#suggestion_text').html());
					$('#submit_search').click();
				}

				function ajax_results(){
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

					return false;
				}


				$('#search_form').submit(ajax_results); //prevent form from submitting/refreshing
				

			</script>