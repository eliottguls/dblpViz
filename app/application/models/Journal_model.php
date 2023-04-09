<?php
class Journal_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function display_rank_title($name, $restrict)
    {

         if ($restrict == false){
            $query = $this->db->query("select * from _Journal_Sub_Categories_Rank where name_journal ilike '%$name%'");
            $result = $query->result_array();
         } else {
            $query = $this->db->query("select * from _Journal_Sub_Categories_Rank where name_journal = '$name'");
            $result = $query->result_array();
        }

        return $result;

    }

    function display_rank_categorie($name, $restrict)
    {

         if ($restrict == false){
            $query = $this->db->query("select * from _Journal_Sub_Categories_Rank where name_categorie ilike '%$name%'");
            $result = $query->result_array();
         } else {
            $query = $this->db->query("select * from _Journal_Sub_Categories_Rank where name_categorie = '$name'");
            $result = $query->result_array();
        }

        return $result;

    }
}
