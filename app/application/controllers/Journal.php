<?php
class Journal extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Journal_model');
        $this->load->library('form_validation');
    }

    public function get_rank_categorie()
    {
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('Restrictive', 'Restrict', 'required');

        $name = $this->input->post('name');
        $restrict = $this->input->post('Restrictive');

        $res = $this->Journal_model->display_rank_categorie($name, $restrict);

        $data['content'] = 'rank_categorie_display';
        $data['title'] = 'Rank by Categorie';
        $data['array'] = $res;
        $data['name'] = $name;
        $this->load->vars($data);
        $this->load->view('template');
    }

    public function get_rank_title()
    {
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('Restrictive', 'Restrict', 'required');

        $name = $this->input->post('name');
        $restrict = $this->input->post('Restrictive');

        $res = $this->Journal_model->display_rank_title($name, $restrict);

        $data['content'] = 'rank_categorie_display';
        $data['title'] = 'Rank by Title';
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
