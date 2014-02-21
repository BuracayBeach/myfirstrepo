<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Announcement_model extends CI_Model {

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

    function insert_announcement(&$data){
        $data['date_posted'] = Date("Y-m-d");
        $query = "INSERT INTO announcement (announcement_title,announcement_content,announcement_author,date_posted)".
            " VALUES ('{$data['announcement_title']}'".
            ",'{$data['announcement_content']}'".
            ",'{$data['announcement_author']}'".
            ",".($data['date_posted']==''?'null':("'".$data['date_posted']."'")).")";

        $this->db->query($query);

        $data['announcement_id'] = $this->db->query("SELECT LAST_INSERT_ID() announcement_id")->result()[0]->announcement_id;
    }

    function get_book($book_no){
        $query = "SELECT * FROM book b, author a WHERE b.book_no='".$book_no."'";
        $query2 = "AND a.book_no='".$book_no."'";

        echo json_encode($this->db->query($query.$query2)->result());
    }

    function get_announcement($announcement_id){
        $query = "SELECT announcement_title,announcement_content,announcement_author FROM announcement WHERE announcement_id='{$announcement_id}'";

        echo json_encode($this->db->query($query)->result());
    }

    function get_all_announcement(){
        $query = "SELECT * from announcement";

        echo json_encode($this->db->query($query)->result());
    }

    function edit_announcement($data){
        $query = "UPDATE announcement SET ".
            "announcement_title='".$data['announcement_title']."'".
            ",announcement_content='".$data['announcement_content']."'".
            " WHERE announcement_id='".$data['announcement_id']."'";

        $this->db->query($query);
    }

    function delete_announcement($announcement_id){
        $this->db->query("DELETE FROM announcement WHERE announcement_id='{$announcement_id}'");
    }
}






/* End of file book.php */
/* Location: ./application/controllers/book.php */