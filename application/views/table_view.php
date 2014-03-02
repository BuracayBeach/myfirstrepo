<div id="search_table_container" class="small-6 column">
    <table id="search_table" border="1">
        <?php

            if(isset($table) && isset($page)){
                echo "<span id='search_results_label'>";
                if (trim($search_term)=='') echo "View all Books";
                else  echo "Search Results for  '" . htmlspecialchars(stripslashes(trim($search_term))) . "'";
                echo "</span><br/><br/>";

                echo "<tr >
                    <th width='15%'>Identification</th>
                    <th width='30%'>Material</th>
                    <th width='15%'>Publishment </th>
                ";

                echo "<th>Tags</th>"; //hide later
                echo "<th>Abstract</th>"; //hide later
                echo "</tr>";


                if ($page > 100) $page = 100;


                $total_count = count($table);

                $row_min = ($page-1) * $rows_per_page;
                $row_max = ($page)*$rows_per_page - 1;
                if ($row_max > $total_count - 1) $row_max = $total_count - 1;

                echo $row_min+1 . "-";
                echo $row_max+1 . " of $total_count<br>";
        
                for($a=$row_min ; $a<=$row_max ; $a++){
                    if (!isset($table[$a])) break;
                    $row = $table[$a];
                    //prevent html generation for tags and scripts
                    include "table_row_view.php";
                }
            } else  {
                echo "<span>No results for '<strong>" . htmlspecialchars(stripslashes(trim($search_term))) . "</strong>'</span>";
            }

        ?>
    </table>
</div>



<div id='pagination_controls_div' class='small-6'>
    <?php //pagination
        if (isset($page)){
            $page_scale = 20;
            $p_search_term = stripslashes($search_term);
           echo "<span id='pagination' page='{$page}' maxpage='{$maxpage}' rowsperpage='{$rows_per_page}' searchterm= '{$p_search_term}' searchby='{$search_by}'>";
            if(isset($table) &&  count($table) > $rows_per_page){
                $max_page = count($table) / $rows_per_page;
                if (count($table) % $rows_per_page > 0) $max_page++;

                echo "<a class='prev_nav' href='javascript: void(0)'>< Prev&nbsp&nbsp;</a>"; 
                for ($a=1 ; $a<=$max_page ; $a++){
                    if ($page > $page_scale/2 && $page - $page_scale/2 > $a) continue;
                    if ($a > $page + $page_scale/2 && $a > $page_scale) continue;

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


<script type="text/javascript" src= "<?php echo base_url()?>js/lend_receive_manager.js"></script>
<script type = "text/javascript" src = "<?php echo base_url(); ?>js/readmore.min.js"></script>

<script type="text/javascript" src= "<?php echo base_url()?>js/search/paginationAjax.js"></script>
<script type="text/javascript" src= "<?php echo base_url()?>js/search/readmores.js"></script>