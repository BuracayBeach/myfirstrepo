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
    <div id="logs_result_container">
        <div id="log_links_container"></div>
        <div id="logs_table_container"></div>
    </div>
    <input type="date" id="logs_from" />
    <input type="date" id="logs_to" />
    <button id="view_logs_button">View Logs</button>

    <a href="javascript:getDownloadURL();" id="download_logs_anchor">View as PDF</a>
    <script src="<?php echo base_url(); ?>js/logs_manager.js"></script>

</div>