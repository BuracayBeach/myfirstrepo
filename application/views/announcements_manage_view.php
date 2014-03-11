<div id="right_side_bar">

<button id="add_announcement_button">Add Announcement</button>
<div id="announcement_manage_container">
    <div id="add_announcement_container">
        <form autocomplete="on" class="well" id="add_announcement_form">
            <label for="add_announcement_title">Heading</label>
            <div class="form-group"><input class="form-control" type="text" name="announcement_title" id="add_announcement_title" placeholder="Breaking News!" required/></div>
            <label for="add_announcement_content">Content</label>
            <div class="form-group"><textarea class="form-control" name="announcement_content" id="add_announcement_content" placeholder="Interesting Content . . ."  required></textarea></div>
            <br>
            <button class="btn btn-primary" type="submit" name="add_announcement_button" id="add_announcement_button1">Add</button>
            <button class="btn btn-default" id="add_announcement_cancel_button" name="add_announcement_cancel_button" >Cancel</button>
        </form>
    </div>
    <div id="edit_announcement_container">
        <form autocomplete="on" class="well" id="edit_announcement_form">
            <fieldset>
                <legend>Edit Announcement</legend>
                <span class="help-required">Fields with * are required.</span>
                <input type="hidden" name="announcement_id" id="edit_announcement_id" />
                <input type="hidden" name="announcement_author" id="edit_announcement_author"/>
                <div class="form-group"> <input class="form-control" type="text" name="announcement_title" id="edit_announcement_title" placeholder="Title" required/></div>
                <br/>
                <div class="form-group"><textarea class="form-control" name="announcement_content" id="edit_announcement_content" placeholder="Announcement Content..."  required></textarea></div>
                <br/>
                <button class="btn btn-primary" type="submit" name="edit_announcement_button" id="edit_announcement_button">Save</button>
                <button class="btn btn-default" id="edit_announcement_cancel_button" name="edit_announcement_cancel_button" >Cancel</button>
            </fieldset>
        </form>
    </div>
</div>
<script src="<?php echo base_url(); ?>js/announcements_manager.js"></script>
