var tableHTML = '<table id="announcements_table" border=1 style="width:60%"></table>';

function generateAnnouncementsTable(){
    $.post("index.php/announcement/get_all_announcements",function(data){
        try{
            data = JSON.parse(data);

            data.forEach(function(entry){
                generateAnnouncementRow(entry);
            });
        }catch(e){
            console.log("cannot parse data: ");
            console.log(data);
        }
    });
}

function generateAnnouncementRow(data){
    var fd = new Date(data.date_posted);

    var rowHTML = '<tr class="announcement_table_row">'+
        '<td announcement_id="'+data.announcement_id+'" class="announcement_table_data">'+
        '<h4 class="announcement_title">'+data.announcement_title+
        '</h4>'+
        'posted on <span class="date_posted">'+fd.toDateString() +'</span> by '+
        '<span class="announcement_author">'+data.announcement_author+'</span>'+
        '<button class="edit_announcement_button">Edit</button>'+
        '<button class="delete_announcement_button">Delete</button>'+
        '<hr/>'+
        '<span class="announcement_content">'+data.announcement_content+'</span>'+
        '</td>'+
        '</tr>';

    var tableContainer = $('#announcements_table_container');
    if(tableContainer.find('table').length == 0){
        tableContainer.append(tableHTML);
        tableContainer.find('table').append($('<tbody>'));
    }
    tableContainer.find('table').find('tbody:last').append(rowHTML);
}

generateAnnouncementsTable();