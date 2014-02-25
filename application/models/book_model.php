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

    function insert_book($data){
        $date_pub = $data['date_published'];
        $query = "INSERT INTO book (book_no,book_title,book_type,abstract,author,description,publisher,tags,date_published)".
            " VALUES ('{$data['book_no']}'".
            ",'{$data['book_title']}'".
            ",'{$data['type']}'".
            ",".(($data['abstract'] != null)?("'".$data['abstract']."'"):'null').
            ",'{$data['author']}'".
            ",'{$data['description']}'".
            ",'{$data['publisher']}'".
            ",'{$data['tags']}'".
            ",".($date_pub==''?'null':("'".$date_pub."'")).")";

        $this->db->query($query);
    }

    function get_book($book_no){
        $query = "SELECT * FROM book WHERE book_no='".$book_no."'";

        return $this->db->query($query)->result();
    }

    function edit_book($data){
        $date_pub = $data['date_published'];
        $query = "UPDATE book SET book_no='".$data['book_no']."'".
            ",book_title='".$data['book_title']."'".
            ",book_type='".$data['type']."'".
            ",abstract=".($data['abstract']==null?'null':("'".$data['abstract']."'")).
            ",status='".$data['book_status']."'".
            ",author='".$data['author']."'".
            ",description='".$data['description']."'".
            " ,publisher='".$data['publisher']."'".
            ",tags='".$data['tags']."'".
            ",date_published=".($date_pub==''?'null':("'".$date_pub."'")).
            " WHERE book_no='".$data['prev_book_no']."'";

        $this->db->query($query);
    }


    function delete_book($book_no){
        $this->db->query("DELETE FROM book WHERE book_no='{$book_no}'");
    }
}






/* End of file book.php */
/* Location: ./application/controllers/book.php */