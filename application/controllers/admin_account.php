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
		if($_SESSION['admin_logged_in'])
			$this->load->view('create_admin_view');
		else
			$this->backtohome();
	}

	public function update_admin(){
		if($_SESSION['admin_logged_in'])
			$this->get_admin_data();
		else
			$this->backtohome();
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
			redirect(site_url("admin_account/adminlogin"));
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
		$password = hash('sha256', filter_var($_POST['password'], FILTER_SANITIZE_STRING));

		$data = $this->admin_account_model->get_admin($username);

		if(!$data){
			$admin_notif['login_notif'] = "Adminintrator username does not exist!";
		}
		
		else{
			if($password == $data['password']){
				return true;
			}
			else{
				$admin_notif['login_notif'] = "Incorrect password!";
				return false;
			}
		}
	}

	public function create_admin_account(){
		$data['username'] = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
		$data['password'] = hash('sha256', filter_var($_POST['password'], FILTER_SANITIZE_STRING));
		$data['name_first'] = filter_var($_POST['name_first'], FILTER_SANITIZE_STRING);
		$data['name_middle'] = filter_var($_POST['name_middle'], FILTER_SANITIZE_STRING);
		$data['name_last'] = filter_var($_POST['name_last'], FILTER_SANITIZE_STRING);

		$result = $this->admin_account_model->insert_admin($data);

		if($result){
			$admin_notif['create_admin_notif'] = "Succesfully created admin!";
			$this->backtohome();
		}

		else{
			$admin_notif['create_admin_notif'] = "Username exists!";
			redirect(site_url("admin_account/create_admin"));
		}
	}

	public function update_admin_account(){
		$data['name_first'] = filter_var($_POST['name_first'], FILTER_SANITIZE_STRING);
		$data['name_middle'] = filter_var($_POST['name_middle'], FILTER_SANITIZE_STRING);
		$data['name_last'] = filter_var($_POST['name_last'], FILTER_SANITIZE_STRING);

		$admin_username = $_SESSION['admin_username'];
		$result = $this->admin_account_model->update_admin($data, $admin_username);

		if($result){
			$admin_notif['update_admin_notif'] = "Succesfully updated admin";
			redirect(site_url("admin_account/update_admin"));
		}

		else{
			$admin_notif['update_admin_notif'] = "Error in updating admin";
			redirect(site_url("admin_account/update_admin"));
		}
	}

	public function get_admin_data(){
		$admin_username = $_SESSION['admin_username'];
		$data = $this->admin_account_model->get_admin_data($admin_username);
		$this->load->view('update_admin_view', $data);
	}

	public function admin_change_password(){
		$admin_username = $_SESSION['admin_username'];
		$current_password = hash('sha256', filter_var($_POST['currentPassword'], FILTER_SANITIZE_STRING));
		$new_password = hash('sha256', filter_var($_POST['newPassword'], FILTER_SANITIZE_STRING));
		$correct_password = $this->admin_account_model->get_admin_password($admin_username);

		if($current_password == $correct_password){
			$this->admin_account_model->change_admin_password($new_password, $admin_username);
			$admin_notif['change_password_notif'] = "Succesfully changed password!";
			redirect(site_url("admin_account/update_admin"));
		}

		else
			$admin_notif['change_password_notif'] = "Password does not match!";
			redirect(site_url("admin_account/update_admin"));
	}
}
?>