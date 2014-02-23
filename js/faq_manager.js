/**
 * Created by isnalla on 2/18/14.
 */

var rowBeingEdited;
var editFormHTML = '<div id="edit_faq_container">' +
                        '<form autocomplete="on" id="edit_faq_form">' +
                            '<input type="hidden" name="id" id="edit_faq_id" />' +
                            '<input type="text" name="question" id="edit_question" placeholder="Question" required/><br/>' +
                            '<textarea name="answer" id="edit_answer" placeholder="Answer..."  required></textarea><br/>' +
                            '<button type="submit" name="edit_faq_button" id="edit_faq_button">Edit</button>' +
                            '<button type="button" id="edit_faq_cancel_button" name="edit_faq_cancel_button" >Cancel</button>' +
                        '</form>' +
                    '</div>';

$('#faq_table_container').ready(function(){
    /***** EVENT ATTACHMENTS *****/
    $('#add_faq_container').closest("tr").hide();
    $('#add_faq_button').on("click",showAddForm);
    $('#add_faq_form').submit(addFAQ);

    var faqTableContainer = $('#faq_table_container');
    faqTableContainer.on('click','.edit_faq_button',fillEditFaqForm);
    faqTableContainer.on('click','.delete_faq_button',deleteFaq);
    $('#add_faq_cancel_button').on('click',cancelAddForm);

});

function deleteFaq(event){
    event.preventDefault();
    var confirmed = confirm('Confirm deleting this FAQ');
    if(confirmed){
        var faq_id = $(this).closest("tr").attr('faq_id');
        $.post("index.php/faq/delete",{'id':faq_id},function(){
            $("tr[faq_id='"+faq_id+"']").remove();
        })
    }
}

function showAddForm(event){
    event.preventDefault();

    $('#edit_faq_container').closest('tr').hide();
//    if(rowBeingEdited != undefined && rowBeingEdited.length > 0)
//        rowBeingEdited.show();
    var addFaqContainer =
        $('#add_faq_container');
    addFaqContainer.closest("tr").show();
    addFaqContainer.show();
    addFaqContainer.find('#add_question').focus();
}
function addFAQ(event){
    event.preventDefault();

    var addFaqForm = this;
    $.post("index.php/faq/add",$(this).serialize(),function(data){
        data = JSON.parse(data);
        console.log(data);
        var rowHTML =
            '<tr faq_id="'+data.id+'" class="faq_table_row">'+
                '<td faq_id="'+data.id+'" class="faq_table_data">'+
                '<h4 class="question">'+data.question+
                '</h4>'+
                '<button class="edit_faq_button">Edit</button>'+
                '<button class="delete_faq_button">Delete</button>'+
                '<hr/>'+
                '<span class="answer">'+data.answer+'</span>'+
                '</td>'+
            '</tr>';


        $('#faq_table').find('tbody tr:nth-child(2)').after(rowHTML);
        //toggleRecentlyAddedTable();

        $(addFaqForm).closest('div').hide();
        addFaqForm.reset();
    }).fail(function(){
            alert('There was a problem adding the material.');
        })
}

function fillEditFaqForm(event){
    event.preventDefault();

    $('#add_faq_container').closest('tr').hide();

    var tr = $(this).closest("tr")[0];
    var td = tr.find('td')[0];
    var id = tr.attr('faq_id');
    $.post("index.php/faq/get_faq",{"id":id},function(data){
        var data = JSON.parse(data)[0];
        console.log(data);
        tr.append(editFormHTML);
        var editForm = tr.find('form');
        editForm.submit(editFAQ);
        editForm.find('#edit_faq_cancel_button').on('click',cancelEditForm);

        editForm.find('#edit_faq_id').val(id);
        editForm.find('#edit_question').val(data.question);
        editForm.find('#edit_answer').val(data.answer);

    });

    tr.hide();
    $('#edit_faq_container').closest('tr').show();
    $('#edit_answer').focus();
}

function editFAQ(event){
    event.preventDefault();
    var editFaqForm = $(this);
    $.post("index.php/faq/edit",$(this).serialize(),tr = function(data){ //navigate to the controller with the address:index.php/faq/edit
        data = JSON.parse(data);
        console.log(data);
        tr = $('#faq_table').find('tr[faq_id="'+data.id+'"]');
        tr.find('.question').text(data.question);
        tr.find('.answer').text(data.answer);

        editFaqForm.closest('tr').hide();
        editFaqForm[0].reset();
        tr.show();
    }).fail(function(){
            alert('There was a problem editing the material.')
        });

}

function cancelAddForm(event){
    event.preventDefault();
    $(this).closest('tr').hide();
    $(this).closest('form')[0].reset();
}
