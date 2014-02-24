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
    <script src="<?php echo base_url();?>js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="<?php echo base_url();?>css/reset.css"/>
    <link rel="stylesheet" href="<?php echo base_url();?>css/bootstrap.min.css"/>
    <link rel="stylesheet" href="<?php echo base_url();?>css/style2.css"/>

</head>
<body>

<div id="navbar">
	<div id="logo_container"> <a href="<?php echo base_url();?>" class="logo"> <img src="<?php echo base_url();?>images/logo5.png"/> </a></div>

	<div id="menulinks">
		<a href="<?php echo base_url();?>ihome">Home</a>
		<a href="<?php echo base_url();?>about_us">About Us</a>
        <a href="<?php echo base_url();?>faq">FAQ</a>
		<a href="<?php echo base_url();?>help">Help</a>
	</div>

	<div id="acc_manager">
		<?php
			//var_dump($_SESSION);
			if(isset($_SESSION['type'])){
				if($_SESSION['type'] == "regular")
					include 'logged_user_view.php';
				else if($_SESSION['type'] == "admin")
					include 'logged_admin_view.php';
			}else{
				include 'login_view.php';
			}
		?>
	</div>
</div>




<div id="pagebody">





<div class="panel-group" id="accordion">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
          Collapsible Group Item #1
        </a>
      </h4>
    </div>
    <div id="collapseOne" class="panel-collapse collapse in">
      <div class="panel-body">
        <?php include 'search_view.php'; ?>
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
          Collapsible Group Item #2
        </a>
      </h4>
    </div>
    <div id="collapseTwo" class="panel-collapse collapse">
      <div class="panel-body">
        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
          Collapsible Group Item #3
        </a>
      </h4>
    </div>
    <div id="collapseThree" class="panel-collapse collapse">
      <div class="panel-body">
        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
      </div>
    </div>
  </div>
</div>

  
    <div style="margin-left: 500px" id="results_per_page_div">
      <form id="results_per_page_form">
        <input id="results_per_page" style="width:45px" type="number" min="1" max="100" value="10" pattern="^[0-9]+$"/>
        <span>Results per page&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
      </form>
    </div>

    <script>
      $(document).ready(function (){
        $("#results_per_page").on('keypress', function(event){
          // console.log($("#results_per_page_form"))
          res = $('#results_per_page')
          res_val = res.val();
          res_min = res.attr('min');
          res_max = res.attr('max');

          if (event.which == 13 && $.isNumeric(res_val) && res_val >= res_min && res_val <= res_max){
            $('#submit_search').submit();
          }
        });

        $('#results_per_page_form').submit(function(event){
          event.preventDefault();
        });
      });
    </script>