<?php
class Gender extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Gender_model');
    }

    public function gender_probability()
    {
        $this->Gender_model->get_gender_probability_name();
        $data['content'] = 'home';   
        $this->load->vars($data);
        $this->load->view('template');
    }

    public function confirmation()
    {
        $this->load->view('template');
    }

}
?>
