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

                            $rows_per_page = 5;
                           

                            $row_counter = 0;
                            $row_min = ($page-1) * $rows_per_page;
                            $row_max = ($page)*$rows_per_page - 1;

                    
                            foreach($table as $row):
                                if ($row_counter < $row_min) continue;
                                if ($row_counter > $row_max) break;
                                $row_counter++;

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

                                                /* checking of favorite */
                                                $favorite = 'favorite';
                                                $size = count($favorite_user);
                                                for ($i=0; $i<$size; $i++) {
                                                    if ($favorite_user[$i]->book_no == $row->book_no) {
                                                        $favorite = 'unfavorite';
                                                        break;
                                                    }
                                                }

                                                /* checking of favorite */
                                                $reserve = 'reserve';
                                                $size = count($reserve_user);
                                                for ($i=0; $i<$size; $i++) {
                                                    if ($reserve_user[$i]->book_no == $row->book_no) {
                                                        $reserve = 'unreserve';
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
                                         "<div book_data='publisher'>" . $row->publisher . "</div>" .
                                         "<div book_data='date_published'>" . $row->date_published . "</div>" .
                                     "</td>";

                                // if (isset($_SESSION['type']) && $_SESSION['type'] == "admin") 
                                echo "<td book_data='tags'>" . $row->tags . "</td>";


                               
                                echo "</tr>";
                            endforeach;
                        } else  {
                            echo "<span>No results for '<strong>" . trim($search_term) . "</strong>'</span>";
                        }



                    ?>

                </table>

                <?php 
                echo "<div id='pagination' page='{$page}' searchterm=" . $search_term . ">";
                        if(isset($table) &&  count($table) > $rows_per_page){
                            $rows_per_page = 5;
                            $max_page = count($table) / $rows_per_page;
                            echo "<br><a href='javascript: void(0)'>< Prev&nbsp&nbsp;</a>"; 
                            for ($a=1 ; $a<=$max_page ; $a++){
                                if ($a == $page) echo '<strong>';
                                echo "<a class='page_nav' href='javascript: void(0)' pageno={$a}>&nbsp;{$a}&nbsp;</a>"; 
                                if ($a == $page) echo '</strong>';
                            }
                            echo "<a href='javascript: void(0)'>&nbsp;&nbsp;Next >&nbsp;</a>"; 
                        }
                echo '</div>';
                ?>
</div>


<script>
    $(document).ready(function() {
        $('#pagination').on('click', '.page_nav' , page_num_clicked);

        function page_num_clicked(){
            //$('#submit_search').click();
            ajax_results($(this).attr('pageno'));
        }

        function ajax_results(page){
            my_input = $('#search_form').serialize();
            my_input += "&page=" + page;
            // alert($('#pagination').attr('page'));
            // alert(page);

            $.ajax({
                type: "post",
                data: my_input, 
                url: "http://localhost/myfirstrepo/index.php/book/search",
                success: function(data, jqxhr, status){
                    $("#result_container").html(data);
                }
            });
        }

    });
    
</script>


<script> 

     //Script author : Edzer Josh V. Padilla
     //Description : AJAX used to call the lend and receieve modules and update the buttons of the page dynamically
     $('.lendButton').on('click', lendClick);
     $('.receivedButton').on('click', receivedClick);

    function lendClick(){
        $this = $(this);
        $bookno = $this.attr('bookno');
        $bookauthor = $this.closest('td').find('[book_data = author]').text()
        $booktitle = $this.closest('td').find('[book_data = book_title]').text()
        if (confirm('Are you sure you want to lend: \n'+$booktitle+'\n'+$bookno+'\n'+$bookauthor+"?")) {    
             $.ajax({
                url: 'index.php/update_book/lend/',
                data: {id:$bookno},
                success: function(data) { 
                    $this.text('Return');
                    $this.off('click').on('click', receivedClick);            }
            });      

        } else {
        // Do nothing!
        }

    }

     function receivedClick(){
        $this = $(this);
        $bookno = $this.attr('bookno');
        $bookauthor = $this.closest('td').find('[book_data = author]').text()
        $booktitle = $this.closest('td').find('[book_data = book_title]').text()
         if (confirm('Are you sure you want to return: \n'+$booktitle+'\n'+$bookno+'\n'+$bookauthor+"?")) {
             $.ajax({
                url: 'index.php/update_book/received/',
                data: {id:$bookno},
                success: function(data) { 
                    $this.text('(available)');
                    $this.off('click');
               // $this.addClass('lendButton'); 
                }
            });        
        } else {
        // Do nothing!
        }
     } 
</script>

