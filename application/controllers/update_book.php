<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Update_book extends CI_Controller {


	public function index()
	{
		echo "hello";
	}
	public function lend(){
		$data['book_no'] = "AA00001";                             //temporary date, in the actual implementation onClick of the button
		$data['username_user'] = "edzerium";
		$data['email'] = "dzerium@gmail.com";
		$data['username_admin'] = "admin";

		$this->load->model('update_book_model');		//loading of the updateBook_model

		//$this->db->trans_begin();
		$this->update_book_model->lend($data);              //we call the lend function which updates the status of the book from reserved to borrowed
		$this->update_book_model->insertLend($data);			//we call this function to insert into the log the whole transaction
	//	$this->load->view('confirmation_view');				// this is not yet finish


	//	$this->index(); 	 			// returns to the indexpage of the controller in the actual implementation, this should return to the search results
	}
	public function received(){
	
		$data['book_no'] = "AA00001";   // temporary data. actual data must be pass via onClick in the actual implementation
		$data['status'] = "borrowed";
		$data['transaction_no'] = 3;

		$this->load->model('update_book_model');		// loads the updateBook_model

		$this->update_book_model->received($data);	// updates the status of the book from borrowed to available
		$this->update_book_model->updateLend($data);	// writes the whole transaction into log

	}


}