<button class="" id="show_add_form_button" name="show_add_form_button" >Add Material</button>
<div id="material_form_container">
    <form class="well form-horizontal" id="material_form">
        <fieldset>
            <!-- Text input-->
            <div class="control-group isbn">
                <label class="control-label" for="isbn">ISBN:</label>
                <div class="controls">
                    <input id="isbn" name="isbn" title="&#013;ex. ISBN-10: 0-306-40615-2&#013;   ISBN-13: 978-0-306-40615-7" maxlength="17" placeholder="978-3-16-148410-0" class="form-control" type="text">
                    <p class="help-block">ex. ISBN-10 : 0-306-40615-2 <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ISBN-13: 978-0-306-40615-7</p>
                </div>
            </div>

            <!-- Text input-->
            <input type="hidden" id="prev_book_no" name="prev_book_no" />
            <div class="control-group">
                <label class="control-label" for="book_no">Call Number:</label>
                <div class="controls">
                    <input id="book_no" title="Call Number" name="book_no" placeholder="CS130-N12" maxlength="25" class="form-control" required="" type="text">
                    <p class="help-block"> </p>
                </div>
            </div>

            <!-- Text input-->
            <div class="control-group">
                <label class="control-label" for="book_title">Title</label>
                <div class="controls">
                    <input id="book_title" maxlength="255" spellcheck="true" name="book_title" placeholder="The Amazing Title" class="form-control" required="" type="text">
                    <p class="help-block"> </p>
                </div>
            </div>

            <!-- Select Basic -->
            <div class="control-group">
                <label class="control-label" for="type">Type:</label>
                <div class="controls">
                    <select id="type" name="type" class="form-control">
                        <option>Book</option>
                        <option>Journal</option>
                        <option>SP</option>
                        <option>Thesis</option>
                        <option>Other</option>
                    </select>
                </div>
            </div><!-- Select Basic -->
            <div class="control-group status_container">
                <label class="control-label" for="book_status">Status:</label>
                <div class="controls">
                    <select id="book_status" name="status" class="form-control">
                        <option>available</option>
                        <option>borrowed</option>
                        <option>reserved</option>
                    </select>
                </div>
            </div>

            <!-- Text input-->
            <div class="control-group other">
                <label class="control-label" for="other">Please Specify:</label>
                <div class="controls">
                    <input id="other" name="other" pattern="^[a-zA-Z0-9 '_]{1,20}$" placeholder="Magazine" class="form-control" type="text">
                    <p class="help-block">ex. Magazine, Newspaper, CD, etc..</p>
                </div>
            </div>

            <!-- Textarea -->
            <div class="control-group abstract">
                <label class="control-label" for="abstract">Abstract:</label>
                <div class="controls">
                    <textarea maxlength="1024" class="form-control" id="abstract" name="abstract"></textarea>
                </div>
            </div>

            <!-- Text input-->
            <div class="control-group">
                <label class="control-label" for="author">Author:</label>
                <div class="controls">
                    <input id="author"  pattern="[a-zA-z0-9,_'. ]+" maxlength="255" name="author" placeholder="Arthur Conan Doyle" class="form-control" type="text">
                    <p class="help-block"> </p>
                </div>
            </div>

            <!-- Textarea -->
            <div class="control-group">
                <label class="control-label" for="description">Description</label>
                <div class="controls">
                    <textarea spellcheck="true" maxlength="255" class="form-control" id="description" name="description"></textarea>
                </div>
            </div>

            <!-- Text input-->
            <div class="control-group">
                <label class="control-label" for="publisher">Publisher:</label>
                <div class="controls">
                    <input id="publisher" maxlength="255" name="publisher" placeholder="ABC Publishing House" class="form-control" type="text">
                    <p class="help-block"> </p>
                </div>
            </div>

            <!-- Text input-->
            <div class="control-group">
                <label class="control-label" for="date_published">Year Published:</label>
                <div class="controls">
                    <input id="date_published" min="0" pattern="^[0-9]{0,4}$" name="date_published" placeholder="1995" class="form-control" type="number">
                    <p class="help-block"> </p>
                </div>
            </div>

            <!-- Text input-->
            <div class="control-group">
                <label class="control-label" for="tags">Tags:</label>
                <div class="controls">
                    <input id="tags" name="tags" pattern="^[a-zA-Z0-9 ]+(,[a-zA-Z0-9 ]+)*$"  placeholder="mathematics, algebra, evolution" class="form-control" type="text">
                    <p class="help-block">Keywords (alphanumeric characters, separated by comma)</p>
                </div>
            </div>

            <a id="more_details" href="javascript:void(0);">Add more details . . .</a>

            <div class="control-group buttons">
                <label class="control-label" for="go_button"></label>
                <div class="controls">
                    <button id="submit_button" name="submit_button" type="submit" class="btn btn-primary">Add</button>
                    <button id="cancel_button" name="cancel_button" class="btn btn-default">Cancel</button>
                </div>
            </div>

        </fieldset>
    </form>
</div>
<script src="<?php echo base_url();?>js/manage_validation.js" ></script>
<script src="<?php echo base_url();?>js/book_manager.js" ></script>