<?php
class Country extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Country_model');
        $this->load->library('form_validation');
    }

    public function display_country()
    {
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('Restrictive', 'Restrict', 'required');

        $name = $this->input->post('name');
        $restrict = $this->input->post('Restrictive');

        $res = $this->Country_model->get_country($name, $restrict);

        $data['content'] = 'country_display';
        $data['title'] = 'Country | Region ';
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
