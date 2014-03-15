function setReadMores(row){ //row can be a single row or whole document

    row.find('.article_abstract').readmore({
        speed: 75,
        maxHeight: 50
    });

    row.find('.article_title').readmore({
        speed: 75,
        maxHeight: 40
    });

    row.find('.article_author').readmore({
        speed: 75,
        maxHeight: 20
    });

    row.find('.article_description').readmore({
        speed: 75,
        maxHeight: 40
    });

    row.find('.article_publisher').readmore({
        speed: 75,
        maxHeight: 50
    });
    row.find('.article_tag').readmore({
        speed: 75,
        maxHeight: 40
    });
}

setReadMores($(document));
