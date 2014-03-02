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

<script>
    $('#search_table').on('click', 'tr', activate_row);

    $('#pagination').on('click', '.page_nav', go_to_page);
    $('.prev_nav').on('click', prev_page);
    $('.next_nav').on('click', next_page);

    function activate_row(){
        $("#search_table").find("tr").attr("active", "false");
        $(this).attr('active', true);
    }

    function go_to_page(){
        page = $(this).attr('pageno');
        to_ajax(page);
    }

   function next_page(){
        page = parseInt($('#pagination').attr('page'));
        maxpage = parseInt($('#pagination').attr('maxpage'));
        if (page >= maxpage) return;
        to_ajax(page+1);
    }

   function prev_page(){
        page = parseInt($('#pagination').attr('page'));
        if (page == 1) return;
        to_ajax(page-1);
    }

    function to_ajax(numPage){
        to_search = $('#pagination').attr('searchterm');
        search_by = $('#pagination').attr('searchby');
        $('#search_text').val(to_search);
        results_per_page = $('#pagination').attr('rowsperpage');
        ajax_results(search_by, numPage, results_per_page);
    }




    function ajax_results(search_by, page, results_per_page){
        my_input = $('#search_form').serialize();
        my_input += "&page=" + page;
        my_input += "&rows_per_page=" + results_per_page;
        my_input += "&search_by=" + search_by;
        // console.log(my_input);

        $.ajax({
            type: "post",
            data: my_input, 
            url: "http://localhost/myfirstrepo/index.php/book/search",
            success: function(data, jqxhr, status){
                $("#result_container").html(data);
            }

        });

    }
</script>

<script type="text/javascript" src= "<?php echo base_url()?>js/lend_receive_manager.js"></script>
<script type = "text/javascript" src = "<?php echo base_url(); ?>js/readmore.min.js"></script>
<script>
    $('.article_abstract').readmore({
      speed: 75,
      maxHeight: 50
    });

    $('.article_title').readmore({
      speed: 75,
      maxHeight: 40
    })  

    $('.article_author').readmore({
      speed: 75,
      maxHeight: 20
    })
    $('.article_description').readmore({
      speed: 75,
      maxHeight: 40
    })

    $('.article_publisher').readmore({
      speed: 75,
      maxHeight: 40
    })
    $('.article_tag').readmore({
      speed: 75,
      maxHeight: 40
    })

</script>
