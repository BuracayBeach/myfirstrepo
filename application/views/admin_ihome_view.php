<div id="tabnavihome"class="tabbable small-7 column"> <!-- Only required for left/right tabs -->
  <ul class="nav nav-tabs">
    <li class="active"><a href="#tab1" data-toggle="tab">Search Results</a></li>
    <li><a href="#tab2" data-toggle="tab">Recently Added</a></li>
    <li><a href="#tab3" data-toggle="tab">Announcements</a></li>
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
  </div>
</div>

<!--

            $this->load->view('recently_added_view');

-->
     
