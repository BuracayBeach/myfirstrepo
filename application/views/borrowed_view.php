<?php

/* call this view via:

$data['borrowed'] = $this->lend_model->get($_SESSION['username']);
$this->load->view('borrowed_view', $data);

*/

?>

<div id="borrowed_container">

	<?php if(isset($borrowed)) : foreach ($borrowed as $row) : ?>
			
		<div class="borrowed" style="margin: 20px 0;">

			<span class="book_no"> Book No: <?php echo $row->book_no; ?> </span> &nbsp; |
			<span class="book_title"> Title: <?php echo $row->book_title; ?> </span> &nbsp; |
			Date Borrowed: <?php echo $row->date_borrowed; ?> &nbsp;
			<br/>

		</div>

	<?php endforeach; ?>

	<?php else : ?>
		<span> No borrowed books. </span>
	<?php endif; ?>

</div>