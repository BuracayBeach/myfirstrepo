/**
 * Created by isnalla on 2/23/14.
 */

var tableHTML = '<table id="faq_table"></table>';



$('#faq_table_container').ready(function(){
    var isAdmin = $('#faq_manage_container').length == 1;

    generateFaqs(isAdmin);
    $('#faq_anchors').on('click','.faq-anchor',scrollToTarget)
    $('.back-to-top').on('click',scrollToTop);
});

function scrollToTop(){
    $('html,body').animate({
        scrollTop: 0
    });
    return false;
}

function scrollToTarget(){
    //this  = anchor
    var $target = $($(this).attr('href'));

    $('html,body').animate({
        scrollTop: $target.offset().top - 90
    });
    return false;
}

function generateFaqAnchor(index,data){
    return '<a class="faq-anchor" href="#faq'+data.id+'">'+index+".&nbsp;"+data.question+'</a><br/>';
}

function generateFaqs(isAdmin){
    $.post("index.php/faq/get_all_faq",function(data){
        try{
            data = JSON.parse(data);
            var anchorsHTML  = "";
            var i = data.length;
            data.forEach(function(entry){
                generateFaqRow(entry,isAdmin);
                anchorsHTML = generateFaqAnchor(i--,entry) + anchorsHTML;
            });

            $('#faq_anchors').html(anchorsHTML);
        }catch(e){
            console.log("cannot parse data for generating table ");
        }
    });
}


function generateFaqRow(data,isAdmin){
    var fd = new Date(data.date_posted);

    var buttons = "";
    var editable = "";
    var prevDataInputs = "";
    var editButtons = "";
    if(isAdmin){
        prevDataInputs = '<h4 hidden class="prev_question"></h4><br/>' +
                         '<textarea style="display:none;" id="answer_'+data.id+'" class="answer_editor"></textarea>';
        editButtons = '<button class="save_faq_button" style="display:none;">Save</button>' +
            '<button class="cancel_faq_button" style="display:none;">Cancel</button>';
        buttons =
            '<button class="edit_faq_button">Edit</button>'+
                '<button class="delete_faq_button">Delete</button>';
        editable = 'contenteditable="false"';
    }
    var rowHTML = '<tr faq_id="'+data.id+'" id="faq'+data.id+'" class="faq_table_row">'+
                    '<td class="faq_table_data">' +
                        ' <span ' + editable +
                        ' class="question" name="question" >'+data.question+
                        '</span><br/><br/>'+
                        '<section '+
                        ' class="answer" name="answer" >'+data.answer+'</section>'+
                        prevDataInputs + editButtons + buttons + '<hr/>' +
                    '</td>'+
                    '</tr>';

    var tableContainer = $('#faq_table_container');
    if(tableContainer.find('table').length == 0){
        tableContainer.append(tableHTML);
        tableContainer.find('table').append($('<tbody>'));
    }

    var firstTr = tableContainer.find('table tbody tr').first();
    if(firstTr.find('#add_faq_container').length == 0 ){
        tableContainer.find('table tbody').prepend(rowHTML);
    }else{
        tableContainer.find('table').find('tbody tr:first').after(rowHTML);
    }




}