<?php
    // class for User_model
    class Procedures_model extends CI_Model{
        public function __construct(){
            parent::__construct();
            $this->load->database();
        }
      
        public function insert_procedure($data){
            $this->db->insert('Procedures', $data);
        }

        //view all users
        public function get_Users() { 
            
            return $users = $this->db->get('users')->result_array();
        }

        //view specific user
        public function get_myProcedure($procedure_id){
            // SELECT * FROM tblproducts WHERE prod_id != $id
            $this->db->where(array('procedure_id' => $procedure_id));
            $query = $this->db->get('procedures');
            $result = $query->row_array();
            return $result;
        }

        public function get_myName($id){
            // SELECT * FROM tblproducts WHERE prod_id != $id
            $this->db->select('firstname,middlename, lastname');
            $this->db->where(array('id' => $id));
            $query = $this->db->get('users');
            $result = $query->row_array();
            return $result;
        }

        public function update($procedure_id, $data){
            $this->db->where(array('procedure_id' => $procedure_id));
            $this->db->update('procedures', $data);
        }

        public function delete($procedure_id){
            $this->db->where(array('procedure_id' => $procedure_id));
            $this->db->delete('procedures');
        }

        //Activation
        public function activate_user($activation_code){
            $this->db->where('activation_code', $activation_code);
            $this->db->update('users', array('active' => 1));
        }
     
     
        public function get_procedures_count(){
            return $this->db->count_all('procedures');
        }
        
        public function get_procedures_with_limit($limit = 5, $offset = 0){
            // SELECT * FROM tblusers
            // $query = $this->db->get('tblusers');
            // return $query->result_array();
            $this->db->order_by('procedure_name', 'ASC');
            $query = $this->db->get('procedures', $limit, $offset);
            $result = $query->result_array();
            return $result;
        }
         // ARCHIVE PROCEDURE
         public function archive_procedure($procedure_id, $data){
            $this->db->where(array('procedure_id' => $procedure_id));
            $this->db->update('procedures', $data);
        }
            // ACTIVATE PROCEDURE
        public function activate_procedure($procedure_id, $data){
            $this->db->where(array('procedure_id' => $procedure_id));
            $this->db->update('procedures', $data);
        }


        public function get_procedures_search_count($search){
            $this->db->like('procedure_name', $search);
            $this->db->or_like('procedure_id', $search);
            $this->db->or_like('procedure_price', $search);
            $this->db->or_like('procedure_desc', $search);
            $this->db->or_like('procedure_duration', $search);
            $this->db->from('procedures');
            return $this->db->count_all_results();
        }

        public function search_procedure($search,$limit = 5, $offset = 0){
            // SELECT * FROM tblproducts WHERE prod_id != $id

            $this->db->like('procedure_name', $search);
            $this->db->or_like('procedure_id', $search);
            $this->db->or_like('procedure_price', $search);
            $this->db->or_like('procedure_desc', $search);
            $this->db->or_like('procedure_duration', $search);
            $this->db->order_by('procedure_name', 'ASC');
            $query = $this->db->get('procedures',$limit, $offset);
            $result = $query->result_array();
            return $result;
        }
        public function is_duplicate_procedure_id($procedure_id){
            $this->db->where('procedure_id', $procedure_id);
            $query = $this->db->get('procedures');
            return ($query->num_rows() > 0);
            
        }

    }