$(document).ready(function(){
/***** ADD FUNCTIONS *****/
    $('#show_add_form_button').on('click',function(){
        $('#add_container').show();
    });

    $('#add_cancel_button').on('click',function(event){
        event.preventDefault();
        $('#add_container').hide();
    });
    
    $('#add_book_form').submit(function (event){
        event.preventDefault();  /* stop form from submitting normally */

        if(checkAll()){
            $.post("index.php/booker/add",$(this).serialize(),function(data){
                console.log(data);
            });
            this.reset();
            $(this).hide();
        }
    });
/***** END ADD FUNCTIONS *****/
/***** EDIT FUNCTIONS *****/
    $('#edit_book_form').submit(function (event){
        event.preventDefault();

        var editForm = $('#edit_book_form');
        var data = editForm.serialize();
        $.post("index.php/booker/edit",data,function(data){
            data = JSON.parse(data);
            var rowToUpdate = editedRow;
            rowToUpdate.find("[book_data='book_no']").html(data.book_no);
            rowToUpdate.find("[book_data='book_title']").html(data.book_title);
            rowToUpdate.find("[book_data='author']").html(data.author);
            rowToUpdate.find("[book_data='description']").html(data.description);
            rowToUpdate.find("[book_data='publisher']").html(data.publisher);
            rowToUpdate.find("[book_data='date_published']").html(data.date_published);
            rowToUpdate.find("[book_data='tags']").html(data.tags);

            //status update
            var transactionAnchor =  rowToUpdate.find("span .transaction_anchor");

            transactionAnchor.attr('bookno',data.book_no);

            var href = "http://localhost/myfirstrepo/index.php/update_book/";
            //href = "window.location.href='http://localhost/myfirstrepo/index.php/update_book/
            //<lend/?id= | received/?id=>/<book_no>'"
            var anchorText;
            if(data.status == "reserved"){
                anchorText = "Lend";
                href += "lend/?id="+data.book_no+"'";
            }
            else if(data.status == "borrowed"){
                anchorText = "Return";
                href += "received/?id="+data.book_no+"'";
            }
            else{
                anchorText = "(available)";
                transactionAnchor.removeAttr('href');
            }
            if(transactionAnchor.attr('href') == undefined
                && data.status != 'available'){
                transactionAnchor.attr('href',href);
            }
            transactionAnchor.html(anchorText);
        });
        editForm.closest('div').hide();

    });
    $('#edit_cancel_button').on('click',function(event){
        event.preventDefault();
        var container = $('#edit_container');
        container.hide();
        container.find('#edit_book_form')[0].reset();
    });
    $('.edit_button').on('click',function(event){
        event.preventDefault();

        var td = $(this).closest('tr').find('td[book_data=book_no]');
        var book_no = td.text();

        $.post("index.php/booker/get_book",{'book_no':book_no},function(data){
            data = JSON.parse(data);
            data = data[0];

            var editForm = $("#edit_book_form");
            editForm.find("#edit_prev_book_no").val(data.book_no);
            editForm.find("#edit_book_no").val(data.book_no);
            editForm.find("#edit_book_title").val(data.book_title);
            editForm.find("#edit_book_status").val(data.status);
            editForm.find("#edit_description").val(data.description);
            editForm.find("#edit_publisher").val(data.publisher);
            editForm.find("#edit_author").val(data.name);
            editForm.find("#edit_date_published")[0].value=data.date_published;
            editForm.find("#edit_tags").val(data.Tags);
        });

        editedRow = td.closest('tr');
        $('#edit_container').show();
    });
/***** END EDIT FUNCTIONS*****/
/***** DELETE FUNCTIONS *****/
    $('.delete_button').on('click',function(){
        var result = confirm("Confirm deleting this book");
        if (result==true) {
            var bookNo = $(this).attr('bookno');
            $(this).closest('tr').remove();
            $.post('index.php/booker/delete',{book_no:bookNo},function(data){
                //callback function for delete
            });
        }
    });
/***** END DELETE FUNCTIONS *****/
});