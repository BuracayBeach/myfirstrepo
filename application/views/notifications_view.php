<?php

/* call this view via:

$data['notifs'] = $this->notifs_model->get_all($_SESSION['username']);
$this->load->view('notifications_view', $data);

*/

?>

<div id="notifs_container">

	<?php if(isset($notifs)) : foreach ($notifs as $row) : ?>
			
		<div class="notif" style="margin: 20px 0;">

			<?php if ($row->type == "custom") : ?>

					<span class="message"> <?php echo $row->message; ?> </span>  <br/>
					sent by <?php echo $row->username_admin; ?>
					| <?php echo $row->date_sent; ?> <br/>
				
			<?php elseif($row->type == "overdue") : ?>

					OVERDUE: <span class="book_title"> "<?php echo $row->book_title; ?>" </span>
					<?php echo $row->message; ?> days past the due date <br/>	
					<?php echo $row->date_sent; ?> <br/>

			<?php elseif($row->type == "claim") : ?>

					CLAIM: <span class="book_title"> "<?php echo $row->book_title; ?>" </span>
					<?php echo $row->message; ?> <br/>
					<?php echo $row->date_sent; ?> <br/>

			<?php endif; ?>

		</div>

	<?php endforeach; ?>

	<?php else : ?>
		<span> No notifications. </span>
	<?php endif; ?>

</div>