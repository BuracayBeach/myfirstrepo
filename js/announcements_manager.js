$('#announcement_container').ready(function(){
    /*** ATTACH EVENT LISTENERS ***/
    $('#add_announcement_button').on('click',showAddAnnouncementForm);
    $('#add_announcement_cancel_button').on('click',cancelAnnouncementForm);
    $('#edit_announcement_cancel_button').on('click',cancelAnnouncementForm);
    $('#add_announcement_form').submit(addAnnouncement);

    var announcementContainer =  $('#announcements_container');
    announcementContainer.on('click','.edit_announcement_button',fillEditAnnouncementForm);
    announcementContainer.on('click','.delete_announcement_button',deleteAnnouncement);

    $('#edit_announcement_form').submit(editAnnouncement);
    /*** END ATTACH EVENT LISTENERS ***/

    /*** INITIALLY HIDE FORMS ***/
    $('#add_announcement_container').hide();
    $('#edit_announcement_container').hide();


    $("#add_announcement_button").on("click", function() {
        $("#add_cancel_button").click();
        $("#edit_cancel_button").click();
    });

    if($('.carousel-inner .item').length == 0)
        $('.carousel').hide();
});

function showAddAnnouncementForm(event){
    event.preventDefault();
    $('[data-toggle="tab"]')[2].click();
    $('#material_cancel_button').click();
    $('#edit_announcement_container').hide();
    $('#add_announcement_form')[0].reset();
    $('#add_announcement_container').slideToggle(function(){
        $('#add_announcement_title').focus();
    });
}

function fillEditAnnouncementForm(event){
    event.preventDefault();
    $('#add_announcement_container').hide();
    $('#edit_announcement_cancel_button').click();
    $('#material_cancel_button').click();

    //this = edit button
    var announcement_id = $(this).closest('div').attr('announcement_id');
    $.post("index.php/announcement/get_announcement",{"announcement_id":announcement_id},function(data){
        try{
            var data = JSON.parse(data)[0];

            var editForm = $('#edit_announcement_form');

            editForm.find('#edit_announcement_id').val(announcement_id);
            editForm.find('#edit_announcement_author').val(data.announcement_author);
            editForm.find('#edit_announcement_title').val(data.announcement_title);
            editForm.find('#edit_announcement_content').val(data.announcement_content);
        }catch(e){
            console.log(e);
            console.log(data);
        }
    });

    $('#edit_announcement_container').slideToggle();
    $('#edit_announcement_content').focus();
}

function addAnnouncement(event){
    event.preventDefault();

    $.post("index.php/announcement/add",$(this).serialize(),function(data){
        try{
            data = JSON.parse(data);
            generateAnnouncementRow(data,true);
            $('#announcement_carousel').carousel($('.carousel-inner .item').length - 1);
            $('[data-toggle="tab"]')[2].click();
        }catch(e){
            console.log(e);
            console.log(data);
        }
    });

    $(this).closest('div').hide();
    this.reset();

}

function editAnnouncement(event){
    event.preventDefault();

    $.post("index.php/announcement/edit",$(this).serialize(),function(data){
        try{
            data = JSON.parse(data);

            //container = announcement container
            var container = $('.carousel-inner').find('.item > div[announcement_id="'+data.announcement_id+'"]');
            console.log(container);
            container.find('.announcement_title').text(data.announcement_title);
            container.find('.announcement_content').text(data.announcement_content);
            $('[data-toggle="tab"]')[2].click();
        }catch(e){
            console.log(e);
            console.log(data);
        }
    });

    $(this).closest('div').hide();
    this.reset();
}

function deleteAnnouncement(event){
    event.preventDefault();
    var result = confirm("Confirm deleting this announcement");
    if (result==true) {

        var container = $(this).closest('.announcement_container');
        var announcement_id = container.attr('announcement_id');
        $.post("index.php/announcement/delete",{"announcement_id":announcement_id},function(data){
            var item = container.closest('.item').addClass('left');
            var siblings = item.siblings();
            $(siblings[0]).addClass('active');
            var indicator = $($('.carousel-indicators li')[item.index()]);
            console.log("index:"+item.index()+" "+indicator.siblings());
            $(indicator.siblings()[0]).addClass('active');
            indicator.remove();
            item.remove();
            if($('.carousel-inner .item').length == 0) $('.carousel').hide();

            cancelForm.call(edit_announcement_form);
        });
    }
}

function cancelAnnouncementForm(){
    var $cancelButton = $(this);
    $cancelButton.closest('div').slideUp(function(){
        $cancelButton.closest('form')[0].reset();
    });
    return false;
}