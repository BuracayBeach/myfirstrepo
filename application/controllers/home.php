<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

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
    }

    public function index(){
        $data['title'] = "eICS Lib";
        $this->load->view("header", $data);
        $this->load->view("search_view", ["home"=>true]);
        $is_admin = isset($_SESSION['type']) && $_SESSION['type'] == "admin";
//        if ($is_admin) $this->load->view('manage_view');

/*        if ($is_admin){ 
            $this->load->view('announcement_manage_view');
            $this->load->view("announcement_view");
        }

*/        $this->load->view("footer");
    }

    public function ihome(){
        $data['title'] = "eICS Lib Home";
        $this->load->view("header", $data);
        $this->load->view("search_view");

        $this->load->view('announcement_view');

        if (isset($_SESSION['type']) && $_SESSION['type'] == "admin"){
            $this->load->view('manage_view');
        $this->load->view('announcement_manage_view');
        }

        $this->load->view("footer");
    }

    public function about_us(){
        $data['title'] = "eICS Lib About Us";
        $this->load->view("header", $data);
        $this->load->view("search_view");
        $this->load->view("about_us_view");

        if (isset($_SESSION['type']) && $_SESSION['type'] == "admin"){
            $this->load->view('manage_view');
        }

        $this->load->view("footer");
    }

    public function faq(){
        $data['title'] = "eICS Lib FAQ";
        $this->load->view("header", $data);
        $this->load->view("search_view");
        $this->load->view("faq_view");
        //$is_admin = isset($_SESSION['type']) && $_SESSION['type'] == "admin";
        //if ($is_admin) $this->load->view('manage_view');

        $this->load->view("footer");
    }

}

/* End of file booker.php */
/* Location: ./application/controllers/booker.php */