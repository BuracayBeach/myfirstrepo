<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Favorite extends CI_Controller {

	public function __construct() {
		parent:: __construct();
		$this->load->model('favorite_model');

		date_default_timezone_set("Asia/Manila");

	}

	public function get_all($username) {

		$data = $this->favorite_model->get_all($username);
		echo json_encode($data);
	}

	public function add() {

		$info = $this->input->post('arr');

		$data = array (
					'username' => $_SESSION['username'],
					'book_no' => $info[0],
					'date_added' => date('Y-m-d H:i:s')
				);	
		
		$this->favorite_model->add($data);
	}

	public function remove() {

		$info = $this->input->post('arr');

		$data = array (
					'username' => $_SESSION['username'],
					'book_no' => $info[0]
				);

		$this->favorite_model->remove($data);
	}

	public function check($username, $book_no) {
		$data = array(
				'username' => $username,
				'book_no' => $book_no
			);

		$result = $this->favorite_model->check($data);
		echo json_encode($result);
	}	
}

?>