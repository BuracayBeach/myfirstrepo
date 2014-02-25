<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
	Author: Billy Joel Arlo T. Zarate
	File Description : This document is the controller of the search module for user accounts
*/
class Enable_disable extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('form');//loads the form helper
		$this->load->library('firephp');
		$this->load->library('pagination');
		

		if(!isset($_SESSION))
			session_start();

		/* start edit by Carl Adrian P. Castueras */

		//restricts this page to admin access
		if(!isset($_SESSION['type']) || $_SESSION['type'] != 'admin')
		{
			header("Location:". base_url());
		}

		/* end edit */
	}

	public function index()
	{
		$this->load->view('header');
		$this->load->view('search_user_view');
		$this->load->view('enable_disable_view');//loads the view
		$this->load->view('footer');
	}

	public function search()
	{
		// Sanitation Author: Cyril Justine D. Bravo
		// Description: Sanitizes queries in the user search
		if(count($_POST) == 0)
		{
			$_POST = $_SESSION['post_temp'];
		}

		// var_dump($_POST);

		$data['field'] = filter_var($_POST["field"],FILTER_SANITIZE_STRING);
		switch($_POST["field"]){
			case "name": {
				$data['fname'] = filter_var($_POST["firstname"],FILTER_SANITIZE_STRING);
				$data['mname'] = filter_var($_POST["middlename"],FILTER_SANITIZE_STRING);
				$data['lname'] = filter_var($_POST["lastname"],FILTER_SANITIZE_STRING);
				break;
			}

			case "stdno": {
				$data['student_no']= filter_var($_POST["studentno"],FILTER_SANITIZE_STRING);
				break;
			}

			case "empno": {
				$data['employee_no']= filter_var($_POST["employeeno"],FILTER_SANITIZE_STRING);
				break;
			}

			case "uname": {
				$data['username'] = filter_var($_POST["username"],FILTER_SANITIZE_STRING);
				break;
			}

			case "email": {
				$data['email'] = filter_var($_POST["emailadd"],FILTER_SANITIZE_STRING);
				break;
			}
		}
		$data['status'] = filter_var($_POST["status"],FILTER_SANITIZE_STRING);
		//End Sanitation Section

		$this->load->model('enable_disable_model');
		$query = $this->enable_disable_model->generateQuery($data);//dynamically generates an sql query based on search option
		$result = $this->enable_disable_model->runQuery($query);//gets the result from the query

		//the number that appears after the enable_disable/search (e.g enable_disable/search/20) in the uri
		$lower_bound = $this->uri->segment(3);

		//maximum number of results per page
		$page_size = 10;

		//declare the necessary configuration for pagination 
		$config['base_url'] = base_url()."enable_disable/search/";
		$config['total_rows'] = count($result);
		$config['per_page'] = $page_size;
		//set-up pagination using the given configuration
		$this->pagination->initialize($config);

		//filter results based on specified page
		$array['result'] = $this->filter_results($result,$lower_bound,$page_size);
		$array['links'] = $this->pagination->create_links();
		//temporarily save the $_POST array to session to paginate without losing the search results
		$_SESSION['post_temp'] = $_POST;
 		$this->load->view('header');						//passes the result to the view 
 		$this->load->view('search_user_view');
		$this->load->view('enable_disable_view', $array);	//loads the view with the results
		$this->load->view('footer');
	}


	/*
		sample ajax call
		$.ajax({
			url : "http://localhost/myfirstrepo/index.php/enable_disable/activate/"+ username +"/" + usertype + "/"+ number + "/" + email,
			type : 'POST',
			dataType : "html",
			async : true,
			success: function(data) {}
		});
				
	*/

	public function activate($username, $usertype, $number, $email)
	{
		/*
			activates a user account
		*/

		$admin = $_SESSION['admin_username'];//hardcoded
		$action = "activate";//hardcoded

		$this->load->model('enable_disable_model');//loads model
		$success = $this->enable_disable_model->activate($username, $usertype, $number, $email);
		if($success)//calls function activate
			$this->enable_disable_model->log($admin, $username, $email, $action);//calls function log from model if activate returns true

		//used for AJAX implementation
		$json = array('success' => $success);
		echo json_encode($json);
	}

	/*
		sample ajax call
		$.ajax({
			url : "http://localhost/myfirstrepo/index.php/enable_disable/disable/"+ username +"/"+ student_no + "/" + email,
			type : 'POST',
			dataType : "html",
			async : true,
			success: function(data) {}
		});
	*/

	public function enable($username, $email)
	{
		/*
			enables a user account
		*/
		$admin = $_SESSION['admin_username'];//hardcoded
		$action = "enable";//hardcoded

		$this->load->model('enable_disable_model');//loads model
		$success = $this->enable_disable_model->enable($username, $email);
		if($success)//calls function enable from model
			$this->enable_disable_model->log($admin, $username, $email, $action);//calls function log from model if enable returns true
		
		//return value for AJAX implementation
		$json = array('success' => $success);
		echo json_encode($json);
	}

	/*
		sample ajax call
		$.ajax({
			url : "http://localhost/myfirstrepo/index.php/enable_disable/enable/"+ username +"/"+ student_no + "/" + email,
			type : 'POST',
			dataType : "html",
			async : true,
			success: function(data) {}
		});
	*/

	public function disable($username, $email)
	{
		/*
			disables a user account
		*/
		$admin = $_SESSION['admin_username'];//hardcoded
		$action = "disable";//hardcoded

		$this->load->model('enable_disable_model');//loads model
		$success = $this->enable_disable_model->disable($username, $email);
		if($success)//calls function disable from model
			$this->enable_disable_model->log($admin, $username, $email, $action);//calls function log from model if disable returns true
		
		//return value for AJAX implementation
		$json = array('success' => $success);
		echo json_encode($json);
	}

	/* start edit by Carl Adrian P. Castueras */

	/* 
		sample AJAX Call
		$.ajax({
			url : "get_log/",
			type : 'POST',
			dataType : "html",
			async : true,
			success: function(data) {}
	*/

	public function get_log()
	{
		$this->load->model('enable_disable_model');
		$page_count = 1;
		$log_result = $this->enable_disable_model->get_log($_POST['page'], $page_count);

		echo json_encode($log_result);
	}

	public function init_pagination(){
		
	}

	/*
		parameters :
		$array -> the array to filter
		$lower_bound -> the minimum index to include in the filtered array
		$size -> the maximum number of results to include in the filtered array
	*/
	private function filter_results($array,$lower_bound,$size)
	{
		$filtered_array = array();

		//get the maximum index in the array of results
		$max_index = count($array);
		//calculate the upper bound by adding the page size to the lower bound
		$upper_bound = $lower_bound + $size;

		//if the page has less results than the declared page size, limit the upper bound to the max index
		if ($upper_bound >  $max_index)	$upper_bound = $max_index;

		//filter the array based on the constraints
		for($i=$lower_bound;$i<$upper_bound;$i+=1)
		{
			$filtered_array[$i] = $array[$i];
		}

		return $filtered_array;
	}

	/* end edit */
}

/* End of file enable_disable.php */
/* Location: ./application/controllers/enable_disable.php */