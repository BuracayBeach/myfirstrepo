// when favorites/unfavorites/reserve/unreserve button is clicked on each row
$(document).ready(function(){
    $("#result_container").on("click", ".book_action", function() {

        var info = new Array();
        info[0] = $(this).attr('book_no');

        var action_type = $(this).text();
        var controller = action_type;

        if (action_type == "favorite" || action_type == "reserve")
            var method = "add";
        else if (action_type == "unfavorite" || action_type == "unreserve")
            var method = "remove";

        if (action_type == "unfavorite")
            controller = "favorite";
        else if (action_type == "unreserve")
            controller = "reserve";


        $.ajax({
            url : icejjfish + "index.php/" + controller + "/" + method,
            data : { arr : info },
            type : 'POST',
            dataType : "html",
            async : true,
            success: function(data) {

                if (controller == "reserve" && method == "add") {

                    $.ajax({
                        url : icejjfish + "index.php/" + "reserve" + "/view_rank/",
                        data : {arr : info},
                        type : 'POST',
                        dataType : "html",
                        async : true,
                        success : function(data2) {
                            $("div.rank[book_no = '"+ info[0] +"']").text(data2).slideDown();
                        }
                    });

                }
            }
        });

        if (action_type == "favorite")
            $(this).text("unfavorite");
        else if (action_type == "unfavorite")
            $(this).text("favorite");
        else if (action_type == "reserve")
            $(this).text("unreserve");
        else if (action_type == "unreserve")
            $(this).text("reserve");

        if (action_type == "unreserve") {
            $(this).html("reserve")
            $(this).toggleClass('btn_green btn_yellow');

            // hide the rank div
            $("div.rank[book_no = '"+ info[0] +"']").slideUp();
        }
        else if (action_type == "reserve") {
            $(this).html("unreserve")
            $(this).toggleClass('btn_green btn_yellow');
        }

        $.ajax({
            url : icejjfish + "index.php/" + "notifs" + "/" + "check_reserve_for_first",
            data : {arr : info},
            type : 'POST',
            dataType : "html",
            async : true,
            success : function(data) {}
        });
    });
});