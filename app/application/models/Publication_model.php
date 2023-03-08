<?php
class Publication_model extends CI_Model {
  
  public function get_publications_by_author($author_name) {
    // Construire l'URL de l'API DBLP pour récupérer les publications de l'auteur
    $url = 'https://dblp.org/search/publ/api?q=author%3A'.urlencode($author_name).'&format=json';
    // Effectuer une requête HTTP pour récupérer les données de l'API DBLP
    $info = file_get_contents($url);
    // Décoder les données JSON en tableau associatif
    $publications = json_decode($info, true);

    // chemin du fichier cache
    $cache_file = APPPATH . 'cache/author/filter__' . $author_name .'__publications.json';

    // Récupération des publications de l'auteur depuis l'API dblp si elles n'existent pas déjà en base de données
    if (!file_exists($cache_file)) {
      // création du fichier cache
      file_put_contents($cache_file, $info);
    }
    
    // Ajout des publications de l'auteur depuis le cache
    $publications_cache = json_decode(file_get_contents($cache_file), true);
    if (isset($publications_cache['result']['hits']['hit'])) {
        $data['publications_cache'] = $publications_cache['result']['hits']['hit'];
    }
    // Retourner les résultats sous forme de tableau associatif
    return $publications;
  }

  public function get_publications_by_article($title) {
    // Construire l'URL de l'API DBLP pour récupérer les publications de l'auteur
    $url = 'https://dblp.org/search/publ/api?q='.urlencode($title).'&format=json';
    // Effectuer une requête HTTP pour récupérer les données de l'API DBLP
    $info = file_get_contents($url);
    // Décoder les données JSON en tableau associatif
    $publications = json_decode($info, true);

    // chemin du fichier cache
    $cache_file = APPPATH . 'cache/title/filter__' . $title .'__publications.json';

    // Récupération des publications de l'auteur depuis l'API dblp si elles n'existent pas déjà en base de données
    if (!file_exists($cache_file)) {
      // création du fichier cache
      file_put_contents($cache_file, $info);
    }
    
    // Ajout des publications de l'auteur depuis le cache
    $publications_cache = json_decode(file_get_contents($cache_file), true);
    if (isset($publications_cache['result']['hits']['hit'])) {
        $data['publications_cache'] = $publications_cache['result']['hits']['hit'];
    }
    // Retourner les résultats sous forme de tableau associatif
    return $publications;
  }



  public function insert_publications_from_json($json_data) {
    $publications = json_decode($json_data, true)['result']['hits']['hit'];
    $info = array();

    foreach ($publications as $publication) {
        $info = $publication['info'];
        $authors = array();
        foreach ($info['authors']['author'] as $author) {
            $authors[] = $author['text'];
        }
        
        $info[] = array(
            'id_dblp' => $info['title'],
            'venue' => $info['venue'],
            'year' => $info['year'],
            'authors' => implode(', ', $authors),
            'url' => $publication['url']
        );
    }

    /* Inserting the data into the database. */
    $this->db->insert_batch('publications', $info);

    
  }
}
?>
