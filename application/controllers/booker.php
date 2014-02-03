<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Booker extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    function __construct(){
        parent::__construct();
        $this->load->model('book_model');
    }

    public function add(){
        $data['book_no'] = $_POST['book_no'];
        $data['book_title'] = $_POST['book_title'];
        $data['description'] = $_POST['description'];
        $data['publisher'] = $_POST['publisher'];
        $data['date_published'] = $_POST['date_published'];
        $data['tags'] = $_POST['tags'];
        $this->load->library('form_validation');
        $this->form_validation->set_rules('book_no','BookNumber','required|is_unique[ics-lib-db.Book_no]|min_length[1]|alpha_numeric');
        $this->form_validation->set_rules('book_title','BookTitle','required' );
        $this->form_validation->set_rules('description','Description','required');
        $this->form_validation->set_rules('publisher','Publisher','required');
        $this->form_validation->set_rules('date_published','DatePublished','required');
        $this->form_validation->set_rules('tags','Tags','callback_tags_check');

        $this->book_model->insertBook($data);

        $this->index();
        /* ???
        if ($this->form_validation->run()==FALSE){

            $this->load->view('manage_view');

        }
        else{
            $this->load->view('views/index.html');
        }
        */
    }

    public function delete(){
        $book_no = $_POST['book_no'];
        $this->book_model->delBook($book_no);
        $this->index();
    }

    public function edit(){
        $data['prev_book_no'] = $_POST['prev_book_no'];
        $data['book_no'] = $_POST['book_no'];
        $data['book_title'] = $_POST['book_title'];
        $data['description'] = $_POST['description'];
        $data['publisher'] = $_POST['publisher'];
        $data['date_published'] = $_POST['date_published'];

        $this->book_model->editBook($data);
    }

    public function index(){
        $data['title'] = "eICS Lib";
        $data['query'] = $this->db->get('book');
        $data['table'] = $this->search();
        $this->load->library('javascript');
        $this->load->view('header',$data);
        $this->load->view('search_view',$data);
        $this->load->view('manage_view',$data);
        $this->load->view('footer');
    }


    public function search(){
        //set defaults
        $search_term = "";
        $search_by = "book_title";
        $order_by = "a.book_no";
        $status_check = "status='available' or status='borrowed' or status='reserved'";

        if (isset($_POST["submit"])){
            //get user input
            $search_term = $_POST['search'];
            $search_by = $_POST['search_by'];
            $order_by = $_POST['order_by'];

            //filter by book status
            if (!isset($_POST["available"])) $status_check = str_replace("status='available' or ","",$status_check);
            if (!isset($_POST["borrowed"])) $status_check = str_replace("status='borrowed' or ","",$status_check);
            if (!isset($_POST["reserved"])){
                $status_check = str_replace(" or status='reserved'","",$status_check);
                $status_check = str_replace("status='reserved'","",$status_check);
            }

            if($search_by == "book_no")	$search_by = "a.book_no";
            if($order_by == "book_no") $order_by = "a.book_no";
        }


        if($status_check!="") $status_check = "(" . $status_check . ") and";


        $details = array(
            'search_term' 	=> $search_term,
            'search_by' 	=> $search_by,
            'order_by' 		=> $order_by,
            'status_check' 	=> $status_check
        );


        return $this->book_model->query_result($details);
    }

}

/* End of file booker.php */
/* Location: ./application/controllers/booker.php */