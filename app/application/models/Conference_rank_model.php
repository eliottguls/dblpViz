<?php
class Conference_rank_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_conference_rank($name_acronym, $restrictive)
    {
        if ($restrictive == true){
            //Get all name from the database 
            $query = $this->db->query("select * from _conference_acronym_rank where name_conference = '$name_acronym'");

            $result = $query->result_array();

            if (empty($result)) {
                $query = $this->db->query("select * from _conference_acronym_rank where acronym  = '$name_acronym'");
                $result = $query->result_array();
            }

            // if the sql request return with name and acronym return nothing
            if (empty($result)) {
                $result[0]['rank'] = "No rank found";
            } 

        return $result;

        }else {
            //Get all name from the database 
            $query = $this->db->query("select * from _conference_acronym_rank where name_conference ilike '%$name_acronym'");

            $result = $query->result_array();

            if (empty($result)) {
                $query = $this->db->query("select * from _conference_acronym_rank where acronym ilike '%$name_acronym'");
                $result = $query->result_array();
            }

            // if the sql request return with name and acronym return nothing
            if (empty($result)) {
                $result = "No rank found";
                return $result;
            }
            
            return $result;

        }

        
    }
}
