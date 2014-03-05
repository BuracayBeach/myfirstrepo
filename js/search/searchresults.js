
				function research(){
					newSearch = $('#suggestion_text').html();
					newSearch = newSearch.replace(/<strong>/g,"");
					newSearch = newSearch.replace(/<\/strong>/g,"");
					$('#search_text').val(newSearch.trim());

					$('#submit_search').submit();
				}

				// function summarize(searchText){
    //                 var search_table = $("#search_table");
    //                 var tr_array = search_table.find('tr:first').nextAll();

    //                 tr_array.each(function(index, tr){
    //                 	tr = $(tr)
    //                 	var abstractTD = tr.find('td[book_data="abstract"]')
    //                 	var abstract = abstractTD.find('textarea').text()

    //                 	abstractTD.html(get_summarize(abstract, searchText))
    //                 })
				// }

				// function wordMatch(word, searchArray){
				// 	var word_is_matched = false
				// 	for (var b=0 ; b<searchArray.length ; b++){
				// 		var term = searchArray[b]
				// 		if (word.toLowerCase() == term.toLowerCase()) {
				// 			word_is_matched = true
				// 			break
				// 		}
				// 	}
				// 	return word_is_matched;
				// }

			

				// function get_summarize(abstract, searchText){
				// 	var summary = ''

				// 	var abstract = abstract.split(' ')
				// 	var searchArray = searchText.split(' ')
				// 	var maxAbstract = 200

				// 	var prev_word = ''
				// 	var next_word = ''

				// 	var last_added = 0
					
				// 	abstLen = abstract.length
				// 	for (var a=0 ; a<abstLen ; a++){
				// 		var word = abstract[a]
				// 		if (word.trim()=='') continue;
				// 		if (wordMatch(word, searchArray)){
				// 			summary += " ..."
				// 			if (a>0 && last_added<a-1) summary += abstract[a-1] + ' '
				// 			summary += '<strong>' + abstract[a] + '</strong> '
				// 			if (a<abstLen-1){
				// 				summary += abstract[a+1] + ' '
				// 				last_added = a+1
				// 				a++
				// 			}
				// 			summary += "... "
				// 		}
				// 		if (summary.length >= maxAbstract) break
				// 	}


				// 	// console.log(summary.length + ' ' + summary)
				// 	return summary
				// }

	

				$(document).ready(function() {
				    $('#sidebar-wrapper').on('click', 'li', ajax_results);


					function ajax_results(event){
						event.preventDefault();
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

						my_input += "&page=1";
						my_input += "&rows_per_page=" + ($('#results_per_page').val()==0?10:$('#results_per_page').val());

						// console.log(my_input);
						$.ajax({
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
							url : icejjfish + "index.php/" + controller + "/" + method,
							data : { arr : info },
							type : 'POST',
							dataType : "html",
							async : true,
							success: function(data) {

								if (controller == "reserve" && method == "add") {

									$.ajax({
										url : icejjfish + "index.php/" + "reserve" + "/view_rank/",
										data : {arr : info},
										type : 'POST',
										dataType : "html",
										async : true,
										success : function(data2) {								
											alert("here! " + data2);
											$("div.rank[book_no = '"+ info[0] +"']").text(data2).slideDown();
										}
									});

								}
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

						if (action_type == "unreserve") {
							$(this).html("reserve")
							$(this).toggleClass('btn_green btn_yellow');

							// hide the rank div
							$("div.rank[book_no = '"+ info[0] +"']").slideUp();
						}
						else if (action_type == "reserve") {
							$(this).html("unreserve")
							$(this).toggleClass('btn_green btn_yellow');
						}

						$.ajax({
							url : icejjfish + "index.php/" + "notifs" + "/" + "check_reserve_for_first",
							data : {arr : info},
							type : 'POST',
							dataType : "html",
							async : true,
							success : function(data) {}
						});
					});
				});


