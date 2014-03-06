

				function research(){
					var newSearch = $(this).html();
					if (newSearch){
						newSearch = newSearch.replace(/<strong>/g,"");
						newSearch = newSearch.replace(/<\/strong>/g,"");
						var searchText = $('#search_text')
						
						if (searchText.val() == '') searchText.val(newSearch.trim())

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



				$(document).ready(function() {
				    $('#sidebar-wrapper li').unbind();
				    $('#sidebar-wrapper li').bind('click', ajax_results);

					$('#search_form').unbind('submit').submit(ajax_results); //prevent form from submitting/refreshing

				    var lastRequest;
					function ajax_results(event){


						event.preventDefault();

						if (lastRequest && lastRequest.readyState != 4) lastRequest.abort();

						// console.log(event)
						// alert("event");

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

						resultsPerPage = $('#results_per_page').val()
						// if (r_num_valid($('#results_per_page')) == false) return;

						my_input += "&page=1";
						my_input += "&rows_per_page=" + ($('#results_per_page').val()==0?10:resultsPerPage);
						
						var searchText = $('#search_text')
						my_input += "&tagSearch=" + searchText.attr('tagSearch')
						// console.log(my_input);

					    // window.location.replace(icejjfish + "ihome/");



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
	                            }
	                            //assume rows are appended already
	                            // summarize(searchText);

	                            $('.hideable').hide();
							},
							fail: function(){
								alert("Search Failed");
							}

			 			});


						$('#search').removeClass('home');
						$('.logo_main').hide();
						$('#results_per_page_div').show();
						return false;
					}
				});


