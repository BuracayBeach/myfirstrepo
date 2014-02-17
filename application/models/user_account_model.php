<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_account_model extends CI_Model {
	function __construct(){
		parent::__construct(); //super sa java
		$this->load->database(); //connect to database
	}

	//Insert data into database.
	public function insertData($data){
		$this->db->query("INSERT INTO user VALUES (
			'{$data['username']}',
			'{$data['password']}',
			'{$data['sex']}',
			'{$data['status']}',
			'{$data['email']}',
			'{$data['usertype']}',
			'{$data['emp_no']}',
			'{$data['student_no']}',
			'{$data['name_first']}',
			'{$data['name_middle']}',
			'{$data['name_last']}',
			{$data['mobile_no']},
			'{$data['course']}',
			'{$data['college']}')");
		return true;
	}

	//Update info in the database.
	public function updateData($data, $uname){
		$this->db->query("UPDATE user SET 
			sex='{$data['sex']}',
			email='{$data['email']}',
			name_first='{$data['name_first']}',
			name_middle='{$data['name_middle']}',
			name_last='{$data['name_last']}',
			mobile_no={$data['mobile_no']},
			course='{$data['course']}',
			college='{$data['college']}' WHERE username='{$uname}'");
	}
	
	//Update the password
	public function updatePassword($new_password, $uname){
		$this->db->query("UPDATE user SET password='{$new_password}' where username='{$uname}'");
	}

	//Get the password of the user.
	public function getPassword($uname) {
		$query=$this->db->query("SELECT password FROM user WHERE username='{$uname}'");
		foreach ($query->result_array() as $result) {}
		return $result['password'];
	}

	//Get data from the user
	public function getData($uname) {
		$query=$this->db->query("SELECT * FROM user WHERE username='{$uname}'");
		foreach ($query->result_array() as $result) {}
		return $result;
	}

	public function getUser($username){
		$query = $this->db->query("SELECT * FROM user WHERE username='{$username}'");
			
		if($query->num_rows() == 1){
			$result = $query->result_array();
			$data['username'] = $result[0]['username'];
			$data['password'] = $result[0]['password'];
			return $data;
		}

		else return false;
	}
}
?>