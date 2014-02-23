/**
 * Created by isnalla on 2/18/14.
 */

$('#content_container').ready(function(){
    /***** EVENT ATTACHMENTS *****/

    $('#add_faq_container').closest("tr").hide();
    $('#edit_faq_container').closest("tr").hide();
    $('#faq_button').on("click",showME);
    $('#add_faq_form').submit(addFAQ);

});

function showME(event){
    event.preventDefault();
    console.log("show me");
    var addFaqContainer =
        $('#add_faq_container');
    addFaqContainer.closest("tr").show();
    addFaqContainer.show();
}
function addFAQ(event){
    event.preventDefault();
    $.post("index.php/faq/add",$(this).serialize(),function(data){
        data = JSON.parse(data);
        console.log(data);

        var rowHTML =
            '<tr class="faq_table_row">'+
                '<td faq_id="'+data.id+'" class="faq_table_data">'+
                '<h4 class="question">'+data.question+
                '</h4>'+
                '<hr/>'+
                '<span class="answer">'+data.answer+'</span>'+
                '</td>'+
                '</tr>';


        $('#faq_table').find('tbody:last').append(rowHTML);
        //toggleRecentlyAddedTable();
    });
    $(this).closest('div').hide();
    this.reset();
}