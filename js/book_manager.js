$('#content_container').ready(function(){
    /***** EVENT ATTACHMENTS *****/
    $('#show_add_form_button').on('click',showAddForm);
    $('#add_cancel_button').on('click',cancelAdd);
    $('#add_book_form').submit(addBook);

    var contentContainer = $('#result_container');
    contentContainer.on('click','.edit_button',fillEditForm);
    $('#edit_cancel_button').on('click',cancelEdit);
    $('#edit_book_form').submit(editBook);

    var recentlyAddedBooksContainer =  $('#recently_added_books_container');
    recentlyAddedBooksContainer.on('click','.edit_button',fillEditForm);
    recentlyAddedBooksContainer.on('click','.delete_button',deleteBook);

    contentContainer.on('click','.delete_button',deleteBook);
    /***** END EVENT ATTACHMENTS *****/

    /* Hide Forms Initially */
    $('#recently_added_books_container').hide();
    $('#add_container').hide();
    $('#edit_container').hide();
});

/***** ADD FUNCTIONS *****/
function showAddForm(){
    var addContainer = $('#add_container');
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

    if(checkAll()){
        $.post("index.php/book/add",$(this).serialize(),function(data){
            data = JSON.parse(data);
            var rowHTML = $('<tr>');
            rowHTML.append(
                '<td book_data="book_no" align="center">'+data.book_no+'</td>'
                    +'<td>' +
                    '<div style="font:20px Verdana" book_data="book_title">'+data.book_title+'</div>' +
                    '<div style="font-size:17px" book_data="description">'+data.description+'<br/></div>' +
                    '<div style="font-size:13px" book_data="author"><em>'+data.author+'</em><br/></div>' +
                    '<span><a href="javascript:void(0)" bookno="'+data.book_no+'" class="edit_button" >Edit</a></span>&nbsp;&nbsp;&nbsp;' +
                    '<span><a href="javascript:void(0)" bookno="'+data.book_no+'" class="delete_button" >Delete</a></span>&nbsp; | &nbsp;' +
                    '<span>' +
                    generateTransactionAnchorHTML(data.status,data.book_no) +
                    '</span>'+
                '</td>' +
                '<td align="center">' +
                    '<div book_data="publisher">'+data.publisher+'</div>' +
                    '<div book_data="date_published">'+data.date_published+'</div>' +
                '</td>' +
                '<td book_data="tags">'+data.tags+'</td>'
            );
            $('#recently_added_books_table').find('tbody:last').append(rowHTML);
            toggleRecentlyAddedTable();
        });
        $(this).closest('div').hide();
        this.reset();
    }
}
/***** END ADD FUNCTIONS *****/

/***** EDIT FUNCTIONS *****/
function fillEditForm(event){
    event.preventDefault();
    var td = $(this).closest('tr').find('td[book_data=book_no]');
    var book_no = td.text();
    $.post("index.php/book/get_book",{'book_no':book_no},function(data){
        data = JSON.parse(data);
        data = data[0];
        console.log(data);
        var editForm = $("#edit_book_form");
        editForm.find("#edit_prev_book_no").val(data.book_no);
        editForm.find("#edit_book_no").val(data.book_no);
        editForm.find("#edit_book_title").val(data.book_title);
        editForm.find("#edit_book_status").val(data.status);
        editForm.find("#edit_description").val(data.description);
        editForm.find("#edit_publisher").val(data.publisher);
        editForm.find("#edit_author").val(data.name);
        editForm.find("#edit_date_published")[0].value=data.date_published;
        editForm.find("#edit_tags").val(data.tags);
    });

    editedRow = td.closest('tr');
    var editContainer = $('#edit_container')
    editContainer.show();
    $(editContainer).find('#edit_book_no').focus();
}

function editBook(event){
    event.preventDefault();

    var editForm = $('#edit_book_form');
    var data = editForm.serialize();
    $.post("index.php/book/edit",data,function(data){
        data = JSON.parse(data);
        var rowToUpdate = editedRow;
        rowToUpdate.find("[book_data='book_no']").html(data.book_no);
        rowToUpdate.find("[book_data='book_title']").html(data.book_title);
        rowToUpdate.find("[book_data='author'] em").html(data.author+"<br/>");
        rowToUpdate.find("[book_data='description']").html(data.description+"<br/>");
        rowToUpdate.find("[book_data='publisher']").html(data.publisher);
        rowToUpdate.find("[book_data='date_published']").html(data.date_published);
        rowToUpdate.find("[book_data='tags']").html(data.tags);

        //status update
        var transactionSpan =  rowToUpdate.find("span:has(.transaction_anchor)");

        var anchorHTML = generateTransactionAnchorHTML(data.status,data.book_no);
        transactionSpan.html(anchorHTML);
    });
    editForm.closest('div').hide();
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
}
/***** END DELETE FUNCTIONS *****/

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

function toggleRecentlyAddedTable(){
    var recentlyAddedTableRows = $('#recently_added_books_table').find('tr');
    if(recentlyAddedTableRows.length > 1){
        recentlyAddedTableRows.closest('div').show();
    }else{
        recentlyAddedTableRows.closest('div').hide();
    }
}
