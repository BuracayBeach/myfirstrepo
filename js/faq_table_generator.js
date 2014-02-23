/**
 * Created by isnalla on 2/23/14.
 */

var tableHTML = '<table id="faq_table" border=1 style="width:60%"></table>';

function generateFaqTable(isAdmin){
    $.post("index.php/faq/get_all_faq",function(data){
        try{
            data = JSON.parse(data);

            data.forEach(function(entry){
                generateFaqRow(entry,isAdmin);
            });
        }catch(e){
            console.log("cannot parse data: ");
            console.log(e);
            console.log(data);
        }
    });
}


function generateFaqRow(data,isAdmin){
    var fd = new Date(data.date_posted);

    var buttons = "";
    if(isAdmin){
        buttons = '<button class="edit_faq_button">Edit</button>'+
                '<button class="delete_faq_button">Delete</button>';
    }
    var rowHTML = '<tr faq_id="'+data.id+'" class="faq_table_row">'+
        '<td faq_id="'+data.id+'" class="faq_table_data">'+
        '<h4 class="question">'+data.question+
        '</h4>'+
        buttons+
        '<hr/>'+
        '<span class="answer">'+data.answer+'</span>'+
        '</td>'+
        '</tr>';


    var tableContainer = $('#faq_table_container');
    if(tableContainer.find('table').length == 0){
        tableContainer.append(tableHTML);
        tableContainer.find('table').append($('<tbody>'));
    }

    tableContainer.find('table').find('tbody tr:nth-child(2)').after(rowHTML);

}

$('#faq_table_container').ready(function(){
    var isAdmin = $('#faq_manage_container').length == 1;

    generateFaqTable(isAdmin);
})