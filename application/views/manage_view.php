<div id="recently_added_books_container">
    <hr/>
    <h4>RECENTLY ADDED BOOKS</h4>
    <table id="recently_added_books_table" border="1" width='60%'>
        <tr>
            <th>Book No.</th>
            <th>Book</th>
            <th>Publishment</th>
            <th>Tags</th>
        </tr>
    </table>
    <hr/>
</div>
<button id="show_add_form_button" name="show_add_form_button" >Add Material</button>
<div id="add_container">
    <form autocomplete="on" id="add_book_form">
        <h4>Add Material</h4>
        <span>Need help? </span><br/>
        <input type="text" title="ISBN (ex. 1234567890)" name="book_no" maxlength="10" id="add_book_no" placeholder="Book No" required pattern="[A-Za-z0-9 ]+">
        <br/>
        <input type="text" maxlength="255" spellcheck="true" name="book_title" id="add_book_title" placeholder="Title" required/>
        <br/>
        <select name="type" id="add_book_type">
            <option selected="true">Book</option>
            <option>Journal</option>
            <option>SP</option>
            <option>Thesis</option>
        </select>
        <br/>
        <div class="abstract_container">
            <label for="add_abstract" >Abstract</label>
            <input type="text" spellcheck="true" maxlength="1024" name="abstract" id="add_abstract" placeholder="Abstract"/>
        </div>
        <input type="text" name="author" maxlength="255" id="add_author" placeholder="Author" pattern="[a-zA-z0-9,_' ]+"/>
        <br/>
        <textarea name="description" spellcheck="true" maxlength="255" id="add_description" placeholder="Description"  ></textarea>
        <br/>
        <input type="text" maxlength="255" name="publisher" id="add_publisher" placeholder="Publisher"  />
        <br/>
        <input type="number" min="0" name="date_published" id="add_date_published"  pattern="\d{4}-\d\d-\d\d" placeholder="Date Published" />
        <br/>
        <input type="text" name="tags" spellcheck="true" id="add_tags" title="Subject, Category, etc...; &#10;separated by comma (ex. 'math, computer science') " placeholder="Tags" pattern="^[a-zA-Z0-9 ]+(,[a-zA-Z0-9 ]+)*$"/>
        <br/>
        <br/>
        <button type="submit" name="add_button" id="add_button">Add Book</button>
        <button id="add_cancel_button" name="add_cancel_button" >Cancel</button>
    </form>
</div>
<div id="edit_container">
    <hr/>
    <form name="edit_book" id="edit_book_form" method="post">
        <h4>Edit Material</h4>
        <label for="edit_prev_book_no" hidden>Previous Book No:</label>
        <input type="text" maxlength="10"  name="prev_book_no" id="edit_prev_book_no" hidden/>
        <label for="edit_book_no">Book No: </label>
        <input type="text" title="ISBN (ex. 1234567890)" maxlength="10" name="book_no" id="edit_book_no" placeholder="Book Number" required pattern="[A-Za-z0-9 ]+" />
        <br/>
        <label for="edit_book_title">Book Title: </label>
        <input type="text" name="book_title" id="edit_book_title" placeholder="Title" required pattern="[-A-Za-z0-9 ]+" />
          <br/>
        <label for="edit_book_type">Type: </label>
        <select name="type" id="edit_book_type">
            <option selected="true">Book</option>
            <option>Journal</option>
            <option>SP</option>
            <option>Thesis</option>
        </select>
        <br/>
        <div class="abstract_container">
            <label for="edit_abstract" >Abstract</label>
            <input type="text" name="abstract" id="edit_abstract" placeholder="Abstract"/>
        </div>
        <label for="edit_author">Book Author: </label>
        <input type="text" name="author" id="edit_author"  pattern="[A-Za-z ]+[-]?[A-Za-z]+" />
        <br/>
        <label for="edit_book_status">Book Status: </label>
        <select name="book_status" id="edit_book_status">
            <option value = "available"> Available </option>
            <option value = "reserved"> Reserved </option>
            <option value = "borrowed"> Borrowed </option>
        </select>
        <br />
        <label for="edit_description">Book Description: </label><br/>
        <textarea name="description" id="edit_description" maxlength=255 placeholder="Description"></textarea>
        <br />
        <label for="edit_publisher">Book Publisher: </label>
        <input type="text" name="publisher" id="edit_publisher" placeholder="Publisher" />
        <br />
        <label for="edit_tags">Tags:</label>
        <input type="text" name="tags" id= "edit_tags" placeholder="Tags" pattern="^[a-zA-Z0-9 ]+(,[a-zA-Z0-9 ]+)*$"/><br/>
        <label for="edit_date_published">Date Published:</label>
        <input type="date" name="date_published" id="edit_date_published" />
        <br/>
        <button type="submit" id="submit_edit" name="submit_edit">Save</button>
        <button id="edit_cancel_button" name="edit_cancel_button">Cancel</button>
    </form>
</div>

<script src="<?php echo base_url();?>js/manage_validation.js" ></script>
<script src="<?php echo base_url();?>js/book_manager.js" ></script>
