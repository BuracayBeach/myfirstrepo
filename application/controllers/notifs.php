<?php if ( ! defined('BASEPATH')) exit('Unauthorized access.');

class Notifs extends CI_Controller {

	public function __construct() {
		parent:: __construct();
		date_default_timezone_set("Asia/Manila");
		$this->load->model('notifs_model');
		$this->load->helper('form');
	}

	public function index() {
		$data['notifs'] = $this->notifs_model->get_all('username');
		$this->load->view('notifications_view', $data);

		$this->load->view('notifications_custom_view');
	}

	public function view_by_username($offset) {

		$q = $this->notifs_model->get_all($_SESSION['username'], $offset);
		echo json_encode($q);
	}

	public function check_reserve_for_first() {

		/* $info[0] is the book_no */
		$info = $this->input->post('arr');
		$username = $this->notifs_model->check_for_first($info[0]);

		if ($username != "")
			$this->send_claim_notif($info[0], $username);
	}

	public function send_custom_notif() {
		$data = array (
				'username_admin' => $_SESSION['admin_username'],
				'username_user' => $_POST['username'],
				'message' => $_POST['message'],
				'date_sent' => date('Y-m-d H:i:s'),
				'type' => 'custom'
			);

		$this->notifs_model->add_notif($data);
		header('location:' . base_url());
	}

	public function send_claim_notif($book_no, $username) {

		$data = array (
				'username_admin' => "",
				'username_user' => $username,
				'book_no' => $book_no,
				'message' => "",
				'date_sent' => date('Y-m-d H:i:s'),
				'type' => 'claim'
			);

		$this->notifs_model->add_notif($data);
	}
}	
