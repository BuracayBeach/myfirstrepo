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

    function get_book($book_no){
        $query = "SELECT * FROM book b, author a WHERE b.book_no='".$book_no."'";
        $query2 = "AND a.book_no='".$book_no."'";
        //$var = $this->db->query($query)->result()
        //var_dump($var);
        echo json_encode($this->db->query($query.$query2)->result());
    }

    function edit_book($data){
        $date_pub = $data['date_published'];
        $query = "UPDATE book SET book_no='".$data['book_no']."'".
            ",book_title='".$data['book_title']."'".
            ",status='".$data['status']."'".
            ",description='".$data['description']."'".
            " ,publisher='".$data['publisher']."'".
            ",tags='".$data['tags']."'".
            ",date_published=".($date_pub==''?'null':("'".$date_pub."'")).
            " WHERE book_no='".$data['prev_book_no']."'";
        $query_author="UPDATE author SET name='{$data['author']}' WHERE book_no='{$data['book_no']}'";

        $this->db->query($query);
        $this->db->query($query_author);
    }


    function delete_book($book_no){
        $this->db->query("DELETE FROM book WHERE book_no='{$book_no}'");
    }
}






/* End of file book.php */
/* Location: ./application/controllers/book.php */