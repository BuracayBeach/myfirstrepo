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

    <input type="date" id="logs_from" />
    <input type="date" id="logs_to" />
    <button id="get_logs_button">Get Logs</button>

    <a href="javascript:getDownloadURL();" id="download_logs_anchor">Download (PDF)</a>
    <script src="<?php echo base_url(); ?>js/logs_manager.js"></script>

</div>