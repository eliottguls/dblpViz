<?php
class Publication_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_gender_probability_name($author_name)
    {

        //Get all name from the database 
        $this->db->select('name');
        $this->db->from('_author');

        $resultat = $this->db->get()->row();
        $valeur = $resultat->nom_du_champ;


        // url send to genderize.io with author name
        $url = 'https://api.genderize.io?name=' . urlencode($author_name);
        $response = file_get_contents($url);

        $name_data = json_decode($response, true);

        // Get gender name and probability in php
        $names = $name_data['name'];
        $genders = $name_data['gender'];
        $probability = $name_data['probability'];

        // put file in cache
        $cache_file = APPPATH . 'cache/dblp/author/gender.json';

        // Save datas in cache
        file_put_contents($cache_file, $response);
        foreach ($all_data['result']['hits']['hit'] as $publication) {

            try {

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
}
