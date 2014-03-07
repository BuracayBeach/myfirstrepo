	$(document).ready(function(){
		var submitSearch = $('#search_text')
		if (submitSearch.attr('autopindot') == 'true') {
			submitSearch.attr('autopindot','false')
			submitSearch.submit();
		}
	})