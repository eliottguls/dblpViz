<?php
class Gender extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Gender_model');
        $this->load->library('form_validation');
    }

    public function gender_probability()
    {
        $this->Gender_model->get_gender_probability_name();
        $data['content'] = 'home';   
        $this->load->vars($data);
        $this->load->view('template');
    }

    public function gender_display()
    {
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('Restrictive', 'Restrict', 'required');

        $name = $this->input->post('name');
        $restrict = $this->input->post('Restrictive');

        $res = $this->Gender_model->display_gender($name, $restrict);

        $data['content'] = 'gender_display';
        $data['title'] = 'Gender Probability';
        $data['array'] = $res;
        $data['name'] = $name;
        $this->load->vars($data);
        $this->load->view('template');
    }

    public function confirmation()
    {
        $this->load->view('template');
    }

}
?>
