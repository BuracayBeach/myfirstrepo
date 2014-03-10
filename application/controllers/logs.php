<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logs extends CI_Controller {
    function __construct(){
        parent::__construct();

        $this->load->model('logs_model');
        $this->load->library('LogsPDF');
        $this->load->library('safeguard');
        $this->load->library('pagination');
    }

    public function index(){
        redirect(base_url());
    }

    public function get_logs_view($from,$to){
        if(isset($_SESSION) && isset($_SESSION['type']) && $_SESSION['type'] == "admin"){
            $qdata['from'] = $from;
            $qdata['to'] = $to;
            $qdata['start_row'] = $this->uri->segment(5,0);
            $qdata['num_rows'] = 10;
            $result = $this->logs_model->get_logs($qdata);
            $data['logs'] = $result['rows'];
            $data['logs'] = $this->safeguard->query_result_ready_for_display($data['logs']);
            $data['count'] = $result['count'];

            $config['uri_segment'] = 5;
            $config['per_page'] = 10;
            $config['base_url'] = base_url() . "index.php/logs/get_logs_view/".$from."/".$to;
            $config['total_rows'] =  $data['count'];
            $config['anchor_class'] = 'class="log_link" ';

            $this->pagination->initialize($config);

            echo json_encode(array(
                 'table' => $this->load->view('logs_table_view',$data, TRUE),
                 'links' => $this->pagination->create_links()
                ));
        }else{
            echo json_encode(array('table'=>'empty'));
        }
    }

    public function download($from,$to){

        if(isset($_SESSION) && isset($_SESSION['type']) && $_SESSION['type'] == "admin"){
            $data['from'] = $from;
            $data['to'] = $to;
            $logs = $this->logs_model->get_logs($data);
            foreach($logs as &$row)
                $row = (array) $row;
            $data = $logs;

            $pdf = new LogsPDF();// Column headings
            $header = array('Timestamp', 'Book #', 'Action', 'By','Administrator','Transaction #'); //Data loading
            $pdf->SetFont('Arial','',8);
            $pdf->AliasNbPages();
            $pdf->AddPage();
            $pdf->BasicTable($header,$data);
            $pdf->Output();
        }else{
            redirect(base_url());
        }
    }
}

/* End of file book.php */
/* Location: ./application/controllers/book.php */
