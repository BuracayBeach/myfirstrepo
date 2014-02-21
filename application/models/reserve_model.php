<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reserve_Model extends CI_Model {

	public function remove($data) {
	
		$this->db->where($data);
		$this->db->delete('reserves');
	}

	public function dequeue($book_no) {

		$q = $this->db->query("SELECT * FROM reserves WHERE
				rank = (SELECT min(rank) FROM reserves) AND 
				book_no LIKE '{$book_no}'");

		if ($q->num_rows() == 0)
			return false;
		
		else {

			$rank = $this->db->query("SELECT min(rank) AS rank FROM reserves WHERE book_no LIKE '{$book_no}'");
			$this->db->query("DELETE FROM reserves WHERE
				rank = {$rank->result()->rank} AND book_no LIKE '{$book_no}'");

			return $q;
		}
	}

	public function enqueue($data) {
		$this->db->insert('reserves', $data);
	}

	public function status_reserved($book_no) {
		$this->db->query("UPDATE book SET status = 'reserved' WHERE book_no LIKE '{$book_no}'");
	}

	public function status_update($book_no) {
		$reserves = $this->db->query("SELECT COUNT(*) FROM reserves WHERE book_no LIKE '{$book_no}'");
		$lend = $this->db->query("SELECT COUNT(*) FROM lend WHERE book_no LIKE '{$book_no}'");

		if ($lend->result() == 1)
			$this->db->query("UPDATE book SET status = 'borrowed' WHERE book_no LIKE '{$book_no}'");
		else if ($reserves->result() == 0 && $lend->result() == 0)
			$this->db->query("UPDATE book SET status = 'available' WHERE book_no LIKE '{$book_no}'");
		else if ($reserves->result() > 0 && $lend->result() == 0)
			$this->db->query("UPDATE book SET status = 'reserved' WHERE book_no LIKE '{$book_no}'");
	}

	public function get($username) {

		$q = $this->db->query("SELECT book_no FROM reserves WHERE username LIKE '{$username}'");
		return $q->result();
	}

	public function check($data) {

		$this->db->where($data);
		$q = $this->db->get('reserves');

		if ($q->num_rows() == 0)
			return false;
		else
			return true;
	}
}

?>