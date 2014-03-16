<a href="<?php echo base_url();?>index.php/user_account/logout">
	<div class="menulinks">
		Logout
	</div>
</a>
<a href="<?php echo base_url();?>update_account">
	<div class="menulinks <?php if(isset($title) && $title == 'ComLib Update') echo 'menulinks-active';?>">
		Update Profile
	</div>
</a>
<a>
	<div class="menulinks" id="notif-toggle">
		<div id="greet-user"> Hi <?php echo $_SESSION['username']; ?> </div>
		<div id="notif-blue-glow"> </div>
	</div>
</a>

<script type="text/javascript">

	$(document).mouseup(function (e) {
	    var container = $("div#notifs_parent");
	    var toggle_link = $("div#notif-toggle");

	    if (!container.is(e.target) && container.has(e.target).length === 0 &&
	    	!toggle_link.is(e.target) && toggle_link.has(e.target).length === 0)
	        container.hide();
	});

	$(document).ready( function() {

		$('div#notif-toggle').on("click", function() {
			$('div#notifs_parent').toggle();
		});

		$('div#load-more-container').on("click", function() {

			var offset = parseInt($(this).attr('offset')) + 5;
			$(this).attr('offset', offset);

			$.ajax({
				url : icejjfish + "index.php/notifs/view_by_username/" + offset,
				type : 'POST',
				dataType : "html",
				async : true,
				success : function(data) {
					notifs = JSON.parse(data);

					for (var i=0; i<notifs.length; i++) {

						if (notifs[i].type == "custom") {

							str = "<div class='notif " + notifs[i].type +  "'>" +
							"<div class='notif_msg'>" + notifs[i].message + "</div><br/>" +
							"<div class='date_added sub-2 space-top'>sent by " + notifs[i].username_admin + " at " + notifs[i].date_sent + "</div>" +
							"</div>";
						}

						else if (notifs[i].type == "overdue") {

							str = "<div class='notif " + notifs[i].type +  "'>" +
							"OVERDUE: <span class='book_title'>" + notifs[i].book_title + "</span>" +
							"<div class='f_left space-top'>(" + notifs[i].message + " due!)</div><br/>" +
							"<div class='date_added sub-2 space-top'>" + notifs[i].date_sent + "</div>" +
							"</div>";
						}

						else if (notifs[i].type == "claim") {

							str = "<div class='notif " + notifs[i].type +  "'>" +
							"CLAIM BOOK: <span class='book_title'>" + notifs[i].book_title + "</span>" +
							"<div class='date_added sub-2 space-top'>" + notifs[i].date_sent + "</div>" +
							"</div>";
						}

						$('div#load-more-container').before(str);
					}

					var count = parseInt($('div#load-more-container').attr('count'));
					if (offset + 5 - 1 >= count )
						$('div#load-more-container').hide();
				}
			});
		});
	});

</script>


