<div id="recently_added_books_container" class="column">
    <span id="no_recently">There are no recently added material for this session.</span><br/>
    <table id="recently_added_books_table" border="1">
        <tr>
            <th>Identification</th>
            <th>Material</th>
            <th>Publishment</th>
            <th>Tags</th>
            <th style="display:none;">Abstract</th>
            <th style="display:none;">Other Detail</th>
        </tr>
        <?php
            if(isset($_SESSION['recently_added_books'])){
                $table = $_SESSION['recently_added_books'];
                $row_max = count($table);
                $recently_added = true;
                foreach($table as $row){
                    $row = json_decode(json_encode($row));
                    $row->book_type = $row->type;
                    $row->status = 'available';

                    $reserve = array();
                    $lend = array();

                    include "table_row_view.php";
                }
            }
        ?>
    </table>
</div>
