var tableHTML = '<table id="news_table" border=1 style="width:60%"></table>';

function generateNewsTable(){
    $.post("index.php/news/get_all_news",function(data){
        data = JSON.parse(data);
        console.log(data);
        data.forEach(function(entry){
            generateNewsRow(entry);
        });

    });
}

function generateNewsRow(data){
    var fd = new Date(data.date_posted);

    rowHTML = '<tr class="news_table_row">'+
        '<td news_id="'+data.news_id+'" class="news_table_data">'+
        '<h4 class="news_title">'+data.news_title+
        '</h4>'+
        'posted on <span class="date_posted">'+fd.toDateString() +'</span> by '+
        '<span class="news_author">'+data.news_author+'</span>'+
        '<button class="edit_news_button">Edit</button>'+
        '<button class="delete_news_button">Delete</button>'+
        '<hr/>'+
        '<span class="news_content">'+data.news_content+'</span>'+
        '</td>'+
        '</tr>';

    var tableContainer = $('#news_table_container');
    if(tableContainer.find('table').length == 0){
        tableContainer.append(tableHTML);
        tableContainer.find('table').append($('<tbody>'));
    }
    tableContainer.find('table').find('tbody:last').append(rowHTML);
}

generateNewsTable();