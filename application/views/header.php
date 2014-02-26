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
    <link rel="stylesheet" href="<?php echo base_url();?>css/normalize.css">
    <link rel="stylesheet" href="<?php echo base_url();?>css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>css/foundation.css">

    <!-- If you are using the gem version, you need this only -->
    <link rel="stylesheet" href="<?php echo base_url();?>css/app.css">
    <link rel="stylesheet" href="<?php echo base_url();?>css/style3.css">

    <script src="<?php echo base_url();?>js/vendor/modernizr.js"></script>
    <script src="<?php echo base_url();?>js/jquery-1.11.0.js"></script>
    <script src="<?php echo base_url();?>js/bootstrap.min.js"></script>

</head>
<body>

<div id="navbar" class="contain-to-grid sticky">
  <nav style="" class="top-bar navb" data-topbar>
    <ul class="title-area navb">
      <li class="name " >
        <a href="<?php echo base_url();?>"><img style="max-height:30px;" src="<?php echo base_url();?>images/icon/logo_icon2.png"/> </a>
      </li>
      <li class="toggle-topbar menu-icon"><a href="#">Menu</a></li>
      <li class="divider"></li>
    </ul>

    <section class="top-bar-section ">
      <!-- Right Nav Section -->
      <ul class="right">

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
      </ul>
    </section>

    <section class="top-bar-section">
      <!-- Left Nav Section -->

    	
      <ul class="left">
        <li><a href="<?php echo base_url();?>ihome">
        <?php if( isset($_SESSION['type']) && $_SESSION['type'] == "admin") echo "Manage";else echo "Home";?>
        </a></li>
      </ul>

      <?php

        if(isset($_SESSION) && isset($_SESSION['type']) && $_SESSION['type'] == "regular"){
            echo "<ul class='left'>";
            echo "<li class='has-dropdown'>";
            echo "<a href='#'>My Library</a>";
            echo    "<ul class='dropdown'>";
            echo        "<li><a href='" . base_url() . "favorites'>Favorites</a></li>";
            echo        "<li><a href='" . base_url() . "borrowed'>Borrowed</a></li>";
            echo        "<li><a href='" . base_url() . "reserved'>Reserved</a></li>";
            echo    "</ul>";
            echo "</li>";

            echo "</ul>";
        }

        if(isset($_SESSION) && isset($_SESSION['type']) && $_SESSION['type'] == "admin"){
          echo '
          <ul class="left">
            <li><a href="'.base_url().'accounts">Accounts</a></li>
          </ul>';

        }
      ?>

 

      <ul class="left">
        <li><a href="<?php echo base_url();?>about_us">About Us</a></li>
      </ul>
      <ul class="left">
        <li><a href="<?php echo base_url();?>faq">FAQ</a></li>
      </ul>
      <ul class="left">
        <li><a href="<?php echo base_url();?>help">Help</a></li>
      </ul>

    </section>
  </nav>
</div>


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




