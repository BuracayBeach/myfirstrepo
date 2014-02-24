<?php

/* call this view via:

$data['favorites'] = $this->favorite_model->get_all($_SESSION['username']);
$this->load->view('favorites_view', $data);

*/

?>

<h1> FAVORITES </h1>

<div id="favorites_container" class="small-3">
	<?php if(isset($favorites)) : foreach ($favorites as $row) : ?>
			
		<div class="favorites" style="margin: 20px 0;">

			<span class="book"> <?php echo $row->book_title; ?> </span> &nbsp;
			| Date Added: <?php echo $row->date_added; ?> &nbsp; |
			<?php "<button class='favorite_button' book_no='" . $row->book_no . "'>remove</button>" ?>

			<br/>

		</div>

	<?php endforeach; ?>

	<?php else : ?>
		<span> No favorite books. </span>
	<?php endif; ?>

	<script type="text/javascript">

		$(document).ready(function() {
			$("#favorites_container").on("click", ".favorite_button", function() {

				var info = new Array();
				info[0] = $(this).attr('book_no');

				var controller = "favorite";
				var method = "remove";

				$.ajax({
					url : "http://localhost/myfirstrepo/index.php/" + controller + "/" + method,
					data : { arr : info },
					type : 'POST',
					dataType : "html",
					async : true,
					success: function(data) {
					}
				});

				
			});
		});

	</script>

</div>