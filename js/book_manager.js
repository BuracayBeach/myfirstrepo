$('#result_container,#faq_container').ready(function(){
    /*-- Show Edit Form on click--*/
    var contentContainer = $('#result_container');
    contentContainer.on('click','.edit_button',fillEditForm);
    contentContainer.on('click','.delete_button',deleteBook);

    /*-- Show Add Form on click--*/
    $('#show_add_form_button').on('click',showAddForm);
    /*-- Show Cancel form on click--*/
    $('#material_cancel_button').on('click',cancelForm);
    /*-- remove detail on click of cancel button--*/
    var materialForm = $('#material_form');
    materialForm.click(submitMaterialForm);
    materialForm.submit(function(){
        $('#material_cancel_button').click();
        return false;
    });
    materialForm.on('click','.detail .x-button',removeDetailInput);

    $('#type').change(checkBookType);

    $('#more_details').on('click',function(){
        var index = $('#material_form').find('.detail_name').length;
        generateInputDetail(this,index);
        var detailContainer = $($('.detail')[index]);
        detailContainer.find('.detail_name')[0].focus();
        $("html, body").animate({ scrollTop: detailContainer.offset().top });
    });
    /***** END EVENT ATTACHMENTS *****/

    /* Hide Forms Initially */
    $('#date_published').attr('max',new Date().getFullYear());

    $('#material_form_container').hide();
    $('.status_container').hide();

});

$('#recently_added_books_container').ready(function(){
    var recentlyTableContainer =  $('#recently_added_books_container');
    var table = recentlyTableContainer.find('table');
    table.on('click','.edit_button',fillEditForm);
    table.on('click','.delete_button',deleteBook);

    toggleRecentlyAddedTable();
});

/** FORM FUNCTIONS **/
function generateInputDetail(anchor,index){
    var detailHTML =
        '<div class="control-group detail removable">' +
            '<span><button type="button" class="show-on-hover x-button">x</button></span><br/>' +
            '<label class="control-label">*Detail Name:</label>' +
            '<input type="text" title="Name of the Detail. (ie. Subject, Volume)" class="form-control detail_name" required="" placeholder="Detail Name" maxlength="20" name="other_detail['+index+'][name]"/>' +
            '<label class="control-label">*Detail:</label>' +
            '<textarea class="form-control detail_content" required="" placeholder="Detail" maxlength="255" name="other_detail['+index+'][content]"></textarea>' +
            '</div>';

    $(anchor).before(detailHTML);
    var detailContainer = $(anchor).prev();
    detailContainer.hide();
    detailContainer.fadeIn();
}
function removeDetailInput(){
    $(this).closest('.detail').fadeOut(function(){
       $(this).remove();
    });
    return false;
}
function resetForm(){
    var $form = $('#material_form');

    $form[0].reset();
    $form.find('.other').hide();
    $form.find('.abstract').hide();
}

function submitMaterialForm(event){
    event.preventDefault();
    var submitButton = $(this).find("#material_submit_button");

    if(submitButton.text() == "Add"){
        addBook.call(this);
    }else if(submitButton.text() == "Save"){
        editBook.call(this);
    }
}


function checkBookType(){
    var type = $(this).val();

    var form = $(this).closest('form');
    if(type == 'Other'){
        form.find('.other').prop('required',true).show();
    }else {
        form.find('.other').prop('required',false).hide();
    }

    if(type == "Book"){
        form.find('.isbn').show().next().show();
    }else{
        form.find('.isbn').hide().next().hide();
    }
    if(type != "Book" && type != "Journal"){

        form.find('.abstract').show();
    }
    else {

        form.find('.abstract').hide();
    }
}

function cancelForm() {
    var materialFormContainer = $('#material_form_container');
    materialFormContainer.slideUp(function(){
        materialFormContainer.find('.detail').remove();
        materialFormContainer.find('form')[0].reset();
    });
    return false;
}
/** END FORM FUNCTIONS **/
/***** ADD FUNCTIONS *****/
function showAddForm(){
    var materialFormContainer = $('#material_form_container');

    function resetAndShow(){
        resetForm();
        $('#add_announcement_cancel_button,#edit_announcement_cancel_button').click();

        materialFormContainer.find('.detail').remove();
        materialFormContainer.find('#material_submit_button').text("Add");
        materialFormContainer.find('#material-form-legend').text("").hide();
        $('.status_container').hide();
        materialFormContainer.slideDown(function(){
            $(materialFormContainer).find('#book_no').focus();
            $('[data-toggle="tab"]')[1].click();
        });
    }

    if(materialFormContainer.is(":visible")){
        if("Save" == materialFormContainer.find('#material_submit_button').text()){
            materialFormContainer.slideUp(function(){
                resetAndShow();
            });
        }else{
            materialFormContainer.slideUp(function(){
                resetForm();
            });
        }
    }else{
        resetAndShow();
    }



    return false;
}
function addBook(){
    var errors;
    if((errors = checkAll.call(this)) == ''){
        var book_no = $(this).find('#book_no').val();
        var addForm = $(this);
        var formInputs = addForm.serialize();
        $.get("index.php/book/get_book",{"book_no":book_no},function(data){
            var isUnique = JSON.parse(data).length == 0;
            if(isUnique){
                $.post("index.php/book/add",formInputs,function(data){
                    data = JSON.parse(data);

                    $.get("index.php/book/get_row_view",data,function(data){
                        $('#recently_added_books_table').find('tbody').append(data);
                        toggleRecentlyAddedTable();
                    });
                })
                    .fail(function(){
                        alert("Sorry! There was a problem processing your action.");
                    });

                $('[data-toggle="tab"]')[1].click();
            }else{
                alert('Cannot add duplicate material.')
            }
        });

    }else{
        errors = "Cannot continue action because of the following errors:<br/>" + errors;
        $(this).closest('div').find('.errors').html(errors);
    }
    return false;
}
/***** END ADD FUNCTIONS *****/

/***** EDIT FUNCTIONS *****/
function fillEditForm(){
    var td = $(this).closest('tr').find('[book_data=book_no]');
    var book_no = td.text();

    $.get("index.php/book/get_book",{'book_no':book_no},function(data){
        data = JSON.parse(data);
        data = data[0];
        
        if(data != undefined){
            $('#add_announcement_cancel_button,#edit_announcement_cancel_button').click();

            var materialForm = $("#material_form");
            materialForm.closest('div').hide();
            materialForm.closest('div').find('.detail').remove();
            materialForm.closest('div').find('form')[0].reset();

            materialForm.find('#material_submit_button').text("Add");
            materialForm.find('#material-form-legend').text("Edit Material").show();

            materialForm.find('#material_submit_button').text("Save");
            materialForm.find("#prev_book_no").val(data.book_no);
            materialForm.find("#book_no").val(data.book_no);
            materialForm.find("#book_title").val(data.book_title);
            materialForm.find("#book_status").val(data.status);
            materialForm.find('.status_container').show();
            var type = data.book_type;
            if( type != 'Journal' && type != 'Book' && type != 'SP' && type != 'Thesis'){
                type = "Other";
                materialForm.find('#other').val(data.book_type);
            }
            materialForm.find("#type").val(type);
            checkBookType.call( $('#type')[0] );
            materialForm.find("#author").val(data.author);
            materialForm.find("#abstract").val(data.abstract);
            materialForm.find("#description").val(data.description);
            materialForm.find("#publisher").val(data.publisher);
            materialForm.find("#date_published").val(data.date_published);
            materialForm.find("#tags").val(data.tags);

            if(data.other_detail != ''){
                data.other_detail.forEach(function(entry){
                    var anchor = $('#more_details');
                    var index = materialForm.find('.detail').length;
                    generateInputDetail(anchor,index);
                    var details = materialForm.find('.detail');

                    $(details[index]).find('.detail_name').val(entry.name);
                    $(details[index]).find('.detail_content').text(entry.content);
                });
            }
            editedRow = td.closest('tr');
            $("#add_announcement_cancel_button").click();
            materialForm.closest('div').slideDown(function(){
                materialForm.find('#book_no')[0].focus();
            });
        }else{
            alert('Material not found. Row will now be deleted.');
            td.closest('tr').remove();
            toggleRecentlyAddedTable();
        }
    });

    return false;
}

function editBook(){
    var errors;
    if((errors = checkAll.call(this)) == ''){
        var book_no = $(this).find('#book_no').val();
        var formInputs = $(this).serialize();
        var prev_book_no  = $(this).find('#prev_book_no').val();
        var editForm = $(this);
        $.get("index.php/book/get_book",{"book_no":book_no},function(data){
            data = JSON.parse(data);
            var matchCount = data.length;
            var isUnique = ((data.length == 1 && prev_book_no == data[0].book_no)|| matchCount == 0);
            if(isUnique){
                $.post("index.php/book/edit",formInputs,function(data){
                    var rowToUpdate = editedRow;

                    rowToUpdate.replaceWith(data);
                });
                editForm.closest('div').hide();
            }else{
                alert('Edit failed: Book number duplicate.');
            }
        });
    }else{
        errors = "Cannot continue action because of the following errors:<br/>" + errors;
        $(this).closest('div').find('.errors').html(errors);
    }
    return false;
}
/***** END EDIT FUNCTIONS*****/

/***** DELETE FUNCTIONS *****/
function deleteBook(){

    var result = confirm("Confirm deleting this book");
    if (result==true) {
        var bookNo = $(this).attr('bookno');
        var button = this;
        
        $.post('index.php/book/delete',{book_no:bookNo},function(){updateView(button)});
        function updateView(button){
            var table = $(button).closest('table');
            $(button).closest('tr').remove();
            var tableID = table.attr('id');
            //remove the same row from the 'other' table (other = either recently table or search table)

            if(tableID == "recently_added_books_table"){
                $('#result_container').find('table').find('[bookno="'+bookNo+'"]').closest('tr').remove();
            }else if(tableID == "search_table"){
                $('#recently_added_books_table').find('[bookno="'+bookNo+'"]').closest('tr').remove();
            }
            toggleRecentlyAddedTable();

        }
    }
    $('#material_cancel_button').click();
}
/***** END DELETE FUNCTIONS *****/

function toggleRecentlyAddedTable(){
    var recentlyAddedTableRows = $('#recently_added_books_table').find('tr');
    if(recentlyAddedTableRows.length > 1){
        $('#no_recently').hide();
        recentlyAddedTableRows.closest('table').show();
    }else{
        $('#no_recently').show();
        recentlyAddedTableRows.closest('table').hide();
    }
}
