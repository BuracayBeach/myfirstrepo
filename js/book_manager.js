function generateInputDetail(e,t){var n='<div class="control-group detail removable">'+'<span><button type="button" class="show-on-hover x-button">x</button></span><br/>'+'<span class="required-asterisk">*</span><label class="control-label">Detail Name:</label>'+'<input type="text" title="Name of the Detail. (ie. Subject, Volume)" class="form-control detail_name" required="" placeholder="Detail Name" maxlength="20" name="other_detail['+t+'][name]"/>'+'<span class="required-asterisk">*</span><label class="control-label">Detail:</label>'+'<textarea class="form-control detail_content" required="" placeholder="Detail" maxlength="255" name="other_detail['+t+'][content]"></textarea>'+"</div>";$(e).before(n);var r=$(e).prev();r.hide();r.fadeIn()}function removeDetailInput(){$(this).closest(".detail").fadeOut(function(){$(this).remove()});return false}function resetForm(){var e=$("#material_form");e[0].reset();e.find(".other").hide();e.find(".abstract").hide()}function submitMaterialForm(e){e.preventDefault();var t=$(this).find("#material_submit_button");if(t.text()=="Add"){addBook.call(this)}else if(t.text()=="Save"){editBook.call(this)}}function checkBookType(){var e=$(this).val();var t=$(this).closest("form");if(e=="Other"){t.find(".other").prop("required",true).show()}else{t.find(".other").prop("required",false).hide()}if(e=="Book"){t.find(".isbn").show().next().show()}else{t.find(".isbn").hide().next().hide()}if(e!="Book"&&e!="Journal"){t.find(".abstract").show()}else{t.find(".abstract").hide()}}function cancelForm(){var e=$("#material_form_container");e.slideUp(function(){e.find(".detail").remove();e.find("form")[0].reset()});return false}function showAddForm(){function t(){resetForm();$("#add_announcement_cancel_button,#edit_announcement_cancel_button").click();e.find(".detail").remove();e.find("#material_submit_button").text("Add");e.find("#material-form-legend").text("").hide();$(".status_container").hide();e.slideDown(function(){$(e).find("#book_no").focus();$('[data-toggle="tab"]')[1].click()})}var e=$("#material_form_container");if(e.is(":visible")){if("Save"==e.find("#material_submit_button").text()){e.slideUp(function(){t()})}else{e.slideUp(function(){resetForm()})}}else{t()}return false}function addBook(){var e;if((e=checkAll.call(this))==""){var t=$(this).find("#book_no").val();var n=$(this);var r=n.serialize();$.get("index.php/book/get_book",{book_no:t},function(e){var t=JSON.parse(e).length==0;if(t){$.post("index.php/book/add",r,function(e){e=JSON.parse(e);$.get("index.php/book/get_row_view",e,function(e){$("#recently_added_books_table").find("tbody").append(e);toggleRecentlyAddedTable()})}).fail(function(){alert("Sorry! There was a problem processing your action.")});n.closest("div").fadeOut();$('[data-toggle="tab"]')[1].click()}else{alert("Cannot add duplicate material.")}})}else{e="Cannot continue action because of the following errors:<br/>"+e;$(this).closest("div").find(".errors").html(e)}return false}function fillEditForm(){var e=$(this).closest("tr").find("[book_data=book_no]");var t=e.text();$.get("index.php/book/get_book",{book_no:t},function(t){t=JSON.parse(t);t=t[0];if(t!=undefined){$("#add_announcement_cancel_button,#edit_announcement_cancel_button").click();var n=$("#material_form");n.closest("div").hide();n.closest("div").find(".detail").remove();n.closest("div").find("form")[0].reset();n.find("#material_submit_button").text("Add");n.find("#material-form-legend").text("Edit Material").show();n.find("#material_submit_button").text("Save");n.find("#prev_book_no").val(t.book_no);n.find("#book_no").val(t.book_no);n.find("#book_title").val(t.book_title);n.find("#book_status").val(t.status);n.find(".status_container").show();var r=t.book_type;if(r!="Journal"&&r!="Book"&&r!="SP"&&r!="Thesis"){r="Other";n.find("#other").val(t.book_type)}n.find("#type").val(r);checkBookType.call($("#type")[0]);n.find("#author").val(t.author);n.find("#abstract").val(t.abstract);n.find("#description").val(t.description);n.find("#publisher").val(t.publisher);n.find("#date_published").val(t.date_published);n.find("#tags").val(t.tags);if(t.other_detail!=""){t.other_detail.forEach(function(e){var t=$("#more_details");var r=n.find(".detail").length;generateInputDetail(t,r);var i=n.find(".detail");$(i[r]).find(".detail_name").val(e.name);$(i[r]).find(".detail_content").text(e.content)})}editedRow=e.closest("tr");$("#add_announcement_cancel_button").click();n.closest("div").slideDown(function(){n.find("#book_no")[0].focus()})}else{alert("Material not found. Row will now be deleted.");e.closest("tr").remove();toggleRecentlyAddedTable()}});return false}function editBook(){var e;if((e=checkAll.call(this))==""){var t=$(this).find("#book_no").val();var n=$(this).serialize();var r=$(this).find("#prev_book_no").val();var i=$(this);$.get("index.php/book/get_book",{book_no:t},function(e){e=JSON.parse(e);var t=e.length;var s=e.length==1&&r==e[0].book_no||t==0;if(s){$.post("index.php/book/edit",n,function(e){var t=editedRow;t.replaceWith(e)});i.closest("div").fadeOut()}else{alert("Edit failed: Book number duplicate.")}})}else{e="Cannot continue action because of the following errors:<br/>"+e;$(this).closest("div").find(".errors").html(e)}return false}function deleteBook(){var e=confirm("Confirm deleting this book");if(e==true){var t=$(this).attr("bookno");var n=this;$.post("index.php/book/delete",{book_no:t},function(){r(n)});function r(e){var n=$(e).closest("table");$(e).closest("tr").remove();var r=n.attr("id");if(r=="recently_added_books_table"){$("#result_container").find("table").find('[bookno="'+t+'"]').closest("tr").remove()}else if(r=="search_table"){$("#recently_added_books_table").find('[bookno="'+t+'"]').closest("tr").remove()}toggleRecentlyAddedTable()}}$("#material_cancel_button").click()}function toggleRecentlyAddedTable(){var e=$("#recently_added_books_table").find("tr");if(e.length>1){$("#no_recently").hide();e.closest("table").show()}else{$("#no_recently").show();e.closest("table").hide()}}$("#result_container,#faq_container").ready(function(){var e=$("#result_container");e.on("click",".edit_button",fillEditForm);e.on("click",".delete_button",deleteBook);$("#show_add_form_button").on("click",showAddForm);$("#material_cancel_button").on("click",cancelForm);var t=$("#material_form");t.submit(submitMaterialForm);t.on("click",".detail .x-button",removeDetailInput);$("#type").change(checkBookType);$("#more_details").on("click",function(){var e=$("#material_form").find(".detail_name").length;generateInputDetail(this,e);var t=$($(".detail")[e]);t.find(".detail_name")[0].focus();$("html, body").animate({scrollTop:t.offset().top})});$("#date_published").attr("max",(new Date).getFullYear());$("#material_form_container").hide();$(".status_container").hide()});$("#recently_added_books_container").ready(function(){var e=$("#recently_added_books_container");var t=e.find("table");t.on("click",".edit_button",fillEditForm);t.on("click",".delete_button",deleteBook);toggleRecentlyAddedTable()})