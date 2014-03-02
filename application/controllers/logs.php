<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logs extends CI_Controller {
    function __construct(){
        parent::__construct();

        $this->load->model('logs_model');

    }

    public function index(){
        redirect(base_url());
    }

    public function download_logs(){
        if(isset($_SESSION) && isset($_SESSION['type']) && $_SESSION['type'] == "admin"){

        }else{
            redirect(base_url());
        }
    }
}

/* End of file book.php */
/* Location: ./application/controllers/book.php */
