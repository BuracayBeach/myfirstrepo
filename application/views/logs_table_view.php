<table id="logs_table">
    <tbody>
        <tr>
            <th>Date</th>
            <th>Book No</th>
            <th>Action</th>
            <th>By</th>
            <th>Administrator</th>
            <th>Transaction #</th>
        </tr>
        <?php
            $rowsHTML = "";
            foreach($logs as $row){
               $rowsHTML .=   "\n\t<tr>\n";
               foreach($row as $cell){
                   $rowsHTML .= "\t\t<td>".$cell."</td>\n";
               }
               $rowsHTML .= "\t</tr>";
            }
            echo $rowsHTML;

        ?>
</tbody>
</table>
