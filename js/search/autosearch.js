$('#search_table_container').ready(function(){
	$('#suggestion_text').on('click', research);
	$('.tag_link').on('click', research);

	hideLoadingGIF();
});


function hideLoadingGIF(){
	$("#loading").fadeOut(100, function(){
		$('.logo_main').fadeOut();
    });
}