<?php
/**
 * Created by PhpStorm.
 * User: isnalla
 * Date: 2/3/14
 * Time: 4:55 PM
 */
?>
    <script>
        $(document).ready(function(){

            //delete button
            $('.delete_button').on('click',function(){
                var bookNo = $(this).attr('bookno');

                $.ajax({
                    type:'POST',
                    url :'index.php/booker/delete',
                    data : {book_no:bookNo},
                    row : $(this).closest('tr')
                }).done(function(){
                        this.row.remove();
                    });
            });

            $('#add_button').on('click',function(){
                var data = {
                         book_no : $('#add_book_no').val(),
                         book_title : $('#add_book_title').val(),
                         description : $('#add_description').val(),
                         publisher : $('#add_publisher').val(),
                         date_published : $('#add_date_published').val(),
                         tags : $('#add_tags').val(),
                         author : $('#add_author').val()
                    };

                $.ajax({
                    type : "POST",
                    url : "index.php/booker/add",
                    data : data
                }).done(function(data){
                        var data = JSON.parse(data);
                        //console.log(data);
                        /*
                        var tableHeader = $('#search_table').find('tr').first();
                        var newBookHTML =
                            "<tr>" +
                                "<td>" + data.book_no + "</td>" +
                                "<td>" + data.book_title + "</td>" +
                                "<td>" + 'available' + "</td>" +
                                "<td>" + data.description + "</td>" +
                                "<td>" + data.publisher+ "</td>" +
                                "<td>" + data.date_published+ "</td>" +
                                "<td>" + data.tags+ "</td>" +
                                "<td>" + data.author+ "</td>" +
                            "</tr>";
                        tableHeader.after(newBookHTML);
                        */
                    });
            });



            $('.edit').on('click',function(event){
                var row = $(this).closest('tr').children();

                row[0].innerHTML = inputify('book_no',row[0].innerHTML);
                row[1].innerHTML = inputify('book_title',row[1].innerHTML);
                row[2].innerHTML = selectify('book_status',row[2].innerHTML);
                row[3].innerHTML = inputify('description',row[3].innerHTML);
                row[4].innerHTML = inputify('publisher',row[4].innerHTML);
                row[5].innerHTML = datify('date_published',row[5].innerHTML);
                row[6].innerHTML = inputify('tags',row[6].innerHTML);

            });

            function datify(id,value){
                console.log(value);
                var str = '<input type="date" id="edit_'+id+'" value="'+value+'"/>';
                console.log(str);
                return str;
            }

            function selectify(id,selected){
                var str = '<select id="edit_book_status"> <option value="available" '+isSelected('available',selected)+'>available</option>'+
                    ' <option value="reserved" '+isSelected('reserved',selected)+'>reserved</option> '+
                    '<option value="borrowed" '+isSelected('borrowed',selected)+'>borrowed</option> </select>';

                return str;
            }

            function isSelected(value,inputVal){
                if(value == inputVal) return 'selected';
                else return '';

            }

            function inputify(id,value){
                if(value == undefined) value = "";
                return '<input type="text" id="edit_'+id+'" value="'+value+'" />';
            }
        });
    </script>
    </body>
</html>