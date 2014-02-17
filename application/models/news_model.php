<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News_model extends CI_Model {

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

    function insert_news(&$data){
        $data['date_posted'] = Date("Y-m-d");
        $query = "INSERT INTO news (news_title,news_content,news_author,date_posted)".
            " VALUES ('{$data['news_title']}'".
            ",'{$data['news_content']}'".
            ",'{$data['news_author']}'".
            ",".($data['date_posted']==''?'null':("'".$data['date_posted']."'")).")";

        $this->db->query($query);

        $data['news_id'] = $this->db->query("SELECT LAST_INSERT_ID() news_id")->result()[0]->news_id;
    }

    function get_book($book_no){
        $query = "SELECT * FROM book b, author a WHERE b.book_no='".$book_no."'";
        $query2 = "AND a.book_no='".$book_no."'";

        echo json_encode($this->db->query($query.$query2)->result());
    }

    function get_news($news_id){
        $query = "SELECT news_title,news_content,news_author FROM news WHERE news_id='{$news_id}'";

        echo json_encode($this->db->query($query)->result());
    }

    function get_all_news(){
        $query = "SELECT * from news";

        echo json_encode($this->db->query($query)->result());
    }

    function edit_news($data){
        $query = "UPDATE news SET ".
            "news_title='".$data['news_title']."'".
            ",news_content='".$data['news_content']."'".
            " WHERE news_id='".$data['news_id']."'";

        $this->db->query($query);
    }

    function delete_news($news_id){
        $this->db->query("DELETE FROM news WHERE news_id='{$news_id}'");
    }
}






/* End of file book.php */
/* Location: ./application/controllers/book.php */