<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Announcement extends CI_Controller {

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
        $this->load->model('announcement_model');
        $this->load->helper('url');
    }

    public function get_announcement(){
        $announcement_id = $_POST['announcement_id'];

        echo $this->announcement_model->get_announcement($announcement_id);
    }

    public function get_all_announcement(){
        echo $this->announcement_model->get_all_announcement();
    }

    public function add(){
        $data['announcement_title'] = filter_var($_POST['announcement_title'], FILTER_SANITIZE_MAGIC_QUOTES);
        $data['announcement_content'] = filter_var($_POST['announcement_content'], FILTER_SANITIZE_MAGIC_QUOTES);
        session_start();
        $data['announcement_author'] = filter_var($_SESSION['username'], FILTER_SANITIZE_MAGIC_QUOTES);

        $this->announcement_model->insert_announcement($data);

        $data = array_replace($data,$_POST);
        echo json_encode($data);
    }


    public function edit(){
        $data['announcement_id'] = filter_var($_POST['announcement_id'], FILTER_SANITIZE_MAGIC_QUOTES);
        $data['announcement_title'] = filter_var($_POST['announcement_title'], FILTER_SANITIZE_MAGIC_QUOTES);
        $data['announcement_content'] = filter_var($_POST['announcement_content'], FILTER_SANITIZE_MAGIC_QUOTES);
        $data['announcement_author'] = filter_var($_POST['announcement_author'], FILTER_SANITIZE_MAGIC_QUOTES);
        $data['date_edited'] = Date("Y-m-d");

        $this->announcement_model->edit_announcement($data);

        $data = array_replace($data,$_POST);
        echo json_encode($data);
    }

    public function delete(){
        $announcement_id = $_POST['announcement_id'];
        $this->announcement_model->delete_announcement($announcement_id);
    }



}

/* End of file announcement.php */
/* Location: ./application/controllers/announcement.php */