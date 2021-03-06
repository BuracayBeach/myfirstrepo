<?php if ( ! defined('BASEPATH')) exit('Unauthorized access.');

class Book extends CI_Controller {

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
        $this->load->model('favorite_model');
        $this->load->model('reserve_model');
        $this->load->model('lend_model');

        $this->load->library('safeguard');


        if (!isset($_SESSION))
            session_start();

    }

    public function add(){
        if(isset($_POST)){
        $data = $this->safeguard->array_ready_for_query($_POST);
        $data['other_detail'] = $this->extract_detail($data);

        if($data['type'] == 'Book' || $data['type'] == 'Journal')
            $data['abstract'] = null;
        if($data['type'] == 'Other')
            $data['type'] = $data['other'];

        $this->book_model->insert_book($data);

        $data = $this->safeguard->str_array_ready_for_display($data);
        if(isset($_SESSION)){
            $_SESSION['recently_added_books'][$data['book_no']] = $data;
        }
        echo json_encode($data);}
    }


    public function edit(){
        if(isset($_POST)){
            $data = $this->safeguard->array_ready_for_query($_POST);
            $data['other_detail'] = $this->extract_detail($data);
            if($data['type'] == 'Book' || $data['type'] == 'Journal')
                $data['abstract'] = null;
            if($data['type'] == 'Other')
                $data['type'] = $data['other'];
            $this->book_model->edit_book($data);
            $data = $this->safeguard->str_array_ready_for_display($data);
            $result = array();
            $result['row'] = json_decode(json_encode($data));
            $result['row']->book_type = $result['row']->type;
            if(isset($_SESSION['recently_added_books'][$data['prev_book_no']])){
                $_SESSION['recently_added_books'][$data['book_no']] = $data;

                if($data['book_no'] != $data['prev_book_no']){
                    unset($_SESSION['recently_added_books'][$data['prev_book_no']]);
                }
            }
            $result['reserve'] = $this->reserve_model->get_first();
            $result['lend'] = $this->lend_model->get_lend();
            echo $this->load->view("table_row_view",$result);
        }
    }

    public function get_book(){
        if(isset($_GET)){
            $book_no = mysql_real_escape_string($_GET['book_no']);
            $data = $this->book_model->get_book($book_no);
            echo json_encode($data);}
    }

    public function delete(){
        if(isset($_POST['book_no'])){
            $book_no = mysql_real_escape_string(trim($_POST['book_no']));
            $this->book_model->delete_book($book_no);
            if(isset($_SESSION['recently_added_books'])){
                if(isset($_SESSION['recently_added_books'][$book_no])){
                    unset($_SESSION['recently_added_books'][$book_no]);
                    if(empty($_SESSION['recently_added_books'])){
                        unset($_SESSION['recently_added_books']);
                    }
                }
            }
        }
    }

    public function extract_detail($data){
        $new_details = [];
        if(isset($data['other_detail'])){
            $details = $data['other_detail'];
            foreach($details as &$detail){
                array_push($new_details,implode("»",$detail));
            }
            return implode("¦",$new_details);
        }else{
            return null;
        }
    }


    public function get_buttons_view(){
        if(isset($_GET)){
            $data['row'] = json_decode(json_encode($_GET));
            echo $this->load->view('table_buttons_view',$data);
        }
    }

    public function get_row_view(){
        if(isset($_GET)){
            $data['row'] = json_decode(json_encode($_GET));
            $data['row']->book_type = $data['row']->type;
            $data['row']->status = "available";
            $data['reserves'] = $this->reserve_model->get_first();
            $data['newly_added'] = true;

            $data['reserve'] = $this->reserve_model->get_first();
            $data['lend'] = $this->lend_model->get_lend();
            echo $this->load->view('table_row_view',$data);
        }
    }

    public function search_sessionize(){
        
        $_SESSION['search_data'] = $_POST;
    }


    public function search(){
        $input = null;
        $this->search_model->get_inputs($input);

        //pack data
        $details = array(
            'status_check'  => $this->search_model->get_status_check($input),
            'type_check'  => $this->search_model->get_type_check($input),
            'search_term'   => $input['search_term'],
            'search_by'     => $input['search_by'],
            'order_by'      => $input['order_by'],
            'tag_search'      => $input['tag_search'],
            'spell_check'   => true
        );
        // var_dump($details);
        if (isset($_POST['page'])) $details['page'] = $_POST['page'];
        if (isset($_POST['rows_per_page'])) $details['rows_per_page'] = $_POST['rows_per_page'];
        // if ($details['search_by'] == 'date_published') $details['spell_check'] = false;


        //construct query and get the array of rows from database
        $table = $this->search_model->query_result($details);
        $search_suggestion = null;
        //sort results by relevance to the search terms
        $search_suggestion = '';
        $sorted_table = $this->search_model->get_sorted_table($table, $input, $details['spell_check'], $search_suggestion);

        $details['search_suggestion'] = trim($search_suggestion);
        $details['table'] = $sorted_table;

        // para lang sa pag check ng user favorites at reserves (w/ lend crosschecking)
        if (isset($_SESSION['username'])) {
            $details['favorite_user'] = $this->favorite_model->get_all($_SESSION['username']);
            $details['reserve_user'] = $this->reserve_model->get($_SESSION['username']);
            $details['lend_user'] = $this->lend_model->get($_SESSION['username']);


            $book = $this->reserve_model->check_book_ranks();

            // total reserves for a particular book
            $book_array = array();
            $size = count($book);
            for ($i=0; $i<$size; $i++)
                array_push($book_array, $book[$i]->book_no);
            $book_ranks = array_count_values($book_array);

            // key value pair for book_no => array(rank)
            $book_temp = array();
            for ($i=0; $i<$size; $i++)
                $book_temp[$book_array[$i]] = array();
            for($i=0; $i<$size; $i++)
                array_push($book_temp[$book[$i]->book_no], $book[$i]->rank);
        
            $details['book_ranks'] = $book_ranks;
            $details['book_temp'] = $book_temp;
        }


        if (isset($details['rows_per_page'])) {
            if ($details['rows_per_page'] == 0) $details['rows_per_page'] = 10;
            $max_page = count($details['table']) / $details['rows_per_page'];
            if (count($details['table']) % $details['rows_per_page'] > 0) $max_page++;
            $details['maxpage'] = $max_page;
        }


        $this->load->view('table_view', $details);

        if ($search_suggestion !=''){
            $p_search_by = filter_var($_POST["search_by"], FILTER_SANITIZE_STRING);
            echo "<div class='word-suggestion'>You might want to search for: <a id='suggestion_text' search_by='{$p_search_by}' href='javascript:void(0)'>" . $search_suggestion . "</a></div>";
        }
    }

     /*
        Section Author : Edzer Josh V. Padilla
        Description : functions used to handle lending and returning of books
    */

    /* start section */

    /*
        sample ajax call
        $.ajax({
            url: 'index.php/update_book/lend/',
            data: {id:$bookno},
            success: function(data) {}
        });
    */

    public function lend(){
        $data['book_no'] = $_GET['id'];
        $this->load->model('reserve_model');
        $q = $this->reserve_model->dequeue($data['book_no']);
        $row = $q->row();
        $data['book_no'] = $row->book_no;
        $data['username_user'] =  $row->username;
        $data['username_admin'] = $_SESSION['admin_username']; // get from session

        $this->load->model('update_book_model');        //loading of the updateBook_model
        $this->update_book_model->lend($data);              //we call the lend function which updates the status of the book from reserved to borrowed
        $this->update_book_model->insertLend($data);            //we call this function to insert into the log the whole transaction
    
        $username = $this->reserve_model->get_next_queue($data['book_no']);
        echo $username;
    }

    /*
        sample ajax call
        $.ajax({
            url: 'index.php/update_book/received/',
            data: {id:$bookno},
            success: function(data) {}
            });
    */

    public function received(){

        $data['book_no'] = $_GET['id'];   // actual data must be pass via onClick in the actual implementation
        $data['status'] = "borrowed";

        $this->load->model('update_book_model');        // loads the updateBook_model
        $data['transaction_no'] = $this->update_book_model->getTransactionno($data['book_no']);
        $status_checker = $this->update_book_model->received($data);  // updates the status of the book from borrowed to available
        $this->update_book_model->updateLend($data);    // writes the whole transaction into log

        $data = array('status' => $status_checker);

        echo json_encode($data);
}
    /* end section */

}

/* End of file book.php */
/* Location: ./application/controllers/book.php */
