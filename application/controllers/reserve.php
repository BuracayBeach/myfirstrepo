<?php if ( ! defined('BASEPATH')) exit('Unauthorized access.');

class Reserve extends CI_Controller {

	public function __construct() {
		parent:: __construct();
		$this->load->model('reserve_model');
		date_default_timezone_set("Asia/Manila");
	}

	public function remove() {
	
		$info = $this->input->post('arr');

		$data = array (
			'username' => $_SESSION['username'],
			'book_no' => $info[0]
		);

		$this->reserve_model->remove($data);
		$this->reserve_model->status_update($info[0]);
	}

	public function dequeue($book_no) {

		$q = $this->reserve_model->dequeue($book_no);
		echo json_encode($q);
	}
	
	public function add() {

		/* $info[0] is the book_no */
		$info = $this->input->post('arr');

		$data = array(
				'username' => $_SESSION['username'],
				'book_no' => $info[0],
				'date_reserved' => date('Y-m-d H:i:s'),
				'notified' => 0
			);

		$this->reserve_model->enqueue($data);
		$this->reserve_model->status_reserved($info[0]);
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

	public function view_rank() {

		/* $info[0] is the book_no */
		$info = $this->input->post('arr');

        $book = $this->reserve_model->check_book_ranks_by_book($info[0]);
		$total_book = count($book);

		for ($i=0; $i<$total_book; $i++) {
			if ($book[$i]->username == $_SESSION['username']) {
				$rank = $i + 1;
				break;
			}
		}

		echo "Rank " . $rank . " of " . $total_book;
	}

	public function get_next() {

		/* $info[0] is the book_no */
		$info = $this->input->post('arr');
		$q = $this->reserve_model->get_next_queue($info[0]);

		if ($q != 0)	
			echo $q[0]->username;
		else echo "";
	}
}
