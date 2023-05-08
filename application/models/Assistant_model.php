<?php
    // class for Assistant_model
    class Assistant_model extends CI_Model{
        public function __construct(){
            parent::__construct();
            $this->load->database();

        }

        
        // display all appointments
        public function get_Appointments_count($status){
            $this->db->where('status',  $status);
            return $this->db->count_all_results('appointments');
        }


    }

?>