	$(document).ready(function(){
		var submitSearch = $('#search_text')
		if (submitSearch.attr('autoSubmitSearch') == 'true') {
			submitSearch.attr('autoSubmitSearch','false')
			submitSearch.submit();
		}
	})