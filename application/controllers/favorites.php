<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Favorites extends CI_Controller {

	public function __construct() {
		parent:: __construct();
		$this->load->model('favorites_model');

		date_default_timezone_set("Asia/Manila");

		if (!isset($_SESSION))
			session_start();
	}

	public function get_all($username) {

		$data = $this->favorites_model->get_all($username);
		echo json_encode($data);
	}

	public function add() {

		$info = $this->input->post('arr');

		$data = array (
					'username' => $_SESSION['username'],
					'book_no' => $info[0],
					'date_added' => date('Y-m-d H:i:s')
				);	
		
		$this->favorites_model->add($data);
	}

	public function remove() {

		$info = $this->input->post('arr');

		$data = array (
					'username' => $_SESSION['username'],
					'book_no' => $info[0]
				);

		$this->favorites_model->remove($data);
	}

	public function check($username, $book_no) {
		$data = array(
				'username' => $username,
				'book_no' => $book_no
			);

		$result = $this->favorites_model->check($data);
		echo json_encode($result);
	}	
}

?>