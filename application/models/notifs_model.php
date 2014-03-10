<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Notifs_Model extends CI_Model {

	public function get_all($username, $offset) {

		$q = $this->db->query("SELECT n.type, n.date_sent, n.message, n.username_admin, b.book_title
							FROM book b, notifications n
							WHERE n.username_user = '{$username}'
							AND (n.book_no = b.book_no OR n.book_no IS NULL)
							GROUP BY n.id DESC LIMIT {$offset}, 5");

		if ($q->num_rows() > 0)
			return $q->result();
		else return null;
	}

	public function count_by_username($username) {
		$count = $this->db->query("SELECT COUNT(*) count FROM notifications WHERE username_user = '{$username}'");
		$count = $count->row_array();

		return $count['count'];
	}

	public function add_notif($data) {

		if ($this->check_user_if_exist($data['username_user']) != 0)
			$this->db->insert('notifications', $data);

		return;
	}

	public function check_user_if_exist($username) {
		$count = $this->db->query("SELECT COUNT(*) count FROM user WHERE username LIKE '{$username}'");
		$count = $count->row_array();

		return $count['count'];
	}

	public function get_unreturned() {
		$q = $this->db->query("SELECT book_no, username_user, date_borrowed FROM lend WHERE
						date_returned IS NULL");

		if ($q->num_rows() == 0)
			return "";
		else return $q->result();
	}

	public function get_unreturned_by_user($username) {
		$q = $this->db->query("SELECT book_no, date_borrowed FROM lend WHERE
						date_returned IS NULL AND
						username_user LIKE '{$username}'");

		if ($q->num_rows() == 0)
			return "";
		else return $q->result();
	}


	public function check_for_first($book_no) {

		$reserves = $this->db->query("SELECT username, notified FROM reserves WHERE 
								book_no LIKE '{$book_no}' AND
								rank LIKE (SELECT min(rank) FROM reserves WHERE 
											book_no LIKE '{$book_no}')");

		if ($reserves->num_rows() == 0)
			return "";
		else $reserves = $reserves->result();

		$lend = $this->db->query("SELECT COUNT(*) count FROM lend WHERE
							book_no LIKE '{$book_no}' AND
							date_returned IS NULL");
		$lend = $lend->row_array();

		if ($lend['count'] == 0 && $reserves[0]->notified == 0) {

			$rank = $this->db->query("SELECT min(rank) AS rank FROM reserves WHERE 
											book_no LIKE '{$book_no}'");
			$this->db->query("UPDATE reserves 
							SET notified = 1 WHERE
							book_no LIKE '{$book_no}' AND
							rank = {$rank->row()->rank}");
			return $reserves[0]->username;
		}		
		else return "";
	}

}