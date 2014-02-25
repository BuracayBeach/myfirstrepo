$('#result_container,#faq_container').ready(function(){
    /***** EVENT ATTACHMENTS *****/
    $('#show_add_form_button').on('click',showAddForm);
    $('#add_cancel_button').on('click',cancelAdd);
    $('#add_book_form').submit(addBook);

    var contentContainer = $('#result_container');
    contentContainer.on('click','.edit_button',fillEditForm);
    contentContainer.on('click','.delete_button',deleteBook);

    $('#edit_cancel_button').on('click',cancelEdit);
    $('#edit_book_form').submit(editBook);


    $('#add_book_type').change(checkBookType);
    $('#edit_book_type').change(checkBookType);
    /***** END EVENT ATTACHMENTS *****/

    /* Hide Forms Initially */
    $('#add_date_published,#edit_date_published').attr('max',new Date().getFullYear());

    $('#add_container').hide();
    $('#edit_container').hide();

});

$('#recently_added_books_container').ready(function(){
    var recentlyTableContainer =  $('#recently_added_books_container');
    var table = recentlyTableContainer.find('table');
    table.on('click','.edit_button',fillEditForm);
    table.on('click','.delete_button',deleteBook);

    toggleRecentlyAddedTable();
});

/***** ADD FUNCTIONS *****/
function showAddForm(){
    var addContainer = $('#add_container');
    $('#edit_container').hide();

    $('#add_other').hide();
    $('.abstract_container').hide();
    addContainer.show();
    $(addContainer).find('#add_book_no').focus();
}
function cancelAdd(event){
    event.preventDefault();
    var addContainer = $('#add_container');
    addContainer.hide();
    addContainer.find('form')[0].reset();
}
function addBook(event){
    event.preventDefault();  /* stop form from submitting normally */
    var errors;
    if((errors = checkAll.call(this)) == ''){
        var book_no = $(this).find('#add_book_no').val();
        var addForm = $(this);
        var formInputs = addForm.serialize();
        $.get("index.php/book/get_book",{"book_no":book_no},function(data){
            var isUnique = JSON.parse(data).length == 0;
            if(isUnique){
                $.post("index.php/book/add",formInputs,function(data){
                    data = JSON.parse(data);
                    $.get("index.php/book/get_row_view",data,function(data){
                        $('#recently_added_books_table').find('tbody').append(data);
                        console.log('should be toggled');
                        toggleRecentlyAddedTable();
                    });
                })
                    .fail(function(){
                        alert("Sorry! There was a problem processing your action.");
                    });

                addForm.closest('div').hide();
            }else{
               alert('Cannot add duplicate material.')
            }
        });

        this.reset();
    }else{
        errors = "Cannot continue action because of the following errors:<br/>" + errors;
        $(this).closest('div').find('.errors').html(errors);
        //prompt error;
    }
}
/***** END ADD FUNCTIONS *****/

function checkBookType(){
    console.log(this);
    var type = $(this).val();

    var form = $(this).closest('form');
    if(type == 'Other'){
        form.find('.other').prop('required',true).show();
    }else {
        form.find('.other').prop('required',false).hide();
    }

    if(type != "Book" && type != "Journal")
        form.find('.abstract_container').show();
    else {
        form.find('.abstract_container').hide();
    }
}
/***** EDIT FUNCTIONS *****/
function fillEditForm(event){
    event.preventDefault();
    $('.abstract_container').hide();
    $('#add_container').hide();
    $('#edit_book_form')[0].reset();
    var td = $(this).closest('tr').find('[book_data=book_no]');
    var book_no = td.text();
    console.log(book_no);
    $.get("index.php/book/get_book",{'book_no':book_no},function(data){
        data = JSON.parse(data);
        data = data[0];
        console.log(data);
        var editForm = $("#edit_book_form");
        editForm.find("#edit_prev_book_no").val(data.book_no);
        editForm.find("#edit_book_no").val(data.book_no);
        editForm.find("#edit_book_title").val(data.book_title);
        editForm.find("#edit_book_status").val(data.status);
        var type = data.book_type;
        if( type != 'Journal' && type != 'Book' && type != 'SP' && type != 'Thesis'){
            type = "Other";
            editForm.find('#edit_other').val(data.book_type);
        }
        editForm.find("#edit_book_type").val(type);
        checkBookType.call( $('#edit_book_type')[0] );
        editForm.find("#edit_author").val(data.author);
        editForm.find("#edit_abstract").val(data.abstract);
        editForm.find("#edit_description").val(data.description);
        editForm.find("#edit_publisher").val(data.publisher);
        editForm.find("#edit_date_published")[0].value=data.date_published;
        editForm.find("#edit_tags").val(data.tags);

    });

    editedRow = td.closest('tr');
    var editContainer = $('#edit_container');
    editContainer.show();
    $(editContainer).find('#edit_book_no').focus();


    $("#add_announcement_cancel_button").click();

}

function editBook(event){
    event.preventDefault();

    var errors;
    if((errors = checkAll.call(this)) == ''){
        var book_no = $(this).find('#edit_book_no').val();
        var formInputs = $(this).serialize();
        var prev_book_no  = $(this).find('#edit_prev_book_no').val();
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




}

function cancelEdit(event){
    event.preventDefault();
    var container = $('#edit_container');
    container.hide();
    container.find('#edit_book_form')[0].reset();
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
    $('#edit_container').hide();
}
/***** END DELETE FUNCTIONS *****/

/*** STRING HTML GENERATION FUNCTIONS ***/
//function generateTableRowHTML(data){
//    var rowHTML = $('<tr>');
//    rowHTML.append(
//        '<td book_data="book_no" align="center">'+data.book_no+'</td>'
//            +'<td>' +
//            '<div style="font:20px Verdana" book_data="book_title">'+data.book_title+'</div>' +
//            '<div style="font-size:17px" book_data="description">'+data.description+'<br/></div>' +
//            '<div style="font-size:13px" book_data="author"><em>'+data.author+'</em><br/></div>' +
//            '<span><a href="javascript:void(0)" bookno="'+data.book_no+'" class="edit_button" >Edit</a></span>&nbsp;&nbsp;&nbsp;' +
//            '<span><a href="javascript:void(0)" bookno="'+data.book_no+'" class="delete_button" >Delete</a></span>&nbsp; | &nbsp;' +
//            '<span>' +
//            generateTransactionAnchorHTML(data.status,data.book_no) +
//            '</span>'+
//            '</td>' +
//            '<td align="center">' +
//            '<div book_data="publisher">'+data.publisher+'</div>' +
//            '<div book_data="date_published">'+data.date_published+'</div>' +
//            '</td>' +
//            '<td book_data="tags">'+data.tags+'</td>'
//    );
//    return rowHTML;
//}

function generateTransactionAnchorHTML(status,book_no){
    var anchorText = "";
    var href = "href='http://localhost/myfirstrepo/index.php/update_book/";
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
        recentlyAddedTableRows.closest('table').show();
    }else{
        recentlyAddedTableRows.closest('table').hide();
    }
}
