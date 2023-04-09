<?php
class Conference_rank extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Conference_rank_model');
        $this->load->library('form_validation');
    }

    public function get_rank()
    {
        $this->form_validation->set_rules('name_acronym', 'Name_Acronym', 'required');

        // get the name of the conference from the form
        $name_acronym = $this->input->post('name_acronym');
        $restrictive = $this->input->post('Restrictive');

        // get the rank of the conference by using the models function
        $rank = $this->Conference_rank_model->get_conference_rank($name_acronym, $restrictive);

        $data['input'] = $name_acronym;
        $data['rank_array'] = $rank;
        $data['title'] = 'Conference rank';
        $data['content'] = 'conference_rank_list';
        
        /* Loading the template view. */
        $this->load->vars($data);
        $this->load->view('template');
    }

    public function confirmation()
    {
        $this->load->view('template');
    }

}
?>
