/***

 CONVENTIONS:

 $foo = jQuery object variable

 ***/

$('#result_container').ready(function(){
   $('#result_container').on('click','.title_link',fillModal);

});

//fill the modal dialog with info
//modal dialog will show after this function
function fillModal(){
    //this = title anchor
    var $row = $(this).closest('tr');
    var info = getRowInfo($row);

    var modalHTML = generateModalHTML(info);

    $('.modal-body').html(modalHTML);
}

function generateModalHTML(info){
    var modalContentHTML = "<label for='modal-callno'>Call Number: </label><span id='modal-callno'>"+info.callNo+"</span><br/>" +
        "<label for='modal-callno'>Title: </label><span id='modal-title'>"+info.title+"</span><br/>" +
        "<label for='modal-callno'>Type: </label><span id='modal-type'>"+info.type+"</span><br/>" +
        "<label for='modal-callno'>Abstract: </label><span id='modal-abstract'>"+info.abstract+"</span><br/>" +
        "<label for='modal-callno'>Author: </label><span id='modal-author'>"+info.author+"</span><br/>" +
        "<label for='modal-callno'>Description: </label><span id='modal-description'>"+info.description+"</span><br/>"+
        "<label for='modal-callno'>Publisher: </label><span id='modal-publisher'>"+info.publisher+"</span><br/>"+
        "<label for='modal-callno'>Year of Publishment: </label><span id='modal-yearPublished'>"+info.yearPublished+"</span><br/>"+
        "<label for='modal-callno'>ISBN: </label><span id='modal-isbn'>"+info.isbn+"</span><br/>" +
         "<label for='modal-callno'>Tags: </label><span id='modal-tags'>"+info.tags+"</span><br/>";

    return modalContentHTML;
}

function getRowInfo($row){

    return {
        "callNo" : $row.find('[book_data="book_no"]').text() ,
        "title" : $row.find('[book_data="book_title"]').text(),
        "type" : $row.find('[book_data="book_type"]').text(),
        "abstract" : $row.find('[book_data="abstract"]').text(),
        "author" : $row.find('[book_data="author"]').text(),
        "status" : $row.find('[book_data="status"]').text(),
        "description" : $row.find('[book_data="description"]').text(),
        "publisher" : $row.find('[book_data="publisher"]').text(),
        "yearPublished" : $row.find('[book_data="date_published"]').text(),
        "tags" : $row.find('[book_data="tags"]').text(),
        "isbn" : $row.find('[book_data="isbn"]').text(),
        "otherDetails" : $row.find('[book_data="other_detail"]').text()
    };
}