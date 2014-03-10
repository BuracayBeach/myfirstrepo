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
    <form action="javascript:void(0);" class="form-inline well logs-form">
        <span class="logs-date-help"></span>
        <label for="logs_from">From:&nbsp;&nbsp;</label><input class="form-control" type="date" id="logs_from" />&nbsp;&nbsp;&nbsp;
        <label for="logs_to">To:&nbsp;&nbsp;</label><input class="form-control" type="date" id="logs_to" />&nbsp;&nbsp;
        <button type="submit" id="view_logs_button" class="btn btn-success">View Logs</button>
        <button onclick="getDownloadURL()" class="btn btn-primary" id="download_logs_anchor">View as PDF</button>
    </form>
    <br/>
    <div id="logs_result_container">
        <div id="log_links_container"></div>
        <br/>
        <div id="logs_table_container"></div>
    </div>


    <script src="<?php echo base_url(); ?>js/logs_manager.js"></script>

</div>