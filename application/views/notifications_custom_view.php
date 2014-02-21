<div id="notifs_send_custom">
	<?php echo form_open('/index.php/notifs/send_custom_notif'); ?>
		
		<?php
			$username = array (
							'name' => 'username',
							'id' => 'username',
							'value' => ''
						);
			$message = array(
							'name' => 'message',
							'id' => 'message',
							'rows' => '10',
							'cols' => '70',
						);
		?>

		Send to: <?php echo form_input($username); ?> <br/>
		Message: <br/> <?php echo form_textArea($message); ?> <br/>
		<?php echo form_submit('send', 'Send'); ?>

	<?php echo form_close(); ?>
</div>