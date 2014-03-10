<script src="<?php echo base_url();?>js/jquery.carouFredSel-6.2.0-packed.js" type="text/javascript"></script>

<style type="text/css">
	
	


</style>

<div id="wrapper_carousel" class="column">
	<div id="slider">

		<div class="slide" style="background-image: url('<?php echo base_url(); ?>images/lib2.jpg');">
			<div class="slide-block">
				<h4>ICS Library</h4>
				<p>The ICS Library is open to all students and faculty members who wish to find references for academic and research purposes.</p>
			</div>
		</div>

		<div class="slide" style="background-image: url(<?php echo base_url(); ?>images/lib1.jpg);">
			<div class="slide-block">
				<h4>Books</h4>
				<p>ICS Library has books related to computer programming, operating systems, algorithms and data structures, artificial intelligence, software engineering and many more. </p>
			</div>
		</div>

		<div class="slide" style="background-image: url(<?php echo base_url(); ?>images/lib3.jpg);">
			<div class="slide-block">
				<h4>Special Problem and Thesis</h4>
				<p>Special Problem and Thesis manuscripts can also be found in the library!</p>
			</div>
		</div>

	</div>
</div>

<script type="text/javascript">
	$('#slider').carouFredSel({
		width: '100%',
		align: false,
		items: 3,
		items: {
			width: $('#wrapper_carousel').width() * 0.10,
			height: 286,
			visible: 1,
			minimum: 1
		},
		scroll: {
			items: 1,
			timeoutDuration : 5000,
			onBefore: function(data) {

				//	find current and next slide
				var currentSlide = $('.slide.active', this),
					nextSlide = data.items.visible,
					_width = $('#wrapper_carousel').width();

				//	resize currentslide to small version
				currentSlide.stop().animate({
					width: _width * 0.10
				});		
				currentSlide.removeClass( 'active' );

				//	hide current block
				data.items.old.add( data.items.visible ).find( '.slide-block' ).stop().fadeOut();					

				//	animate clicked slide to large size
				nextSlide.addClass( 'active' );
				nextSlide.stop().animate({
					width: _width * 0.7
				});						
			},
			onAfter: function(data) {
				//	show active slide block
				data.items.visible.last().find( '.slide-block' ).stop().fadeIn();
			}
		},
		onCreate: function(data){

			//	clone images for better sliding and insert them dynamacly in slider
			var newitems = $('.slide',this).clone( true ),
				_width = $('#wrapper_carousel').width();

			$(this).trigger( 'insertItem', [newitems, newitems.length, false] );

			//	show images 
			$('.slide', this).fadeIn();
			$('.slide:first-child', this).addClass( 'active' );
			$('.slide', this).width( _width * 0.10 );

			//	enlarge first slide
			$('.slide:first-child', this).animate({
				width: _width * 0.7
			});

			//	show first title block and hide the rest
			$(this).find( '.slide-block' ).hide();
			$(this).find( '.slide.active .slide-block' ).stop().fadeIn();
		}
	});

	//	Handle click events
	$('#slider').children().click(function() {
		$('#slider').trigger( 'slideTo', [this] );
	});

	//	Enable code below if you want to support browser resizing
	$(window).resize(function(){

		var slider = $('#slider'),
			_width = $('#wrapper_carousel').width();

		//	show images
		slider.find( '.slide' ).width( _width * 0.10 );

		//	enlarge first slide
		slider.find( '.slide.active' ).width( _width * 0.7 );

		//	update item width config
		slider.trigger( 'configuration', ['items.width', _width * 0.10] );
	});

</script>