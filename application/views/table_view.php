<div id="search_table_container">
                <table id="search_table" border="1" width='60%'>
                    <?php
                        $is_admin = isset($_SESSION['is_admin']);
                        $is_admin = true; //temporary

                        //new
                        if(isset($table)){
                            echo "<tr >
                                <th width='10%'>Book No.    </th>
                                <th width='40%'>Book        </th>
                                <th width='15%'>Publishment </th>
                            ";

                     
                            echo "</tr>";

                            foreach($table as $row):
                                echo "<tr>";                               
                                echo "<td align='center'>" . $row->book_no . "</td>";
                                echo "<td>" .
                                        "<div style = 'font:20px Verdana'>" . 
                                            $row->book_title . 
                                        "</div>" . 
                                        
                                        "<div style = 'font-size:17px'>" . 
                                            $row->description   . "<br>" .  
                                        "</div>" . 

                                        "<div style = 'font-size:13px'><em>" . 
                                            $row->name . "<br>" .
                                        "</em></div>";


                                        if ($is_admin){  //--------------- ADMIN ACTIONS ----------------\\
                                            
                                            // Edit , Delete Button
                                            echo "<span><a href='#' bookno='{$row->book_no}' class='edit_button'>Edit</a></span>&nbsp&nbsp&nbsp";
                                            echo "<span><a href='#' bookno='{$row->book_no}' class='delete_button'>Delete</a></span>&nbsp | &nbsp";
                                            echo "<span><a ";

                                            // Lend , Return Button
                                            if ($row->status == "reserved")  echo "href='#' bookno='{$row->book_no}'    onclick=\"window.location.href='http://localhost/myfirstrepo/index.php/update_book/lend/?id={$row->book_no}'\">Lend</a>";
                                            elseif ($row->status == "borrowed") echo "href='#' bookno='{$row->book_no}' onclick=\"window.location.href='http://localhost/myfirstrepo/index.php/update_book/received/?id={$row->book_no}'\">Return</a>";
                                            else echo "'>(" . $row->status . ")";

                                            echo "</span>";

                                            
                                        } else { //--------------- USER ACTIONS ----------------\\
                                            
                                            //like button
                                            echo
                                            "<span>" .
                                                "<a href='#' book_no='" . $row->book_no . "'>Favorite</a>&nbsp;&nbsp;" . //condition is to be added here
                                            "</span>" .

                                            //reserve button
                                            "<span>" .
                                                "<a ";

                                                if ($row->status == "available") echo "href='#' bookno='{$row->book_no}'>Reserve";
                                                else echo ">(" . $row->status . ")";

                                                echo "</a>" .
                                            "</span>";
                                        }


                                     "</td>";

                                    //other data
                                echo "<td align='center'>" . 
                                         $row->publisher . "<br>" .
                                         $row->date_published . 
                                     "</td>";                                    
                               
                                echo "</tr>";
                            endforeach;
                        }
                    ?>

</table>
</div>