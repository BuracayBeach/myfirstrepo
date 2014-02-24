<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_account extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('user_account_model');
		$this->load->library('safeguard');
		if(!isset($_SESSION))
			session_start();
	}

	//Index page
	public function index() {
		if(!isset($_SESSION))
			session_start();

		$this->load->view('login_view');
	}

	public function backtohome() {
		redirect(base_url());
	}

	public function create_account(){
		$this->load->view('create_account_view');
	}

	public function update_account(){
		$this->get_data();
	}

	public function login(){
		if (isset($_SESSION['logged_in'])){
			redirect(base_url());
		}
		
		if($this->check_user_validity()){	
			$_SESSION['username'] = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
			$_SESSION['logged_in'] = true;
			$_SESSION['type'] = "regular";
			redirect(base_url());
		}

		else
			redirect(base_url());	
	}

	private function check_user_validity(){
		$username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
		$password = hash('sha256', filter_var($_POST['password'], FILTER_SANITIZE_STRING));

		$data = $this->user_account_model->get_user($username);

		if(!$data){
			$user_notif['login_notif'] = "Username does not exist!";
			return false;
		}
		
		else{
			if($password == $data['password']){
				return true;
			}
			else{
				$user_notif['login_notif'] = "Password does not match!";		
				return false;
			}
		}
	}

	public function logout(){
		unset($_SESSION['username']);
		unset($_SESSION['type']);
		unset($_SESSION['logged_in']);
		session_destroy();

		redirect(base_url());
	}

	public function createaccount(){
		$data['username']= filter_var($_POST['username'], FILTER_SANITIZE_STRING);
		$data['password']= hash('sha256', filter_var($_POST['password'], FILTER_SANITIZE_STRING));
		$data['sex']= filter_var($_POST['sex'], FILTER_SANITIZE_STRING);
		$data['status']= "pending";
		$data['email']= filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
		$data['usertype']= filter_var($_POST['usertype'], FILTER_SANITIZE_STRING);
		$data['emp_no']= filter_var($_POST['emp_no'], FILTER_SANITIZE_STRING);
		$data['student_no']= filter_var($_POST['student_no'], FILTER_SANITIZE_STRING);
		$data['name_first']= filter_var($_POST['name_first'], FILTER_SANITIZE_STRING);
		$data['name_middle']= filter_var($_POST['name_middle'], FILTER_SANITIZE_STRING);
		$data['name_last']= filter_var($_POST['name_last'], FILTER_SANITIZE_STRING);
		$data['mobile_no']= filter_var($_POST['mobile_no'], FILTER_SANITIZE_STRING);
		$data['course']= filter_var($_POST['course'], FILTER_SANITIZE_STRING);
		$data['college']= filter_var($_POST['college'], FILTER_SANITIZE_STRING);

		$new_data = $this->safeguard->array_ready_for_query($data);
		$result = $this->user_account_model->insert_data($new_data);

		if($result){
			$user_notif['create_account_notif'] = "Succesfully created account!";
			$this->backtohome();
		}

		else
			$user_notif['create_account_notif'] = "Failed in creating account!";
			redirect(site_url("user_account/create_account"));
	}

	//Update the value of the user info.
	public function update(){
		$data['sex']= filter_var($_POST['sex'], FILTER_SANITIZE_STRING);
		$data['email']= filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
		$data['name_first']= filter_var($_POST['name_first'], FILTER_SANITIZE_STRING);
		$data['name_middle']= filter_var($_POST['name_middle'], FILTER_SANITIZE_STRING);
		$data['name_last']= filter_var($_POST['name_last'], FILTER_SANITIZE_STRING);
		$data['mobile_no']= filter_var($_POST['mobile_no'], FILTER_SANITIZE_STRING);
		$data['course']= filter_var($_POST['course'], FILTER_SANITIZE_STRING);
		$data['college']= filter_var($_POST['college'], FILTER_SANITIZE_STRING);

		$uname = $_SESSION['username'];
		$new_data = $this->safeguard->array_ready_for_query($data);
		$result = $this->user_account_model->update_data($new_data, $uname);
		
		if($result){
			$user_notif['update_account_notif'] = "Succesfully updated account!";
			redirect(site_url("update_account"));
		}

		else{
			$user_notif['update_account_notif'] = "Email already exist!";
			redirect(site_url("update_account"));
		}
	}

	//Check if the current password entered is the same as that of the password in the database.
	public function change_password(){
		$uname = $_SESSION['username'];
		$new_password= hash('sha256', filter_var($_POST['newPassword'], FILTER_SANITIZE_STRING));
		$current_password= hash('sha256', filter_var($_POST['currentPassword'], FILTER_SANITIZE_STRING));
		$database_password = $this->user_account_model->get_password($uname);

		if($database_password==$current_password) {
			$user_notif['change_password_notif'] = "Succesfully changed password!";
			$this->user_account_model->update_password($new_password, $uname);
			redirect(site_url("user_account/update_account"));	
		} else {
			$user_notif['change_password_notif'] = "Password does not match";
			redirect(site_url("user_account/update_account"));	
		}
	}

	//Get the username of the current user
	public function get_data() {
		$username = $_SESSION['username'];
		$result=$this->user_account_model->get_data($username);
		$new_result = $this->safeguard->str_array_ready_for_display($result);
		$this->load->view('update_account_view', $new_result);
	}
}
?>