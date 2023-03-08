<?php
class Publication_model extends CI_Model {
  
  public function get_publications_by_author($author_name) {
    // Construire l'URL de l'API DBLP pour récupérer les publications de l'auteur
    $url = "https://dblp.org/search/publ/api?q=author%3AOrazio&format=json";
    // Effectuer une requête HTTP pour récupérer les données de l'API DBLP
    $data = file_get_contents($url);
    // Décoder les données JSON en tableau associatif
    $publications = json_decode($data, true);
    // Stocker les résultats dans un fichier JSON
    file_put_contents('publications.json', json_encode($publications));
    // Retourner les résultats sous forme de tableau associatif
    return $publications;
  }

  public function insert_publications_from_json($json_data) {
    $publications = json_decode($json_data, true)['result']['hits']['hit'];
    $data = array();

    foreach ($publications as $publication) {
        $info = $publication['info'];
        $authors = array();
        foreach ($info['authors']['author'] as $author) {
            $authors[] = $author['text'];
        }
        $data[] = array(
            'title' => $info['title'],
            'venue' => $info['venue'],
            'year' => $info['year'],
            'authors' => implode(', ', $authors),
            'url' => $publication['url']
        );
    }

    /* Inserting the data into the database. */
    $this->db->insert_batch('publications', $data);
}
}
?>
