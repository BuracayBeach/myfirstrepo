function generateAnnouncementsTable(isAdmin){
    $.post("index.php/announcement/get_all_announcements",function(data){
        try{
            data = JSON.parse(data);


            data.forEach(function(entry){
                generateAnnouncementRow(entry,isAdmin);
            });
        }catch(e){
            console.log("Failed generating table");
            //console.log(data);
        }
    });
}

function generateAnnouncementRow(data,isAdmin){
    var fd = new Date(data.date_posted);

    var buttons = "";
    var editable = "";
    var prevDataInputs = "";
    var editButtons = "";
    if(isAdmin){
        prevDataInputs = '<h4 hidden class="prev_question"></h4>' +
            '<textarea style="display:none;" id="answer_'+data.id+'" class="answer_editor"></textarea>';
        buttons = '<button class="save_faq_button" style="display:none;">Save</button>' +
            '<button class="cancel_faq_button" style="display:none;">Cancel</button>';
        editButtons = '<button class="edit_announcement_button">Edit</button>'+
                '<button class="delete_announcement_button">Delete</button>';
        editable = 'contenteditable="false"';
    }
    var carouselInner = $('div.carousel-inner');
    var activeClass = "";
    if(carouselInner.find('.item').length == 0){
        activeClass = "active";
    }
    var itemHTML = '<div  class="item '+activeClass+'">' +
                        '<div announcement_id="'+data.announcement_id+'" class="carousel-caption announcement_container">'+
                            '<h4 '+editable+' class="announcement_title">'+data.announcement_title+'</h4>'+
                            '<div class="sub-heading small-font">posted on <span class="date_posted">'+fd.toDateString() +'</span> by '+
                                '<span class="announcement_author">'+data.announcement_author+'</span></div>' +
                            '<div class="announcement_content_container"><p class="announcement_content">'+data.announcement_content+'</p></div>'+
                            editButtons +
                        "</div>"+
                    '</div>';


    var len = carouselInner.find('.item').length;
    var active = '';
    if(len == 0) active = 'class="active"';
    var liHTML = '<li data-target="#announcement_carousel" data-slide-to="'+len+'" '+active+'></li>';

    $('.carousel-indicators').append(liHTML);
    carouselInner.append(itemHTML);
    if(len == 0) carouselInner.closest('.carousel').show();

}

$('announcement_manage_container').ready(function(){
    var isAdmin = $('#announcement_manage_container').length == 1;
    generateAnnouncementsTable(isAdmin);
    $('#announcements_container').fadeIn();
});