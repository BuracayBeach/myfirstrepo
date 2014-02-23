
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
						my_input += "&rows_per_page=" + ($('#results_per_page').val()==0?10:$('#results_per_page').val());

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

