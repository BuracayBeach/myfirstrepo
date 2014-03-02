$('#announcement_container').ready(function(){
    /*** ATTACH EVENT LISTENERS ***/
    $('#add_announcement_button').on('click',showAddAnnouncementForm);
    $('#add_announcement_cancel_button').on('click',cancelForm);
    $('#edit_announcement_cancel_button').on('click',cancelForm);
    $('#add_announcement_form').submit(addAnnouncement);

    var announcementContainer =  $('#announcements_container');
    announcementContainer.on('click','.edit_announcement_button',fillEditAnnouncementForm);
    announcementContainer.on('click','.delete_announcement_button',deleteAnnouncement);

    $('#edit_announcement_form').submit(editAnnouncement);
    /*** END ATTACH EVENT LISTENERS ***/

    /*** INITIALLY HIDE FORMS ***/
    $('#add_announcement_container').hide();
    $('#edit_announcement_container').hide();
});

function showAddAnnouncementForm(event){
    event.preventDefault();
    $('[data-toggle="tab"]')[2].click();
    $('#edit_announcement_container').hide();
    $('#add_announcement_container').show();
    $('#add_announcement_title').focus();
}

function fillEditAnnouncementForm(event){
    event.preventDefault();
    $('#add_announcement_container').hide();
    var announcement_id = $(this).closest('tr').attr('announcement_id');

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

    $('#edit_announcement_container').show();
    $('#edit_announcement_content').focus();
}

function addAnnouncement(event){
    event.preventDefault();

    $.post("index.php/announcement/add",$(this).serialize(),function(data){
        try{
            data = JSON.parse(data);
            generateAnnouncementRow(data,true);
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

            var td = $('#announcements_table').find('tbody').find('tr[announcement_id="'+data.announcement_id+'"]');
            console.log($('#announcements_table'));
            td.find('.announcement_title').text(data.announcement_title);
            td.find('.announcement_content').text(data.announcement_content);
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
        var announcement_id = $(this).closest('tr').attr('announcement_id');
        var tr = $(this).closest('tr');
        $.post("index.php/announcement/delete",{"announcement_id":announcement_id},function(data){
            try{
                if(tr.closest('table').find('tbody tr').length - 1 == 0)
                    tr.closest('table').remove();
                else tr.remove();
            }
            catch(e){
                console.log(e);
                console.log(data);
            }
        });
    }
}

function cancelForm(event){
    event.preventDefault();
    $(this).closest('div').hide();
    $(this).closest('form')[0].reset();
}