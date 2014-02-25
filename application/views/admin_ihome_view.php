<div id="tabnavihome"class="tabbable small-8 column"> <!-- Only required for left/right tabs -->
  <ul class="nav nav-tabs">
    <li class="active"><a href="#tab1" data-toggle="tab">Recently Added Books</a></li>
    <li><a href="#tab2" data-toggle="tab">Recently Added</a></li>
  </ul>
  <div class="tab-content">
    <div class="tab-pane active" id="tab1">
      <?php include 'search_results_view.php';?>
    </div>
    <div class="tab-pane" id="tab2">
      <?php include 'recently_added_view.php';?>
    </div>
  </div>
</div>

<!--

            $this->load->view('recently_added_view');

-->
     
