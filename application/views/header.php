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
    <title><?php echo $title ?></title>

    <script src="<?php echo base_url();?>js/jquery-1.11.0.js"></script>
</head>
<body>

<div id="navbar">
	<a href="<?php echo base_url();?>index.php/home/">LOGOIMAGETHISYIH</a>
	<a href="<?php echo base_url();?>index.php/home/homie">HOME</a>
	<a href="<?php echo base_url();?>index.php/home/about_us">ABOUT US</a>
	<a href="<?php echo base_url();?>index.php/home/help">HELP</a>

	<div id="acc_manager">
		<?php
			if(isset($_SESSION['type'])){
				if($_SESSION['type'] == "regular")
					include 'logged_user_view.php';
				else
					include 'admin_user_view.php';
			}else{
				include 'login_view.php';;
			}
		?>
	</div>
</div>
