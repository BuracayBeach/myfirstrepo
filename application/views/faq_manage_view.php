<?php
/**
 * Created by PhpStorm.
 * User: isnalla
 * Date: 2/18/4
 * Time: 1:01 PM
 */
?>
<br/><br/><br/><br/><br/>
<div id="faq_container">

    <div id="faq_table_container">

        <table id="faq_table">
            <tbody>
            <tr>
                <td>

                    <div id="add_faq_container" class="show_me">
                        <form autocomplete="on" id="add_faq_form">
                            <h4>ADD FAQ</h4>
                            <input type="text" name="question" id="add_question" placeholder="Question" required/>
                            <br/>
                            <textarea name="answer" id="add_answer" placeholder="Answer..."  required></textarea>
                            <br/>
                            <button type="submit" name="add_faq_button" id="add_faq_button">Add</button>
                            <button id="add_faq_cancel_button" name="add_faq_cancel_button" >Cancel</button>
                        </form>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div id="edit_faq_container">
                        <form autocomplete="on" id="edit_faq_form">
                            <h4>EDIT FAQ</h4>
                            <input type="hidden" name="id" id="edit_id" />
                            <input type="text" name="question" id="edit_question" placeholder="Question" required/>
                            <br/>
                            <textarea name="answer" id="edit_answer" placeholder="Answer..."  required></textarea>
                            <br/>
                            <button type="submit" name="edit_faq_button" id="edit_faq_button">Edit</button>
                            <button id="edit_faq_cancel_button" name="edit_faq_cancel_button" >Cancel</button>
                        </form>
                    </div>
                <td/>
            </tr>
            <tr id="">
                <td class="">
                        <span class="question">
                        <span class="answer">
                </td>
            </tr>
            </tbody>
        </table>
    </div>
    <!--script src="<?php echo base_url() ?>js/faq_table_generator.js"></script-->
</div>
<script src="<?php echo base_url(); ?>js/faq_manager.js"></script>