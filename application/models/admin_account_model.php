<?php if ( ! defined('BASEPATH')) exit('Unauthorized access.');

class Admin_account_model extends CI_Model {
	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	public function get_admin($username){
		$query = $this->db->query("SELECT * FROM admin WHERE username='{$username}'");
			
		if($query->num_rows() == 1){
			$result = $query->result_array();
			$data['username'] = $result[0]['username'];
			$data['password'] = $result[0]['password'];
			return $data;
		}

		else return false;
	}

	public function insert_admin($data){
		$query = $this->db->query("SELECT * FROM admin WHERE username='{$data['username']}'");
		
		if($query->num_rows() == 0){
			$this->db->query("INSERT INTO admin VALUES (
				'{$data['name_first']}',
				'{$data['name_middle']}',
				'{$data['name_last']}',
				'{$data['username']}',
				'{$data['password']}')");
			return true;
		}

		return false;
	}

	public function update_admin($data, $username){
		$this->db->query("UPDATE admin SET 
				name_first='{$data['name_first']}',
				name_middle='{$data['name_middle']}',
				name_last='{$data['name_last']}'
				WHERE username='{$username}'");
		return true;
	}

	public function get_admin_data($username){
		$query=$this->db->query("SELECT * FROM admin WHERE username='{$username}'");
		$result = $query->result_array();
		return $result[0];
	}

	public function get_admin_password($username){
		$query=$this->db->query("SELECT * FROM admin WHERE username='{$username}'");
		$result = $query->result_array()[0]['password'];
		return $result;
	}

	public function change_admin_password($new_password, $username){
		$this->db->query("UPDATE admin SET password='{$new_password}' where username='{$username}'");
	}

	public function delete_admin($username){

		$this->db->query("DELETE FROM admin WHERE username LIKE '{$username}'");
		//should return TRUE if a row was deleted successfully
		if($this->db->affected_rows() == 1) return true;
		//once the same row is already deleted, return false
		else return false;
	}

	public function get_admins($admin_name)
	{
		//fetch all admins except the logged admin
		return $this->db->query("SELECT * FROM admin WHERE username NOT LIKE '{$admin_name}' ORDER BY username")->result();
	}
}
