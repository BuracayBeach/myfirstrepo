$(document).ready(function(){$("#result_container").on("click",".book_action",function(){var e=new Array;e[0]=$(this).attr("book_no");var t=$(this).text();var n=t;if(t=="favorite"||t=="reserve")var r="add";else if(t=="unfavorite"||t=="unreserve")var r="remove";if(t=="unfavorite")n="favorite";else if(t=="unreserve")n="reserve";if(t=="BORROWED")return;$.ajax({url:icejjfish+"index.php/"+n+"/"+r,data:{arr:e},type:"POST",dataType:"html",async:true,success:function(t){if(n=="reserve"&&r=="add"){$.ajax({url:icejjfish+"index.php/"+"reserve"+"/view_rank/",data:{arr:e},type:"POST",dataType:"html",async:true,success:function(t){$("div.rank[book_no = '"+e[0]+"']").text(t).slideDown()}})}}});if(t=="favorite")$(this).text("unfavorite");else if(t=="unfavorite")$(this).text("favorite");else if(t=="reserve")$(this).text("unreserve");else if(t=="unreserve")$(this).text("reserve");if(t=="unreserve"){$(this).html("reserve");$(this).toggleClass("btn_green btn_yellow");$("div.rank[book_no = '"+e[0]+"']").slideUp()}else if(t=="reserve"){$(this).html("unreserve");$(this).toggleClass("btn_green btn_yellow")}$.ajax({url:icejjfish+"index.php/"+"notifs"+"/"+"check_reserve_for_first",data:{arr:e},type:"POST",dataType:"html",async:true,success:function(e){}})})})