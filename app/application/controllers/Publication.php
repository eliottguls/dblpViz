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
        $data['content']='publication_list';
        
        // Récupération des publications de l'auteur depuis la base de données
        $publications = $this->Publication_model->get_publications_by_author('Orazio');

        // Vérification que $publications n'est pas null avant de le passer à la vue
        if($publications !== null){
            $data['publications'] = $publications;
        } else {
            $data['title']='No list';
            $data['content']='no_list';
        }

        // Récupération des publications de l'auteur depuis l'API dblp si elles n'existent pas déjà en base de données
        $cache_file = APPPATH . 'cache/publications.json';
        if (!file_exists($cache_file)) {
            $author_name = 'Orazio';
            $url = "https://dblp.org/search/publ/api?q=author%3AOrazio&format=json";
            $result = file_get_contents($url);
            file_put_contents($cache_file, $result);
        }

        // Ajout des publications de l'auteur depuis le cache
        $publications_cache = json_decode(file_get_contents($cache_file), true);
        if (isset($publications_cache['result']['hits']['hit'])) {
            $data['publications_cache'] = $publications_cache['result']['hits']['hit'];
        }

        /* Loading the template view. */
        $this->load->vars($data);
        $this->load->view('template');
    }

    
    
}
?>
