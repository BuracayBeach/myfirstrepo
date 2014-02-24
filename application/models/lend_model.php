<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lend_Model extends CI_Model {

	public function get($username) {

		$q = $this->db->query("SELECT book_no FROM lend WHERE username_user = '{$username}'");
		return $q->result();
	}
	
}

?>