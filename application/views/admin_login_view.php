<style type="text/css">
	div#wrapper_admin {
	    width: 1024px;
	    margin: 0 auto;
	}

	#login_box {
	    width: 350px;
	    height: 200px;
	    margin: 0 auto;
	    margin-top: 200px;
	    border-radius: 25px;
	    -webkit-box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
	    padding-top: 50px;
	}

	.login_container {
	    width: 220px;
	    margin: 0 auto;
	    padding: 10px 15px;
	}

	.login_container .login_input {
	    width: 220px;
	    font-size: 16px;
	    padding: 5px 0;
	    outline: 2px solid #eee;
	    font-family: "Courier New", Courier, monospace;
	    text-align: center;

	    transition: all 0.25s ease-in-out;
	    -webkit-transition: all 0.25s ease-in-out;
	    -moz-transition: all 0.25s ease-in-out;
	}

	.login_container .login_input:focus  {
	    outline-color: #6cf3f1;
	    color: #242424;

	    transition: all 0.25s ease-in-out;
	    -webkit-transition: all 0.25s ease-in-out;
	    -moz-transition: all 0.25s ease-in-out;
	    box-shadow: 0 0 15px rgba(81, 203, 238, 1);
	    -webkit-box-shadow: 0 0 15px rgba(81, 203, 238, 1);
	    -moz-box-shadow: 0 0 15px rgba(81, 203, 238, 1);
	}

	#login_box #submit_box {
	    width: 100px;
	    margin: 0 auto;
	}

	#login_box #submit_button {
	    width: 100px;
	    background-color: #fff;
	    font-size: 11px;
	}

	#login_box #submit_button:hover {
	    width: 100px;
	    transition: all 0.25s ease-in-out;
	    -webkit-transition: all 0.25s ease-in-out;
	    -moz-transition: all 0.25s ease-in-out;
	    box-shadow: 0 0 15px rgba(81, 203, 238, 1);
	    -webkit-box-shadow: 0 0 15px rgba(81, 203, 238, 1);
	}
</style>

<div id="wrapper_admin">

	<div id="login_box">

		<form action = "<?php echo base_url();?>index.php/admin_account/admin_login" method = "post">

			<div class="login_container">
				<input class="login_input" type = "text" name="username" placeholder="username" size="27"/>
			</div>

			<div class="login_container">
				<input class="login_input" type = "password" name="password" placeholder="password" size="27"/>
			</div>

			<div class="login_container" id="submit_box">
				<input type = "submit" name="submit" value="Login" id="submit_button" />
			</div>

		</form>

	</div>

</div>

<?php 
	if(isset($_SESSION['admin_login_notif']) && $_SESSION['admin_login_notif'] == "not_exists")
		echo "<script> alert('Username does not exist!') </script>";

	elseif(isset($_SESSION['admin_login_notif']) && $_SESSION['admin_login_notif'] == "wrong_pwd")
		echo "<script> alert('Wrong password!') </script>";

	unset($_SESSION['admin_login_notif']);
?>