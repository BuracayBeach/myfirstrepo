/**
 * Created by isnalla on 2/18/14.
 */

$('#faq_table_container').ready(function(){
    /***** EVENT ATTACHMENTS *****/
    $('#add_faq_container').closest("tr").hide();
    $('#edit_faq_container').closest("tr").hide();

    $('#add_faq_button').on("click",showAddForm);
    $('#add_faq_form').submit(addFAQ);

    var faqTableContainer = $('#faq_table_container');
    faqTableContainer.on('click','.edit_faq_button',setEditTarget);
    faqTableContainer.on('click','.save_faq_button',updateChanges);
    faqTableContainer.on('click','.cancel_faq_button',cancelChanges);
    //$(this).on('click','.edit_faq_button',fillEditFaqForm);
    faqTableContainer.on('click','.delete_faq_button',deleteFaq);

    $('#edit_faq_cancel_button').on('click',cancelEditForm);
    $('#add_faq_cancel_button').on('click',cancelAddForm);
    $('#edit_faq_form').submit(editFAQ);


});

function updateChanges(){
    var row = $(this).closest('tr');
    var data = {
            'id' :row.attr('faq_id'),
            'question' : row.find('.question').text(),
            'answer' : row.find('.answer').text()
        };

    console.log(data);

    $.post("index.php/faq/edit", data , function(data){ //navigate to the controller with the address:index.php/faq/edit
        data = JSON.parse(data);

        row.find('.question').text(data.question);
        row.find('.answer').text(data.answer);
    }).fail(function(){
            alert('There was a problem editing the material.')
            cancelChanges.call(row.find('.cancel_faq_button')[0]);
        });
}

/*** OLD EDIT FAQ MODULE ***/
function editFAQ(event){
    event.preventDefault();
    var editFaqForm = $(this);
    $.post("index.php/faq/edit",$(this).serialize(), function(data){ //navigate to the controller with the address:index.php/faq/edit
        data = JSON.parse(data);
        console.log(data);
        var tr = $('#faq_table').find('tr[faq_id="'+data.id+'"]');
        tr.find('.question').text(data.question);
        tr.find('.answer').text(data.answer);

        editFaqForm.closest('tr').hide();
        editFaqForm[0].reset();
        tr.show();
    }).fail(function(){
            alert('There was a problem editing the material.')
        });

}
/*** END OLD EDIT FAQ MODULE ***/


function cancelChanges(){
    var row = $(this).closest('tr');
    row.removeClass('active');
    row.find('.question').text(row.find('.prev_question').val());
    row.find('.answer').text(row.find('.prev_answer').val());
    row.find('.question,.answer').attr("contenteditable",false);
    row.find('.save_faq_button').hide();
    row.find('.edit_faq_button').show();
    row.find('.cancel_faq_button').hide();
}


function setEditTarget(event){
    var faqTableContainer =  $('#faq_table_container');
    var activeRow = faqTableContainer.find('.active');
    if(activeRow.length != 0)
        cancelChanges.call(activeRow[0]);
    var row = $(this).closest('tr');
    row.addClass('active');
    row.find('.edit_faq_button').hide();
    row.find('.prev_question').val( row.find('.question').text());
    row.find('.prev_answer').val( row.find('.answer').text());
    row.find('.question,.answer').attr("contenteditable",true);
    row.find('.question')[0].focus();
    row.find('.save_faq_button').show();
    row.find('.cancel_faq_button').show();
}

function deleteFaq(event){
    event.preventDefault();
    var confirmed = confirm('Confirm deleting this FAQ');
    if(confirmed){
        var faq_id = $(this).closest("tr").attr('faq_id');
        console.log(faq_id);
        $.post("index.php/faq/delete",{'id':faq_id},function(){
            $("tr[faq_id='"+faq_id+"']").remove();
        })
    }
}

function showAddForm(event){
    event.preventDefault();

    $('#edit_faq_container').closest('tr').hide();
    if(rowBeingEdited != undefined && rowBeingEdited.length > 0)
        rowBeingEdited.show();
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
        var rowHTML = generateFaqRow(data,true);


        $('#faq_table').find('tbody tr:nth-child(2)').after(rowHTML);
        //toggleRecentlyAddedTable();

        $(addFaqForm).closest('div').hide();
        addFaqForm.reset();
    }).fail(function(){
            alert('There was a problem adding the material.');
        })
}

var rowBeingEdited;
function fillEditFaqForm(event){
    event.preventDefault();

    if(rowBeingEdited != undefined)
        rowBeingEdited.show();
    $('#add_faq_container').closest('tr').hide();
    var id = $(this).closest("tr").attr('faq_id');
    $.post("index.php/faq/get_faq",{"id":id},function(data){
        var data = JSON.parse(data)[0];
        console.log(data);
        var editForm = $('#edit_faq_form');

        editForm.find('#edit_faq_id').val(id);
        editForm.find('#edit_question').val(data.question);
        editForm.find('#edit_answer').val(data.answer);

    });

    rowBeingEdited = $(this).closest("tr");
    rowBeingEdited.hide();
    $('#edit_faq_container').closest('tr').show();
    $('#edit_answer').focus();
}



function cancelEditForm(event){
    event.preventDefault();
    $(this).closest('tr').hide();
    rowBeingEdited.show();
    $(this).closest('form')[0].reset();
}

function cancelAddForm(event){
    event.preventDefault();
    $(this).closest('tr').hide();
    $(this).closest('form')[0].reset();
}
