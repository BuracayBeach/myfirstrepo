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
            $search_term = htmlspecialchars(stripslashes($search_term));
             //bold matching terms
            if (trim($search_term) != ''){
               $search_terms = explode(" ",trim($search_term));
                foreach($search_terms as $s_term){
                    if ($s_term == '' || strlen($s_term) < 3) continue;
                    if(preg_match("/[^a-zA-Z0-9]+/",$s_term)) continue;
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

            "<div style = 'font:10px Verdana' book_data='isbn'><em>" .
            $row_copy->isbn .
            "</em></div>" .
          "</td>";

    echo "<td>" .
        "<div style = 'font:15px Verdana'>" .
        '<span class="article_title"><a class="title_link" data-toggle="modal" href="#book-info-modal" book_data="book_title">' . $row_copy->book_title . '</a></span>' .
        "</div>" .
        "<div style = 'font-size:13px'> " .
        '<span class="article_description" book_data="description">' . $row_copy->description   . "</span>" .
        "</div>" .

        "<div style = 'font-size:13px'><em> " .
        '<span class="article_author" book_data="author">' . $row_copy->author . "</span>" .
        "</em></div>
        ";

    /*GENERATES APPROPRIATE BUTTONS (html stored to variable) DEPENDING ON THE TYPE OF THE USER*/
    $data['row'] = $row;
    $data['reserve'] = $reserve;
    $data['lend'] = $lend;
    // the "TRUE" argument tells it to return the content, rather than display it immediately
    $buttonsHTML = $this->load->view("table_buttons_view.php",$data,TRUE);

    echo $buttonsHTML;
    "</td>";

    //other data
    echo "<td align='center' style='font:10px Verdana'>" .
        "<div ><span class='article_publisher' book_data='publisher'>" . $row_copy->publisher . "</span></div>";
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

    if(isset($_SESSION) && isset($_SESSION['search_data']) && isset($_SESSION['search_data']['search_by']) ){
        $search_by = $_SESSION['search_data']['search_by'];
    }
    echo "<td book_data='abstract' class='book_abstract'";
    if (isset($search_by) && $search_by != 'any' && $search_by != 'abstract') echo 'hidden';
    echo "><span class='article_abstract'>" . $row_copy->abstract . '<span></td>';


    $extracted_detail = array();
    if($row->other_detail != null){
        $row->other_detail = explode("¦",$row->other_detail);
        foreach($row->other_detail as &$detail){
            $arr = explode("»",$detail);
            array_push($extracted_detail,["name"=>$arr[0],"content"=>$arr[1]]);
        }
    }

    echo "<td style='display:none;'>";
    if (isset($extracted_detail) && $extracted_detail != null) {
        foreach($extracted_detail as $detail){
            echo '<div book_data="other_detail">' .
                    '<span detail="name">'
                    . $detail['name'] .
                    '</span>:' .
                    '<span detail="content">'
                    . $detail['content'] .
                    '</span><br/>' .
                '</div>';
        }
    }
    echo '</td>';

    echo "</tr>";

