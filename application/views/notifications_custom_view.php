<div id="notifs_send_custom">
	<?php echo form_open('/index.php/notifs/send_custom_notif'); ?>
		
		<?php
			$username = array(
							'name' => 'username',
							'id' => 'username',
							'value' => '',
							'class' => 'form-control'
						);
			$message = array(
							'name' => 'message',
							'id' => 'message',
							'rows' => '10',
							'cols' => '70',
							'class' => 'form-control'
						);
		?>

		<div class="form-group">Send to: <?php echo form_input($username); ?> </div>
		<div class="form-group">Message: <br/> <?php echo form_textArea($message); ?> </div>
		<?php echo form_submit(array('class'=>'btn btn-default'), 'send', 'Send'); ?>

	<?php echo form_close(); ?>
</div>