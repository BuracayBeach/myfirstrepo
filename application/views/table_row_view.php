<?php
    /**
     * Created by PhpStorm.
     * User: isnalla
     * Date: 2/25/14
     * Time: 4:00 PM
     */
    //prevent html generation for tags and scripts

    $row_copy = clone $row;

    if(!(isset($newly_added) && $newly_added) && isset($search_term)){
        //prevent html generation for tags and scripts
        // var_dump($search_term);
        foreach($row as &$r){
            $r = htmlspecialchars(stripslashes($r));
        }

        foreach($row_copy as &$r){
            $r = htmlspecialchars(stripslashes($r));
             //bold matching terms
            if (trim($search_term) != ''){
               $search_terms = explode(" ",trim($search_term));
                foreach($search_terms as $s_term){
                    if ($s_term == '' || strlen($s_term) < 3) continue;
                    $r = preg_replace('/' . $s_term . '/i', "<strong>$0</strong>", $r);                        
                }  
            }
        }

    }

    echo "<tr active='false'>";
        echo "<td align='center'>" .
            "<div style = 'font:15px Verdana' book_data='book_no'>" .
            $row_copy->book_no .
            "</div>" .
            "<div style = 'font:12px Verdana' book_data='book_type'><em>" .
            $row_copy->book_type .
            "</em></div>" .
          "</td>";

    echo "<td>" .
        "<div style = 'font:15px Verdana' book_data='book_title'>" .
        '<span class="article_title"><a class="title_link" href="javascript:void(0)">' . $row_copy->book_title . '</a></span>' .
        "</div>" .

        "<div style = 'font-size:13px' book_data='description'> " .
        '<span class="article_description">' . $row_copy->description   . "</span><br>" .
        "</div>" .

        "<div style = 'font-size:13px' book_data='author'><em> " .
        '<span class="article_author">' . $row_copy->author . "</span><br>" .
        "</em></div>";

    if (isset($_SESSION['type']) && $_SESSION['type'] == "admin"){  //--------------- ADMIN ACTIONS ----------------\\
        include "table_buttons_view.php";
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
            $reserve_class = 'btn_green';
            $size = count($reserve_user);
            for ($i=0; $i<$size; $i++) {
                if ($reserve_user[$i]->book_no == $row->book_no) {
                    $reserve = 'unreserve';
                    $reserve_class = 'btn_yellow';
                    break;
                }
            }

            /* counter-check reserves with lends */
            $size = count($lend_user);
            for ($i=0; $i<$size; $i++) {
                if ($lend_user[$i]->book_no == $row->book_no) {
                    $reserve = 'BORROWED';
                    $reserve_class = 'btn_gray';
                    break;
                }
            }


            //favorite button
            echo
                "<button class='book_action' book_no='" . $row->book_no . "'>" .
                $favorite
                . "</button>" .
                
                //reserve button
                "<button action_type='reserve' class='book_action {$reserve_class}' book_no='{$row->book_no}'>";
            if ($row->status == 'available')
                echo "reserve";
            else 
                echo $reserve;
            
            echo "</button>";

            if ($reserve == "unreserve") {

                $size = count($reserve_user);
                for ($i=0; $i<$size; $i++)
                    if ($reserve_user[$i]->book_no == $row->book_no) 
                        $rank_temp = $reserve_user[$i]->rank;
                
                $temp = $book_temp[$row->book_no];
                $size2 = count($temp);
                for ($i=0; $i<$size2; $i++) {
                    if ($temp[$i] == $rank_temp) {
                        $rank = $i+1;
                        break;
                    }
                }

                echo "<div class='rank sub-2 sub-heading' book_no='{$row->book_no}'> Rank " . $rank . 
                " of " .$book_ranks[$row->book_no] . "</div>";
            }
            else
                echo "<div class='rank sub-2 sub-heading' book_no='{$row->book_no}' style='display:none;'></div>";
        }
    }

    "</td>";

    //other data
    echo "<td align='center' style='font:13px Verdana'>" .
        "<div book_data='publisher'><span class='article_publisher'>" . $row_copy->publisher . "</span></div>";
    if ($row->date_published != '') echo "<div book_data='date_published'><em>" . $row_copy->date_published . "</em></div>";
    echo "</td>";

    // if (isset($_SESSION['type']) && $_SESSION['type'] == "admin")
    echo "<td align='center' book_data='tags'><span style='font:10px Verdana' class='article_tag'>";
    $exploded_tags = explode(",", $row_copy->tags);
    $tag_counter = 0;
    foreach ($exploded_tags as $ex_tag){
        if ($tag_counter++ > 0) echo ", ";
        echo '<a href="javascript:void(0)" class="tag_link">' . trim($ex_tag) . '</a>';
    }
    echo "<span></td>";

    echo "<td book_data='abstract' class='book_abstract'";
    if (isset($search_by) && $search_by != 'any' && $search_by != 'abstract') echo 'hidden';
    echo "><span class='article_abstract'>" . $row_copy->abstract . '<span></td>';

    echo "</tr>";

?>


