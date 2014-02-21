<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

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
}
?>