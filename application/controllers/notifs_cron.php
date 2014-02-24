<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Notifs_Cron extends CI_Controller {

	public function __construct() {
		parent:: __construct();
		$this->load->model('notifs_model');
		$this->load->library('input');
	}

	public function check_overdue() {

		if($this->input->is_cli_request()) {
			$unreturned = $this->notifs_model->get_unreturned();

			echo "Checking overdue books @ " . date('Y-m-d H:i:s') . PHP_EOL;
		
			foreach ($unreturned as $row) {

				$diff = date_diff(date_create($row->date_borrowed), date_create(date('Y-m-d H:i:s')));
				$days = $diff->format("%a days");


				if ($days > 7) 
					$this->send_overdue_notif($row->book_no, $row->username_user, $days-7);
			}
		}
	}

	public function send_overdue_notif($book_no, $username, $days) {

		$data = array (
				'username_admin' => "",
				'username_user' => $username,
				'book_no' => $book_no,
				'message' => "Please return the book ASAP. Overdue of {$days} days.",
				'date_sent' => date('Y-m-d H:i:s'),
				'type' => 'overdue'
			);

		$this->notifs_model->add_notif($data);
	}
}
