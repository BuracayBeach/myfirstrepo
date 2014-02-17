<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News extends CI_Controller {

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
        $this->load->model('news_model');
        $this->load->helper('url');
    }

    public function get_news(){
        $news_id = $_POST['news_id'];

        echo $this->news_model->get_news($news_id);
    }

    public function get_all_news(){
        echo $this->news_model->get_all_news();
    }

    public function add(){
        $data['news_title'] = filter_var($_POST['news_title'], FILTER_SANITIZE_MAGIC_QUOTES);
        $data['news_content'] = filter_var($_POST['news_content'], FILTER_SANITIZE_MAGIC_QUOTES);
        session_start();
        $data['news_author'] = filter_var($_SESSION['username'], FILTER_SANITIZE_MAGIC_QUOTES);

        $this->news_model->insert_news($data);

        $data = array_replace($data,$_POST);
        echo json_encode($data);
    }


    public function edit(){
        $data['news_id'] = filter_var($_POST['news_id'], FILTER_SANITIZE_MAGIC_QUOTES);
        $data['news_title'] = filter_var($_POST['news_title'], FILTER_SANITIZE_MAGIC_QUOTES);
        $data['news_content'] = filter_var($_POST['news_content'], FILTER_SANITIZE_MAGIC_QUOTES);
        $data['news_author'] = filter_var($_POST['news_author'], FILTER_SANITIZE_MAGIC_QUOTES);
        $data['date_edited'] = Date("Y-m-d");

        $this->news_model->edit_news($data);

        $data = array_replace($data,$_POST);
        echo json_encode($data);
    }

    public function delete(){
        $news_id = $_POST['news_id'];
        $this->news_model->delete_news($news_id);
    }



}

/* End of file news.php */
/* Location: ./application/controllers/news.php */