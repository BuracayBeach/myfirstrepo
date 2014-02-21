<div id="search_table_container">
                <table id="search_table" border="1" width='60%'>
                    <?php
                        //  if (isset($search_suggestion) && trim($search_suggestion) != ''){
                        //     echo "<span>You might want to search for: <a href='javascript:research;'>" . $search_suggestion . "</a></span><br/><br/>";
                        // }

                        if(isset($table)){
                            echo "<span id='search_results_label'>";
                            if (trim($search_term)=='') echo "View all Books";
                            else  echo "Search Results for  '" . $search_term . "'";
                            echo "</span><br/><br/>";

                            echo "<tr >
                                <th width='15%'>Book No.    </th>
                                <th>Book        </th>
                                <th>Publishment </th>
                            ";
                            // if (isset($_SESSION['type']) && $_SESSION['type'] == "admin") 
                            echo "<th>Tags</th>";
                            echo "</tr>";



                            $total_count = count($table);

                            $row_min = ($page-1) * $rows_per_page;
                            $row_max = ($page)*$rows_per_page - 1;
                            if ($row_max > $total_count - 1) $row_max = $total_count - 1;

                            echo $row_min+1 . "-";
                            echo $row_max+1 . " of $total_count<br>";
                    
                            for($a=$row_min ; $a<=$row_max ; $a++){
                                if (!isset($table[$a])) break;
                                $row = $table[$a];
                            
                                echo "<tr>";                               
                                echo "<td book_data='book_no' align='center'>" . $row->book_no . "</td>";
                                echo "<td>" .
                                        "<div style = 'font:20px Verdana' book_data='book_title'>" . 
                                            $row->book_title . 
                                        "</div>" . 
                                        
                                        "<div style = 'font-size:17px' book_data='description'> " . 
                                            $row->description   . "<br>" .  
                                        "</div>" . 

                                        "<div style = 'font-size:13px' book_data='author'><em> " . 
                                            $row->name . "<br>" .
                                        "</em></div>";

                                        if (isset($_SESSION['type']) && $_SESSION['type'] == "admin"){  //--------------- ADMIN ACTIONS ----------------\\
                                            
                                            // Edit , Delete Button
                                            echo "<span><a href='javascript:void(0)' bookno='{$row->book_no}' class='edit_button'>Edit</a></span>&nbsp&nbsp&nbsp";
                                            echo "<span><a href='javascript:void(0)' bookno='{$row->book_no}' class='delete_button'>Delete</a></span>&nbsp | &nbsp";
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

                                                //favorite button
                                                echo "<span>" .
                                                    "<button class='book_action' book_no='" . $row->book_no . "'>favorites</button>&nbsp;&nbsp;" . 
                                                "</span>" .

                                                //reserve button
                                                "<span>" .
                                                    "<button action_type='reserve' ";

                                                    if ($row->status == "available") echo "class='book_action' book_no='{$row->book_no}'>reserve";
                                                    else echo ">(" . $row->status . ")";

                                                    echo "</button>" .
                                                "</span>";
                                            }
                                        }


                                     "</td>";

                                    //other data
                                echo "<td align='center'>" . 
                                         "<div book_data='publisher'>" . $row->publisher . "</div>" .
                                         "<div book_data='date_published'>" . $row->date_published . "</div>" .
                                     "</td>";

                                // if (isset($_SESSION['type']) && $_SESSION['type'] == "admin") 
                                echo "<td book_data='tags'>" . $row->tags . "</td>";


                               
                                echo "</tr>";
                            }
                        } else  {
                            echo "<span>No results for '<strong>" . trim($search_term) . "</strong>'</span>";
                        }

                    ?>
                </table>


                <?php //pagination

                echo "<div id='pagination' page='{$page}' maxpage='{$maxpage}' searchterm=" . "'" . $search_term . "'" . ">";
                    if(isset($table) &&  count($table) > $rows_per_page){
                        $rows_per_page = 5;
                        $max_page = count($table) / $rows_per_page;
                        if (count($table) % $rows_per_page > 0) $max_page++;
                        echo "<br><a class='prev_nav' href='javascript: void(0)'>< Prev&nbsp&nbsp;</a>"; 
                        for ($a=1 ; $a<=$max_page ; $a++){
                            if ($a == $page) echo '<strong>';
                            echo "<a class='page_nav' href='javascript: void(0)' pageno={$a}>&nbsp;{$a}&nbsp;</a>"; 
                            if ($a == $page) echo '</strong>';
                        }
                        echo "<a class='next_nav' href='javascript: void(0)'>&nbsp;&nbsp;Next >&nbsp;</a>"; 
                    }
                echo '</div>';
                ?>
</div>

<script>
    $('#pagination').on('click', '.page_nav', go_to_page);
    // $('#pagination').on('click', '.next_nav', next_page);
    // $('#pagination').on('click', '.prev_nav', prev_page);


    function go_to_page(){
        page = $(this).attr('pageno');
        to_search = $('#pagination').attr('searchterm');
        $('#search_text').val(to_search);
        ajax_results(page);
    }

   function next_page(){
        page = $(this).attr('pageno');
        alert(page);
        to_search = $('#pagination').attr('searchterm');
        $('#search_text').val(to_search);
        ajax_results(page+1);
    }

   function prev_page(){
        page = $(this).attr('pageno');
        to_search = $('#pagination').attr('searchterm');
        $('#search_text').val(to_search);
        ajax_results(page-1);
    }





    function ajax_results(page){
        my_input = $('#search_form').serialize();
        my_input += "&page=" + page;
        my_input += "&rows_per_page=5";
        console.log(my_input);

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

<script type="text/javascript" src= "<?php echo base_url()?>/js/lend_receive_manager.js"></script>

