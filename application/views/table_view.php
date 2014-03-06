
<div id="search_table_container" class="column">
    <?php include 'pagination_view.php';?>

    <table id="search_table" border="1">
        <?php

            if(isset($table) && isset($page)){
                echo "<span id='search_results_label'>";
                if (trim($search_term)=='') echo "View all Books";
                else  echo "Search Results for  '<span class='bold'>" . htmlspecialchars(stripslashes(trim($search_term))) . "</span>'";
                echo "</span>";

                echo "<tr >
                    <th width='15%'>Identification</th>
                    <th width='40%'>Material</th>
                    <th width='15%'>Publishment </th>
                ";

                echo "<th width='15%'>Tags</th>";
                echo "<th ";
                if ($search_by != 'any' && $search_by != 'abstract') echo ' hidden';
                echo ">Abstract</th>";
                echo "</tr>";


                if ($page > 100) $page = 100;


                $total_count = count($table);

                $row_min = ($page-1) * $rows_per_page;
                $row_max = ($page)*$rows_per_page - 1;
                if ($row_max > $total_count - 1) $row_max = $total_count - 1;

                echo "<div class='search_results_counter'>";
                echo $row_min+1 . "-";
                echo $row_max+1 . " of $total_count";
                echo "<div><br>";
        
                for($a=$row_min ; $a<=$row_max ; $a++){
                    if (!isset($table[$a])) break;
                    $row = $table[$a];
                    include "table_row_view.php";
                }
            } else  {
                echo "<span>No results for '<strong>" . htmlspecialchars(stripslashes(trim($search_term))) . "</strong>'</span>";
            }

        ?>
    </table>

    <hr/>

    <?php include 'pagination_view.php';?>
</div>




<script type="text/javascript" src= "<?php echo base_url()?>js/lend_receive_manager.js"></script>
<script type = "text/javascript" src = "<?php echo base_url(); ?>js/readmore.min.js"></script>

<script type="text/javascript" src= "<?php echo base_url()?>js/search/paginationAjax.js"></script>
<script type="text/javascript" src= "<?php echo base_url()?>js/search/readmores.js"></script>

<script type="text/javascript" src= "<?php echo base_url()?>js/search/autosearch.js"></script>
