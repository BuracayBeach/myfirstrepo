			<div id="search"><br>

				<form name="search_form" method="post">

					<div id="status">
						<input id = "available" type="checkbox" name = "available" checked>
						<label for="available">Available</label><br/>
						<input id = "reserved" type="checkbox" name = "reserved" checked>
						<label for="reserved">Reserved</label><br/>
						<input id = "borrowed" type="checkbox" name = "borrowed" checked>
						<label for="borrowed">Borrowed</label><br/><br/>
					</div>

					<a>Search by:</a>
					<select name="search_by">
						<option value="book_title"> Book Title </option>
						<option value="book_no"> Book Number </option>
						<option value="status"> Status </option>
						<option value="description"> Description </option>
						<option value="publisher"> Publisher</option>
						<option value="name"> Author</option>
						<option value="date_published"> Date Published</option>
					</select>

					<input type="text" name='search'/>
					<input type="submit" name="submit" value="Search" /><br/>


					<a>Order by:</a>
					<select name="order_by">
						<option value="book_title"> Book Title </option>
						<option value="book_no"> Book Number </option>
						<option value="status"> Status </option>
						<option value="description"> Description </option>
						<option value="publisher"> Publisher</option>
						<option value="name"> Author</option>
						<option value="date_published"> Date Published</option>
					</select><br/><br/>

				</form>
			</div>

			<div id="table">
				<table border=1>
					<?php
						if (isset($table)){
							echo "<tr>
								<th>Book No.	</th>
								<th>Book Title 	</th>
								<th>Status 		</th>
								<th>Description </th>
								<th>Publisher 	</th>
								<th>Publish Date</th>
								<th>Tags 		</th>
								<th>Author 		</th>
								<th colspan='3'>Book Action</th>
								<th>Borrow Action 		</th>
								<th></th>
							</tr>";

                            foreach($table as $row):
                                echo "<tr>";

                                foreach($row as $cell):
                                    echo "<td>" . $cell	. "</td>";
                                endforeach;

                                if ($row->status == "available") echo "<td><input type='button' bookno='{$row->book_no}' value='Reserve'</td>";
                                else echo "<td>(" . $row->status . ")</td>";

                                echo "<td><input type='button' bookno='{$row->book_no}' value='Edit'</td>";
                                echo "<td><input type='button' bookno='{$row->book_no}' value='Delete'</td>";

                                if ($row->status == "reserved") 	echo "<td><input type='button' bookno='{$row->book_no}' value='Lend'</td>";
                                elseif ($row->status == "borrowed") echo "<td><input type='button' bookno='{$row->book_no}' value='Return'</td>";
                                else echo "<td>(" . $row->status . ")</td>";
                                echo "<td><input type='button' value='Add to Favorites'/></td>";
                                echo "</tr>";
                            endforeach;
						}
					?>

				</table>	
			</div>