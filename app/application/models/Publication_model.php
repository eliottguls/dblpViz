<?php
class Publication_model extends CI_Model
{

    public function get_publications_by_author($author_name)
    {

        // Construire l'URL de l'API DBLP pour récupérer les publications de l'auteur
        $url = 'https://dblp.org/search/publ/api?q=author%3A' . urlencode($author_name) . '&format=json';
        // Effectuer une requête HTTP pour récupérer les données de l'API DBLP
        $response = file_get_contents($url);

        $info = json_decode($response, true);

        // Récupérer le nombre total de résultats
        $total_results = $info['result']['hits']['@total'];

        try {
          // Insertion des données dans la base de données
          $this->$db->insert('_article', array(
              'id_dblp' => intval($all_data['result']['hits']['hit']['@id']),
              'doi' => $all_data['result']['hits']['hit']['info']['doi'],
              'title' => $all_data['result']['hits']['hit']['info']['title'],
              'venue' => $all_data['result']['hits']['hit']['info']['venue'],
              'year' => intval($all_data['result']['hits']['hit']['info']['year']),
              'pages' => $all_data['result']['hits']['hit']['info']['pages'],
              'ee' => $all_data['result']['hits']['hit']['info']['ee'],
              'url_dblp' => $all_data['result']['hits']['hit']['info']['url'],
          ));
  
          foreach ($all_data['result']['hits']['hit']['info']['authors']['author']['text'] as $author) {
              // Vérifier si l'auteur existe déjà
              $query = $this->db->get_where('_author', array('name' => $author));
              $result = $query->row();
  
              // Si l'auteur n'existe pas, l'ajouter
              if (!$result) {
                  $this->db->insert('_author', array('name' => $author));
              }
          }
      } catch (Exception $e) {
          // En cas d'erreur de la base de données, ajouter l'erreur à $all_data
          $all_data['error'] = $e->getMessage();
      }
  

        // chemin du fichier cache
        $cache_file = APPPATH . 'cache/dblp/author/filter__' . $author_name . '__publications.json';

        // Enregistrer les résultats en cache
        file_put_contents($cache_file, $all_response);

        // Retourner les résultats sous forme de tableau associatif
        return $all_data;
    }

    public function get_publications_by_article($title)
{
    // Construire l'URL de l'API DBLP pour récupérer les publications de l'auteur
    $url = 'https://dblp.org/search/publ/api?q=' . urlencode($title) . '&format=json';

    // Effectuer une requête HTTP pour récupérer les données de l'API DBLP
    $response = file_get_contents($url);
    $all_data = json_decode($response, true);

    // Récupérer le nombre total de résultats
    $total_results = $info['result']['hits']['@total'];

    // Initialiser un tableau pour stocker tous les résultats
    $all_results = [];


    try {
        // Insertion des données dans la base de données
        $this->$db->insert('_article', array(
            'id_dblp' => intval($all_data['result']['hits']['hit']['@id']),
            'doi' => $all_data['result']['hits']['hit']['info']['doi'],
            'title' => $all_data['result']['hits']['hit']['info']['title'],
            'venue' => $all_data['result']['hits']['hit']['info']['venue'],
            'year' => intval($all_data['result']['hits']['hit']['info']['year']),
            'pages' => $all_data['result']['hits']['hit']['info']['pages'],
            'ee' => $all_data['result']['hits']['hit']['info']['ee'],
            'url_dblp' => $all_data['result']['hits']['hit']['info']['url'],
        ));

        foreach ($all_data['result']['hits']['hit']['info']['authors']['author']['text'] as $author) {
            // Vérifier si l'auteur existe déjà
            $query = $this->db->get_where('_author', array('name' => $author));
            $result = $query->row();

            // Si l'auteur n'existe pas, l'ajouter
            if (!$result) {
                $this->db->insert('_author', array('name' => $author));
            }
        }
    } catch (Exception $e) {
        // En cas d'erreur de la base de données, ajouter l'erreur à $all_data
        $all_data['error'] = $e->getMessage();
    }

    // chemin du fichier cache
    $cache_file = APPPATH . 'cache/dblp/title/filter__' . $title . '__publications.json';

    // Enregistrer les résultats en cache
    file_put_contents($cache_file, $all_response);

    // Retourner les publications sous forme de tableau associatif
    return $all_data;


        /*
        foreach ($all_results as $publi){
        $year = $all_results['result']['hits']['hit']['info']['year'];
        // URL de l'API Scimago
        $url = "https://www.scimagojr.com/journalrank.php?out=json&year=".$year;

        // Récupérer les données JSON depuis l'API
        $json_data = file_get_contents($url);

        $cache_file = APPPATH . 'cache/scimago/'.$year .'__ranks.json';
        file_put_contents($cache_file, $json_data);

        // Convertir les données JSON en tableau PHP
        $output = json_decode($json_data, true);

        // Récupérer le classement des articles par catégorie
        $categories = $output['categories'];
        foreach ($categories as $category) {
        $category_name = $category['category'];
        $rankings = $category['ranks'];
        foreach ($rankings as $ranking) {
        $data['rank'] = $ranking['rank'];
        $this->$db->insert('_rank', array(
        'id_article' => $$all_results['@id'],
        'rank' => $data['rank'],
        'categorie' => $category_name
        ));
        }
        }
        }*/

    }
}
