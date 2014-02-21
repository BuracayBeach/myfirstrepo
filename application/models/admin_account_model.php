<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_account_model extends CI_Model {
	function __construct(){
		parent::__construct(); //super sa java
		$this->load->database(); //connect to database
	}
}
?>