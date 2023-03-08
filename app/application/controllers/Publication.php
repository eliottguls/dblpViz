<?php
class Publication extends CI_Controller {
  
    public function __construct(){
        parent::__construct();
        $this->load->model('Publication_model');
        $this->load->helper('url');
        $this->load->library('form_validation');
    }
  
    public function index(){
        // Récupération des publications de l'auteur depuis la base de données
        $this->load->model('Publication_model');
        $data['title']='List of publications';
        $data['content']='home';

        /* Loading the template view. */
        $this->load->vars($data);
        $this->load->view('template');
        
        
    }

    public function get_article_by_author(){
        $this->form_validation->set_rules('name', 'Name', 'required');

        $author_name = $this->input->post('name');


        // Récupération des publications de l'auteur depuis la base de données
        $publications = $this->Publication_model->get_publications_by_author($author_name);

        // Vérification que $publications n'est pas null avant de le passer à la vue
        if($publications !== null){
            $data['publications'] = $publications;
            $data['content']='publication_list';
            $data['title']='List of publications';
        } else {
            $data['title']='No list';
            $data['content']='no_list';
        }
        /* Loading the template view. */
        $this->load->vars($data);
        $this->load->view('template');
    }

    public function get_article_by_title(){
        $this->form_validation->set_rules('title', 'Title', 'required');

        $article_title = $this->input->post('title');


        // Récupération des publications de l'auteur depuis la base de données
        $publications = $this->Publication_model->get_publications_by_article($article_title);

        // Vérification que $publications n'est pas null avant de le passer à la vue
        if($publications !== null){
            $data['publications'] = $publications;
            $data['content']='publication_list';
            $data['title']='List of publications';
        } else {
            $data['title']='No list';
            $data['content']='no_list';
        }
        /* Loading the template view. */
        $this->load->vars($data);
        $this->load->view('template');
    }

    
    
}
?>
