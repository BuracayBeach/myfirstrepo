<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Notifs_Model extends CI_Model {

	public function get_all($username) {


		$q = $this->db->query("SELECT n.type, n.date_sent, n.message,
									  n.username_admin, b.book_title
							FROM book b, notifications n WHERE 
							n.username_user = '{$username}' AND
							b.book_no = n.book_no = b.book_no
							GROUP BY n.username_user;");

		if ($q->num_rows() > 0)
			return $q->result();
		else return null;
	}

}

?>