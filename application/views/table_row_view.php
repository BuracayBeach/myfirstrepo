<?php
    /**
     * Created by PhpStorm.
     * User: isnalla
     * Date: 2/25/14
     * Time: 4:00 PM
     */
    //prevent html generation for tags and scripts

    if(!(isset($newly_added) && $newly_added))
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
        "<div style = 'font:15px Verdana' book_data='book_title'>" .
        '<span class="article_title">' . $row->book_title . '</span>' .
        "</div>" .

        "<div style = 'font-size:13px' book_data='description'> " .
        '<span class="article_description">' . $row->description   . "</span><br>" .
        "</div>" .

        "<div style = 'font-size:11px' book_data='author'><em> " .
        '<span class="article_author">' . $row->author . "</span><br>" .
        "</em></div>";

    if (isset($_SESSION['type']) && $_SESSION['type'] == "admin"){  //--------------- ADMIN ACTIONS ----------------\\

        // Edit , Delete Button
        if ($page!='index') echo "<span><a href='javascript:void(0)' bookno='{$row->book_no}' class='edit_button'>Edit</a></span>&nbsp&nbsp&nbsp";
        if ($row->status != 'borrowed' && $page!='index') echo "<span><a href='javascript:void(0)' bookno='{$row->book_no}' class='delete_button'>Delete</a></span>&nbsp | &nbsp";
        else echo "<span>({$row->status})&nbsp|&nbsp</span>";
        echo "<span>";

        // Lend , Return Button

        /* edit by Edzer Padilla start */
        if ($row->status == "reserved")  echo "<a bookno='{$row->book_no}' class='transaction_anchor lendButton' >Lend</a>";
        elseif ($row->status == "borrowed") echo "<a bookno='{$row->book_no}' class = 'transaction_anchor receivedButton'>Return</a>";
        else echo "(" . $row->status . ")";
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
        "<div book_data='publisher'><span class='article_publisher'>" . $row->publisher . "</span></div>";
    if ($row->date_published != 0) echo "<div book_data='date_published'>" . $row->date_published . "</div>";
    echo "</td>";

    // if (isset($_SESSION['type']) && $_SESSION['type'] == "admin")
    echo "<td book_data='tags'><span class='article_tag'>" . $row->tags . "<span></td>";
    $row_abstract = $row->abstract;

    echo "<td book_data='abstract' class='book_abstract'>";
    // if (strlen($row_abstract) > 75) {
    //     $row_abstract = substr($row_abstract, 0, 75);
    //     echo "<a href='javascript:void(0)'>more</a>";
    // }
    echo '<span class="article_abstract">' . $row->abstract . '<span>';

    // echo "<textarea class='hidden_abstract' hidden>" . $row->abstract . "</textarea>" .
    "</td>";

    echo "</tr>";

?>


