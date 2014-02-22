<?php

/* call this view via:


$rank = $this->reserve_model->check_book_ranks($_SESSION['username']);

$data['book'] = $rank['book'];
$data['reserves'] = $this->reserve_model->get($_SESSION['username']);

$this->load->view('reserves_view', $data);

*/

?>

<div id="reserves_container">


	<?php // para sa ranking 

		// total reserves for a particular book
		$book_array = array();
		$size = count($book);
		for ($i=0; $i<$size; $i++)
			array_push($book_array, $book[$i]->book_no);
		$book_ranks = array_count_values($book_array);

		// key value pair for book_no => array(rank)
		$book_chever = array();
		for ($i=0; $i<$size; $i++)
			$book_chever[$book_array[$i]] = array();
		for($i=0; $i<$size; $i++)
			array_push($book_chever[$book[$i]->book_no], $book[$i]->rank);
	?>

	<?php if(isset($reserves)) : foreach ($reserves as $row) : ?>

		<?php 

			$temp = $book_chever[$row->book_no];
			$size2 = count($temp);
			for ($i=0; $i<$size2; $i++) {
				if ($temp[$i] == $row->rank) {
					$rank = $i+1;
					break;
				}
			}

		?>
			
		<div class="reserves" style="margin: 20px 0;">

			<span class="book"> <?php echo $row->book_title; ?> </span>
			| Date Reserved: <?php echo $row->date_reserved; ?>
			| Rank <?php echo $rank; ?>
			of <?php echo $book_ranks[$row->book_no]; ?>
			<?php echo "<button class='.reserve_button' book_no='" . $row->book_no . "'>unreserve</button>" ?>

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