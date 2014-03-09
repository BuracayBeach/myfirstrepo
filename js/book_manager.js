$('#result_container,#faq_container').ready(function(){
    /***** EVENT ATTACHMENTS *****/
    $('#show_add_form_button').on('click',function(){
         showForm("add");
    });
    $('#cancel_button').on('click',function(){
        cancelForm();
    });

    $('#material_form').submit(submitMaterialForm);

    var contentContainer = $('#result_container');
    contentContainer.on('click','.edit_button',function(){
        showForm.call(this,"edit");
    });
    contentContainer.on('click','.delete_button',deleteBook);

    $('#type').change(checkBookType);

    $('#more_details').on('click',function(){
        var index = $('#material_form').find('.detail_name').length;
        generateInputDetail(this,index);
    });
    /***** END EVENT ATTACHMENTS *****/

    /* Hide Forms Initially */
    $('#date_published,#date_published').attr('max',new Date().getFullYear());

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

function showForm(action){
    var materialFormContainer = $('#material_form_container');
    materialFormContainer.find('form')[0].reset();
    materialFormContainer.find('.other').hide();
    materialFormContainer.find('.abstract').hide();
    $('#add_announcement_cancel_button,#edit_announcement_cancel_button').click();
    if(action == "add"){
        materialFormContainer.find('#submit_button').text("Add");
        $('.status_container').hide();
    }else if (action == "edit"){
        materialFormContainer.find('#submit_button').text("Edit");
        materialFormContainer.find('.status_container').show();
        fillEditForm.call(this);
    }

    materialFormContainer.slideToggle();

    $(materialFormContainer).find('#book_no').focus();
    return false;
}

function submitMaterialForm(){
    var submitButton = $(this).find("#submit_button");

    if(submitButton.text() == "Add"){
        addBook.call(this);
    }else if(submitButton.text() == "Edit"){
        editBook.call(this);
    }
    return false;
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
    materialFormContainer.find('.detail_content,.detail_name,.detail_name+br,.detail_content+br').remove();
    materialFormContainer.hide();
    return false;
}
/** END FORM FUNCTIONS **/
/***** ADD FUNCTIONS *****/
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
                    console.log(data);
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
    cancelForm();
    return false;
}
/***** END ADD FUNCTIONS *****/

/***** EDIT FUNCTIONS *****/
function fillEditForm(){
    cancelForm.call($('#cancel_button'));
    var td = $(this).closest('tr').find('[book_data=book_no]');
    var book_no = td.text();
    $.get("index.php/book/get_book",{'book_no':book_no},function(data){
        data = JSON.parse(data);
        data = data[0];
        console.log(data);
        var materialForm = $("#material_form");
        materialForm.find("#prev_book_no").val(data.book_no);
        materialForm.find("#book_no").val(data.book_no);
        materialForm.find("#book_title").val(data.book_title);
        materialForm.find("#book_status").val(data.status);
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

        editedRow = td.closest('tr');
        $("#add_announcement_cancel_button").click();

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
            console.log(data);
            console.log(data.length == 1 && prev_book_no == data[0].book_no);
            console.log(matchCount);
            if(isUnique){
                $.post("index.php/book/edit",formInputs,function(data){
                    data = JSON.parse(data);
                    console.log(data);
                    var rowToUpdate = editedRow;

                    rowToUpdate.find("[book_data='book_no']").text(data.book_no);
                    rowToUpdate.find("[book_data='book_type']").html("<em>"+data.type+"</em>");
                    rowToUpdate.find("[book_data='book_title']").text(data.book_title);
                    rowToUpdate.find("[book_data='author'] em").text(data.author);
                    rowToUpdate.find("[book_data='description']").text(data.description);
                    rowToUpdate.find("[book_data='publisher']").text(data.publisher);
                    rowToUpdate.find("[book_data='date_published']").text(data.date_published);
                    rowToUpdate.find("[book_data='tags']").text(data.tags);
                    rowToUpdate.find("[book_data='abstract']").text(data.abstract);

                    //status update
                    var transactionSpan =  rowToUpdate.find("span:has(.transaction_anchor)");

                    var anchorHTML = generateTransactionAnchorHTML(data.status,data.book_no);
                    transactionSpan.html(anchorHTML);

                    $.get("index.php/book/get_buttons_view", data, function(data){
                        console.log(data);
                        rowToUpdate.find('span').remove();
                        rowToUpdate.find('[book_data="author"]').after(data);
                    })
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
        var element = this;
        $.post('index.php/book/delete',{book_no:bookNo},function(){updateView(element)});
        function updateView(element){
            var table = $(element).closest('table');
            $(element).closest('tr').remove();
            if(table.attr('id') == "recently_added_books_table")
                toggleRecentlyAddedTable();
        }
    }
    cancelForm();
}
/***** END DELETE FUNCTIONS *****/
/***** FUNCTION FOR OTHER DATA *****/
function generateInputDetail(anchor,index){

    var detailHTML =
        '<div class="control-group detail">' +
            '<label class="control-label">Detail Name:</label>' +
            '<input type="text" title="Name of the Detail. (ie. Subject, Volume)" class="form-control detail_name" required="" placeholder="Detail Name" maxlength="20" name="other_detail['+index+'][name]"/>' +
            '<label class="control-label">Detail:</label>' +
            '<textarea class="form-control detail_content" placeholder="Detail" maxlength="255" name="other_detail['+index+'][content]"></textarea>' +
        '</div>';

    $(anchor).nextAll('.buttons').before(detailHTML);
    var detailContainer = $(anchor).nextAll('.detail:last');
    $("html,body").animate({ scrollTop: detailContainer.offset().top }, 2000);
    detailContainer.find('.detail_name')[0].focus();

}

/***** END FUNCTION FOR OTHER DATA *****/

/*** STRING HTML GENERATION FUNCTIONS ***/
function generateTransactionAnchorHTML(status,book_no){
    var anchorText = "";
    var href = "href='" + icejjfish + "index.php/update_book/";
    if(status == "reserved"){
        anchorText = "Lend";
        href += "lend/?id="+book_no+"'";
    }
    else if(status == "borrowed"){
        anchorText = "Return";
        href += "received/?id="+book_no+"'";
    }
    else{
        anchorText = "(available)";
        href="";
    }

    return "<a class='transaction_anchor' "+href+" bookno='"+book_no+"'>"+anchorText+"</a>";
}
/*** END STRING HTML GENERATION FUNCTIONS ***/

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
