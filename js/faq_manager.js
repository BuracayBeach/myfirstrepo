/**
 * Created by isnalla on 2/18/14.
 */
var customEditor;
$('#faq_table_container').ready(function(){
    /***** EVENT ATTACHMENTS *****/
    var addFaqContainer = $('#add_faq_container');
    addFaqContainer.closest("tr").hide();

    $('#edit_faq_container').closest("tr").hide();

    $('#add_faq_button').on("click",showAddForm);
    $('#add_faq_form').submit(addFAQ);

    var faqTableContainer = $('#faq_table_container');
    faqTableContainer.on('click','.edit_faq_button',setEditTarget);
    //faqTableContainer.on('click','.save_faq_button',updateChanges);
    faqTableContainer.on('click','.save_faq_button',updateChanges);
    faqTableContainer.on('click','.cancel_faq_button',function(){
        cancelChanges.call($(this).closest('tr'));
    });
    //$(this).on('click','.edit_faq_button',fillEditFaqForm);
    faqTableContainer.on('click','.delete_faq_button',deleteFaq);

    $('#edit_faq_cancel_button').on('click',cancelEditForm);
    $('#add_faq_cancel_button').on('click',cancelAddForm);
    $('#edit_faq_form').submit(editFAQ);

    customEditor = new nicEditor({iconsPath : icejjfish + "js/nicEditorIcons.gif" });
    customEditor.panelInstance('add_answer');

});

function updateChanges(){
    var row = $(this).closest('tr');
    var id = row.attr('faq_id');
    var editor = nicEditors.findEditor('answer_'+id);
    editor.saveContent();
    var answer = editor.getContent();

    var data = {
            'id' :row.attr('faq_id'),
            'question' : row.find('.question').text(),
            'answer' : answer
        };

    $.post("index.php/faq/edit", data , function(data){ //navigate to the controller with the address:index.php/faq/edit
        data = JSON.parse(data);

        row.find('.question h5').text(data.question);
        row.find('.answer').html(data.answer);
        row.find('.question').attr("contenteditable",false);
        row.find('.save_faq_button').hide();
        row.find('.edit_faq_button').show();
        row.find('.cancel_faq_button').hide();
        row.removeClass('active');

        customEditor.removeInstance('answer_'+row.attr('faq_id'));
        row.find('.answer_editor').hide();
        row.find('.answer').show();
    }).fail(function(){
            alert('There was a problem editing the material.');
            cancelChanges.call(row.find('.cancel_faq_button')[0]);
        });
}

function setEditTarget(){
    $('#add_faq_container').closest("tr").hide();

    var faqTableContainer =  $('#faq_table_container');
    var activeRow = faqTableContainer.find('.active');
    if(activeRow.length != 0){
        cancelChanges.call(activeRow[0]);
    }
    var row = $(this).closest('tr');
    row.addClass('active');
    row.find('.edit_faq_button').hide();
    var question = row.find('.question').text();
    var answer =  row.find('.answer').html();
    row.find('.prev_question').text( question);
    row.find('.answer_editor').text( answer);
    row.find('.question').attr("contenteditable",true);
    row.find('.answer').hide();
    row.find('.answer_editor').show();
    row.find('.save_faq_button').show();
    row.find('.cancel_faq_button').show();

    customEditor.panelInstance('answer_'+row.attr('faq_id'));
    row.find('.nicEdit-main')[0].focus();

}

function cancelChanges(){
    var row = $(this).closest('tr');
    row.removeClass('active');
    row.find('.question h5').text(row.find('.prev_question').text());
    row.find('.question').attr("contenteditable",false);
    customEditor.removeInstance('answer_'+row.attr('faq_id'));
    row.find('.answer_editor').hide();
    row.find('.answer').show();
    row.find('.save_faq_button').hide();
    row.find('.edit_faq_button').show();
    row.find('.cancel_faq_button').hide();
}


/*** OLD EDIT FAQ MODULE ***/
function editFAQ(event){
    event.preventDefault();
    var editFaqForm = $(this);
    $.post("index.php/faq/edit",$(this).serialize(), function(data){ //navigate to the controller with the address:index.php/faq/edit
        data = JSON.parse(data);
        console.log(data);
        var tr = $('#faq_table').find('tr[faq_id="'+data.id+'"]');
        tr.find('.question').text("<h5>"+data.question+"</h5>");
        tr.find('.answer').text(data.answer);

        editFaqForm.closest('tr').hide();
        editFaqForm[0].reset();
        tr.show();

    }).fail(function(){
            alert('There was a problem editing the material.')
        });

}
/*** END OLD EDIT FAQ MODULE ***/

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
    var editFaqContainer = $('#faq_table').find('.active');
    var tr = editFaqContainer.closest('tr');
    cancelChanges.call(tr);

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
    var editor = nicEditors.findEditor('add_answer');
    editor.saveContent();
    var answer = editor.getContent();
    event.preventDefault();
    var data = {
        'question' : $(this).find('#add_question').val(),
        'answer' : answer
    };

    var addFaqForm = this;
    $.post("index.php/faq/add", data ,function(data){
        data = JSON.parse(data);
        console.log(data);
        var rowHTML = generateFaqRow(data,true);

        $('#faq_table').find('tbody tr:first-child').after(rowHTML);
        //toggleRecentlyAddedTable();

        $(addFaqForm).closest('div').hide();
        addFaqForm.reset();
        editor.setContent('');
    }).fail(function(){
            alert('There was a problem adding the material.');
        })
}

var rowBeingEdited;
//function fillEditFaqForm(event){
//    event.preventDefault();
//
//    if(rowBeingEdited != undefined)
//        rowBeingEdited.show();
//    $('#add_faq_container').closest('tr').hide();
//    var id = $(this).closest("tr").attr('faq_id');
//    $.post("index.php/faq/get_faq",{"id":id},function(data){
//        var data = JSON.parse(data)[0];
//        console.log(data);
//        var editForm = $('#edit_faq_form');
//
//        editForm.find('#edit_faq_id').val(id);
//        editForm.find('#edit_question').val(data.question);
//        editForm.find('#edit_answer').val(data.answer);
//
//    });
//
//    rowBeingEdited = $(this).closest("tr");
//    rowBeingEdited.hide();
//    $('#edit_faq_container').closest('tr').show();
//    $('#edit_answer').focus();
//}



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
