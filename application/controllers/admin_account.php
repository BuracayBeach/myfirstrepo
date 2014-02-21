<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_account extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('admin_account_model');
		if(!isset($_SESSION))
			session_start();
	}

	public function index(){
		if(!isset($_SESSION))
			session_start();
		
		$this->load->view('admin_login_view');
	}

	public function backtohome() {
		redirect(base_url());
	}

	public function create_admin(){
		$this->load->view('create_admin_view');
	}

	public function admin_login(){
		if (isset($_SESSION['admin_logged_in'])){
			redirect(base_url());
		}
		
		if($this->check_user_validity()){	
			$_SESSION['username'] = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
			$_SESSION['logged_in'] = true;
			$_SESSION['type'] = "admin";
			redirect(base_url());
		}

		else
			redirect(base_url());	
	}
}
?>