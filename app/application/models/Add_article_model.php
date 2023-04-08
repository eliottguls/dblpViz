<?php
class Add_article_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function new_conference($title_name, $venue, $year_name, $type, $pages, $doi)
    {



        $length = 20;
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $random_string = '';
        for ($i = 0; $i < $length; $i++) {
            $random_string .= $characters[rand(0, strlen($characters) - 1)];
        }

        $url_dblp = "https://dblp.org/rec/conf/" . $random_string . " ";

        $ee = "https://doi.org/" . $doi . " ";

        $query = $this->db->query("select * from _article");
        $result = $query->result_array();

        $random_number = rand();
        echo $random_number;

        $break = false;

        foreach ($result as $row['id_dblp']) {
            if ($row['id_dblp'] == $random_number) {
                $random_number = rand();
                $break = true;
                if ($break == true) {
                    break;
                }
            }
        }

        // Définir les valeurs à insérer
        $data_article = array(
            'id_dblp' => $random_number,
            'type' => $type,
            'doi' => $doi,
            'title' => $title_name,
            'venue' => $venue,
            'year' => $year_name,
            'pages' => $pages,
            'ee' => $ee,
            'url_dblp' => $url_dblp,
        );

        $this->db->insert('_article', $data_article);  

        $data_conference = array(
            'id_dblp' => $random_number,
        );

        $this->db->insert('_conference_article', $data_conference);

    }

    public function new_journal($title_name, $venue, $year_name, $type, $pages, $doi, $volume, $number_journal)
    {

        $length = 20;
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $random_string = '';
        for ($i = 0; $i < $length; $i++) {
            $random_string .= $characters[rand(0, strlen($characters) - 1)];
        }

        $url_dblp = "https://dblp.org/rec/conf/" . $random_string . " ";

        $ee = "https://doi.org/" . $doi . " ";

        $query = $this->db->query("select * from _article");
        $result = $query->result_array();

        $random_number = rand();
        echo $random_number;

        $break = false;

        foreach ($result as $row['id_dblp']) {
            if ($row['id_dblp'] == $random_number) {
                $random_number = rand();
                $break = true;
                if ($break == true) {
                    break;
                }
            }
        }

        // Définir les valeurs à insérer
        $data_article = array(
            'id_dblp' => $random_number,
            'type' => $type,
            'doi' => $doi,
            'title' => $title_name,
            'venue' => $venue,
            'year' => $year_name,
            'pages' => $pages,
            'ee' => $ee,
            'url_dblp' => $url_dblp,
        );

        $this->db->insert('_article', $data_article);  

        $data_journal = array(
            'id_dblp' => $random_number,
            'volume' => $volume,
            'number_journal' => $number_journal,
        );
        
        $this->db->insert('_journal_article', $data_journal);

    }

}

?>