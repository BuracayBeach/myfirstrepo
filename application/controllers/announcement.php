<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Announcement extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model('announcement_model');
        $this->load->library('safeguard');
        $this->load->helper('url');
    }

    public function add(){
        if(isset($_POST)){
            $data = $this->safeguard->array_ready_for_query($_POST);
            session_start();
            $data['announcement_author'] = mysql_real_escape_string($_SESSION['admin_username']);

            $this->announcement_model->insert_announcement($data);

            $data = $this->safeguard->str_array_ready_for_display($data);
            echo json_encode($data);
        }
    }

    public function get_announcement(){
        if(isset($_POST)){
            $announcement_id = mysql_real_escape_string($_POST['announcement_id']);
            $data = $this->announcement_model->get_announcement($announcement_id);

            echo json_encode($data);
        }
    }

    public function get_all_announcements(){
        if(isset($_POST)){
        $data = $this->announcement_model->get_all_announcements();
        $data = $this->safeguard->query_result_ready_for_display($data);
        echo json_encode($data);}
    }

    public function edit(){
        if(isset($_POST)){
        $data = $this->safeguard->array_ready_for_query($_POST);
        $data['date_edited'] = Date("Y-m-d");

        $this->announcement_model->edit_announcement($data);

        $data = $this->safeguard->str_array_ready_for_display($data);
        echo json_encode($data);}
    }

    public function delete(){
            $announcement_id = mysql_real_escape_string($_POST['announcement_id']);
            $this->announcement_model->delete_announcement($announcement_id);

    }



}

/* End of file announcement.php */
/* Location: ./application/controllers/announcement.php */