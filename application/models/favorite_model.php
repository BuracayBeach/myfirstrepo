<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Favorite_Model extends CI_Model {

	public function get_all($username) {

		$q = $this->db->query("SELECT f.date_added, b.book_title, b.book_no
							FROM favorites f, book b
							WHERE f.username = '{$username}' AND
							f.book_no = b.book_no
							GROUP BY f.book_no");
		return $q->result();
	}
	
	public function add($data) {

		$this->db->insert('favorites', $data);
		return;
	}

	public  function remove($data) {	

		$this->db->delete('favorites', $data);
		return;
	}

	public function check($data) {

		$this->db->where($data);
		$q = $this->db->get('favorites');

		if ($q->num_rows() == 0)
			return false;
		else
			return true;
	}
}

?>