<?php

/* call this view via:

$data['favorites'] = $this->favorite_model->get_all($_SESSION['username']);
$data['reserve_user'] = $this->favorite_model->get_all($_SESSION['username']);
$data['lend_user'] = $this->favorite_model->get_all($_SESSION['username']);
$this->load->view('favorites_view', $data);

*/

?>

<link rel="stylesheet" href="<?php echo base_url();?>css/burnzz.css">
<script src="<?php echo base_url();?>js/freewall.js"></script>

<h1> FAVORITES </h1>

<div id="favorites_container" class="my_library_container">
	<?php if(isset($favorites)) : foreach ($favorites as $row) : ?>

		<?php

	        $reserve = 'reserve';
	        $enabler = 'btn_enabled';

			/* checking of reserves */
	        $size = count($reserve_user);
	        for ($i=0; $i<$size; $i++) {
	            if ($reserve_user[$i]->book_no == $row->book_no) {
	                $reserve = 'unreserve';
	                $enabler = 'btn_untoggle';
	                break;
	            }
	        }

	        /* counter-check reserves with lends */
	        $size = count($lend_user);
	        for ($i=0; $i<$size; $i++) {
	            if ($lend_user[$i]->book_no == $row->book_no) {
	                $reserve = 'BORROWED';
	                $enabler = 'btn_disabled';
	                break;
	            }
	        }
	    ?>             
			
		<div class="item brick">

			<div class="book_title"> <?php echo $row->book_title; ?> </div> <br/>
			<div class="date_added"> Date Added: <?php echo $row->date_added; ?> </div> <br/>
			<?php echo "<button class='action_button favorite_button' book_no='" . $row->book_no . "'>unfavorite</button>" ?>
			<?php echo "<button class='action_button reserve_button ".$enabler."' book_no='" . $row->book_no . "'>".$reserve."</button>" ?>			
			<br/>

		</div>

	<?php endforeach; ?>

	<?php endif; ?>
</div>

<script type="text/javascript">

		$(document).ready(function() {

			generateWall();

			$("#favorites_container").on("click", ".action_button", function() {

				var info = new Array();
				info[0] = $(this).attr('book_no');

				var action_type = $(this).text();

				if (action_type == "unfavorite" || action_type == "unreserve")
					var method = "remove"; 
				else if (action_type == "reserve")
					var method = "add";

				if (action_type == "unfavorite")
					controller = "favorite";
				else if (action_type == "unreserve" || action_type == "reserve")
					controller = "reserve";

				$.ajax({
					url : "http://localhost/myfirstrepo/index.php/" + controller + "/" + method,
					data : { arr : info },
					type : 'POST',
					dataType : "html",
					async : true,
					success: function(data) {
					}
				});

				if (action_type == "unfavorite") {
					brick = this.parentNode;
					$(brick).remove();
					generateWall();
				}
				else if (action_type == "unreserve") {
					$(this).html("reserve")
					$(this).toggleClass('btn_enabled btn_untoggle');
				}
				else if (action_type == "reserve") {
					$(this).html("unreserve")
					$(this).toggleClass('btn_enabled btn_untoggle');
				}
			});


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