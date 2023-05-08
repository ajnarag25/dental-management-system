<?php
    // class for User_model
    class Patient_model extends CI_Model{
        public function __construct(){
            parent::__construct();
            $this->load->database();
        }

        public function get_user_myappointments($id){
            
            $this->db->where('user_id',  $id);
            $this->db->order_by('appointment_date', 'ASC');
            $query = $this->db->get('appointments');
            $result = $query->result_array();
            return $result;
        }


        public function get_user_myappointment_details($id){
            // SELECT * FROM tblproducts WHERE prod_id != $id
            $this->db->where(array('appointment_id' => $id));
            $query = $this->db->get('appointments');
            $result = $query->row_array();
            return $result;
        }

        public function get_user_patient_info($user_id){
            $this->db->where(array('id' => $user_id));
            $query = $this->db->get('users');
            $result = $query->row_array();
            return $result;
        }


          
        // public function search_user_myappointments($search,$limit = 5, $offset = 0){
        //     // SELECT * FROM tblproducts WHERE prod_id != $id
        //     $this->db->where('user_id', $search);
        //     $this->db->group_start();
        //     $this->db->like('appointment_id', $search);
        //     $this->db->or_like('start_time', $search);
        //     $this->db->or_like('appointment_date', $search);
        //     $this->db->or_like('service_name', $search);
        //     $this->db->or_like('status', $search);
        //     $this->db->group_end();
        //     $this->db->order_by('appointment_id', 'ASC');
        //     $query = $this->db->get('appointments',$limit, $offset);
        //     $result = $query->result_array();
        //     return $result;
        // }
        // public function get_users_search_count_myappointments($search){
        //     $this->db->where('user_id', $search);
        //     $this->db->group_start();
        //     $this->db->like('appointment_id', $search);
        //     $this->db->or_like('start_time', $search);
        //     $this->db->or_like('appointment_date', $search);
        //     $this->db->or_like('service_name', $search);
        //     $this->db->or_like('status', $search);
        //     $this->db->group_end();
        //     $this->db->from('appointments');
        //     return $this->db->count_all_results();
        // }


        // PAGINATION FOR INDEX
        // public function get_user_myappointment($user_id){
        //     $this->db->where('user_id', $user_id);
        //     return $this->db->count_all('appointments');
        // }
           

        // GET THE UPCOMING APPOINTMENTS FOR THE PATIENT
        public function get_user_upcoming_appointments($id){
            $current_date = date('Y-m-d');
            $one_week_later = date('Y-m-d', strtotime('+1 week'));
            
            $this->db->where('user_id', $id);
            $this->db->where('appointment_date BETWEEN "'.$current_date.'" AND "'.$one_week_later.'"');
            $this->db->order_by('appointment_date', 'ASC');
            $query = $this->db->get('appointments');
            
            $result = $query->result_array();
            return $result;
        }

        
        public function get_myappointment_count($id){
            $this->db->from('appointments');
            $this->db->where('user_id', $id);
            return $this->db->count_all_results();
        }

        public function get_appointments_with_limit($id, $limit = 5, $offset = 0){
            // SELECT * FROM tblproducts WHERE prod_id != $id
            $this->db->where('user_id', $id);
            $this->db->order_by('appointment_date', 'ASC');
            $query = $this->db->get('appointments',$limit, $offset);
            $result = $query->result_array();
            return $result;
        }

   

        public function get_myappointment_search_count($search, $id){
   
            $this->db->where('user_id', $id);
            $this->db->like('appointment_date', $search);
            $this->db->or_like('start_time', $search);
            $this->db->or_like('end_time', $search);
            $this->db->or_like('service_name', $search);
            $this->db->or_like('status', $search);
            $this->db->from('appointments');
            return $this->db->count_all_results();
        }

        
        public function search_myappointments($search,$id,$limit = 5, $offset = 0){
            // SELECT * FROM tblproducts WHERE prod_id != $id
            $this->db->where('user_id', $id);
            $this->db->like('appointment_date', $search);
            $this->db->or_like('start_time', $search);
            $this->db->or_like('end_time', $search);
            $this->db->or_like('service_name', $search);
            $this->db->or_like('status', $search);
            $this->db->order_by('appointment_date', 'ASC');
            $query = $this->db->get('appointments',$limit, $offset);
            $result = $query->result_array();
            return $result;
        }
    }
?>