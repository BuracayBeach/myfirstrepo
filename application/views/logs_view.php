<?php
/**
 * Created by PhpStorm.
 * User: isnalla
 * Date: 3/2/14
 * Time: 10:05 PM
 */
?>
<div id="logs_container">

    <h3 id="header_logs">Logs</h3>
    <br/>

    <label for="logs_from">From:&nbsp;&nbsp; </label><input type="date" id="logs_from" />&nbsp;&nbsp;&nbsp;
    <label for="logs_from">To:&nbsp;&nbsp; </label><input type="date" id="logs_to" />&nbsp;&nbsp;
    <button id="view_logs_button" class="btn btn-primary">View Logs</button>
    <a href="javascript:getDownloadURL();" id="download_logs_anchor">View as PDF</a>
    <br/>
    <br/>

    <div id="logs_result_container">
        <div id="log_links_container"></div>
        <br/>
        <div id="logs_table_container"></div>
    </div>


    <script src="<?php echo base_url(); ?>js/logs_manager.js"></script>

</div>