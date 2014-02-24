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
        $this->load->model('notifs_model');
        $this->load->model('favorite_model');
        $this->load->model('lend_model');
        $this->load->model('reserve_model');
    }

    public function index(){
        $data['title'] = "eICS Lib";
        $this->load->view("header", $data); 
        $this->load->view("search_results_view");
        $is_admin = isset($_SESSION['type']) && $_SESSION['type'] == "admin";
        if ($is_admin) $this->load->view('manage_view');

/*        if ($is_admin){
            $this->load->view('announcement_manage_view');
            $this->load->view("announcement_view");
        }
*/
        $this->load->view("footer");
    }

    public function ihome(){
        $data['title'] = "eICS Lib Home";
        $this->load->view("header", $data);
        $this->load->view("search_results_view");


        $is_admin = isset($_SESSION['type']) && $_SESSION['type'] == "admin";
        if ($is_admin){
            $this->load->view('recently_added_view');
            $this->load->view('manage_view');

        }
        if (isset($_SESSION['type']) && $_SESSION['type'] == "regular"){
            $data['notifs'] = $this->notifs_model->get_all($_SESSION['username']);
            $this->load->view('notifications_view', $data);
        }


        $this->load->view("footer");
    }

    public function announcements(){
        $data['title'] = "eICS Lib Announcements";
        $this->load->view("header", $data);
        $this->load->view("search_results_view");
        $this->load->view('announcements_view');

        if (isset($_SESSION['type']) && $_SESSION['type'] == "admin")
            $this->load->view('announcements_manage_view');

        $this->load->view("footer");
    }

    public function about_us(){
        $data['title'] = "eICS Lib About Us";
        $this->load->view("header", $data);
        $this->load->view("search_results_view");
        $this->load->view("about_us_view");


        $this->load->view("footer");
    }

    public function faq(){
        $data['title'] = "eICS Lib FAQ";
        $this->load->view("header", $data);
        $this->load->view("search_results_view");
        $is_admin = isset($_SESSION['type']) && $_SESSION['type'] == "admin";
        if ($is_admin){
            $this->load->view('faq_manage_view', $data);
        }else{
            $this->load->view('faq_view');
        }

        $this->load->view("footer");
    }

   public function help(){
        $data['title'] = "eICS Lib Help";
        $this->load->view("header", $data);
        $this->load->view("search_results_view");
        $is_admin = isset($_SESSION['type']) && $_SESSION['type'] == "admin";
        $this->load->view("footer");
    }


    public function borrowed(){
        $data['title'] = "eICS Lib My Lib";
        $this->load->view("header", $data);

        $data['borrowed'] = $this->lend_model->get($_SESSION['username']);
        $this->load->view('borrowed_view', $data);

        $this->load->view("search_results_view");

        $this->load->view("footer");
    }

    public function favorites(){
        $data['title'] = "eICS Lib My Lib";
        $this->load->view("header", $data);

        $data['favorites'] = $this->favorite_model->get_all($_SESSION['username']);
        $this->load->view('favorites_view', $data);
        $this->load->view("search_results_view");

        $this->load->view("footer");
    }

    public function reserved(){
        $data['title'] = "eICS Lib My Lib";
        $this->load->view("header", $data);

        $rank = $this->reserve_model->check_book_ranks($_SESSION['username']);

        $data['book'] = $rank['book'];
        $data['reserves'] = $this->reserve_model->get($_SESSION['username']);

        $this->load->view('reserves_view', $data);

        $this->load->view("search_results_view");

        $this->load->view("footer");
    }

}

/* End of file booker.php */
/* Location: ./application/controllers/booker.php */