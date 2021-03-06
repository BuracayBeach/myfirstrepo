var str, msg;
$(document).ready(function(){

});

function validateBookNo(bookNo){
    bookNo = bookNo.trim();

    var patt = /^[a-zA-Z0-9\- ]+$/;
    var valid = patt.test(bookNo);
    //write regex here
    var msg = "";
    if(bookNo == ''){
        msg = '- Call number is required.'
    }
    else if(bookNo.length > 25){
        msg = '- Book number too long: cannot be more than 25 digits/characters<br/>';
    }else if (!valid){
        msg = ' - Invalid Call Number Format.';
    }else{
        msg = '';
    }

    return msg;
}

function validateISBN(isbn){
    isbn = isbn.trim();
    if(isbn.length > 17){
        return ' ISBN too long: cannot be more than 17 characters';
    }else{
        return '';
    }
}

function validateTitle(title){
    title = title.trim();
    if(title == ""){
        return "-Book title is required";
    }
    else if(title.length > 255){
        return "- Title too long: please limit it to 255 characters<br/>"
    }
    else return '';
}

function validateDatePublished(year){
    year = parseInt(year.trim());

    var currentYear = currentYear;
    if(year.length == null || year <= currentYear && year >= 0){
        return '';
    }else{
        return '- Please enter a valid year.<br/>'
    }
}

function validateAuthor(author){
    //regex for name

    author = author.trim();
    var patt = /^[a-zA-Z0-9,_'.\- ]*(;[a-zA-Z0-9,_'.\- ]+)*$/g;
    var valid = patt.test(author);
    //write regex here

    if(valid){
        return '';
    }else{
        return 'Invalid author<br/>';
    }
}

function validateTags(tags){
    tags = tags.trim();
    var patt = /^[a-zA-Z0-9\- ]*(,[a-zA-Z0-9\- ]+)*$/;
    var res = patt.test(tags);

    if(tags.length > 255){
        return '- Tags too long: limit it to 255 characters<br/>';
    }
    else if(res){
        return '';
    }else{
        return '- Invalid format for tags<br/>';
    }
}

function validateType(type){
    type = type.trim();

    if(type.length > 20){
        return '- Type too long: limit it to 20 characters<br/>';
    }else{
        return '';
    }
}

function validateDescription(description){
    description = description.trim();
    if(description.length > 255){
        return "- Description too long: limit it to 255 characters<br/>"
    }else return '';
}

function validatePublisher(publisher){
    publisher = publisher.trim();
    if(publisher.length > 255){
        return "- Publisher too long: limit it to 255 characters<br/>"
    }else{
        return '';
    }
}

function validateAbstract(abstract){
    abstract = abstract.trim();
    if(abstract.length > 1024){
        return "- Abstract too long: limit it to 1024 characters<br/>"
    }else return '';
}

function checkAll(){
    var form = $(this);
    var bookNo = form.find('[name="book_no"]').val();
    var isbn = form.find('[name="isbn"]').val();
    var title = form.find('[name="book_title"]').val();;
    var type = form.find('[name="type"]').val();
    var other = form.find('[name="other"]').val();
    var abstract = form.find('[name="abstract"]').val();
    var author = form.find('[name="author"]').val();
    var description = form.find('[name="description"]').val();
    var publisher = form.find('[name="publisher"]').val();
    var year = form.find('[name="date_published"]').val();
    var tags = form.find('[name="tags"]').val();


    var msgs = validateBookNo(bookNo);
    msgs += validateTitle(title);
    msgs += validateType(type=='Other'?other:type);
    msgs += validateISBN(isbn);
    msgs += validateAbstract(abstract);
    msgs += validateAuthor(author);
    msgs += validateDescription(description);
    msgs += validatePublisher(publisher);
    msgs += validateDatePublished(year);
    msgs += validateTags(tags);

    if(msgs != '')
        alert(msgs);
    return msgs;
}