/**
 * Created by isnalla on 2/18/14.
 */

$('#faq_table_container').ready(function(){
    /***** EVENT ATTACHMENTS *****/
    $('#add_faq_container').closest("tr").hide();
    $('#edit_faq_container').closest("tr").hide();
    $('#add_faq_button').on("click",showME);
    $('#add_faq_form').submit(addFAQ);

    var faqTableContainer = $('#faq_table_container');
    faqTableContainer.on('click','.edit_faq_button',fillEditFaqForm);
    faqTableContainer.on('click','.delete_faq_button',deleteFaq);
    $('#edit_faq_cancel_button').on('click',cancelForm);
    $('#add_faq_cancel_button').on('click',cancelForm);
    $('#edit_faq_form').submit(editFAQ);

});

function deleteFaq(event){
    event.preventDefault();
    var confirmed = confirm('Confirm deleting this Faq');
    if(confirmed){
        var faq_id = $(this).closest("tr").attr('faq_id');
        console.log(faq_id);
        $.post("index.php/faq/delete",{'id':faq_id},function(){
            $("tr[faq_id='"+faq_id+"']").remove();
        })
    }
}

function showME(event){
    event.preventDefault();

    var addFaqContainer =
        $('#add_faq_container');
    addFaqContainer.closest("tr").show();
    addFaqContainer.show();
}
function addFAQ(event){
    event.preventDefault();
    $.post("index.php/faq/add",$(this).serialize(),function(data){
        data = JSON.parse(data);

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


        $('#faq_table').find('tbody:last').append(rowHTML);
        //toggleRecentlyAddedTable();
    });
    $(this).closest('div').hide();
    this.reset();
}

function fillEditFaqForm(event){
    event.preventDefault();

    var id = $(this).closest("tr").attr('faq_id');
    $.post("index.php/faq/get_faq",{"id":id},function(data){
        var data = JSON.parse(data)[0];
        console.log(data);
        var editForm = $('#edit_faq_form');

        editForm.find('#edit_id').val(id);
        editForm.find('#edit_question').val(data.question);
        editForm.find('#edit_answer').val(data.answer);

    });

    $(this).closest("tr").hide();
    $('#edit_faq_container').closest('tr').show();
    $('#edit_answer').focus();
}

function editFAQ(event){
    event.preventDefault();

    var tr = null;
    $.post("index.php/faq/edit",$(this).serialize(),function(data){ //navigate to the controller with the address:index.php/faq/edit
        data = JSON.parse(data);
        console.log(data);
        tr = $('#faq_table').find('tr[id="'+data.id+'"]');
        tr.find('.question').text(data.question);
        tr.find('.answer').val(data.answer);
    });

    $(this).closest('div').hide();
    this.reset();
    if(tr != null) tr.show();
}

function cancelForm(event){
    event.preventDefault();
    $(this).closest('div').hide();
    $(this).closest('form')[0].reset();
}
