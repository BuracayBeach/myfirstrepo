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
		$page_size = filter_var($_POST["pagesize"],FILTER_SANITIZE_STRING);

		$filtered_results['results'] = $this->filter_results($result,$lower_bound,$page_size);
		$result_count = count($result);
		$num_pages = floor($result_count / $page_size);
		if($result_count % $page_size > 0) $num_pages++;
		$filtered_results['search_details']  = array('num_pages' => $num_pages,'page_size' => $page_size);
		echo json_encode($filtered_results);
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
		//$i -> indexing of the original array (may not start from 0)
		//$j -> indexing of the filtered array (should start from 0)
		for($i=$lower_bound,$j=0;$i<$upper_bound;$i+=1,$j+=1)
		{
			$filtered_array[$j] = $array[$i];
		}

		return $filtered_array;
	}

	/* end edit */
}

/* End of file enable_disable.php */
/* Location: ./application/controllers/enable_disable.php */