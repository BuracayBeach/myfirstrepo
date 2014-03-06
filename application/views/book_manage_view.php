<button class="" id="show_add_form_button" name="show_add_form_button" >Add Material</button>
<div id="add_container">
    <form autocomplete="on" id="add_book_form">
        &nbsp; ADD MATERIAL<br/>  <br/>
        <span class="errors"></span>
        <input type="text" title="Call Number" name="book_no" maxlength="25" id="add_book_no" placeholder="Call Number" required />
        <br/>
        <input type="text" title="ISBN" class="isbn" name="isbn" maxlength="17" id="add_isbn" pattern="[0-9]{1,17}" placeholder="ISBN" />
        <br/>
        <input type="text" maxlength="255" spellcheck="true" name="book_title" id="add_book_title" placeholder="Title" required/>
        <br/>
        <select name="type" id="add_book_type">
            <option selected="true">Book</option>
            <option>Journal</option>
            <option>SP</option>
            <option >Thesis</option>
            <option>Other</option>
        </select>
        <br/>
        <input type="text"
               title="ex. magazine, newspaper"
               pattern="^[a-zA-Z0-9 '_]{1,20}$"
               placeholder="Please specify..."
               name="other" class="other" id="add_other" />
        <div class="abstract_container">
            <label for="add_abstract" >Abstract</label><br/>
            <textarea spellcheck="true" maxlength="1024" name="abstract" id="add_abstract" placeholder="Abstract">
                </textarea>
            <br/>
        </div>
        <input type="text" name="author" maxlength="255" id="add_author" placeholder="Author" pattern="[a-zA-z0-9,_'. ]+"/>
        <br/>
        <textarea name="description" spellcheck="true" maxlength="255" id="add_description" placeholder="Description"  ></textarea>
        <br/>
        <input type="text" maxlength="255" name="publisher" id="add_publisher" placeholder="Publisher"  />
        <br/>
        <input type="number" min="0" max="0" name="date_published" id="add_date_published"
               pattern="^[0-9]{0,4}$"
               placeholder="Year Published"
               title="ex. 2014, 1995"/>
        <br/>
        <input type="text" name="tags" spellcheck="true" id="add_tags"
               title="Tags contain additional keywords, like, &#10;Subject, Category, etc...; &#10;separated by comma (ex. 'math, computer science') "
               placeholder="Tags" pattern="^[a-zA-Z0-9 ]+(,[a-zA-Z0-9 ]+)*$"/>
        <br/>
        <a class="more_details" href="javascript:void(0);" id="add_more_details">Add More Details...</a>
        <br/>
        <button type="submit" class="add_button" name="add_button" id="add_button">Add Book</button>
        <button id="add_cancel_button" class="edit_button" name="add_cancel_button" >Cancel</button>
    </form>
</div>

<div id="edit_container" class="column">
    <form name="edit_book" id="edit_book_form" method="post">
        Edit Material<br/>
        <span class="errors"></span>
        <label for="edit_prev_book_no" hidden>Previous Book No:</label>
        <input type="hidden" maxlength="12"  name="prev_book_no" id="edit_prev_book_no"/>
        <label for="edit_book_no">Book No: </label>
        <input type="text" title="ISBN (ex. 1234567890)" maxlength="10" name="book_no" id="edit_book_no" placeholder="Book Number" required />
        <label for="edit_book_title">Book Title: </label>
        <input type="text" name="book_title" id="edit_book_title" placeholder="Title" required />
        <label for="edit_book_type">Type: </label>
        <select name="type" id="edit_book_type">
            <option selected="true">Book</option>
            <option>Journal</option>
            <option>SP</option>
            <option>Thesis</option>
            <option>Other</option>
        </select>
        <input type="text"
               pattern="^[a-zA-Z0-9. '_]{1,20}$"
               title="magazine, newspaper"
               name="other" class="other" id="edit_other"  />
        <div class="abstract_container">
            <label for="edit_abstract" >Abstract</label>
            <textarea spellcheck="true" maxlength="1024" name="abstract" id="edit_abstract" placeholder="Abstract">
            </textarea>
        </div>
        <label for="edit_author">Book Author:</label>
        <input type="text" title="multiple authors are separated by semi-colon"
               name="author"
               id="edit_author"
               pattern="([a-zA-Z.,'0-9 ]+(;[a-zA-Z,.'0-9 ]+)*)*" />
        <label for="edit_book_status">Book Status: (Only for error in data)</label>
        <select name="book_status" id="edit_book_status">
            <option value = "available" selected="true"> Available </option>
            <option value = "reserved"> Reserved </option>
            <option value = "borrowed"> Borrowed </option>
        </select>
        <label for="edit_description">Book Description: </label><br/>
        <textarea name="description" id="edit_description" maxlength=255 placeholder="Description"></textarea>
        <label for="edit_publisher">Book Publisher: </label>
        <input type="text" name="publisher" id="edit_publisher" placeholder="Publisher" />
        <label for="edit_date_published">Year Published:</label>
        <input type="number" min="0" max="0" name="date_published"
               pattern="^[0-9]{0,4}$"
               placeholder="Year Published"
               title="ex. 2014, 1995"
               id="edit_date_published" />
        <label for="edit_tags">Tags:</label>
        <input type="text" name="tags" id= "edit_tags"
               title="Tags contain additional keywords, like, &#10;Subject, Category, etc...; &#10;separated by comma (ex. 'math, computer science') "
               placeholder="Tags" pattern="^[a-zA-Z0-9 ]+(,[a-zA-Z0-9 ]+)*$"/><br/>

        <button type="submit" id="submit_edit" name="submit_edit">Save</button>
        <button id="edit_cancel_button" name="edit_cancel_button">Cancel</button>
    </form>
</div>
</div>
<script src="<?php echo base_url();?>js/manage_validation.js" ></script>
<script src="<?php echo base_url();?>js/book_manager.js" ></script>