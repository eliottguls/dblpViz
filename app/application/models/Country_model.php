<?php
class Country_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function get_country($name, $restrict)
    {

         if ($restrict == false){
            $query = $this->db->query("select * from _journal_location_publiser where title ilike '%$name%'");
            $result = $query->result_array();
         } else {
            $query = $this->db->query("select * from _journal_location_publiser where title = '$name'");
            $result = $query->result_array();
        }

        return $result;

    }
}
