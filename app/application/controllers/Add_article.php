<?php
class Add_article extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Add_article_model');
        $this->load->library('form_validation');
    }

    public function new_conference()
    {
        $this->form_validation->set_rules('title_name', 'Name_Acronym', 'required');
        $this->form_validation->set_rules('venue', 'Venue', 'required');
        $this->form_validation->set_rules('year_name', 'Year_name', 'required');
        $this->form_validation->set_rules('type', 'Type', 'required');
        $this->form_validation->set_rules('pages', 'Pages', 'required');
        $this->form_validation->set_rules('doi', 'Doi', 'required');

        // get all the data from the form
        $title_name = $this->input->post('title_name');
        $venue = $this->input->post('venue');
        $year_name = $this->input->post('year_name');
        $type = $this->input->post('type');
        $pages = $this->input->post('pages');
        $doi = $this->input->post('doi');

        $this->Add_article_model->new_conference($title_name, $venue, $year_name, $type, $pages, $doi);

        $data['content'] = 'home';
        
        $this->load->view('home');
    }

    public function new_journal()
    {
        $this->form_validation->set_rules('title_name', 'Name_Acronym', 'required');
        $this->form_validation->set_rules('venue', 'Venue', 'required');
        $this->form_validation->set_rules('year_name', 'Year_name', 'required');
        $this->form_validation->set_rules('type', 'Type', 'required');
        $this->form_validation->set_rules('pages', 'Pages', 'required');
        $this->form_validation->set_rules('doi', 'Doi', 'required');
        $this->form_validation->set_rules('volume', 'Volume', 'required');
        $this->form_validation->set_rules('number_journal', 'Number_journal', 'required');

        // get all the data from the form
        $title_name = $this->input->post('title_name');
        $venue = $this->input->post('venue');
        $year_name = $this->input->post('year_name');
        $type = $this->input->post('type');
        $pages = $this->input->post('pages');
        $doi = $this->input->post('doi');
        $volume = $this->input->post('volume');
        $number_journal = $this->input->post('number_journal');

        $this->Add_article_model->new_journal($title_name, $venue, $year_name, $type, $pages, $doi, $volume, $number_journal);

        $data['content'] = 'home';
        
        $this->load->view('home');
    }

    public function confirmation()
    {
        $this->load->view('template');
    }

}
?>
