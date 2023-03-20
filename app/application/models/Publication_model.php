<?php
class Publication_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_publications_by_author($author_name)
    {

        // Construire l'URL de l'API DBLP pour récupérer les publications de l'auteur
        $url = 'https://dblp.org/search/publ/api?q=author%3A' . urlencode($author_name) . '&format=json';
        // Effectuer une requête HTTP pour récupérer les données de l'API DBLP
        $response = file_get_contents($url);

        $all_data = json_decode($response, true);

        // Récupérer le nombre total de résultats
        $total_results = $all_data['result']['hits']['@total'];

        // chemin du fichier cache
        $cache_file = APPPATH . 'cache/dblp/author/filter__' . $author_name . '__publications.json';

        // Enregistrer les résultats en cache
        file_put_contents($cache_file, $response);
        foreach ($all_data['result']['hits']['hit'] as $publication) {

            try {
                // Vérifier si l'auteur existe déjà
                $query = $this->db->get_where('_article', array('id_dblp' => $publication['@id']));
                $result = $query->row();

                if (!$result) {
                    if (isset($publication['info']['doi'])) {
                        if (isset($publication['info']['pages'])) {
                            $year = $publication['info']['pages'];
                        } else {
                            $year = '';
                        }
                        // Insertion des données dans la base de données si l'article n'est pas déjà dedans
                        $this->db->insert('_article', array(
                            'id_dblp' => intval($publication['@id']),
                            'type' => $publication['info']['type'],
                            'doi' => strval($publication['info']['doi']),
                            'title' => $publication['info']['title'],
                            'venue' => $publication['info']['venue'],
                            'year' => intval($publication['info']['year']),
                            'pages' => $year,
                            'ee' => $publication['info']['ee'],
                            'url_dblp' => $publication['info']['url'],
                        ));

                        foreach ($publication['info']['authors']['author'][0] as $author) {
                            // Vérifier si l'auteur existe déjà
                            $name = $author['text'];
                            $query = $this->db->get_where('_author', array('name' => $name));
                            $result = $query->row();

                            // Si l'auteur n'existe pas, l'ajouter
                            if (!$result) {
                                $this->db->insert('_author', array(
                                    'name' => $name,
                                ));
                            }
                        }
                    }

                }

            } catch (Exception $e) {
                // En cas d'erreur de la base de données, ajouter l'erreur à $all_data
                $all_data['error'] = $e->getMessage();
            }
        }

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
        $total_results = $all_data['result']['hits']['@total'];

        // Initialiser un tableau pour stocker tous les résultats
        $all_results = [];

        // chemin du fichier cache
        $cache_file = APPPATH . 'cache/dblp/title/filter__' . $title . '__publications.json';

        // Enregistrer les résultats en cache
        file_put_contents($cache_file, $response);

        if ($total_results > 1000) {
            $beggining = 0;
            $end = 1000;
            while ($beggining < $total_results) {
                $all_url = $url . '&h=' . $end . '&f=' . $beggining;
                $all_response = file_get_contents($all_url);
                $all_data = json_decode($all_response, true);
                $all_results = array_merge($all_results, $all_data['result']['hits']['hit']);
                $beggining += 1000;
                $end += 1000;

                foreach ($all_data['result']['hits']['hit'] as $publication) {
                    try {
                        // Vérifier si l'auteur existe déjà
                        $query = $this->db->get_where('_article', array('id_dblp' => $publication['@id']));
                        $result = $query->row();

                        if (!$result) {
                            if (isset($publication['info']['doi']) && isset($publication['info']['pages'])) {
                                // Insertion des données dans la base de données si l'article n'est pas déjà dedans
                                $this->db->insert('_article', array(
                                    'id_dblp' => intval($publication['@id']),
                                    'type' => $publication['info']['type'],
                                    'doi' => strval($publication['info']['doi']),
                                    'title' => $publication['info']['title'],
                                    'venue' => $publication['info']['venue'],
                                    'year' => intval($publication['info']['year']),
                                    'pages' => $publication['info']['pages'],
                                    'ee' => $publication['info']['ee'],
                                    'url_dblp' => $publication['info']['url'],
                                ));

                                foreach ($publication['info']['authors']['author'][0] as $author) {
                                    // Vérifier si l'auteur existe déjà
                                    $name = $author['text'];
                                    $query = $this->db->get_where('_author', array('name' => $name));
                                    $result = $query->row();

                                    // Si l'auteur n'existe pas, l'ajouter
                                    if (!$result) {
                                        $this->db->insert('_author', array(
                                            'name' => $name,
                                        ));
                                    }
                                }
                            }
                        }
                    } catch (Exception $e) {
                        // En cas d'erreur de la base de données, ajouter l'erreur à $all_data
                        $all_data['error'] = $e->getMessage();
                    }
                }
            }
        }

        // Retourner les publications sous forme de tableau associatif
        return $all_data;
    }
}
