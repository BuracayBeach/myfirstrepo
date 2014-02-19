<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_account extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('user_account_model');
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
	}

	private function check_user_validity(){
		$username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
		$password = md5(filter_var($_POST['password'], FILTER_SANITIZE_STRING));

		$data = $this->user_account_model->get_user($username);

		if(!$data){
			$_SESSION['notif_login'] = "Username does not exist!";
		}
		
		else{
			if($password == $data['password']){
				return true;
			}
			else{
				$_SESSION['notif_login'] = "Incorrect password!";
			}
		}
	}

	public function logout(){
		unset($_SESSION['username']);
		unset($_SESSION['type']);
		unset($_SESSION['logged_in']);
		unset($_SESSION['notifs']);

		redirect(base_url());
	}

	public function createaccount(){
		$data['username']= filter_var($_POST['username'], FILTER_SANITIZE_STRING);
		$data['password']= md5(filter_var($_POST['password'], FILTER_SANITIZE_STRING));
		$data['sex']= filter_var($_POST['sex'], FILTER_SANITIZE_STRING);
		$data['status']= "pending";
		$data['email']= filter_var($_POST['email'], FILTER_SANITIZE_STRING);
		$data['usertype']= filter_var($_POST['usertype'], FILTER_SANITIZE_STRING);
		$data['emp_no']= filter_var($_POST['emp_no'], FILTER_SANITIZE_STRING);
		$data['student_no']= filter_var($_POST['student_no'], FILTER_SANITIZE_STRING);
		$data['name_first']= filter_var($_POST['name_first'], FILTER_SANITIZE_STRING);
		$data['name_middle']= filter_var($_POST['name_middle'], FILTER_SANITIZE_STRING);
		$data['name_last']= filter_var($_POST['name_last'], FILTER_SANITIZE_STRING);
		$data['mobile_no']= filter_var($_POST['mobile_no'], FILTER_SANITIZE_STRING);
		$data['course']= filter_var($_POST['course'], FILTER_SANITIZE_STRING);
		$data['college']= filter_var($_POST['college'], FILTER_SANITIZE_STRING);

		$result = $this->user_account_model->insert_data($data);

		if($result){
			$_SESSION['notif_create_account'] = "Succesfully created account!";
			$this->backtohome();
		}

		else
			$this->backtohome();	
	}

	//Update the value of the user info.
	public function update(){
		$data['sex']= filter_var($_POST['sex'], FILTER_SANITIZE_STRING);
		$data['email']= filter_var($_POST['email'], FILTER_SANITIZE_STRING);
		$data['name_first']= filter_var($_POST['name_first'], FILTER_SANITIZE_STRING);
		$data['name_middle']= filter_var($_POST['name_middle'], FILTER_SANITIZE_STRING);
		$data['name_last']= filter_var($_POST['name_last'], FILTER_SANITIZE_STRING);
		$data['mobile_no']= filter_var($_POST['mobile_no'], FILTER_SANITIZE_STRING);
		$data['course']= filter_var($_POST['course'], FILTER_SANITIZE_STRING);
		$data['college']= filter_var($_POST['college'], FILTER_SANITIZE_STRING);

		$uname = $_SESSION['username'];
		$result = $this->user_account_model->update_data($data, $uname);
		
		if($result){
			$_SESSION['notif_update_account'] = "Succesfully updated account";
			$this->get_data();
		}

		else{
			$_SESSION['notif_update_account'] = "Email exists";
			$this->get_data();
		}
	}

	//Check if the current password entered is the same as that of the password in the database.
	public function change_password(){
		$uname = $_SESSION['username'];
		$new_password= md5(filter_var($_POST['newPassword'], FILTER_SANITIZE_STRING));
		$current_password= md5(filter_var($_POST['currentPassword'], FILTER_SANITIZE_STRING));
		$database_password = $this->user_account_model->get_password($uname);

		if($database_password==$current_password) {
			$_SESSION['notif_change_password'] = "Succesfully changed password!";
			$this->user_account_model->update_password($new_password, $uname);
			$this->get_data();
		} else {
			$_SESSION['notif_change_password'] = "Password does not match";
			$this->get_data();
		}
	}

	//Get the username of the current user
	public function get_data() {
		$username = $_SESSION['username'];
		$result=$this->user_account_model->get_data($username);
		$this->load->view('update_account_view', $result);
	}
}
?>