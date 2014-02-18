<button id="add_news_button">Add News</button>
<div id="add_news_container">
    <form autocomplete="on" id="add_news_form">
        <h4>ADD NEWS</h4>
        <input type="text" name="news_title" id="add_news_title" placeholder="Title" required"/>
        <br/>
        <textarea name="news_content" id="add_news_content" placeholder="News Content..."  required></textarea>
        <br/>
        <button type="submit" name="add_news_button" id="add_news_button">Add</button>
        <button id="add_news_cancel_button" name="add_news_cancel_button" >Cancel</button>
    </form>
</div>
<div id="edit_news_container">
    <form autocomplete="on" id="edit_news_form">
        <h4>EDIT NEWS</h4>
        <input type="hidden" name="news_id" id="edit_news_id" />
        <input type="hidden" name="news_author" id="edit_news_author"/>
        <input type="text" name="news_title" id="edit_news_title" placeholder="Title" required"/>
        <br/>
        <textarea name="news_content" id="edit_news_content" placeholder="News Content..."  required></textarea>
        <br/>
        <button type="submit" name="edit_news_button" id="edit_news_button">Edit</button>
        <button id="edit_news_cancel_button" name="edit_news_cancel_button" >Cancel</button>
    </form>
</div>
<script src="<?php echo base_url(); ?>js/news_manager.js"></script>