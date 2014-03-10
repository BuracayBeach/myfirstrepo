<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_account extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('admin_account_model');	
		$this->load->library('safeguard');
		if(!isset($_SESSION))
			session_start();
	}

	public function index(){
		$this->backtohome();
	}

	public function backtohome() {
		redirect(base_url() . 'ihome');
	}

	public function adminlogin(){
		if(!isset($_SESSION['admin_logged_in']))
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
			redirect(base_url() . 'ihome');

		if($this->check_admin_validity()){	
			$_SESSION['admin_username'] = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
			$_SESSION['admin_logged_in'] = true;
			$_SESSION['type'] = "admin";
			$_SESSION['search_data']['available'] = 'on'; //added by rey benedicto 2014-03-09 22.47
			$_SESSION['search_data']['reserved'] = 'on'; //added by rey benedicto 2014-03-09 22.47
			$_SESSION['search_data']['borrowed'] = 'on'; //added by rey benedicto 2014-03-09 22.47

			$_SESSION['search_data']['type_book'] = 'on'; //added by rey benedicto 2014-03-09 22.47
			$_SESSION['search_data']['type_journal'] = 'on'; //added by rey benedicto 2014-03-09 22.47
			$_SESSION['search_data']['type_sp'] = 'on'; //added by rey benedicto 2014-03-09 22.47
			$_SESSION['search_data']['type_thesis'] = 'on'; //added by rey benedicto 2014-03-09 22.47
			$_SESSION['search_data']['type_other'] = 'on'; //added by rey benedicto 2014-03-09 22.47

			redirect(base_url() . 'ihome');
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
			$_SESSION['admin_login_notif'] = "not_exists";
		}
		
		else{
			if($password == $data['password']){
				return true;
			}
			else{
				$_SESSION['admin_login_notif'] = "wrong_pwd";
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

		$new_data = $this->safeguard->array_ready_for_query($data);
		$result = $this->admin_account_model->insert_admin($new_data);

		if($result){
			$_SESSION['create_admin_notif'] = "create_admin_success";
			redirect(site_url("home/create_admin"));
		}

		else{
			$_SESSION['create_admin_notif'] = "username_exist";
			redirect(site_url("home/create_admin"));
		}
	}

	public function update_admin_account(){
		$data['name_first'] = filter_var($_POST['name_first'], FILTER_SANITIZE_STRING);
		$data['name_middle'] = filter_var($_POST['name_middle'], FILTER_SANITIZE_STRING);
		$data['name_last'] = filter_var($_POST['name_last'], FILTER_SANITIZE_STRING);

		$admin_username = $_SESSION['admin_username'];
		$new_data = $this->safeguard->array_ready_for_query($data);
		$result = $this->admin_account_model->update_admin($new_data, $admin_username);

		if($result){
			$_SESSION['update_admin_notif'] = "successful_update_admin";
			redirect(site_url("/update_admin"));
		}

		else{
			$_SESSION['update_admin_notif'] = "error_update_admin";
			redirect(site_url("/update_admin"));
		}
	}

	public function get_admin_data(){
		$admin_username = $_SESSION['admin_username'];
		$data = $this->admin_account_model->get_admin_data($admin_username);
		$new_result = $this->safeguard->str_array_ready_for_display($data);
		$this->load->view('update_admin_view', $new_result);
	}

	public function admin_change_password(){
		$admin_username = $_SESSION['admin_username'];
		$current_password = hash('sha256', filter_var($_POST['currentPassword'], FILTER_SANITIZE_STRING));
		$new_password = hash('sha256', filter_var($_POST['newPassword'], FILTER_SANITIZE_STRING));
		$correct_password = $this->admin_account_model->get_admin_password($admin_username);

		if($current_password == $correct_password){
			$this->admin_account_model->change_admin_password($new_password, $admin_username);
			$_SESSION['change_admin_password_notif'] = "admin_pwd_changed";
			redirect(site_url("/update_admin"));
		}

		else
			$_SESSION['change_admin_password_notif'] = "pwd_not_match";
			redirect(site_url("/update_admin"));
	}

	public function delete_admin($username){

		//admin can only delete other admins
		if($username != $_SESSION['admin_username']){
			$success = $this->admin_account_model->delete_admin($username);
			$result = array('success' => $success);
		}

		else{
			//indicate that the delete failed 
			$result = array('success' => false);
		}
		echo json_encode($result);
	}

	public function get_admins()
	{
		echo json_encode($this->admin_account_model->get_admins($_SESSION['admin_username']));
	}
}