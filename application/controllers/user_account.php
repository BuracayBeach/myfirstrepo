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

	public function usernav() {
		$this->load->view('logged_user_view');
	}

	public function backtologin() {
		redirect(base_url());
	}

	public function login(){
		if (isset($_SESSION['logged_in'])){
			redirect(base_url());
		}
		if($this->checkUserValidity()){	
			$_SESSION['username'] = $_POST['username'];
			$_SESSION['logged_in'] = true;
			$_SESSION['type'] = "admin";
			redirect(base_url());
		}
	}

	public function logout(){
		unset($_SESSION['username']);
		unset($_SESSION['type']);
		unset($_SESSION['logged_in']);

		redirect(base_url());
	}

	private function checkUserValidity(){

		//check if username and password is correct. Return true or false
		//data needed are in the $_POST['username'] and $_POST['password']
		
		$username = $_POST['username'];
		$password = md5($_POST['password']);

		$data = $this->user_account_model->getUser($username);

		if(!$data){
			echo "Error: username: $username does not exists";
			$this->load->view('login_view');	
		}
		
		else{
			if($password == $data['password']){
				return true;
			}
			else{
				echo "Wrong password!";
				$this->load->view('login_view');
			}
		}
	}

	public function create(){
		$this->load->view('create_account_view');
	}

	//Get the info from the create account form.
	//Display in the user info on View_Data.
	public function getUserInfo(){
		$data['username']= $_POST['username'];
		$data['password']= md5($_POST['password']);
		$data['sex']= $_POST['sex'];
		$data['status']= "pending";
		$data['email']= $_POST['email'];
		$data['usertype']= $_POST['usertype'];
		$data['emp_no']= $_POST['emp_no'];
		$data['student_no']= $_POST['student_no'];
		$data['name_first']= $_POST['name_first'];
		$data['name_middle']= $_POST['name_middle'];
		$data['name_last']= $_POST['name_last'];
		$data['mobile_no']= $_POST['mobile_no'];
		$data['course']= $_POST['course'];
		$data['college']= $_POST['college'];
		
		if($this->user_account_model->insertData($data)){
			echo "Account created succesfully";
			// $this->load->view('login_view');
			redirect(base_url());
		}
	}

	//Update the value of the user info.
	public function update(){
		$data['sex']= $_POST['sex'];
		$data['email']= $_POST['email'];
		$data['name_first']= $_POST['name_first'];
		$data['name_middle']= $_POST['name_middle'];
		$data['name_last']= $_POST['name_last'];
		$data['mobile_no']= $_POST['mobile_no'];
		$data['course']= $_POST['course'];
		$data['college']= $_POST['college'];

		$uname = $_SESSION['username'];
		$this->user_account_model->updateData($data, $uname);
		$data=$this->user_account_model->getData($uname);
		$this->load->view('view_data', $data);
	}

	//Check if the current password entered is the same as that of the password in the database.
	public function changePassword(){
		$uname = $_SESSION['username'];
		$new_password= md5($_POST['newPassword']);
		$current_password= md5($_POST['currentPassword']);
		$database_password= $this->user_account_model->getPassword($uname);

		if($database_password==$current_password) {
			$this->user_account_model->updatePassword($new_password, $uname);
			echo "Succesfully changed password";
		} else {
			echo "Current password entered and password in database do not match.";
		}

		$result=$this->user_account_model->getData($uname);
		$this->load->view('view_data', $result);
	}

	//Get the username of the current user
	public function getData() {
		$username = $_SESSION['username'];
		$result=$this->user_account_model->getData($username);
		$this->load->view('update_account_view', $result);
	}
}
?>