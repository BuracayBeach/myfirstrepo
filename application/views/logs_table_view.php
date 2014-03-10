<table id="logs_table" border="1">
    <tbody>
        <?php
            if(empty($logs)){
                echo '<br/><span class="logs-empty">There are no logs recorded during the specified date range.</span><br/>';
            }else{
                echo '<tr>
                        <th>Date</th>
                        <th>Book No</th>
                        <th>Action</th>
                        <th>By</th>
                        <th>Administrator</th>
                        <th>Transaction #</th>
                    </tr>';

                $rowsHTML = "";
                foreach($logs as $row){
                    $rowsHTML .=   "\n\t<tr>\n";
                    foreach($row as $cell){
                        $rowsHTML .= "\t\t<td>".$cell."</td>\n";
                    }
                    $rowsHTML .= "\t</tr>";
                }
                echo $rowsHTML;

            }
        ?>
</tbody>
</table>
