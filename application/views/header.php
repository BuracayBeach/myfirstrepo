<html>
	<!--
	     .-=-==--==--.
       ..-=="  ,'o`)      `.
     ,'         `"'         \
    :  (                     `.__...._
    |                  )    /         `-=-.
    :       ,vv.-._   /    /               `---==-._
     \/\/\/VV ^ d88`;'    /                         `.
         ``  ^/d88P!'    /             ,              `._
            ^/    !'   ,.      ,      /                  "-,,__,,--'""""-.
           ^/    !'  ,'  \ . .(      (         _           )  ) ) ) ))_,-.\
          ^(__ ,!',"'   ;:+.:%:a.     \:.. . ,'          )  )  ) ) ,"'    '
          ',,,'','     /o:::":%:%a.    \:.:.:         .    )  ) _,'
           """'       ;':::'' `+%%%a._  \%:%|         ;.). _,-""
                  ,-='_.-'      ``:%::)  )%:|        /:._,"
                 (/(/"           ," ,'_,'%%%:       (_,'
                                (  (//(`.___;        \
                                 \     \    `         `
                                  `.    `.   `.        :
                                    \. . .\    : . . . :
                                     \. . .:    `.. . .:
                                      `..:.:\     \:...\
            RAWR                       ;:.:.;      ::...:
                                       ):%::       :::::;
                                   __,::%:(        :::::
                                ,;:%%%%%%%:        ;:%::
                                  ;,--""-.`\  ,=--':%:%:\
                                 /"       "| /-".:%%%%%%%\
                                                 ;,-"'`)%%) 
                                                /"      "|
	-->
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title><?php echo $title;?></title>

		<!-- If you are using CSS version, only link these 2 files, you may add app.css to use for your overrides if you like. -->
		<link rel="stylesheet" href="<?php echo base_url();?>css/bootstrap.min.css">


		<!-- If you are using the gem version, you need this only -->
		<link rel="stylesheet" href="<?php echo base_url();?>css/style4.css">
		<link rel="stylesheet" href="<?php echo base_url();?>css/style5.css">

		<link rel="shortcut icon" href="<?php echo base_url();?>favicon.ico" />
		<link rel="icon" href="<?php echo base_url();?>favicon.ico" type="image/ico" />

		<script src="<?php echo base_url();?>js/jquery-1.11.0.min.js"></script>
		<script src="<?php echo base_url();?>js/bootstrap.min.js"></script>
		<script type="text/javascript">
			var icejjfish = "<?php echo base_url(); ?>";
		</script>

	</head>
	<body>
    <noscript><div> hahahaha </div></noscript>

	<div id="site-cont">
		<?php
			if($title != "ComLib")
				include 'banner_view.php';
		?>
		<div id="navbar" class="<?php if($title == "ComLib") echo "default";?>">
			<div id="element-cont">
				<div class="left">
					<a href="<?php echo base_url();?>ihome">
						<div class="menulinks <?php if(isset($title) && $title == 'ComLib Home') echo 'menulinks-active';?>">
							<?php if( isset($_SESSION['type']) && $_SESSION['type'] == "admin") echo "Manage";else echo "Home";?>
						</div>
					</a>

					<?php
						if( isset($_SESSION['type']) && $_SESSION['type'] == "admin"){
							echo "
								<a href=" . base_url() . "accounts>
									<div class='menulinks ";  

							if(isset($title) && $title == 'ComLib Accounts') echo 'menulinks-active';

							echo		"'>
										Accounts
									</div>
								</a>";
						}
					?>

					<?php

					if(isset($_SESSION) && isset($_SESSION['type']) && $_SESSION['type'] == "regular"){
						echo 
							"<div class='btn-group  dropdown-hover'>
								<a href='javascript:void(0);' class='' data-toggle='dropdown'>
									<div class='menulinks ";

									if(isset($title) && $title == 'ComLib My Lib') echo 'menulinks-active';

									echo "'>
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
						<div class="menulinks  <?php if(isset($title) && $title == 'ComLib About Us') echo 'menulinks-active';?>">
							About Us
						</div>
					</a>
					<a href="<?php base_url()?>faq">
						<div class="menulinks  <?php if(isset($title) && $title == 'ComLib FAQ') echo 'menulinks-active';?>">
							FAQ
						</div>
					</a>
					<a href="<?php base_url()?>help">
						<div class="menulinks  <?php if(isset($title) && $title == 'ComLib Help') echo 'menulinks-active';?>">
							Help
						</div>
					</a>
					<?php
						if(isset($_SESSION) && isset($_SESSION['type']) && $_SESSION['type'] == "admin"){
							echo "<a href=" . base_url() . "logs><div class='menulinks ";  

							if(isset($title) && $title == 'ComLib Logs') echo 'menulinks-active';

							echo " '>Logs</div></a>";

						}
					?>
		
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
			var winsize = false;


			$(window).on("resize", function(){
				if("<?php echo $title;?>" != "ComLib"){
					if($(window).width() < 1024){
						winsize = true;
						pfgt12p();
						$(window).scrollTop(90);
					}
					else if($(window).scrollTop() > 90){
						winsize = false;
						pfgt1ap();
					}
				}
			});

			$(window).scroll(function () {
				if(!winsize && "<?php echo $title;?>" != "ComLib"){
					if ($(window).scrollTop() < 90) {
						pfgt12p();
					}
					if ($(window).scrollTop() >= 90 && $(window).width() > 1024) {
						pfgt1ap();
					}
				}
			});

			function pfgt12p(){
				$('#navbar').removeClass('fixed');
				$('#search').removeClass('fixed');
				$('#banner').removeClass('pad');
				$('#rightbody').removeClass('fixerupper');
			}

			function pfgt1ap(){
				$('#navbar').addClass('fixed');
				$('#search').addClass('fixed');
				$('#banner').addClass('pad');
				$('#rightbody').addClass('fixerupper');
			}
		</script>

		<!---->
		<!--<div class=""  id="results_per_page_div" hidden>-->
		<!--  <form id="results_per_page_form">-->
		<!--    <input id="results_per_page" style="width:45px" type="number" min="1" max="100" value="10" pattern="^[0-9]+$"/>-->
		<!--    <span>Results per page&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>-->
		<!--  </form>-->
		<!--</div>-->