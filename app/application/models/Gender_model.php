<?php
class Gender_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_gender_probability_name()
    {

        //Get all name from the database 
        $this->db->select('name');
        $this->db->from('_author');

        $resultat = $this->db->get()->result_array();

        $array_name_last_name = array();
        $array_name_last_name_temp = array();

        foreach ($resultat as $name_last_name) {
            // get just the name ( characters before the 1st space)
            $name = explode(" ", $name_last_name["name"]);
            
            array_push($array_name_last_name_temp, $name, $name_last_name);
            array_push($array_name_last_name, $name[0], $name_last_name["name"]);
        }

        $max = 1999; // max number of name send to genderize.io (1000 per day)

        for ($i=0; $i < ($max)-1; $i+=2) {

            // url send to genderize.io with author name
            $url = 'https://api.genderize.io?name=' . urlencode($array_name_last_name[$i]);
            $response = file_get_contents($url);

            $name_data = json_decode($response, true);

            // Get gender name and probability in php
            $names = $name_data['name'];
            $gender = $name_data['gender'];
            $probability = $name_data['probability'];


            try{
                $this->db->where('name', $array_name_last_name[$i+1]);
                $this->db->update('_author', array('gender' => $gender));
                $this->db->where('name', $array_name_last_name[$i+1]);
                $this->db->update('_author', array('probability' => $probability));
            } 
            catch (Exception $e) {
                // En cas d'erreur de la base de données, ajouter l'erreur à $all_data
                $all_data['error'] = $e->getMessage();
            }
        }
    }

    function display_gender($name, $restrict)
    {

         if ($restrict == false){
            $query = $this->db->query("select * from _author where name ilike '%$name%'");
            $result = $query->result_array();
         } else {
            $query = $this->db->query("select * from _author where name = '$name'");
            $result = $query->result_array();
        }

        return $result;

    }
}
