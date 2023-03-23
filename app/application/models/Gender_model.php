<?php
class Publication_model extends CI_Model
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

        $resultat = $this->db->get()->row();

        $array_name_last_name = array();
        $array_name_last_name_temp = array();

        foreach ($resultat as $name_last_name) {
            print_r($name_last_name);
            // get just the name ( characters before the 1st space)
            $name = explode(" ", $name_last_name);
            array_push($array_name_last_name_temp, $name, $name_last_name);
            array_push($array_name_last_name, $array_name_last_name_temp);
        }


        
        $i = 0;

        foreach($array_name_last_name as $value){

            // url send to genderize.io with author name
            $url = 'https://api.genderize.io?name=' . urlencode($value[0]);
            $response = file_get_contents($url);

            $name_data = json_decode($response, true);

            // Get gender name and probability in php
            $names = $name_data['name'];
            $gender = $name_data['gender'];
            $probability = $name_data['probability'];

            $this->db->where('name', $value[1]);

            try{
                $this->db->update('_author', array('gender' => $gender));
                $this->db->update('_author', array('probability' => $probability));
            } 
            catch (Exception $e) {
                // En cas d'erreur de la base de données, ajouter l'erreur à $all_data
                $all_data['error'] = $e->getMessage();
            }
        }
    }
}
