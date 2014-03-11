<?php if ( ! defined('BASEPATH')) exit('Unauthorized access.');

class Faq_model extends CI_Model {

    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    function add_faq(&$data){
        $query = "INSERT INTO faq (question,answer)".
            " VALUES ('{$data['question']}'".
            ",'{$data['answer']}'".")";

        $this->db->query($query);

        $data['id'] = $this->db->query("SELECT LAST_INSERT_ID() id")->result()[0]->id;

    }

    function get_faq($id){
        $query = "SELECT * FROM faq WHERE id='{$id}'";

        return $this->db->query($query)->result();

    }

    function get_all_faq(){
        $query = "SELECT id,question,answer FROM faq";

        return $this->db->query($query)->result();
    }

    function edit_faq($data){
        $query = "UPDATE faq SET ".
            "question='".$data['question']."'".
            ",answer='".$data['answer']."'".
            " WHERE id='".$data['id']."'";

        $this->db->query($query);
    }

    function delete_faq($id){
        $query = "DELETE FROM faq WHERE id='{$id}'";

        $this->db->query($query);
    }
}






/* End of file book.php */
/* Location: ./application/controllers/book.php */