/**
 * Created by isnalla on 2/18/14.
 */
var customEditor;
$('#faq_table_container').ready(function(){
    /***** EVENT ATTACHMENTS *****/
    var addFaqContainer = $('#add_faq_container');
    addFaqContainer.closest('tr').hide();

    $('#add_faq_button').on("click",showAddForm);
    $('#add_faq_form').submit(addFAQ);

    var faqTableContainer = $('#faq_table_container');
    faqTableContainer.on('click','.edit_faq_button',setEditTarget);
    //faqTableContainer.on('click','.save_faq_button',updateChanges);
    faqTableContainer.on('click','.save_faq_button',updateChanges);
    faqTableContainer.on('click','.cancel_faq_button',function(){
        cancelChanges.call($(this).closest('tr'));
    });
    faqTableContainer.on('click','.delete_faq_button',deleteFaq);

    $('#add_faq_cancel_button').on('click',cancelAddForm);

    customEditor = new nicEditor({iconsPath : 'http://localhost/myfirstrepo/js/nicEditorIcons.gif'});

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
        row.find('.question').removeClass('editable');
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
    row.find('.question').addClass('editable');
    row.find('.question')[0].focus();

}

function cancelChanges(){
    var row = $(this).closest('tr');
    row.removeClass('active');
    row.find('.question').text(row.find('.prev_question').text());
    row.find('.question').attr("contenteditable",false);
    row.find('.question').removeClass('editable');
    customEditor.removeInstance('answer_'+row.attr('faq_id'));
    row.find('.answer_editor').hide();
    row.find('.answer').show();
    row.find('.save_faq_button').hide();
    row.find('.edit_faq_button').show();
    row.find('.cancel_faq_button').hide();

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
    if(!$('#add_faq_container').closest('tr').is(":visible")){
        var editFaqContainer = $('#faq_table').find('.active');
        var tr = editFaqContainer.closest('tr');
        cancelChanges.call(tr);

        var addFaqContainer = $('#add_faq_container');
        addFaqContainer.closest("tr").fadeIn();
        addFaqContainer.show();

        customEditor.panelInstance('add_answer');
        addFaqContainer.find('#add_question')[0].focus();
    }
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

function cancelAddForm(event){
    event.preventDefault();
    $(this).closest('tr').hide();
    customEditor.removeInstance('add_answer');
    $(this).closest('form')[0].reset();

}
