

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_account extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('user_account_model');
		$this->load->library('safeguard');
	}

	//Index page
	public function index() {

		$this->load->view('login_view');
	}

	public function backtohome() {
		redirect(base_url());
	}

	public function create_account(){
		$this->load->view('create_account_view');
	}

	public function log_in(){
		$this->load->view('login_view2');
	}

	public function update_account(){
		$this->get_data();
	}

	public function registration_pending(){
		$this->load->view('user_pending');
	}

	public function account_deactivated(){
		$this->load->view('user_deactivated');
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

		if(isset($_SESSION['login_notif']) && $_SESSION['login_notif'] == "pending"){
			$this->registration_pending();
			unset($_SESSION['login_notif']);
		}

		else if(isset($_SESSION['login_notif']) && $_SESSION['login_notif'] == "deactivated"){
			$this->account_deactivated();
			unset($_SESSION['login_notif']);
		}

		else{
			redirect(base_url());	
		}
	}

	private function check_user_validity(){
		$username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
		$password = hash('sha256', filter_var($_POST['password'], FILTER_SANITIZE_STRING));

		$result = $this->user_account_model->get_user($username);

		if($result == "pending")
			return false;

		else if ($result == "deactivated")
			return false;

		else if(!$result){
			$_SESSION['login_notif'] = "not_exists";
			return false;
		}
		
		else{
			if($password == $result['password']){
				return true;
			}
			else{
				$_SESSION['login_notif'] = "wrong_password";		
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
			//$this->send_mail($new_data);
			$this->load->view('create_account_successful');
		}

		else{
			redirect(base_url() . "create_account");
		}
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
			$_SESSION['update_account_notif'] = "account_updated";
			redirect(site_url("update_account"));
		}

		else{
			$_SESSION['update_account_notif'] = "email";
			redirect(site_url("update_account"));
		}
	}

	//Check if the current password entered is the same as that of the password in the database.
	public function change_password(){
		$uname = $_SESSION['username'];
		$new_password= hash('sha256', filter_var($_POST['newpassword'], FILTER_SANITIZE_STRING));
		$current_password= hash('sha256', filter_var($_POST['currentpassword'], FILTER_SANITIZE_STRING));
		$database_password = $this->user_account_model->get_password($uname);

		if($database_password==$current_password) {
			$this->user_account_model->update_password($new_password, $uname);
			$_SESSION['change_password_notif'] = "password_changed";
			redirect(site_url("update_account"));	
		} else {
			$_SESSION['change_password_notif'] = "pass";
			redirect(site_url("update_account"));	
		}
	}

	//Get the username of the current user
	public function get_data() {
		$username = $_SESSION['username'];
		$result=$this->user_account_model->get_data($username);
		$new_result = $this->safeguard->str_array_ready_for_display($result);
		$this->load->view('update_account_view', $new_result);
	}

	public function send_mail($data){
		$config = Array(
				'protocol' => 'smtp',
				'smtp_host' => 'ssl://smtp.gmail.com',
				'smtp_port' => 465,
				'smtp_user' => 'icscomlib@gmail.com',  		
				'smtp_pass' => '1csc0ml1b',		
				'mailtype'  => 'html', 
				'charset'   => 'iso-8859-1'
			);
		
		$this->load->library('email', $config);
		$this->email->from('icscomlib@gmail.com', 'ICS ComLib');
		$this->email->to($data['email']);
		$this->email->subject("Welcome to the ICS ComLib {$data['username']}");
		$this->email->message("Please wait for your account to be activated by the admin before you can use our services.");	
		$this->email->send();
	}
}
?>