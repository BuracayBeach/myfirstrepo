<?php
/**
 * Created by PhpStorm.
 * User: isnalla
 * Date: 3/2/14
 * Time: 10:05 PM
 */
?>
<h3 id="header_logs">Logs</h3>
<div id="tabnavlogs" class="tabbable small-7 column"> <!-- Only required for left/right tabs -->
    <ul class="nav nav-tabs">
        <li class="active"><a href="#tab1" data-toggle="tab">Materials</a></li>
        <li><a href="#tab2" data-toggle="tab">Recently Added Materials</a></li>
        <li><a href="#tab3" data-toggle="tab">Announcements</a></li>
        <li><a href="#tab4" data-toggle="tab">Notify User</a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="tab1">
            <?php include 'search_results_view.php';?>
        </div>
        <div class="tab-pane" id="tab2">
            <?php include 'recently_added_view.php';?>
        </div>
        <div class="tab-pane" id="tab3">
            <?php include 'announcements_view.php';?>
        </div>
        <div class="tab-pane" id="tab4">
            <?php include 'notifications_custom_view.php';?>
        </div>
    </div>
</div>