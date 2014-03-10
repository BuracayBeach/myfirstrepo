<?php

/* call this view via:

$data['notifs'] = $this->notifs_model->get_all($_SESSION['username']);
$this->load->view('notifications_view', $data);

*/

?>

<link rel="stylesheet" href="<?php echo base_url();?>css/burnzz.css">
<div id="notifs_parent"  style="display:none;">
<div id="notifs_container">

	<?php if(isset($notifs)) : foreach ($notifs as $row) : ?>
			
		<div class="notif <?php echo $row->type; ?>">

			<?php if ($row->type == "custom") : ?>

					<div class="notif_msg"> <?php echo $row->message; ?> </div>  <br/>
					<div class="date_added sub-2 space-top"> sent by <?php echo $row->username_admin; ?> at <?php echo $row->date_sent; ?> </div>
				
			<?php elseif($row->type == "overdue") : ?>

					OVERDUE: <span class="book_title"> <?php echo $row->book_title; ?> </span>
					<div class="f_left space-top"> (<?php echo $row->message; ?> due!) </div> <br/>
					<div class="date_added sub-2 space-top"> <?php echo $row->date_sent; ?> </div>

			<?php elseif($row->type == "claim") : ?>

					CLAIM BOOK: <span class="book_title"> <?php echo $row->book_title; ?> </span> <br/>
					<div class="date_added sub-2 space-top"> <?php echo $row->date_sent; ?> </div>

			<?php endif; ?>

		</div>

	<?php endforeach; ?>

	<?php
		else :
			echo "<div class='notif no-notifs'>No notifications.</div>";
		
	?>

	<?php endif; ?>

	<?php if($notifs_count > 5) : ?>

		<div class="notif" id="load-more-container" offset="0" count="<?php echo $notifs_count; ?>">
			<div id="load-more"> LOAD MORE </div>
		</div>

	<?php endif; ?>

</div> 
</div>
