<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reserve extends CI_Controller {

	public function __construct() {
		parent:: __construct();
		$this->load->model('reserve_model');

		date_default_timezone_set("Asia/Manila");

		if (!isset($_SESSION))
			session_start();
	}

	public function remove() {
	
		$info = $this->input->post('arr');

		$data = array (
			'username' => $_SESSION['username'],
			'book_no' => $info[0]
		);
		
		$this->reserve_model->remove($data);
	}

	public function dequeue($book_no) {

		$q = $this->reserve_model->dequeue($book_no);
		echo json_encode($q);
	}
	
	public function add() {

		$info = $this->input->post('arr');

		$data = array(
				'username' => $_SESSION['username'],
				'book_no' => $info[0],
				'date_reserved' => date('Y-m-d H:i:s'),
				'notified' => 0
			);

		$this->reserve_model->enqueue($data);
	}
	
	public function check($username, $book_no) {
		$data = array(
				'username' => $username,
				'book_no' => $book_no
			);

		$result = $this->reserve_model->check($data);
		echo json_encode($result);
	}

	public function view_by_username($username) {
		$q = $this->reserve_model->get($username);
		echo json_encode($q);
	}

}

?>