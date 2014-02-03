
        <form method="post" action="index.php/booker/add" name="add_book" id="add_book_form">
            <table id="add_book_table">
                <th>ADD BOOK</th>
                <tr>
                    <td><input type="text" name="book_no" id="book_no"/></td>
                    <td><input type="text" name="book_title" id="book_title"/></td>
                    <td><input type="text" name="description" id="description"/></td>
                    <td><input type="text" name="publisher" id="publisher"/></td>
                    <td><input type="date" name="date_published" id="date_published"/></td>
                    <td><input type="text" name="tags" id="tags"/></td>
                    <td><input type="submit" name="add_submit" id="add_submit" disabled = "disabled"></td>
                </tr>
                <tr>
                    <td><span name = "book_no_msg"></span></span></td>
                    <td> <span name = "book_title_msg"></span></td>
                    <td> <span name = "description_msg"></span></td>
                    <td> <span name = "publisher_msg"></span></td>
                    <td> <span name = "date_published_msg"></span></td>
                    <td> <span name = "tags_msg"></span></td>
                </tr>
            </table>
        </form>
        <hr>
        <form action="index.php/booker/delete" method="post" name="del_form">
            <input type="text" name="book_no" id="book_no"/>
            <input type="submit" name="submit" id="del_submit">
        </form>
        <hr>
        <!--form name="edit_book">
            <fieldset>
                <legend>Personal Information</legend>

                <label for="book_no">Book No: </label>
                <input type="text" name="book_no" id="book_no" /><br/><span name="help_book_no"> </span></br>
                <br /><br />

                <label for="book_title">Book Title: </label>
                <input type="text" name="book_title" id="book_title" /><br/><span name="help_book_title"> </span></br>
                <br /><br />

                <label for="book_status">Book Status: </label>
                <select name="book_status" id="book_status">
                    <option value = "available"> Available </option>
                    <option value = "reserved"> Reserved </option>
                    <option value = "borrowed"> Borrowed </option>
                </select>
                <span name="help_book_status"> </span>
                <br /><br />

                <label for="book_description">Book Description: </label></br>
                <textarea name="book_desc" id="book_desc"size=50 maxlength=255></textarea><br/><span name="help_book_description"> </span></br>
                <br /><br />

                <label for="book_publisher">Book Publisher: </label>
                <input type="text" name="book_publisher" id="book_publisher" /><br/><span name="help_book_publisher"> </span></br>
                <br /><br />

                <label for="book_author">Book Author: </label>
                <input type="text" name="book_author" id="book_author" /><br/><span name="help_book_author"> </span></br>
                <br /><br />

                Date Published:
                <input type="date" name="date_published" /> <span name="help_date_published"> </span> </br>

            </fieldset>

            <input type="submit"/>

        </form -->
        <!--table id="sample_table" name="sample_table">
            <tr>
                <th>book_no</th>
                <th>book_title</th>
                <th>status</th>
                <th>description</th>
                <th>publisher</th>
                <th>date_published</th>
                <th>tags</th>
                <th>actions</th>
            </tr>
            <tr>
                <td>a</td>
                <td>b</td>
                <td>available</td>
                <td>d</td>
                <td>e</td>
                <td>1995-06-12</td>

                <td>lol</td>
                <td>
                    <button class="edit">edit</button>
                </td>
            </tr>
            <tr>
                <td>g</td>
                <td>h</td>
                <td>reserved</td>
                <td>i</td>
                <td>j</td>
                <td>k</td>
                <td>lol</td>
                <td>
                    <button class="edit">edit</button>
                </td>
            </tr>
            <tr>
                <td>l</td>
                <td>m</td>
                <td>reserved</td>
                <td>o</td>
                <td>p</td>
                <td>q</td>
                <td>lol</td>
                <td>
                    <button class="edit">edit</button>
                </td>
            </tr>
        </table -->