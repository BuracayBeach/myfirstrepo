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
    <link rel="stylesheet" href="<?php echo base_url();?>css/reset.css"/>
    <link rel="stylesheet" href="<?php echo base_url();?>css/bootstrap.min.css"/>
    <link rel="stylesheet" href="<?php echo base_url();?>css/style.css"/>

</head>
<body>

<div id="navbar">
	<div id="menulinks">
		<a href="<?php echo base_url();?>" class="logo"> <img src="<?php echo base_url();?>images/logo4.png"/> </a>
		<a href="ihome">Home</a>
		<a href="about_us">About Us</a>
        <a href="announcements">Announcements</a>
		<a href="help">Help</a>
        <a href="faq">FAQ</a>
	</div>

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

<div id="pagebody">