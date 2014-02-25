<button id="add_announcement_button">Add Announcement</button>
<div id="announcement_manage_container">
    <div id="add_announcement_container">
        <form autocomplete="on" id="add_announcement_form">
            <h4>ADD ANNOUNCEMENT</h4>
            <input type="text" name="announcement_title" id="add_announcement_title" placeholder="Title" required"/>
            <br/>
            <textarea name="announcement_content" id="add_announcement_content" placeholder="Announcement Content..."  required></textarea>
            <br/>
            <button type="submit" name="add_announcement_button" id="add_announcement_button">Add</button>
            <button id="add_announcement_cancel_button" name="add_announcement_cancel_button" >Cancel</button>
        </form>
    </div>
    <div id="edit_announcement_container">
        <form autocomplete="on" id="edit_announcement_form">
            <h4>EDIT ANNOUNCEMENT</h4>
            <input type="hidden" name="announcement_id" id="edit_announcement_id" />
            <input type="hidden" name="announcement_author" id="edit_announcement_author"/>
            <input type="text" name="announcement_title" id="edit_announcement_title" placeholder="Title" required"/>
            <br/>
            <textarea name="announcement_content" id="edit_announcement_content" placeholder="Announcement Content..."  required></textarea>
            <br/>
            <button type="submit" name="edit_announcement_button" id="edit_announcement_button">Edit</button>
            <button id="edit_announcement_cancel_button" name="edit_announcement_cancel_button" >Cancel</button>
        </form>
    </div>
</div>
<script src="<?php echo base_url(); ?>js/announcements_manager.js"></script>