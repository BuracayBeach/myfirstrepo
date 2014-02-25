<?php

/* call this view via:

$data['notifs'] = $this->notifs_model->get_all($_SESSION['username']);
$this->load->view('notifications_view', $data);

*/

?>

<link rel="stylesheet" href="<?php echo base_url();?>css/burnzz.css">

<div id="notifs_container" class="my_library_container">

	<?php if(isset($notifs)) : foreach ($notifs as $row) : ?>
			
		<div class="notif <?php echo $row->type; ?>">

			<?php if ($row->type == "custom") : ?>

					<div class="notif_msg"> <?php echo $row->message; ?> </div>  <br/>
					<div class="date_added sub-2 space-top"> sent by <?php echo $row->username_admin; ?> at <?php echo $row->date_sent; ?> </div>
				
			<?php elseif($row->type == "overdue") : ?>

					OVERDUE: <span class="book_title"> <?php echo $row->book_title; ?> </span>
					<div class="f_right"> (<?php echo $row->message; ?> due!) </div> <br/>
					<div class="date_added sub-2 space-top"> <?php echo $row->date_sent; ?> </div>

			<?php elseif($row->type == "claim") : ?>

					CLAIM: <span class="book_title"> <?php echo $row->book_title; ?> </span> <br/>
					<div class="notif_msg"> <?php echo $row->message; ?> </div> <br/>
					<div class="date_added sub-2 space-top"> <?php echo $row->date_sent; ?> </div>

			<?php endif; ?>

		</div>

	<?php endforeach; ?>

	<?php else : ?>
		<span> No notifications. </span>
	<?php endif; ?>

</div> 

