<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Book_model extends CI_Model {

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
        $this->load->database();
    }

    function insertBook($data){
        $date_pub = $data['date_published'];
        $query = "INSERT INTO book (book_no,book_title,description,publisher,tags,date_published)".
                " VALUES ('{$data['book_no']}'".
                ",'{$data['book_title']}'".
                ",'{$data['description']}'".
                ",'{$data['publisher']}'".
                ",'{$data['tags']}'".
                ",".($date_pub==''?'null':("'".$date_pub."'")).")";

        $this->db->query($query);

        $this->db->query("INSERT INTO author (book_no,name) VALUES ('{$data['book_no']}','{$data['author']}')");
    }
 
    function delBook($book_no){
        $this->db->query("DELETE FROM book WHERE book_no='{$book_no}'");
    }

    function query_result($details){
        $details['search_term'] = filter_var($details['search_term'], FILTER_SANITIZE_STRING);

        $tok = explode(" ", $details['search_term']);
        
        $q = array(
                'select' => "select * from book b, author a ",
                'where' => "where " . $details['status_check'] . " b.book_no = a.book_no and (",
                'orderby' => ") order by " . $details['order_by']
        );

        $word_count = 0;
        foreach ($tok as $search) {
            // echo $search."<br>";
            if($details['search_by']== 'book_title'){
               $q['where'] .= "book_title like '%" . $search . "%' or description like '%" . $search . "%' or Tags like '%" . $search . "%' ";
            } else {
                $q['where'] .= $details['search_by'] . " like '%".$search."%' ";
            }
           
            if($word_count < count($tok) - 1) {
                $q['where'] .= " or ";
            }

            $word_count++;
        }

        $query_string = $q['select'] . $q['where'] . ")";// . $q['orderby'];


        // echo $query_string;
        return $this->db->query($query_string)->result();
    }
}






/* End of file booker.php */
/* Location: ./application/controllers/booker.php */