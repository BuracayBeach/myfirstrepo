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
        $this->load->model('search_model');
        $this->load->helper('url');
    }

    public function index(){
        $this->load->library('javascript');
        $data['title'] = "eICS Lib";

        // $this->display_views($data);
    }

    public function add(){
        $data['book_no'] = $_POST['book_no'];
        $data['book_title'] = $_POST['book_title'];
        $data['description'] = $_POST['description'];
        $data['author'] = $_POST['author'];
        $data['publisher'] = $_POST['publisher'];
        $data['date_published'] = $_POST['date_published'];
        $data['tags'] = $_POST['tags'];

        $this->book_model->insertBook($data);

        echo json_encode($_POST);
    }

    public function delete(){
        $book_no = $_POST['book_no'];
        $this->book_model->delete_book($book_no);
    }

    public function get_book(){
        $book_no = $_POST['book_no'];

        echo $this->book_model->get_book($book_no);
    }

    public function edit(){
        $data['prev_book_no'] = filter_var($_POST['prev_book_no'], FILTER_SANITIZE_MAGIC_QUOTES);
        $data['book_no'] =  filter_var($_POST['book_no'], FILTER_SANITIZE_MAGIC_QUOTES);
        $data['book_title'] = filter_var($_POST['book_title'], FILTER_SANITIZE_MAGIC_QUOTES);
        $data['author'] = filter_var($_POST['author'], FILTER_SANITIZE_MAGIC_QUOTES);
        $data['description'] = filter_var($_POST['description'], FILTER_SANITIZE_MAGIC_QUOTES);
        $data['status'] = filter_var($_POST['book_status'], FILTER_SANITIZE_MAGIC_QUOTES);
        $data['publisher'] = filter_var($_POST['publisher'], FILTER_SANITIZE_MAGIC_QUOTES);
        $data['tags'] = filter_var($_POST['tags'], FILTER_SANITIZE_MAGIC_QUOTES);
        $data['date_published'] = filter_var($_POST['date_published'], FILTER_SANITIZE_MAGIC_QUOTES);

        $this->book_model->edit_book($data);
        echo json_encode($data);
    }

    public function display_views($data){
        $this->load->view('header',$data);
        $this->load->view('search_view', $data);
        // $this->load->view('table_view',$data);
        if($data['is_admin'])
            $this->load->view('manage_view',$data);
        $this->load->view('footer');
    }




    public function search(){
        $data['is_admin'] = true;

        $input['search_term'] = "";
        $input['search_by'] = "book_title";
        $input['order_by'] = "a.book_no";

        if (isset($_POST['search'])) $input['search_term'] = $_POST['search'];
        if (isset($_POST['search_by'])) $input['search_by'] = $_POST['search_by'];
        if (isset($_POST['order_by'])) $input['order_by'] = $_POST['order_by'];

        $input['available'] = isset($_POST["available"]);
        $input['borrowed'] = isset($_POST["borrowed"]);
        $input['reserved'] = isset($_POST["reserved"]);

        $input['is_admin'] = $data['is_admin'];



        //pack data
        $details = array(
            'status_check'  => $this->search_model->get_status_check($input),
            'search_term'   => $input['search_term'],
            'search_by'     => $input['search_by'],
            'order_by'      => $input['order_by'],
            'is_admin'      => $input['is_admin'],
            'spell_check'   => true
        );

        //construct query and get the array of rows from database
        $table = $this->search_model->query_result($details);

        //sort results by relevance to the search terms
        $sorted_table = $this->search_model->get_sorted_table($table, $input, $details['spell_check'], $search_suggestion); 

        $details['search_suggestion'] = $search_suggestion;
        $_SESSION['table'] = $sorted_table;

        // $this->load->view('table_view', $details);

        if (trim($search_suggestion)!=''){
            echo "<span>You might want to search for: <a id='suggestion_text' href='javascript:research();'>" . trim($search_suggestion) . "</a></span><br/><br/>";
        }
        // json_encode($search_suggestion);
    }

}

/* End of file booker.php */
/* Location: ./application/controllers/booker.php */