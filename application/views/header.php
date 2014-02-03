<?php
/**
 * Created by PhpStorm.
 * User: isnalla
 * Date: 1/15/14
 * Time: 6:47 PM
 */
?>
<html>
<head>
    <title><?php echo $title ?></title>

    <script src="http://localhost/ProjectYes/jquery-1.11.0.js"></script>
    <script>
        var str, msg;
        function main(){    //for validation

            $(document).ready(function(){

                var columns = $('#add_book_table input')
                columns.on('blur',checkAll);
            });

        }

        function validateBookNo(){
            str = add_book.book_no.value;
            msg = "";
            if(str == ""){
                msg+="Book no is required.";
            }//else if(!str.match(/^[+]\([0-9]{12}\)$/) ){
            else if(!str.match(/^[a-zA-Z0-9 ]+$/)){
                msg+="Wrong Input";
            }
            else if(msg == "Invalid input: "){
                msg = "";
            }
            document.getElementsByName("book_no_msg")[0].innerHTML = msg;

            if(msg == ""){
                return true;
            }

        }
        function validateTitle(){
            str = add_book.book_title.value;
            msg = "";
            if(str == ""){
                msg+="Book title is required.";
            }
            else if(!str.match(/^[a-zA-Z ]+$/)){
                msg+="Wrong Input";
            }
            else if(msg == "Invalid input: "){
                msg = "";
            }
            document.getElementsByName("book_title_msg")[0].innerHTML = msg;

            if(msg == ""){
                return true;
            }
            return false;
        }
        function validateDescription(){
            str = add_book.description.value;
            msg = "";
            if(str == ""){
                msg+="Description is required.";
            }
            document.getElementsByName("description_msg")[0].innerHTML = msg;

            if(msg == ""){
                return true;
            }
            return false;
        }
        function validatePublisher(){
            str = add_book.description.value;
            msg = "";
            if(str == ""){
                msg+="Publisher name is required.";
            }
            document.getElementsByName("publisher_msg")[0].innerHTML = msg;

            if(msg == ""){
                return true;
            }
            return false;
        }
        function validateDatePublished(){
            var str = add_book.date_published.value.toString();
            var currentDate = str.split("-");
            str = new Date(currentDate[0],(currentDate[1] - 1), (currentDate[2]));
            var today = new Date();
            var dd = today.getDate();
            var mm = today.getMonth()+1; //January is 0!
            var year = today.getFullYear();
            msg = "";

            if(str == "" || str == 'Invalid Date'){
                msg+="Date is required.";
            }
            else if(str.getFullYear()>=year){
                if(str.getMonth()+1 >= mm){
                    if(str.getDate() > dd){
                        msg+="Wrong date.";
                    }
                    else{
                        msg+="Wrong date.";
                    }
                }
            }
            document.getElementsByName("date_published_msg")[0].innerHTML = msg;

            if(msg == ""){
                return true;
            }
            return false;

        }

        function checkAll(){
            var submitButton = $('#add_submit');

            if(validateTitle() && validateBookNo() && validateDescription() && validatePublisher() && validateDatePublished() )
            {
                submitButton.attr('disabled', false);
            }
            else{
                submitButton.attr('disabled', true);
            }
        }
    </script>
</head>
<body onload = "main()">
