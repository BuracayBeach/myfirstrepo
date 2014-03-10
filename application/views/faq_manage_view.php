<div id="faq_manage_container">
    <h3>Frequently Asked Questions</h3>
    <button id="add_faq_button">Add a FAQ</button>
    <div id="faq_anchors">
    </div>
    <br/>
    <hr/>
    <br/>
    <div id="faq_table_container">
        <table id="faq_table" class="column">
            <tbody>
            <tr>
                <td>
                    <div id="add_faq_container" class="show_me column">
                        <form autocomplete="on" id="add_faq_form">
                            <input type="text" class="form-control" name="question" required id="add_question" placeholder="Question"/>
                            <br/>
                            <label>Answer:</label>
                            <textarea name="answer" id="add_answer" class="answer_editor" placeholder="Answer..."></textarea>
                            <br/>
                            <button type="submit" name="add_faq_button" id="add_faq_button">Add</button>
                            <button type="button" id="add_faq_cancel_button" name="add_faq_cancel_button" >Cancel</button>
                            <br/>
                        </form>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
    <button class="btn btn-block back-to-top">Back to top</button>
</div>

<script src="<?php echo base_url() ?>js/nicEdit.js"></script>
<script src="<?php echo base_url() ?>js/faq_table_generator.js"></script>
<script src="<?php echo base_url(); ?>js/faq_manager.js"></script>