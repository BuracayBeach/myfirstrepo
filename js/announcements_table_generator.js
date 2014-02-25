var tableHTML = '<table id="announcements_table"></table>';

function generateAnnouncementsTable(isAdmin){
    $.post("index.php/announcement/get_all_announcements",function(data){
        try{
            data = JSON.parse(data);

            data.forEach(function(entry){
                generateAnnouncementRow(entry,isAdmin);
            });
        }catch(e){
            console.log("cannot parse data: ");
            //console.log(data);
        }
    });
}

function generateAnnouncementRow(data,isAdmin){
    var fd = new Date(data.date_posted);

    var buttons = "";
    var editable = "";
    var prevDataInputs = "";
    var editButtons = "";
    if(isAdmin){
        prevDataInputs = '<h4 hidden class="prev_question"></h4>' +
            '<textarea style="display:none;" id="answer_'+data.id+'" class="answer_editor"></textarea>';
        buttons = '<button class="save_faq_button" style="display:none;">Save</button>' +
            '<button class="cancel_faq_button" style="display:none;">Cancel</button>';
        editButtons = '<button class="edit_announcement_button">Edit</button>'+
                '<button class="delete_announcement_button">Delete</button>';
        editable = 'contenteditable="false"';
    }
    var rowHTML = '<tr class="announcement_table_row">'+
                        '<td announcement_id="'+data.announcement_id+'" class="announcement_table_data">'+
                            '<h4 '+editable+' class="announcement_title">'+data.announcement_title+'</h4>'+
                            'posted on <span class="date_posted">'+fd.toDateString() +'</span> by '+
                                '<span class="announcement_author">'+data.announcement_author+'</span>' +
                                 editButtons +
                            '<p class="announcement_content">'+data.announcement_content+'</p>'+
                        '</td>'+
                    '</tr>';


    var tableContainer = $('#announcements_table_container');
    if(tableContainer.find('table').length == 0){
        tableContainer.append(tableHTML);
        tableContainer.find('table').append($('<tbody>'));
    }
    tableContainer.find('table').find('tbody:last').append(rowHTML);
}

$('#announcements_table_container').ready(function(){
    var isAdmin = $('#announcement_manage_container').length == 1;
    generateAnnouncementsTable(isAdmin);
});