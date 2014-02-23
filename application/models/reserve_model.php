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
				rank = {$rank->row()->rank} AND book_no LIKE '{$book_no}'");

			return $q;
		}
	}

	public function enqueue($data) {
		$this->db->insert('reserves', $data);
	}

	public function status_reserved($book_no) {
		$lend = $this->db->query("SELECT COUNT(*) count FROM lend WHERE book_no LIKE '{$book_no}'");
		$lend = $lend->row_array();

		if ($lend['count'] != 1)
			$this->db->query("UPDATE book SET status = 'reserved' WHERE book_no LIKE '{$book_no}'");
	}

	public function status_update($book_no) {
		$reserves = $this->db->query("SELECT COUNT(*) count FROM reserves WHERE book_no LIKE '{$book_no}'");
		$lend = $this->db->query("SELECT COUNT(*) count FROM lend WHERE book_no LIKE '{$book_no}'");

		$reserves = $reserves->row_array();
		$lend = $lend->row_array();

		if ($lend['count'] == 1)
			$this->db->query("UPDATE book SET status = 'borrowed' WHERE book_no LIKE '{$book_no}'");
		else if ($reserves['count'] == 0 && $lend['count'] == 0)
			$this->db->query("UPDATE book SET status = 'available' WHERE book_no LIKE '{$book_no}'");
		else if ($reserves['count'] > 0 && $lend['count'] == 0)
			$this->db->query("UPDATE book SET status = 'reserved' WHERE book_no LIKE '{$book_no}'");
	}

	public function get($username) {

		$q = $this->db->query("SELECT r.date_reserved, b.book_title, b.book_no, r.rank
						FROM reserves r, book b
						WHERE r.username = '{$username}' AND
						r.book_no = b.book_no
						GROUP BY b.book_no");

		return $q->result();
	}

	public function check_book_ranks($username) {

		$q = $this->db->query("SELECT rank, book_no FROM reserves ORDER BY book_no, rank");
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