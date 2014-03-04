<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logs extends CI_Controller {
    function __construct(){
        parent::__construct();

        $this->load->model('logs_model');
        $this->load->library('LogsPDF');
    }

    public function index(){
        redirect(base_url());
    }

    public function download($from,$to){

        session_start();

        if(isset($_SESSION) && isset($_SESSION['type']) && $_SESSION['type'] == "admin"){
            $logs = $this->logs_model->get_logs($from,$to);
            foreach($logs as &$row)
                $row = (array) $row;
            $data = $logs;

            $pdf = new LogsPDF();// Column headings
            $header = array('Timestamp', 'Book #', 'Action', 'By','Administrator','Transaction #'); //Data loading
            $pdf->SetFont('Arial','',8);
            $pdf->AddPage();
            $pdf->BasicTable($header,$data);
            $pdf->Output();
        }else{
            echo 'unauthorized';
        }

    }
}

/* End of file book.php */
/* Location: ./application/controllers/book.php */
