
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

<script type="text/javascript" src= "<?php echo base_url()?>js/search/resultsPerPageManager.js"></script>
<script type="text/javascript" src= "<?php echo base_url()?>js/search/searchresults.js"></script>

