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
<button id="show_add_form_button" name="show_add_form_button" >Add New Book</button>
<div id="add_container">
    <form autocomplete="on" id="add_book_form">
        <h4>ADD BOOK</h4>
        <label for="add_book_no">Book No: </label>
        <input type="text" name="book_no" id="add_book_no" placeholder="Book Number" required pattern="[A-Za-z0-9 ]+">
        <br/>
        <label for="add_book_title">Book Title: </label>
        <input type="text" name="book_title" id="add_book_title" placeholder="Book Title" required pattern="[-A-Za-z0-9 ]+"/>
        <br/>
        <label for="add_author">Book Author: </label>
        <input type="text" name="author" id="add_author" placeholder="Author" pattern="[A-Za-z ]+[-]?[A-Za-z]*"/>
        <br/>
        <label for="add_description">Book Description: </label> <br/>
        <textarea name="description" id="add_description" placeholder="Description"  ></textarea>
        <br/>
        <label for="add_publisher">Book Publisher: </label>
        <input type="text" name="publisher" id="add_publisher" placeholder="Publisher"  />
        <br/>
        <label for="add_date_published">Date Published: </label>
        <input type="date" name="date_published" id="add_date_published" placeholder="Date Published" />
        <br/>
        <label for="add_tags">Tags: </label>
        <input type="text" name="tags" id="add_tags" placeholder="Tags" pattern="^[a-zA-Z0-9 ]+(,[a-zA-Z0-9 ]+)*$"/>
        <br/>
        <button type="submit" name="add_button" id="add_button">Add Book</button>
        <button id="add_cancel_button" name="add_cancel_button" >Cancel</button>
    </form>
</div>
<div id="edit_container">

    <hr/>
    <form name="edit_book" id="edit_book_form" method="post">
        <h4>EDIT BOOK</h4>
        <label for="edit_prev_book_no" hidden>Previous Book No:</label>
        <input type="text" name="prev_book_no" id="edit_prev_book_no" hidden/>
        <label for="edit_book_no">Book No: </label>
        <input type="text" name="book_no" id="edit_book_no" required pattern="[A-Za-z0-9 ]+" />
        <br/>
        <label for="edit_book_title">Book Title: </label>
        <input type="text" name="book_title" id="edit_book_title" required pattern="[-A-Za-z0-9 ]+" />
        <br/>
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
