<div id="recently_added_books_container" class="small-5 column">
    <span id="no_recently">There are no recently added material for this session.</span><br/>
    <table id="recently_added_books_table" border="1" width="60%">
        <tr>
            <th>Identification</th>
            <th>Material</th>
            <th>Publishment</th>
            <th>Tags</th>
            <th>Abstract</th>
        </tr>
        <?php
            if(isset($_SESSION['recently_added_books'])){
                $table = $_SESSION['recently_added_books'];
                $row_max = count($table);
                foreach($table as $row){
                    $row = json_decode(json_encode($row));
                    $row->book_type = $row->type;
                    $row->status = 'available';
                    include "table_row_view.php";
                }
            }
        ?>
    </table>
</div>
