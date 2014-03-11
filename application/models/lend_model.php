<?php if ( ! defined('BASEPATH')) exit('Unauthorized access.');

class Lend_Model extends CI_Model {

	public function get($username) {

		$q = $this->db->query("SELECT l.book_no, b.book_title, l.date_borrowed FROM lend l, book b WHERE
							l.username_user = '{$username}' AND
							l.book_no LIKE b.book_no AND
							l.date_returned IS NULL");
		return $q->result();
	}
	
	public function get_lend() {
		$q = $this->db->query("SELECT username_user, book_no FROM lend WHERE date_returned IS NULL");

		if ($q->num_rows() > 0)
			return $q->result();
	}
}

?>