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

<div class="hideable">

	<h1>FAVORITES</h1>
	
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
				<div class="book_no sub-2"> Book No: <?php echo $row->book_no; ?> </div> <br/>
				<div class="date_added sub-2"> Date Added: <?php echo $row->date_added; ?> </div> <br/>
				<div class="button_container">
					<?php echo "<button class='action_button btn btn-primary favorite_button' book_no='" . $row->book_no . "'>unfavorite</button>" ?>
					<?php echo "<button class='action_button btn reserve_button ".$enabler."' book_no='" . $row->book_no . "'>".$reserve."</button>" ?>			
				</div>
				<br/>

			</div>

		<?php endforeach; ?>
		<?php endif; ?>
	</div>
</div>

<script type="text/javascript">

	$(document).ready(function(){function e(){$(function(){var e=new freewall(".my_library_container");e.reset({selector:".item",animate:false,cellW:320,cellH:230,delay:50,onResize:function(){e.fitWidth()}});e.fitWidth()})}e();$("#favorites_container").on("click",".action_button",function(){var t=new Array;t[0]=$(this).attr("book_no");var n=$(this).text();if(n=="unfavorite"||n=="unreserve")var r="remove";else if(n=="reserve")var r="add";if(n=="unfavorite")controller="favorite";else if(n=="unreserve"||n=="reserve")controller="reserve";if(n=="BORROWED")return;$.ajax({url:icejjfish+"index.php/"+controller+"/"+r,data:{arr:t},type:"POST",dataType:"html",async:true,success:function(e){}});if(n=="unfavorite"){brick=this.parentNode.parentNode;$(brick).remove();e()}else if(n=="unreserve"){$(this).html("reserve");$(this).toggleClass("btn_enabled btn_untoggle")}else if(n=="reserve"){$(this).html("unreserve");$(this).toggleClass("btn_enabled btn_untoggle")}})})

</script>