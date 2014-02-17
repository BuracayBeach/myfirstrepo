<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Notifs_Model extends CI_Model {

	public function get_all($username) {

		$this->db->where('username', $username);
		$q = $this->db->get('notifications');

		if (q->num_rows() > 0)
			return $q->result();
		else return null;
	}

	public function add_notif($data) {

		$this->db->insert('notifications', $data);
		return;
	}
}

?>