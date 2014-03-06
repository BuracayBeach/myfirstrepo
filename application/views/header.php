<?php
/**
* Created by PhpStorm.
* User: isnalla
* Date: 1/15/14
* Time: 6:47 PM
*/
?>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title><?php echo $title;?></title>

		<!-- If you are using CSS version, only link these 2 files, you may add app.css to use for your overrides if you like. -->
		<link rel="stylesheet" href="<?php echo base_url();?>css/bootstrap.min.css">


		<!-- If you are using the gem version, you need this only -->
		<link rel="stylesheet" href="<?php echo base_url();?>css/style4.css">
		<link rel="stylesheet" href="<?php echo base_url();?>css/style5.css">

		<script src="<?php echo base_url();?>js/jquery-1.11.0.js"></script>
		<script src="<?php echo base_url();?>js/bootstrap.min.js"></script>
		<script type="text/javascript">
			var icejjfish = "<?php echo base_url(); ?>";
		</script>

	</head>
	<body>

	<div id="site-cont">
		<div id="banner">
			This is the banner
		</div>
		<div id="navbar" class="">
			<div id="element-cont">
				<div class="left">
					<a href="<?php echo base_url();?>ihome">
						<div class="menulinks">
							<?php if( isset($_SESSION['type']) && $_SESSION['type'] == "admin") echo "Manage";else echo "Home";?>
						</div>
					</a>

					<?php

					if(isset($_SESSION) && isset($_SESSION['type']) && $_SESSION['type'] == "regular"){
						echo 
							"<div class='btn-group  dropdown-hover'>
								<a href='' class='' data-toggle='dropdown'>
									<div class='menulinks'>
										My Library
										<span class='caret'></span>
									</div>
							  	</a>
							  	<ul class='dropdown-menu'>
							  		<li><a href='". base_url() ."favorites'>Favorites</a></li>
							  		<li><a href='". base_url() ."borrowed'>Borrowed</a></li>
							  		<li><a href='". base_url() ."reserved'>Reserved</a></li>
							  	</ul>
							</div>";
					}
					?>

					<a href="<?php base_url()?>about_us">
						<div class="menulinks">
							About Us
						</div>
					</a>
					<a href="<?php base_url()?>faq">
						<div class="menulinks">
							FAQ
						</div>
					</a>
					<a href="<?php base_url()?>help">
						<div class="menulinks">
							Help
						</div>
					</a>
		
				</div>

				<div class="right">
					<?php
						if(isset($_SESSION) && isset($_SESSION['type'])){
							if($_SESSION['type'] == 'regular')
								include 'logged_user_view.php';
							else
								include 'logged_admin_view.php';
						}else{
							include 'login_view.php';
						}
					?>

				</div>
			</div>
		</div>

		<script type="text/javascript">
			$(window).scroll(function () {
				console.log($(window).scrollTop());
				if ($(window).scrollTop() < 90) {
					$('#navbar').removeClass('fixed');
					$('#search').removeClass('fixed');
				}
				if ($(window).scrollTop() > 90) {
					$('#navbar').addClass('fixed');
					$('#search').addClass('fixed');
				}
			});
		</script>

		<div class="small-2 side-nav columns">
			<?php include 'search_view.php';?>
		</div>

		<!---->
		<!--<div class=""  id="results_per_page_div" hidden>-->
		<!--  <form id="results_per_page_form">-->
		<!--    <input id="results_per_page" style="width:45px" type="number" min="1" max="100" value="10" pattern="^[0-9]+$"/>-->
		<!--    <span>Results per page&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>-->
		<!--  </form>-->
		<!--</div>-->