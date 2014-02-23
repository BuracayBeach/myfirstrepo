<div id='pagination_controls_div'>

	<span id="results_per_page_div">
	    <input id="results_per_page" style="width:45px" type="number" min="1" max="500" value="1"/>
	    <span>Results per page&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
	</span>

	<?php //pagination
	    if (isset($page)){
	       echo "<span id='pagination' page='{$page}' maxpage='{$maxpage}' rowsperpage='{$rows_per_page}' searchterm=" . "'" . $search_term . "'" . ">";
	        if(isset($table) &&  count($table) > $rows_per_page){
	            $max_page = count($table) / $rows_per_page;
	            if (count($table) % $rows_per_page > 0) $max_page++;

	            echo "<a class='prev_nav' href='javascript: void(0)'>< Prev&nbsp&nbsp;</a>"; 
	            for ($a=1 ; $a<=$max_page ; $a++){
	                if ($a == $page) echo '<strong>';
	                echo "<a class='page_nav' href='javascript: void(0)' pageno={$a}>&nbsp;{$a}&nbsp;</a>"; 
	                if ($a == $page) echo '</strong>';
	            }
	            echo "<a class='next_nav' href='javascript: void(0)'>&nbsp;&nbsp;Next >&nbsp;</a>"; 
	        
	        }
	        echo '</span>'; 
	    }   
	?>


</div>