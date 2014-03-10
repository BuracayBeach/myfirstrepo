/**
 * Created by isnalla on 3/2/14.
 */
$('#logs_container').ready(function(){

    $('#view_logs_button').on('click',generateLogsTable);
    $(this).on('click','a.log_link',changePage);
    $('.logs-date-help').text(getTextHelpAccordingToBrowser);
});

function getTextHelpAccordingToBrowser(){
    if (navigator.userAgent.indexOf('Firefox') != -1 && parseFloat(navigator.userAgent.substring(navigator.userAgent.indexOf('Firefox') + 8)) >= 3.6){//Firefox
        return 'Date Format: YYYY-mm-dd  (ex. "2014-03-04")';
    }else if (navigator.userAgent.indexOf('Chrome') != -1 && parseFloat(navigator.userAgent.substring(navigator.userAgent.indexOf('Chrome') + 7).split(' ')[0]) >= 15){//Chrome
        //Allow
    }else if(navigator.userAgent.indexOf('Safari') != -1 && navigator.userAgent.indexOf('Version') != -1 && parseFloat(navigator.userAgent.substring(navigator.userAgent.indexOf('Version') + 8).split(' ')[0]) >= 5){//Safari
        //Allow
    }else{
        // Block
    }

    return '';
}

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