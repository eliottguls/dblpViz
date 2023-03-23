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
        if(array_key_exists('hit', $publications['result']['hits'])){
            $data['publications'] = $publications;
            if (array_key_exists('error', $publications)){
                $data['error'] = $publications['error'];
            } else {
                $data['error'] = 'No db error';
            }
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

    public function get_cited_by(){
        $this->form_validation->set_rules('key', 'Key', 'required');

        $article_key = $this->input->post('key');

        $cited_by = $this->Publication_model->get_cited_by($article_key);
        
        $data['cited_by'] = $cited_by;
        $data['content']='cite_by_list';
        $data['doi']=$article_key;
        $data['title']='List of cite_by';
        
    }

    public function get_article_by_title(){

        $this->form_validation->set_rules('title', 'Title', 'required');

        $article_title = $this->input->post('title');


        // Récupération des publications de l'auteur depuis la base de données
        $publications = $this->Publication_model->get_publications_by_article($article_title);
        
        // Vérification que $publications n'est pas null avant de le passer à la vue
        if($publications['result']['hits']['hit'] !== null){
            $data['publications'] = $publications;
            $data['content']='publication_list';
            $data['title']='List of publications';
        } else {
            $data['error'] = $publications;
            $data['title']='No list';
            $data['content']='no_list';
        }


        /* Loading the template view. */
        $this->load->vars($data);
        $this->load->view('template');
    }

    public function get_article_by_key_to_bibtex($key){


        // Récupérer les informations de l'article depuis DBLP
        $article_xml = simplexml_load_file("https://dblp.org/rec/xml/" . $key . ".xml");

        // Vérifier si l'article existe
        if ($article_xml === false) {
            echo "L'article avec l'identifiant " . $article_xml . " n'existe pas sur DBLP.";
        } else {
            // Extraire les informations nécessaires de l'article
            $author_str = "";
            foreach ($article_xml->authors->author as $author) {
                $author_str .= $author . " and ";
            }
            $data['bibtex']['authors'] = $author_str;
            $data['bibtex']['title'] = $article_xml->title;
            $data['bibtex']['booktitle'] = $article_xml->booktitle;
            $data['bibtex']['pages'] = $article_xml->pages;
            $data['bibtex']['year'] = $article_xml->year;
        }


        $data['content']='bibtex_view';
        $data['title']='BibTeX view';
        /* Loading the template view. */
        $this->load->vars($data);
        $this->load->view('template');

    }
}
?>
