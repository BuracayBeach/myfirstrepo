<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Notifs extends CI_Controller {

	public function __construct() {
		parent:: __construct();
		date_default_timezone_set("Asia/Manila");
		$this->load->model('notifs_model');
		$this->load->helper('form');

		if (isset($_SESSION))
			session_start();
	}

	public function index() {
		$data['notifs'] = $this->notifs_model->get_all('username');
		$this->load->view('notifications_view', $data);

		$this->load->view('notifications_custom_view');

		////////////////////////
//		while(true){
//		    $this->send_custom_notif();
//		    sleep( 5 );
//		}
		
	}

	public function view_by_username($username) {

		$q = $this->notifs_model->get_all($username);
		echo json_encode($q);
	}

	public function check_overdue() {
		$q = $this->notifs_model->check_unreturned();
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

	public function send_claim_notif($book_no, $username, $admin) {

		$data = array (
				'username_admin' => $admin,
				'username_user' => $username,
				'book_no' => $book_no,
				'message' => "You may now claim your book ASAP",
				'date_sent' => date('Y-m-d H:i:s'),
				'type' => 'claim'
			);

		$this->notif_model->add_notif($data);
	}
}	

?>