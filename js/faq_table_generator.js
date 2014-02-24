/**
 * Created by isnalla on 2/23/14.
 */

var tableHTML = '<table id="faq_table"></table>';

function generateFaqTable(isAdmin){
    $.post("index.php/faq/get_all_faq",function(data){
        try{
            data = JSON.parse(data);

            data.forEach(function(entry){
                generateFaqRow(entry,isAdmin);
            });
        }catch(e){
            console.log("cannot parse data for generating table ");
        }
    });
}


function generateFaqRow(data,isAdmin){
    var fd = new Date(data.date_posted);

    var buttons = "";
    var editable = "";
    var prevDataInputs = "";
    if(isAdmin){
        prevDataInputs = '<input type="hidden" value="" class="prev_question"/>' +
                         '<input type="hidden" value="" class="prev_answer"/>';
        buttons = '<button class="save_faq_button" style="display:none;">Save</button>' +
            '<button class="cancel_faq_button" style="display:none;">Cancel</button>' +
            '<button class="edit_faq_button">Edit</button>'+
                '<button class="delete_faq_button">Delete</button>';
        editable = 'contenteditable="false"';
    }
    var rowHTML = '<tr faq_id="'+data.id+'" class="faq_table_row">'+
                    '<td class="faq_table_data">' +
                        prevDataInputs +
                        ' <h4 ' + editable +
                        ' class="question" name="question" >'+data.question+
                        '</h4>'+
                        buttons+
                        '<hr/>'+
                        '<span ' + editable +
                        ' class="answer" name="answer" >'+data.answer+'</span>'+
                    '</td>'+
                    '</tr>';

    var tableContainer = $('#faq_table_container');

    if(tableContainer.find('table').length == 0){
        tableContainer.append(tableHTML);
        tableContainer.find('table').append($('<tbody>'));
    }

    var firstTr = tableContainer.find('table tbody tr').first();
    if(firstTr.find('#add_faq_container').length == 0 ){
        tableContainer.find('table tbody').append(rowHTML);
    }else{
        tableContainer.find('table').find('tbody tr:nth-child(2)').after(rowHTML);
    }
}

$('#faq_table_container').ready(function(){
    var isAdmin = $('#faq_manage_container').length == 1;

    generateFaqTable(isAdmin);

});