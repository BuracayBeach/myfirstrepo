$("img#chibi1, img#chibi2").on("click", function() {
	var audioElement = document.createElement('audio');
	audioElement.setAttribute('src', icejjfish + 'easteregg/easteregg.mp3');
	audioElement.setAttribute('autoplay', 'autoplay');
	audioElement.load();

	$.get();

	audioElement.addEventListener("load", function() {
	    audioElement.play();
	}, true);
	audioElement.play();
});