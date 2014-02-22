<?php

/* call this view via:

$data['reserves'] = $this->reserve_model->get($_SESSION['username']);
$this->load->view('reserves_view', $data);

*/

?>

<div id="reserves_container">

	<?php if(isset($reserves)) : foreach ($reserves as $row) : ?>
			
		<div class="reserves" style="margin: 20px 0;">

			<span class="book"> <?php echo $row->book_title; ?> </span>
			| Date Reserved: <?php echo $row->date_reserved; ?> | &nbsp;
			<?php "<button class='.reserve_button' book_no='" . $row->book_no ?. "'>remove</button>" ?>

			<br/>

		</div>

	<?php endforeach; ?>

	<?php else : ?>
		<span> No reserved books. </span>
	<?php endif; ?>

	<script type="text/javascript">

		$(document).ready(function() {
			$("#reserves_container").on("click", ".reserve_button", function() {

				var info = new Array();
				info[0] = $(this).attr('book_no');

				var controller = "reserve";
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