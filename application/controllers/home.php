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
        $this->load->model('user_account_model');
        $this->load->model('admin_account_model');

        $this->load->helper("form");
        $this->load->library('safeguard');
    }

    public function index(){
        $data['title'] = "eICS Lib";
        $data['page'] = 'index';
        $this->load->view("header", $data); 
        $this->load->view("search_results_view");
        $is_admin = isset($_SESSION['type']) && $_SESSION['type'] == "admin";

        if ($is_admin){
            redirect(base_url() . 'ihome');
        }else{
            $this->load->view("announcements_view");
        }

        $this->load->view("footer");
    }

    public function ihome(){
        $data['title'] = "eICS Lib Home";
        $data['page'] = 'index';
        $this->load->view("header", $data);

        $is_admin = isset($_SESSION['type']) && $_SESSION['type'] == "admin";
        if ($is_admin){
            $this->load->view('admin_ihome_view');
            $this->load->view("announcements_manage_view");
            $this->load->view('book_manage_view');
        }
        if (isset($_SESSION['type']) && $_SESSION['type'] == "regular"){
            $data['notifs'] = $this->notifs_model->get_all($_SESSION['username'], 0);
            $this->load->view("search_results_view");
            $this->load->view("announcements_view");
            $this->load->view('notifications_view', $data);
        }

        if(!isset($_SESSION['type'])){
            $this->load->view("search_results_view");
            $this->load->view("announcements_view");
        }


        $this->load->view("footer");
    }

    public function logs(){
        $is_admin = isset($_SESSION['type']) && $_SESSION['type'] == "admin";
        if ($is_admin){
            $data['title'] = "eICS Lib Home";
            $data['page'] = 'index';
            $this->load->view("header", $data);

            $this->load->view('logs_view');
            $this->load->view("footer");
        }else{
            redirect(base_url());
        }


    }

    public function about_us(){
        $data['title'] = "eICS Lib About Us";
        $data['page'] = 'about_us';
        $this->load->view("header", $data);
        $this->load->view("search_results_view", $data);
        $this->load->view("about_us_view", $data);


        $this->load->view("footer");
    }

    public function faq(){
        $data['title'] = "eICS Lib FAQ";
        $data['page'] = 'faq';
        $this->load->view("header", $data);
        $this->load->view("search_results_view");
        $is_admin = isset($_SESSION['type']) && $_SESSION['type'] == "admin";
        if ($is_admin){
            $this->load->view('faq_manage_view', $data);
        }else{
            $this->load->view('faq_view', $data);
        }

        $this->load->view("footer");
    }

    public function borrowed(){
        $data['title'] = "eICS Lib My Lib";
        $this->load->view("header", $data);

        if(!isset($_SESSION['logged_in']) && $_SESSION['type'] != "regular")
            redirect(base_url());

        else{
            $data['borrowed'] = $this->lend_model->get($_SESSION['username']);
            $unreturned = $this->notifs_model->get_unreturned_by_user($_SESSION['username']);

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

        $this->load->view("search_results_view");
        $this->load->view("footer");
    }

    public function favorites(){
        $data['title'] = "eICS Lib My Lib";
        $this->load->view("header", $data);

        if(!isset($_SESSION['logged_in']) && $_SESSION['type'] != "regular")
            redirect(base_url());

        else {
            $data['favorites'] = $this->favorite_model->get_all($_SESSION['username']);
            $data['reserve_user'] = $this->reserve_model->get($_SESSION['username']);
            $data['lend_user'] = $this->lend_model->get($_SESSION['username']);

            $this->load->view('favorites_view', $data);
        }

        $this->load->view("search_results_view");
        $this->load->view("footer");
    }

    public function reserved(){
        $data['title'] = "eICS Lib My Lib";
        $this->load->view("header", $data);

        if(!isset($_SESSION['logged_in']) && $_SESSION['type'] != "regular")
            redirect(base_url());

        else{
            $data['book'] = $this->reserve_model->check_book_ranks();
            $data['reserves'] = $this->reserve_model->get($_SESSION['username']);
            $this->load->view('reserves_view', $data);
        }

        $this->load->view("search_results_view");
        $this->load->view("footer");
    }


    public function help(){
        $data['title'] = "eICS Lib Help";
        $data['page'] = 'help';
        $this->load->view("header", $data);

        $this->load->view("help_view",$data);
        $this->load->view("search_results_view",$data);

        $this->load->view("footer",$data);
    }

    public function create_account(){
        if(isset($_SESSION['logged_in']) && $_SESSION['type'] == "regular")
            redirect(base_url());

        $data['title'] = "eICS Lib Sign Up";
        $this->load->view("header", $data);
        $this->load->view("create_account_view", $data);
    }

    public function update_account(){
        if(!isset($_SESSION['logged_in']) && $_SESSION['type'] != "regular")
            redirect(base_url());  

        $data['title'] = "eICS Lib Sign Up";
        $this->load->view("header", $data);
        $username = $_SESSION['username'];
        $result=$this->user_account_model->get_data($username);
        $new_result = $this->safeguard->str_array_ready_for_display($result);
        $this->load->view('update_account_view', $new_result);
    }

    public function update_admin(){
        if(!isset($_SESSION['admin_logged_in']) && $_SESSION['type'] != "admin")
            redirect(base_url()); 

        $data['title'] = "eICS Lib Sign Up";
        $this->load->view("header", $data);

        $admin_username = $_SESSION['admin_username'];
        $data = $this->admin_account_model->get_admin_data($admin_username);
        $new_result = $this->safeguard->str_array_ready_for_display($data);
        $this->load->view('update_admin_view', $new_result);
    }

    public function accounts(){
        $data['title'] = "eICS Lib Sign Up";
        $this->load->view("header", $data);
        $this->load->view("search_user_view");
        $this->load->view("enable_disable_view");
        $this->load->view("footer");
        //put loading and stuff here
        $this->load->view("search_results_view",$data);
    }

}

/* End of file booker.php */
/* Location: ./application/controllers/booker.php */