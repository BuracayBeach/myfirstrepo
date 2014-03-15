/***

 CONVENTIONS:

 $foo = jQuery object variable

 ***/

$('#result_container').ready(function(){
   $('#result_container').on('click','.title_link',fillModal);
});

$('#recently_added_books_table').ready(function(){
    $('#recently_added_books_table').on('click','.title_link',fillModal);
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
    var modalContentHTML =
        "<table class='table table-hover modal-data'><tbody>" + 
            "<tr><td><label for='modal-callno'>Call Number: </label></td><td><span id='modal-callno'>"+info.callNo+"</span></td><tr>" +
            "<tr><td><label for='modal-title'>Title: </label></td><td><span id='modal-title'>"+info.title+"</span></td><tr>" +
            "<tr><td><label for='modal-type'>Type: </label></td><td><span id='modal-type'>"+info.type+"</span></td><tr>" +
            "<tr><td><label for='modal-abstract'>Abstract: </label></td><td><span id='modal-abstract'>"+info.abstract+"</span></td><tr>" +
            "<tr><td><label for='modal-author'>Author: </label></td><td><span id='modal-author'>"+info.author+"</span></td><tr>" +
            "<tr><td><label for='modal-description'>Description: </label></td><td><span id='modal-description'>"+info.description+"</span></td><tr>"+
            "<tr><td><label for='modal-publisher'>Publisher: </label></td><td><span id='modal-publisher'>"+info.publisher+"</span></td><tr>"+
            "<tr><td><label for='modal-year-published'>Year of Publishment: </label></td><td><span id='modal-year-published'>"+info.yearPublished+"</span></td><tr>"+
            "<tr><td><label for='modal-isbn'>ISBN: </label></td><td><span id='modal-isbn'>"+info.isbn+"</span></td><tr>" +
            "<tr><td><label for='modal-tags'>Tags: </label></td><td><span id='modal-tags'>"+info.tags+"</span></td><tr>";
    var i = 0;
    info.otherDetails.forEach(function(detail){
       i++;
       modalContentHTML += generateRowHTML('modal-other','modal-other'+i,detail[0],detail[1]);
    });

    modalContentHTML +=  "</tbody></table>";

    return modalContentHTML;
}

function generateRowHTML(classs,id,label,text){
    return "<tr><td><label class='"+classs+"' for='"+id+"'>"+label+": </label></td><td><span id='"+id+"'>"+text+"</span></td><tr>";
}

function getRowInfo($row){
    var otherDetails = [];

    var $detailContainers = $row.find('[book_data="other_detail"]');

    $detailContainers.each(function(){
        var detailName = $(this).find('[detail="name"]').text();
        var detailContent = $(this).find('[detail="content"]').text();

        otherDetails.push([detailName,detailContent]);
    });


    return {
        "callNo" : $row.find('[book_data="book_no"]').text() ,
        "title" : $row.find('[book_data="book_title"]').html(),
        "type" : $row.find('[book_data="book_type"]').text(),
        "abstract" : $row.find('[book_data="abstract"]').text(),
        "author" : $row.find('[book_data="author"]').text(),
        "status" : $row.find('[book_data="status"]').text(),
        "description" : $row.find('[book_data="description"]').text(),
        "publisher" : $row.find('[book_data="publisher"]').text(),
        "yearPublished" : $row.find('[book_data="date_published"]').text(),
        "tags" : $row.find('[book_data="tags"]').text(),
        "isbn" : $row.find('[book_data="isbn"]').text(),
        "otherDetails" : otherDetails
    };
}