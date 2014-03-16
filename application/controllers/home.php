<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *      http://example.com/index.php/welcome
     *  - or -
     *      http://example.com/index.php/welcome/index
     *  - or -
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
        $this->load->model('user_account_model');
        $this->load->model('admin_account_model');

        $this->load->helper("form");
        $this->load->library('safeguard');
        if(!isset($_SESSION))
            session_start();
    }

    public function index(){
        $data['title'] = "ComLib";
        $data['page'] = 'index';
        $this->load->view("header", $data); 
        $this->load->view("search_google_view"); 
        // $this->load->view("search_results_view");

        $is_admin = isset($_SESSION['type']) && $_SESSION['type'] == "admin";

        if ($is_admin){
            redirect(base_url() . 'ihome');
        }

        if (isset($_SESSION['type']) && $_SESSION['type'] == "regular"){
            $data['notifs'] = $this->notifs_model->get_all($_SESSION['username'], 0);
            $data['notifs'] = $this->safeguard->query_result_ready_for_display($data['notifs']);
            $data['notifs_count'] = $this->notifs_model->count_by_username($_SESSION['username']);
            $this->load->view('notifications_view', $data);
        }

        $this->load->view("footer",$data);
    }

    public function ihome(){
        $data['title'] = "ComLib Home";
        $data['page'] = 'index';
        $this->load->view("header", $data);
        $this->load->view("search_view");

        $is_admin = isset($_SESSION['type']) && $_SESSION['type'] == "admin";
        if ($is_admin){
            $this->load->view('admin_ihome_view');
            $this->load->view("announcements_manage_view");
            $this->load->view('book_manage_view');
        }

        $search_from_google_page = isset($_POST) && isset($_POST['home_search_text']);

        if (isset($_SESSION) && isset($_SESSION['search_data']) && isset($_SESSION['search_data']['searchFromOtherPage'])){
            $search_from_other_page = $_SESSION['search_data']['searchFromOtherPage'];
        } else {
            $search_from_other_page = 'false';
        }

        if ($search_from_google_page || $search_from_other_page != 'false') $autoSubmitSearch = 'true';
        else $autoSubmitSearch = 'false';

        if (isset($_SESSION['type']) && $_SESSION['type'] == "regular"){
            $data['notifs'] = $this->notifs_model->get_all($_SESSION['username'], 0);
            $data['notifs'] = $this->safeguard->query_result_ready_for_display($data['notifs']);
            $data['notifs_count'] = $this->notifs_model->count_by_username($_SESSION['username']);
            $this->load->view("search_results_view");

            if ($autoSubmitSearch != 'true') $this->load->view("announcements_view");
            if ($autoSubmitSearch != 'true') $this->load->view("home_contents_view");
            $this->load->view('notifications_view', $data);
        }

        if(!isset($_SESSION['type'])){
            if ($autoSubmitSearch != 'true') $this->load->view("announcements_view");
            $this->load->view("search_results_view");
            if ($autoSubmitSearch != 'true') $this->load->view("home_contents_view");
        }


        $this->load->view("footer");
    }

    public function logs(){
        if(!(isset($_SESSION) && isset($_SESSION['admin_logged_in'])))
            redirect(base_url());

            $data['title'] = "ComLib Logs";
            $data['page'] = 'index';
            $this->load->view("header", $data);
            $this->load->view("search_view");

            $this->load->view('logs_view');
            $this->load->view("footer");
    }

    public function about_us(){
        $data['title'] = "ComLib About Us";
        $this->load->view("header", $data);
        $this->load->view("search_view");
        $this->load->view("about_us_view", $data);

        if (isset($_SESSION['type']) && $_SESSION['type'] == "regular"){
            $data['notifs'] = $this->notifs_model->get_all($_SESSION['username'], 0);
            $data['notifs'] = $this->safeguard->query_result_ready_for_display($data['notifs']);
            $data['notifs_count'] = $this->notifs_model->count_by_username($_SESSION['username']);
            $this->load->view('notifications_view', $data);
        }

        $this->load->view("footer");
    }

    public function faq(){
        $data['title'] = "ComLib FAQ";
        $data['page'] = 'faq';
        $this->load->view("header", $data);
        $this->load->view("search_view");
        $this->load->view("search_results_view");

        $is_admin = isset($_SESSION['type']) && $_SESSION['type'] == "admin";
        if ($is_admin){
            $this->load->view('faq_manage_view', $data);
        }else{
            $this->load->view('faq_view', $data);
        }

        if (isset($_SESSION['type']) && $_SESSION['type'] == "regular"){
            $data['notifs'] = $this->notifs_model->get_all($_SESSION['username'], 0);
            $data['notifs'] = $this->safeguard->query_result_ready_for_display($data['notifs']);
            $data['notifs_count'] = $this->notifs_model->count_by_username($_SESSION['username']);
            $this->load->view('notifications_view', $data);
        }

        $this->load->view("footer");
    }

    public function borrowed(){
        $data['title'] = "ComLib My Lib";
        $this->load->view("header", $data);
        $this->load->view("search_view");

        if(!isset($_SESSION['logged_in']) && $_SESSION['type'] != "regular")
            redirect(base_url());

        else{
            $data['borrowed'] = $this->lend_model->get($_SESSION['username']);
            $data['borrowed'] = $this->safeguard->query_result_ready_for_display($data['borrowed']);
            $unreturned = $this->notifs_model->get_unreturned_by_user($_SESSION['username']);
            $unreturned = $this->safeguard->query_result_ready_for_display($unreturned);


            if ($unreturned != "") {

                $days_elapsed = array();
                foreach ($unreturned as $row) {
                    $diff = date_diff(date_create($row->date_borrowed), date_create(date('Y-m-d H:i:s')));
                    $days = $diff->format("%a");

                    $days_elapsed[$row->book_no] = $days;
                }
                $data['days_elapsed'] = $days_elapsed;
                $this->load->view('borrowed_view', $data);
            }
        }

        if (isset($_SESSION['type']) && $_SESSION['type'] == "regular"){
            $data['notifs'] = $this->notifs_model->get_all($_SESSION['username'], 0);
            $data['notifs'] = $this->safeguard->query_result_ready_for_display($data['notifs']);
            $data['notifs_count'] = $this->notifs_model->count_by_username($_SESSION['username']);
            $this->load->view('notifications_view', $data);
        }

        $this->load->view("search_results_view");
        $this->load->view("footer");
    }

    public function favorites(){

        $data['title'] = "ComLib My Lib";
        $this->load->view("header", $data);
        $this->load->view("search_view");

        if(!isset($_SESSION['logged_in']) && $_SESSION['type'] != "regular")
            redirect(base_url());

        else {
            $data['favorites'] = $this->favorite_model->get_all($_SESSION['username']);
            $data['favorites'] = $this->safeguard->query_result_ready_for_display($data['favorites']);
            $data['reserve_user'] = $this->reserve_model->get($_SESSION['username']);
            $data['reserve_user'] = $this->safeguard->query_result_ready_for_display($data['reserve_user']);
            $data['lend_user'] = $this->lend_model->get($_SESSION['username']);
            $data['lend_user'] = $this->safeguard->query_result_ready_for_display($data['lend_user']);


            $this->load->view('favorites_view', $data);
        }

        if (isset($_SESSION['type']) && $_SESSION['type'] == "regular"){
            $data['notifs'] = $this->notifs_model->get_all($_SESSION['username'], 0);
            $data['notifs'] = $this->safeguard->query_result_ready_for_display($data['notifs']);
            $data['notifs_count'] = $this->notifs_model->count_by_username($_SESSION['username']);
            $this->load->view('notifications_view', $data);
        }

        $this->load->view("search_results_view");
        $this->load->view("footer");
    }

    public function reserved(){
        $data['title'] = "ComLib My Lib";
        $this->load->view("header", $data);
        $this->load->view("search_view");

        if(!isset($_SESSION['logged_in']) && $_SESSION['type'] != "regular")
            redirect(base_url());

        else{
            $data['book'] = $this->reserve_model->check_book_ranks();
            $data['reserves'] = $this->reserve_model->get($_SESSION['username']);
            $data['reserves'] = $this->safeguard->query_result_ready_for_display($data['reserves']);
            $this->load->view('reserves_view', $data);
        }

        if (isset($_SESSION['type']) && $_SESSION['type'] == "regular"){
            $data['notifs'] = $this->notifs_model->get_all($_SESSION['username'], 0);
            $data['notifs'] = $this->safeguard->query_result_ready_for_display($data['notifs']);
            $data['notifs_count'] = $this->notifs_model->count_by_username($_SESSION['username']);
            $this->load->view('notifications_view', $data);
        }

        $this->load->view("search_results_view");
        $this->load->view("footer");
    }


    public function help(){
        $data['title'] = "ComLib Help";
        $data['page'] = 'help';
        $this->load->view("header", $data);
        $this->load->view("search_view");

        $this->load->view("help_view",$data);
        $this->load->view("search_results_view",$data);

        if (isset($_SESSION['type']) && $_SESSION['type'] == "regular"){
            $data['notifs'] = $this->notifs_model->get_all($_SESSION['username'], 0);
            $data['notifs'] = $this->safeguard->query_result_ready_for_display($data['notifs']);
            $data['notifs_count'] = $this->notifs_model->count_by_username($_SESSION['username']);
            $this->load->view('notifications_view', $data);
        }

        $this->load->view("footer",$data);
    }

    public function create_admin_account(){
        if(!(isset($_SESSION) && isset($_SESSION['admin_logged_in'])))
            redirect(base_url());
//        if(isset($_SESSION['logged_in']) && $_SESSION['type'] != "admin")

        $data['title'] = "ComLib Admin Create";
        $this->load->view("header", $data);
        $this->load->view("search_view");
        $this->load->view('create_admin_view');
    }

    public function create_account(){
        if(isset($_SESSION) && isset($_SESSION['logged_in']) && $_SESSION['logged_in'])
            redirect(base_url());

        $data['title'] = "ComLib Sign Up";
        $this->load->view("header", $data);
        $this->load->view("search_view");
        $this->load->view("create_account_view", $data);
    }

    public function update_account(){
        if(!(isset($_SESSION) && isset($_SESSION['logged_in'])))
            redirect(base_url());  

        $data['title'] = "ComLib Update";
        $this->load->view("header", $data);
        $this->load->view("search_view");
        $username = $_SESSION['username'];
        $result=$this->user_account_model->get_data($username);
        $new_result = $this->safeguard->str_array_ready_for_display($result);
        $this->load->view('update_account_view', $new_result);

        if (isset($_SESSION['type']) && $_SESSION['type'] == "regular"){
            $data['notifs'] = $this->notifs_model->get_all($_SESSION['username'], 0);
            $data['notifs_count'] = $this->notifs_model->count_by_username($_SESSION['username']);
            $this->load->view('notifications_view', $data);
        }
    }

    public function update_admin(){
        if(!(isset($_SESSION) && isset($_SESSION['admin_logged_in'])))
            redirect(base_url()); 

        $data['title'] = "ComLib Update";
        $this->load->view("header", $data);
        $this->load->view("search_view");

        $admin_username = $_SESSION['admin_username'];
        $data = $this->admin_account_model->get_admin_data($admin_username);
        $new_result = $this->safeguard->str_array_ready_for_display($data);
        $this->load->view('update_admin_view', $new_result);
    }

    public function accounts(){
        if(!(isset($_SESSION) && isset($_SESSION['admin_logged_in'])))
            redirect(base_url());

        $data['title'] = "ComLib Accounts";
        $this->load->view("header", $data);
        $this->load->view("search_view");
        $this->load->view("search_user_view");
        $this->load->view("enable_disable_view");
        $this->load->view("footer");
        //put loading and stuff here
        $this->load->view("search_results_view",$data);
    }

    public function create_admin()
    {
        if(!(isset($_SESSION) && isset($_SESSION['admin_logged_in'])
            && $_SESSION['admin_username'] == "admin"))
            redirect(base_url()); 
        
        $data['title'] = "ComLib Admin Create";
        $this->load->view("header", $data);
        $this->load->view("search_view");
        $this->load->view("create_admin_view");
        $this->load->view("footer");
    }

    public function delete_admins()
    {
        if(!(isset($_SESSION) && isset($_SESSION['admin_logged_in'])
            && $_SESSION['admin_username'] == "admin"))
            redirect(base_url());
        
        $data['title'] = "ComLib Admin Delete";
        $this->load->view("header", $data);
        $this->load->view("search_view");
        $this->load->view("delete_admin_view");
        $this->load->view("footer");
        //put loading and stuff here
        $this->load->view("search_results_view",$data);
    }

}

/* End of file booker.php */
/* Location: ./application/controllers/booker.php */