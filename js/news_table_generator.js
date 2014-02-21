var tableHTML = '<table id="announcements_table" border=1 style="width:60%"></table>';

function generateAnnouncementsTable(){
    $.post("index.php/announcement/get_all_announcement",function(data){
        data = JSON.parse(data);
        console.log(data);
        data.forEach(function(entry){
            generateAnnouncementRow(entry);
        });

    });
}

function generateAnnouncementRow(data){
    var fd = new Date(data.date_posted);

    rowHTML = '<tr class="announcement_table_row">'+
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

    var tableContainer = $('#announcement_table_container');
    if(tableContainer.find('table').length == 0){
        tableContainer.append(tableHTML);
        tableContainer.find('table').append($('<tbody>'));
    }
    tableContainer.find('table').find('tbody:last').append(rowHTML);
}

generateAnnouncementsTable();