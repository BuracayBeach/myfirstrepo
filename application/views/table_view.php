<div id="search_table_container">
                <table id="search_table" border="1" width='60%'>
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
                                foreach($row as &$r){
                                    $r = htmlspecialchars(stripslashes($r));
                                }
                            
                                echo "<tr active='false'>";                               
                                echo "<td align='center'>" .
                                        "<div style = 'font:15px Verdana' book_data='book_no'>" .
                                            $row->book_no . 
                                        "</div>" . 
                                        "<div style = 'font:12px Verdana' book_data='book_type'><em>" .
                                            $row->book_type . 
                                        "</em></div>" . 
                                    "</td>";

                                echo "<td>" .
                                        "<div style = 'font:20px Verdana' book_data='book_title'>" . 
                                            $row->book_title . 
                                        "</div>" . 

                                        
                                        "<div style = 'font-size:17px' book_data='description'> " . 
                                            $row->description   . "<br>" .  
                                        "</div>" . 

                                        "<div style = 'font-size:13px' book_data='author'><em> " . 
                                            $row->author . "<br>" .
                                        "</em></div>";

                                        if (isset($_SESSION['type']) && $_SESSION['type'] == "admin"){  //--------------- ADMIN ACTIONS ----------------\\
                                            
                                            // Edit , Delete Button
                                            echo "<span><a href='javascript:void(0)' bookno='{$row->book_no}' class='edit_button'>Edit</a></span>&nbsp&nbsp&nbsp";
                                            if ($row->status != 'borrowed') echo "<span><a href='javascript:void(0)' bookno='{$row->book_no}' class='delete_button'>Delete</a></span>&nbsp | &nbsp";
                                            else echo "<span>({$row->status})&nbsp|&nbsp</span>";
                                            echo "<span><a ";

                                            // Lend , Return Button

                                            /* edit by Edzer Padilla start */
                                            if ($row->status == "reserved")  echo "bookno='{$row->book_no}' class='transaction_anchor lendButton' >Lend</a>";
                                            elseif ($row->status == "borrowed") echo "bookno='{$row->book_no}' class = 'transaction_anchor receivedButton'>Return</a>";
                                            else echo "'>(" . $row->status . ")";
                                            /* edit end */
                                            echo "</span>";

                                            
                                        } else { //--------------- USER ACTIONS ----------------\\
                                            
                                            if (isset($_SESSION['type']) && $_SESSION['type'] == "regular"){ 

                                                /* checking of favorite */
                                                $favorite = 'favorite';
                                                $size = count($favorite_user);
                                                for ($i=0; $i<$size; $i++) {
                                                    if ($favorite_user[$i]->book_no == $row->book_no) {
                                                        $favorite = 'unfavorite';
                                                        break;
                                                    }
                                                }

                                                /* checking of reserves */
                                                $reserve = 'reserve';
                                                $size = count($reserve_user);
                                                for ($i=0; $i<$size; $i++) {
                                                    if ($reserve_user[$i]->book_no == $row->book_no) {
                                                        $reserve = 'unreserve';
                                                        break;
                                                    }
                                                }

                                                /* counter-check reserves with lends */
                                                $size = count($lend_user);
                                                for ($i=0; $i<$size; $i++) {
                                                    if ($lend_user[$i]->book_no == $row->book_no) {
                                                        $reserve = 'you are borrowing this';
                                                        break;
                                                    }
                                                }
                                                

                                                //favorite button
                                                echo "<span>" .
                                                    "<button class='book_action' book_no='" . $row->book_no . "'>" .
                                                        $favorite
                                                    . "</button>&nbsp;&nbsp;" . 
                                                "</span>" .

                                                //reserve button
                                                "<span>" .
                                                    "<button action_type='reserve' class='book_action' book_no='{$row->book_no}'>";
                                                        if ($row->status == 'available')
                                                            echo "reserve";
                                                        else {
                                                            echo $reserve;
                                                        }
                                                echo "</button></span>";
                                            }
                                        }


                                     "</td>";

                                    //other data
                                echo "<td align='center'>" . 
                                         "<div book_data='publisher'>" . $row->publisher . "</div>";
                                        if ($row->date_published != 0) echo "<div book_data='date_published'>" . $row->date_published . "</div>";
                                     echo "</td>";

                                // if (isset($_SESSION['type']) && $_SESSION['type'] == "admin") 
                                echo "<td book_data='tags'>" . $row->tags . "</td>";
                                echo "<td book_data='abstract'>" . $row->abstract . "</td>";

                                echo "</tr>";
                            }
                        } else  {
                            echo "<span>No results for '<strong>" . htmlspecialchars(stripslashes(trim($search_term))) . "</strong>'</span>";
                        }

                    ?>
                </table>


             
</div>



<div id='pagination_controls_div'>
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

