

				function research(){
					var newSearch = $(this).text();
					if (newSearch){
						var searchText = $('#search_text');
						
						if ($(this).attr('class') == 'tag_link') searchText.attr('tagSearch',$(this).text())
						else searchText.val(newSearch.trim());
					
						$('#submit_search').submit();
						searchText.attr('tagSearch','false')
					}
				}

			
		        function r_num_valid(object){
		          o_val = parseFloat(object.val());
		          o_min = parseFloat(object.attr('min'));
		          o_max = parseFloat(object.attr('max'));

		          return $.isNumeric(o_val) && o_val >= o_min && o_val <= o_max && o_val % 1 == 0;
		        }


				    // alert("Reday")

				$(document).ready(function() {
					$('#search_form').unbind('submit').submit(ajax_results); //prevent form from submitting/refreshing
				    var lastRequest, lastSessionSave, lastAutoSearchUnset;


					function ajax_results(event){


                        $('.hideable').fadeOut(500);
						event.preventDefault();
						//get inputs
						var searchForm = $('#search_form')
						var my_input = searchForm.serialize();
						var searchText = searchForm.find('#search_text').val()

						if ($(this).attr('searchby') == null) {
							my_input += "&search_by=" + $('#search_text').attr('searchby');
						} else {
							search_by = $(this).attr('searchby');
							my_input += "&search_by=" + search_by;
							$('#search_text').attr('searchby', search_by);
						}

						var searchText = $('#search_text')
						var resultsPerPage = $('#results_per_page').val()
						 my_input += "&page=1";
						 my_input += "&rows_per_page=" + ($('#results_per_page').val()==0?10:resultsPerPage);
						 my_input += "&tagSearch=" + searchText.attr('tagSearch')

						

						var currentPath = window.location.href
						var searchPath = icejjfish + "ihome"

						if (currentPath != searchPath) my_input += "&autoSubmitSearch=true&searchFromOtherPage=true"
						else my_input += "&autoSubmitSearch=false&searchFromOtherPage=false"

						if (lastSessionSave && lastSessionSave.readyState != 4){ 
							lastSessionSave.abort();

						}else{
							//alert("first instance");
						    $("#loading").fadeIn(500);
						}

						lastSessionSave = $.ajax({
							type: "post",
							data: my_input, 
							url: icejjfish + "index.php/book/search_sessionize",
							success: function(data, jqxhr, status){
								if (currentPath != searchPath){
									 window.location.replace(icejjfish + "ihome");
								} else {
									if (lastRequest && lastRequest.readyState != 4) lastRequest.abort();

									lastRequest = $.ajax({
										type: "post",
										data: my_input, 
										url: icejjfish + "index.php/book/search",
										success: function(data, jqxhr, status){
			                                var resultContainer = $("#result_container");
			                                var recentlyAddedBooksContainer = resultContainer.find("#recently_added_books_container");
			                                 
			                                if (recentlyAddedBooksContainer.length != 0){
				                                recentlyAddedBooksContainer.nextAll().remove();
				                                resultContainer.append(data);
			                                } else {
				                                resultContainer.html(data);
				                            }

				                            var book_tab = $('[data-toggle="tab"]')
				                            if (book_tab.length != 0) {
				                            	book_tab[0].click();
                                                setReadMores($('#result_container'));
				                            }
				                            //assume rows are appended already
				                            // summarize(searchText);
											hideLoadingGIF()
										},
										fail: hideLoadingGIF()

						 			});

									//alert("end of instance");

							    	$('#results_per_page_div').fadeIn(500);
									$('#search').removeClass('home');
								}

							}
						});
						
						return false;

					}

					function hideLoadingGIF(){
						$("#loading").fadeOut(500, function(){
							$('.logo_main').fadeOut();
					    });
					}
				});


