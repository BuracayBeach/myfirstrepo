$(document).ready(function(){
    $('#sidebar-wrapper li').bind('click', bindMenuToggles);

	    function bindMenuToggles(){
	        $("li.active").toggleClass("active")
	        $(this).toggleClass("active");
	        $('#search_text').attr('searchby', $(this).attr('searchby'))
	        $('#search_form').submit();
	    }
})

 