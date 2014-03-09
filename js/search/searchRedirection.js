	$(document).ready(function(){
		var awto = $('#autoSubmitSearchDiv').attr('balyu');
		var currentPath = window.location.href
		var searchPath = icejjfish + "ihome"

		if (awto == 'true' && currentPath == searchPath) $('#search_form').submit()
	})
