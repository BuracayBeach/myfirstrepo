<?php if ( ! defined('BASEPATH')) exit('Unauthorized access.');

class Faq extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model('faq_model');
        $this->load->library('safeguard');
    }

    public function delete(){
        if(isset($_POST['id'])){
        $id = mysql_real_escape_string($_POST['id']);
        $this->faq_model->delete_faq($id);}
    }

    public function add(){
        if(isset($_POST)){
        $data = $this->safeguard->array_ready_for_query($_POST);
        $this->faq_model->add_faq($data);

        $data['question'] = htmlspecialchars(stripslashes(trim($data['question'])));
        $data['answer'] = stripslashes(trim($data['answer']));
        echo json_encode($data);}
    }

    public function get_faq(){
        if(isset($_POST['id'])){
        $id = mysql_real_escape_string($_POST['id']);

        $faq = $this->faq_model->get_faq($id);

        echo json_encode($faq);}
    }

    public function get_all_faq(){
        $faqs = $this->faq_model->get_all_faq();

        foreach($faqs as &$e){
            $e->question = htmlspecialchars(stripslashes(trim(  $e->question)));
            $e->answer = stripslashes(trim(  $e->answer));
        }
        echo json_encode($faqs);
    }

    public function edit(){
        if(isset($_POST)){
        $data = $this->safeguard->array_ready_for_query($_POST);
        $this->faq_model->edit_faq($data);

        echo json_encode($_POST);}
    }

}

/* End of file faq.php */
/* Location: ./application/controllers/faq.php */