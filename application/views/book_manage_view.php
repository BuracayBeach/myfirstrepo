<button class="" id="show_add_form_button" name="show_add_form_button" >Add Material</button>
<div id="material_form_container">
    <form class="well form-horizontal" id="material_form">
        <fieldset>
            <!-- Text input-->
            <div class="control-group">
                <label class="control-label" for="isbn">ISBN:</label>
                <div class="controls">
                    <input id="isbn" name="isbn" placeholder="978-3-16-148410-0" class="form-control" type="text">
                    <p class="help-block">ex. ISBN-10 : 0-306-40615-2 <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ISBN-13: 978-0-306-40615-7</p>
                </div>
            </div>

            <!-- Text input-->
            <div class="control-group">
                <label class="control-label" for="book_no">Call Number:</label>
                <div class="controls">
                    <input id="book_no" name="book_no" placeholder="CS130-N12" class="form-control" required="" type="text">
                    <p class="help-block"> </p>
                </div>
            </div>

            <!-- Text input-->
            <div class="control-group">
                <label class="control-label" for="book_title">Title</label>
                <div class="controls">
                    <input id="book_title" name="book_title" placeholder="The Amazing Title" class="form-control" required="" type="text">
                    <p class="help-block"> </p>
                </div>
            </div>

            <!-- Select Basic -->
            <div class="control-group">
                <label class="control-label" for="book_type">Type:</label>
                <div class="controls">
                    <select id="book_type" name="book_type" class="form-control">
                        <option>Book</option>
                        <option>Journal</option>
                        <option>SP</option>
                        <option>Thesis</option>
                        <option>Other</option>
                    </select>
                </div>
            </div>

            <!-- Text input-->
            <div class="control-group">
                <label class="control-label" for="other">Please Specify:</label>
                <div class="controls">
                    <input id="other" name="other" placeholder="Magazine" class="form-control other" type="text">
                    <p class="help-block">ex. Magazine, Newspaper, CD, etc..</p>
                </div>
            </div>

            <!-- Textarea -->
            <div class="control-group abstract_container">
                <label class="control-label" for="abstract">Abstract:</label>
                <div class="controls">
                    <textarea class="form-control" id="abstract" name="abstract"></textarea>
                </div>
            </div>

            <!-- Text input-->
            <div class="control-group">
                <label class="control-label" for="autjor">Author:</label>
                <div class="controls">
                    <input id="autjor" name="autjor" placeholder="Arthur Conan Doyle" class="form-control" type="text">
                    <p class="help-block"> </p>
                </div>
            </div>

            <!-- Textarea -->
            <div class="control-group">
                <label class="control-label" for="description">Description</label>
                <div class="controls">
                    <textarea class="form-control" id="description" name="description"></textarea>
                </div>
            </div>

            <!-- Text input-->
            <div class="control-group">
                <label class="control-label" for="publisher">Publisher:</label>
                <div class="controls">
                    <input id="publisher" name="publisher" placeholder="ABC Publishing House" class="form-control" type="text">
                    <p class="help-block"> </p>
                </div>
            </div>

            <!-- Text input-->
            <div class="control-group">
                <label class="control-label" for="date_published">Year Published:</label>
                <div class="controls">
                    <input id="date_published" name="date_published" placeholder="1995" class="form-control" type="number">
                    <p class="help-block"> </p>
                </div>
            </div>

            <!-- Text input-->
            <div class="control-group">
                <label class="control-label" for="tags">Tags:</label>
                <div class="controls">
                    <input id="tags" name="tags" placeholder="mathematics, algebra, evolution" class="form-control" type="text">
                    <p class="help-block">Keywords (alphanumeric characters, separated by comma)</p>
                </div>
            </div>

            <div class="control-group">
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