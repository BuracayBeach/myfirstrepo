<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_account extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('admin_account_model');	
		
		if(!isset($_SESSION))
			session_start();
	}

	public function index(){
		$this->backtohome();
	}

	public function backtohome() {
		redirect(base_url());
	}

	public function adminlogin(){
		if(count($_SESSION) == 0)
			$this->load->view('admin_login_view');
		else
			$this->backtohome();
	}

	public function create_admin(){
		$this->load->view('create_admin_view');
	}

	public function update_admin(){
		
	}

	public function admin_login(){
		if (isset($_SESSION['admin_logged_in']))
			redirect(base_url());

		if($this->check_admin_validity()){	
			$_SESSION['admin_username'] = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
			$_SESSION['admin_logged_in'] = true;
			$_SESSION['type'] = "admin";
			redirect(base_url());
		}

		else
			redirect(base_url());
	}

	public function logout(){
		unset($_SESSION['admin_username']);
		unset($_SESSION['type']);
		unset($_SESSION['admin_logged_in']);
		session_destroy();

		redirect(base_url());
	}

	private function check_admin_validity(){
		$username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
		$password = md5(filter_var($_POST['password'], FILTER_SANITIZE_STRING));

		$data = $this->admin_account_model->get_admin($username);

		if(!$data){
			$_SESSION['notif_admin_login'] = "Username does not exist!";
		}
		
		else{
			if($password == $data['password']){
				return true;
			}
			else{
				$_SESSION['notif_admin_login'] = "Incorrect password!";
				return false;
			}
		}
	}

	public function create_admin_account(){

	}
}
?>