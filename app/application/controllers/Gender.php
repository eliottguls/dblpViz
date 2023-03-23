<?php
class Publication_controller extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Gender_model');
    }

    public function gender_probability()
    {
        $this->Gender_model->get_gender_probability_name();
        redirect('/app');
    }

    public function confirmation()
    {
        $this->load->view('template');
    }

}
?>
