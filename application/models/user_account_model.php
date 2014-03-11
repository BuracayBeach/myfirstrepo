<?php if ( ! defined('BASEPATH')) exit('Unauthorized access.');

class User_account_model extends CI_Model {
	function __construct(){
		parent::__construct(); //super sa java
		$this->load->database(); //connect to database
	}

	//Insert data into database.
	public function insert_data($data){
		$query = $this->db->query("SELECT * FROM user WHERE ( username='{$data['username']}' OR email='{$data['email']}' OR ( student_no='{$data['student_no']}' AND emp_no='{$data['emp_no']}' ) ) ");

		if($query->num_rows() == 0){
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
				'{$data['mobile_no']}',
				'{$data['course']}',
				'{$data['college']}')");
			return true;
		} 

		else {
			$query_rows = $query->result();
            $data_exists_notif = '';
			foreach($query_rows as $row){
				if ($data['username'] == $row->username) $data_exists_notif .=  ' username';
				if ($data['email'] == $row->email) $data_exists_notif .= ' email';
				if ($data['usertype'] == "student" && $data['student_no'] == $row->student_no) $data_exists_notif .= ' student_no';
				if ($data['usertype'] == "employee" && $data['emp_no'] == $row->emp_no) $data_exists_notif .= ' emp_no';
			}
			
			$_SESSION['create_account_notif'] = $data_exists_notif;
			return false;
		}
	}

	//Update info in the database.
	public function update_data($data, $uname){
		$query = $this->db->query("SELECT * FROM user WHERE email='{$data['email']}' ");

		if($query->num_rows() == 0 || ($query->num_rows() == 1 && $query->result_array()[0]['username'] == $uname)) {
			$this->db->query("UPDATE user SET 
				sex='{$data['sex']}',
				email='{$data['email']}',
				name_first='{$data['name_first']}',
				name_middle='{$data['name_middle']}',
				name_last='{$data['name_last']}',
				mobile_no='{$data['mobile_no']}',
				course='{$data['course']}',
				college='{$data['college']}' WHERE username='{$uname}'");
			return true;
		}

		else
			return false;
	}
	
	//Update the password
	public function update_password($new_password, $uname){
		$this->db->query("UPDATE user SET password='{$new_password}' where username='{$uname}'");
	}

	//Get the password of the user.
	public function get_password($uname) {
		$query=$this->db->query("SELECT password FROM user WHERE username='{$uname}'");
		$result = $query->result_array();
		return $result[0]['password'];
	}

	//Get data from the user
	public function get_data($uname) {
		$query=$this->db->query("SELECT * FROM user WHERE username='{$uname}'");
		$result = $query->result_array();
		return $result[0];
	}

	public function get_user($username){
		$query = $this->db->query("SELECT * FROM user WHERE username='{$username}'");

		if($query->num_rows() == 0)
			return false;

		if($query->result_array()[0]['status'] == "pending"){
			$_SESSION['login_notif'] = "pending";
			return "pending";
		}

		else if($query->result_array()[0]['status'] == "disabled"){
			$_SESSION['login_notif'] = "deactivated";
			return "deactivated";
		}

		else if($query->num_rows() == 1 && $query->result_array()[0]['status'] == "enabled"){
			$result = $query->result_array();
			$data['username'] = $result[0]['username'];
			$data['password'] = $result[0]['password'];
			return $data;
		}

		else return false;
	}
}
