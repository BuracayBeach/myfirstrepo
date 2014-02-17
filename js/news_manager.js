$('#news_container').ready(function(){
    /*** ATTACH EVENT LISTENERS ***/
    $('#add_news_button').on('click',showAddNewsForm);
    $('#add_news_cancel_button').on('click',cancelForm);
    $('#edit_news_cancel_button').on('click',cancelForm);
    $('#add_news_form').submit(addNews);

    var newsContainer =  $('#news_container');
    newsContainer.on('click','.edit_news_button',fillEditNewsForm);
    newsContainer.on('click','.delete_news_button',deleteNews);

    $('#edit_news_form').submit(editNews);
    /*** END ATTACH EVENT LISTENERS ***/

    /*** INITIALLY HIDE FORMS ***/
    $('#add_news_container').hide();
    $('#edit_news_container').hide();
    /** GENERATE NEWS TABLE **/
    generateNewsTable();
});

function showAddNewsForm(event){
    event.preventDefault();
    $('#add_news_container').show();
}

function fillEditNewsForm(event){
    event.preventDefault();

    var news_id = $(this).closest('td').attr('news_id');

    $.post("index.php/news/get_news",{"news_id":news_id},function(data){
        var data = JSON.parse(data)[0];

        var editForm = $('#edit_news_form');

        editForm.find('#edit_news_id').val(news_id);
        editForm.find('#edit_news_author').val(data.news_author);
        editForm.find('#edit_news_title').val(data.news_title);
        editForm.find('#edit_news_content').val(data.news_content);

    });

    $('#edit_news_container').show();
}

function generateNewsTable(){
    $.post("index.php/news/get_all_news",function(data){
        data = JSON.parse(data);
        console.log(data);
        data.forEach(function(entry){
            generateNewsRow(entry);
        });
    });
}

function editNews(event){
    event.preventDefault();

    $.post("index.php/news/edit",$(this).serialize(),function(data){
        data = JSON.parse(data);
        console.log(data);
        var td = $('#news_table').find('tr > td[news_id="'+data.news_id+'"]')

        console.log( td.find('.news_title'))
        td.find('.news_title').text(data.news_title);
        td.find('.news_content').text(data.news_content);
    });

    $(this).closest('div').hide();
    this.reset();
}

function generateNewsRow(data){
    var rowHTML = "";

    var fd = new Date(data.date_posted);

    rowHTML += '<tr class="news_table_row">'+
        '<td news_id="'+data.news_id+'" class="news_table_data">'+
        '<h4 class="news_title">'+data.news_title+
        '<button class="edit_news_button">Edit</button>'+
        '<button class="delete_news_button">Delete</button>'+
        '</h4>'+
        'posted on <span class="date_posted">'+fd.toDateString() +'</span> by '+
        '<span class="news_author">'+data.news_author+'</span>'+
        '    <hr/>'+
        '<span class="news_content">'+data.news_content+'</span>'+
        '</td>'+
        '</tr>';

    var newsTable = $('#news_table');
    if(newsTable.find('tbody').length == 0)
        newsTable.append($('<tbody>'));
    newsTable.find('tbody:last').append(rowHTML);
}

function addNews(event){
    event.preventDefault();

    $.post("index.php/news/add",$(this).serialize(),function(data){
        data = JSON.parse(data);
        console.log(data);
        generateNewsRow(data);
    });

    $(this).closest('div').hide();
    this.reset();

}

function deleteNews(event){
    event.preventDefault();
    var result = confirm("Confirm deleting this news");
    if (result==true) {
        var news_id = $(this).closest('td').attr('news_id');
        var tr = $(this).closest('tr');
        $.post("index.php/news/delete",{"news_id":news_id},function(data){
            tr.remove();
        });
    }
}

function cancelForm(event){
    event.preventDefault();
    $(this).closest('div').hide();
    $(this).closest('form')[0].reset();
}