<div class="pagination_container">
    <div id='pagination_controls_div'>
        <?php //pagination
            if (isset($page)){
                $page_scale = 10;
                $temp = str_replace('\'', '&#39', stripcslashes($search_term));
                
                $p_search_term = $temp;
               echo "<div id='pagination";
               if (isset($pagination2)) echo "2";
               echo"' page='{$page}' maxpage='{$maxpage}' rowsperpage='{$rows_per_page}' searchterm= '{$p_search_term}' searchby='{$search_by}'>";
                if(isset($table) &&  count($table) > $rows_per_page){
                    $max_page = count($table) / $rows_per_page;
                    if (count($table) % $rows_per_page > 0) $max_page++;

                    echo "<a class='prev_nav' href='javascript: void(0)'>" . "˂" . "Prev&nbsp&nbsp;</a>"; 
                    for ($a=1 ; $a<=$max_page ; $a++){
                        if ($page > $page_scale/2 && $page - $page_scale/2 > $a) continue;
                        if ($a > $page + $page_scale/2 && $a > $page_scale) continue;

                        if ($a == $page) echo '<strong>';
                        echo "<a ";
                        if ($a != $page) echo "class='page_nav'";
                        echo " href='javascript: void(0)' pageno={$a}>&nbsp;{$a}&nbsp;</a>"; 
                        if ($a == $page) echo '</strong>';
                    }
                    echo "<a class='next_nav' href='javascript: void(0)'>&nbsp;&nbsp;Next˃&nbsp;</a>"; 
                
                }
                echo '</div>'; 

            }   
        ?>
    </div>
</div>
<hr>