<?php

/* call this view via:

$data['book'] = $this->reserve_model->check_book_ranks();
$data['reserves'] = $this->reserve_model->get($_SESSION['username']);

$this->load->view('reserves_view', $data);

*/

?>

<link rel="stylesheet" href="<?php echo base_url();?>css/burnzz.css">
<script src="<?php echo base_url();?>js/freewall.js"></script>

<div class="hideable">

	<h1>RESERVED</h1>

	<div id="reserves_container" class="my_library_container">

		<?php // para sa ranking 

			// total reserves for a particular book
			$book_array = array();
			$size = count($book);
			for ($i=0; $i<$size; $i++)
				array_push($book_array, $book[$i]->book_no);
			$book_ranks = array_count_values($book_array);

			// key value pair for book_no => array(rank)
			$book_temp = array();
			for ($i=0; $i<$size; $i++)
				$book_temp[$book_array[$i]] = array();
			for($i=0; $i<$size; $i++)
				array_push($book_temp[$book[$i]->book_no], $book[$i]->rank);
		?>

		<?php if(isset($reserves)) : foreach ($reserves as $row) : ?>

			<?php 

				$temp = $book_temp[$row->book_no];
				$size2 = count($temp);
				for ($i=0; $i<$size2; $i++) {
					if ($temp[$i] == $row->rank) {
						$rank = $i+1;
						break;
					}
				}

			?>
				
			<div class="item brick">

				<div class="book_title"> <?php echo $row->book_title; ?> </div> <br/>
				<div class="date_reserved sub-2">  Date Reserved: <?php echo $row->date_reserved; ?> </div> <br/>
				<div class="rank sub-2">  Rank <?php echo $rank; ?> 
				of <?php echo $book_ranks[$row->book_no]; ?> </div> 
				<br>
				<div class="button_container">
					<?php echo "<button class='action_button btn reserve_button btn_untoggle' book_no='" . $row->book_no . "'>unreserve</button>" ?>
				</div>
			</div>

		<?php endforeach; ?>
		<?php endif; ?>

		<script type="text/javascript">

			$(document).ready(function() {
				$("#reserves_container").on("click", ".reserve_button", function() {

					var info = new Array();
					info[0] = $(this).attr('book_no');

					var controller = "reserve";
					var method = "remove";

					$.ajax({
						url : icejjfish + "index.php/" + controller + "/" + method,
						data : { arr : info },
						type : 'POST',
						dataType : "html",
						async : true,
						success: function(data) {
						}
					});

					brick = this.parentNode.parentNode;
					$(brick).remove();
					generateWall();
					
				});

				generateWall();

				function generateWall() {
					$(function() {  
						var wall = new freewall(".my_library_container");
						wall.reset({
							selector: '.item',
							animate: false,
							cellW: 320,
							cellH: 230,
							delay: 50,
							onResize: function() {
								wall.fitWidth();
							}
						});
						wall.fitWidth();
					});  
				}
			});

		</script>

	</div>
</div>