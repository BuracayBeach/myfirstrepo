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

        if($row->other_detail != null){
            $row->other_detail = explode("¦",$row->other_detail);
            foreach($row->other_detail as &$detail){
                $arr = explode("»",$detail);
                $detail = [];
                $detail['name'] = $arr[0];
                $detail['content'] = $arr[1];
            }
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

        if($row_copy->other_detail != null){
            $row_copy->other_detail = explode("¦",$row_copy->other_detail);
            foreach($row_copy->other_detail as &$detail){
                $arr = explode("»",$detail);
                $detail = [];
                $detail['name'] = $arr[0];
                $detail['content'] = $arr[1];
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

        $modal_id =  str_replace(' ', '', $row_copy->book_no);
        $modal_details_HTML = /* FULL BOOK DETAILS OUTPUT INSIDE modal-body */
            '<div class="modal fade" id="modal-'.$modal_id.'" tabindex="-1" role="dialog" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"> Book Details</h4>
                  </div>
                  <div class="modal-body">
                    !!Output Goes Here!!
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>';

    echo "<td>" .
        "<div style = 'font:15px Verdana' book_data='book_title'>" .
        '<span class="article_title"><a class="title_link" data-toggle="modal" href="#modal-'.$modal_id.'">' . $row_copy->book_title . '</a></span>' .
        "</div>" .
        $modal_details_HTML .
        "<div style = 'font-size:13px' book_data='description'> " .
        '<span class="article_description">' . $row_copy->description   . "</span>" .
        "</div>" .

        "<div style = 'font-size:13px' book_data='author'><em> " .
        '<span class="article_author">' . $row_copy->author . "</span>" .
        "</em></div>
        ";

    /*GENERATES APPROPRIATE BUTTONS (html stored to variable) DEPENDING ON THE TYPE OF THE USER*/
    $data['row'] = $row;
    // the "TRUE" argument tells it to return the content, rather than display it immediately
    $buttonsHTML = $this->load->view("table_buttons_view.php",$data,TRUE);

    echo $buttonsHTML;
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


