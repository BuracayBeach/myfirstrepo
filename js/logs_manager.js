/**
 * Created by isnalla on 3/2/14.
 */
$('#logs_container').ready(function(){

    $('#view_logs_button').on('click',generateLogsTable);
    $(this).on('click','a.log_link',changePage);
});

function getRange(){
    var from = $('#logs_from').val();
    var to = $('#logs_to').val();
    if(from == '') from = 0;
    if(to == '') to = 0;

    return {
        from: from,
        to: to
    };
}

function changePage(){

    $.get(this,{source:'anchor'},function(data){
        data = JSON.parse(data);
        if(data.table != 'empty'){
            $('#logs_table_container').html(data.table);
            $('#log_links_container').html(data.links);
        }else{
            alert('error getting next page');
        }
    });

    return false;
}

function generateLogsTable(){
    var range = getRange();

    $.get("index.php/logs/get_logs_view/"+range.from+"/"+range.to+"/0",{source:'button'},function(data){
        data = JSON.parse(data);
        if(data.table != 'empty'){
            $('#logs_table_container').html(data.table);
            $('#log_links_container').html(data.links);
        }else{
            alert('error getting logs');
        }
    });
}

function getDownloadURL(){
    var range = getRange();
    window.open("index.php/logs/download/"+range.from+"/"+range.to);
}