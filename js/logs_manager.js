/**
 * Created by isnalla on 3/2/14.
 */
$('#logs_container').ready(function(){


});

function getDownloadURL(){

    var from = $('#logs_from').val();
    var to = $('#logs_to').val();
    if(from == '') from = 0;
    if(to == '') to = 0;
    window.open("index.php/logs/download/"+from+"/"+to);
}