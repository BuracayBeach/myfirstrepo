<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/** 
*	All functions of this class is called via AJAX. Return data should be in
*	json_encode() format.
*/ 
class Notifs extends CI_Controller {

	public function __construct() {
		parent:: __construct();
		$this->load->model('notifs_model');
	}


	/*
	*	Sample call of this function in AJAX.
	*		
	*	$.ajax({
	*		url : "http://localhost/128_team2/notifs/view_by_username/" + username,
	*		type : 'POST',
	*		dataType : "html",
	*		async : true,		
	*		success: function(data) {}
	*	});
	*/
	public function view_by_username($username) {

		$q = $this->notifs_model->get_all($username);
		echo json_encode($q);
	}

	public function send_custom_notif($admin, $book) {
		$data = array (
				'username_admin' => $admin,
				'username_user' => $_POST['username'],
				'book_no' => $book_no,
				'message' => $_POST['message'],
				'date_sent' => date('Y-m-d H:i:s'),
				'type' => 'custom'
			);

		$this->notif_model->add_notif($data);
	}

///////////////////////////////////////////////////////////////////////////////////////////////
//	Guys, naalala niyo pa yung pinag usapan natin sa lab? :)
//	Medjo natapos naman natin yun diba? haha. So more on checking and polishing tayo for this part..
//
//	So recap lang, ang gagawin niyo ay yung notif na mag reremind sa user na ready na for claiming
//	yung book na ni-reserve niya. This happens when the reserved book is returned to the library
//	by the previous user. Upon returning, the admin clicks the button 'return', which changes the
//	book's status from 'borrowed' to 'reserved'.
//
//	This module is called via AJAX, relying on the jQuery event na clicked yung button. (see below)
//
//	Since hindi pa integrated fully yung system natin with all of the Teams, it's not wise to fully
//	test ours along with them. Baka kasi may mga changes sila that did not reflect the previously
//	discussed implementations. So puro assumptions nlng muna tayo..
//
// 	Username of both admin and user are via $_SESSION, pero binago daw Team 5 ang kanilang implementation,
//	so hard coded muna yung data natin dito.
//
//	The AJAX call is closed via <script> tags sa view, pero hindi pa nag meet ang TLs and PM for
//	overall integration, kaya di pa natin alam yung structure for the in-page js calls. Make your own view
//	for implementing this muna, that simulates the button event for the notification. May layout na akong
//	ginawa sa baba.. yan parin yung sinulat natin sa lab, pero inimprove ko lang. If di niyo maalala yung
//	discussion natin diyan or medyo malabo, Message niyo lang ako ah.. :)
//
//	Hard coded muna yung lines 75 and 76. So replace the $() calls with the commented strings. :)
	
	/* 
	*
	*	$("div.book_row_entry").on("click", "div.button_return", function() {
	*		
	*		var book_no = $(this).attr('bookno');  // "CD 4321"
	*		var username = $(body).attr('username'); // "user123"
	*		
	*		$.ajax({
	*			url : "http://localhost/128_team2/notifs/send_claim_notif/" + book_no + "/" + username,
	*			type : 'POST',
	*			dataType : "html",
	*			async : true,
	*			success: function(data) {}
	*		});
	*
	*	});
	*
	*/

	public function send_claim_notif($book_no, $username) {

		$data = array (
				'username_admin' => "admin123", //$_SESSION["username_admin"];
				'username_user' => "user123", //$_POST['username'],
				'book_no' => $book_no,
				'message' => "You may now claim your book ASAP",
				'date_sent' => date('Y-m-d H:i:s'),
				'type' => 'claim'
			);

		$this->notif_model->add_notif($data);
	}
}

?>