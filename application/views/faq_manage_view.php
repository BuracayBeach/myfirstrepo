<?php
/**
 * Created by PhpStorm.
 * User: isnalla
 * Date: 2/18/4
 * Time: 1:01 PM
 */
?>
<h3>Frequently Asked Questions</h3>

<button id="add_faq_button">Add a FAQ</button>
<div id="faq_manage_container">
    <div id="faq_table_container">
        <table id="faq_table">
            <tbody>
            <tr>
                <td>
                    <div id="add_faq_container" class="show_me">
                        <form autocomplete="on" id="add_faq_form">
                            <input type="text" name="question" required id="add_question" placeholder="Question"/>
                            <br/>
                            <textarea name="answer" id="add_answer" placeholder="Answer..."></textarea>
                            <br/>
                            <button type="submit" name="add_faq_button" id="add_faq_button">Add</button>
                            <button type="button" id="add_faq_cancel_button" name="add_faq_cancel_button" >Cancel</button>
                        </form>
                    </div>
                </td>
            </tr>
            <!--
            <tr>
                <td>
                    <div id="edit_faq_container">
                        <form autocomplete="on" id="edit_faq_form">
                            <input type="hidden" name="id" id="edit_faq_id" />
                            <input type="text" name="question" id="edit_question" placeholder="Question" required/>
                            <br/>
                            <textarea name="answer" id="edit_answer" placeholder="Answer..."  required></textarea>
                            <br/>
                            <button type="submit" name="edit_faq_button" id="edit_faq_button">Edit</button>
                            <button type="button" id="edit_faq_cancel_button" name="edit_faq_cancel_button" >Cancel</button>
                        </form>
                    </div>
                <td/>
            </tr-->
            </tbody>
        </table>
    </div>
</div>

<script src="<?php echo base_url() ?>js/nicEdit.js"></script>
<script src="<?php echo base_url() ?>js/faq_table_generator.js"></script>
<script src="<?php echo base_url(); ?>js/faq_manager.js"></script>