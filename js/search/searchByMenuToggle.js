// alert("included")
$(document).ready(function(){
		// alert("ready")
	    $(".menu-toggle").click(function(e) {
			// alert("clicked")
	        // e.preventDefault();
	        $("li.active").toggleClass("active")
	        $(this).toggleClass("active");
	    });
})

 