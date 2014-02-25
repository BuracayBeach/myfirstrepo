<?php
    // Edit , Delete Button
    echo "<span class='search_table_button'><a href='javascript:void(0)' bookno='{$row->book_no}' class='edit_button'>Edit</a></span>&nbsp&nbsp&nbsp";
    if ($row->status != 'borrowed') echo "<span class='search_table_button'><a href='javascript:void(0)' bookno='{$row->book_no}' class='delete_button'>Delete</a>&nbsp&nbsp|&nbsp&nbsp</span>";
    else echo "<span class='search_table_button' >({$row->status})&nbsp|&nbsp</span>";
    echo "<span class='search_table_button'>";

    // Lend , Return Button

    /* edit by Edzer Padilla start */
    if ($row->status == "reserved")  echo "<a bookno='{$row->book_no}' class='transaction_anchor lendButton' >Lend</a>";
    elseif ($row->status == "borrowed") echo "<a bookno='{$row->book_no}' class = 'transaction_anchor receivedButton'>Return</a>";
    else echo "(" . $row->status . ")";
    /* edit end */
    echo "</span>";
?>