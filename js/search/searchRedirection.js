	$(document).ready(function(){
		var submitSearch = $('#search_text')
		var currentPath = window.location.href
		var searchPath = icejjfish + "ihome"
		var autoSubmitSearch = submitSearch.attr('autoSubmitSearch')

		if (submitSearch.attr('autoSubmitSearch') == 'true' && currentPath == searchPath) {
			submitSearch.attr('autoSubmitSearch','false')
			submitSearch.submit();
		}
	})
