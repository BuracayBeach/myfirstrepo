<?php

/* call this view via:

$data['borrowed'] = $this->lend_model->get($_SESSION['username']);
$this->load->view('borrowed_view', $data);

*/

?>

<link rel="stylesheet" href="<?php echo base_url();?>css/burnzz.css">
<script src="<?php echo base_url();?>js/freewall.js"></script>


<div class="hideable">

	<h1>BORROWED</h1>

	<div id="borrowed_container" class="my_library_container">

		<?php if(isset($borrowed)) : foreach ($borrowed as $row) : ?>
			
			<?php

				$overdue_class = "";

				$due_days =  $days_elapsed[$row->book_no] - 6;
				if ($due_days == 0)
					$days_msg = "DUE TODAY!";
				else if ($due_days > 0) {
					$days_msg = "OVERDUE by {$due_days} days!";
					$overdue_class = "overdue_glow";
				}
				else {
					$due_days *= -1;
					$days_msg = "Due in {$due_days} days.";
				}
			?>

			<div class="item brick">

				<div class="book_title"> <?php echo $row->book_title; ?> </div> <br/>
				<div class="book_no sub-2"> Book No: <?php echo $row->book_no; ?> </div> <br/>
				<div class="date_added sub-2"> Date Borrowed: <?php echo $row->date_borrowed; ?> </div> <br/>
				<?php echo "<div class='days_due ".$overdue_class."'> $days_msg </div>" ?>

			</div>

		<?php endforeach; ?>
		<?php endif; ?>

	</div>
</div>

<script type="text/javascript">

	$(document).ready(function() {

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