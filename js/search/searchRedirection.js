	$(document).ready(function(){
        var awto = $('#autoSubmitSearchDiv').attr('balyu');
		var currentPath = window.location.href
		var searchPath = icejjfish + "ihome"

		if (awto == 'true' && currentPath == searchPath) {
			$('#autoSubmitSearchDiv').attr('balyu', 'false')
			$('#search_form').submit()
		}
	})
