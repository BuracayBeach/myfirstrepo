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
});

function showAddNewsForm(event){
    event.preventDefault();
    $('#add_news_container').show();
    $('#add_news_title').focus();
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
    $('#edit_news_content').focus();
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

function editNews(event){
    event.preventDefault();

    $.post("index.php/news/edit",$(this).serialize(),function(data){
        data = JSON.parse(data);
        console.log(data);
        var td = $('#news_table').find('tr > td[news_id="'+data.news_id+'"]')

        td.find('.news_title').text(data.news_title);
        td.find('.news_content').text(data.news_content);
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
            if(tr.closest('table').find('tbody tr').length - 1 == 0)
                tr.closest('table').remove();
            else tr.remove();
        });
    }
}

function cancelForm(event){
    event.preventDefault();
    $(this).closest('div').hide();
    $(this).closest('form')[0].reset();
}