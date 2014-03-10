<?php

    $size = count($reserve);
    for ($i=0; $i < $size; $i++) { 
        if ($reserve[$i]->book_no == $row->book_no) {
            $username = $reserve[$i]->username;
            break;
        }
    }

    $size2 = count($lend);
    for ($i=0; $i < $size2; $i++) { 
        if ($lend[$i]->book_no == $row->book_no) {
            $username2 = $lend[$i]->username_user;
            break;
        }
    }

    // Edit , Delete Button
    if (isset($_SESSION['type']) && $_SESSION['type'] == "admin"){  //--------------- ADMIN ACTIONS ----------------\\

        echo "<span class='search_table_button'><a href='javascript:void(0)' bookno='{$row->book_no}' class='edit_button'>Edit</a></span>&nbsp&nbsp&nbsp";
        if ($row->status != 'borrowed') echo "<span class='search_table_button'><a href='javascript:void(0)' bookno='{$row->book_no}' class='delete_button'>Delete</a>&nbsp&nbsp|&nbsp&nbsp</span>";
        else echo "<span class='search_table_button' >({$row->status})&nbsp|&nbsp</span>";
        echo "<span class='search_table_button'>";

        // Lend , Return Button

        /* edit by Edzer Padilla start */
        if ($row->status == "reserved") 
            echo "<a bookno='{$row->book_no}' class='transaction_anchor lendButton' reserver='".$username."'>Lend (". $username .")</a>";
        elseif ($row->status == "borrowed")
            echo "<a bookno='{$row->book_no}' class ='transaction_anchor receivedButton'>Return (". $username2 .")</a>";
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
                "<div class='button_container'>" .
                "<button class='book_action btn btn-primary' book_no='" . $row->book_no . "'>" .
                $favorite
                . "</button>" .

                //reserve button
                "<button action_type='reserve' class='book_action btn {$reserve_class}' book_no='{$row->book_no}'>";
            if ($row->status == 'available')
                echo "reserve";
            else
                echo $reserve;

            echo "</button></div>";

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

                echo "<div class='rank sub-2 sub-heading-rank' book_no='{$row->book_no}'> Rank " . $rank .
                    " of " .$book_ranks[$row->book_no] . "</div>";
            }
            else
                echo "<div class='rank sub-2 sub-heading-rank' book_no='{$row->book_no}' style='display:none;'></div>";
        }
    }