<?php
    $logged_in = !isset($_SESSION['type']);
    $regular = isset($_SESSION['type']) && $_SESSION['type'] == 'regular';
    if ($logged_in || $regular){
        echo '<div id="result_container_container">';
    }
?>
    <div class=""  id="results_per_page_div" hidden>
        <div id="results_per_page_container" >
            <form id="results_per_page_form">
                <div>
                    Results per page: 
                </div>

                <div>
                    <input id="results_per_page" style="width:50px" type="number" min="1" max="100" value="10" pattern="^[0-9]+$"/>
                </div>

            </form>
        </div>
    </div>
	<div id='result_container'>

	</div>
<?php
    if (!$logged_in || $regular){
        echo '</div>';
        if ($regular){
            echo '<script src="'.base_url().'js/search/favorites_reserve.js"></script>';
        }
    }
?>
<script type="text/javascript" src= "<?php echo base_url()?>js/search/resultsPerPageManager.js"></script>
<script type="text/javascript" src= "<?php echo base_url()?>js/search/searchresults.js"></script>

