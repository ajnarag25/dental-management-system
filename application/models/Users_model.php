<?php
    // class for User_model
    class Users_model extends CI_Model{
        public function __construct(){
            parent::__construct();
            $this->load->database();
        }
        public function get_user($email, $password){
            $this->db->where(array(
                'email' => $email,
                'password' => $password
            ));
            $query = $this->db->get('Users');
            $result = $query->row_array();
            return $result;
        }           
        public function insert_user($data){
            $this->db->insert('Users', $data);
        }

        //view all users
        public function get_Users() { 
            
            return $users = $this->db->get('users')->result_array();
        }

        //view specific user
        public function get_myUser($id){
            // SELECT * FROM tblproducts WHERE prod_id != $id
            $this->db->where(array('id' => $id));
            $query = $this->db->get('users');
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

        public function update($id, $data){
            $this->db->where(array('id' => $id));
            $this->db->update('users', $data);
        }

        public function delete($id){
            $this->db->where(array('id' => $id));
            $this->db->delete('users');
        }

        //Activation
        public function activate_user($activation_code){
            $this->db->where('activation_code', $activation_code);
            $this->db->update('users', array('active' => 1));
        }

        public function Update_user_password($id, $data){
            $this->db->set($data);
            $this->db->where('id',  $id);
            $this->db->update('users');

            if($this->db->affected_rows() > 0){
                return true;
            }else {
                return false;
            }

        }

        public function Check_current_password($id, $cur_password){
            $this->db->where('id', $id);
            $this->db->where('password',  $cur_password);
            $query =$this->db->get('users');

            if($query->num_rows() > 0){
                return true;
            }else {
                return false;
            }

        }
     
     
        public function get_users_count(){
            $this->db->where('role', 'patient');
            return $this->db->count_all_results('users');
        }
        public function get_users_count_assistants(){
            $this->db->where('role', 'assistant');
            return $this->db->count_all_results('users');
        }
        
        public function get_users_with_limit($limit = 5, $offset = 0){
            // SELECT * FROM tblusers
            // $query = $this->db->get('tblusers');
            // return $query->result_array();
            $this->db->where('role', 'patient');
            $this->db->order_by('firstname', 'ASC');
            $query = $this->db->get('users', $limit, $offset);
            $result = $query->result_array();
            return $result;

            // $this->db->where(array('status' => 'active'));
            // $this->db->order_by('firstname', 'ASC');
            // $query = $this->db->get('users', $limit, $offset)->result_array();
            // return $query;
        }
        public function get_users_with_limit_assistants($limit = 5, $offset = 0){
            // SELECT * FROM tblusers
            // $query = $this->db->get('tblusers');
            // return $query->result_array();
            $this->db->where('role', 'assistant');
            $this->db->order_by('firstname', 'ASC');
            $query = $this->db->get('users', $limit, $offset);
            $result = $query->result_array();
            return $result;

            // $this->db->where(array('status' => 'active'));
            // $this->db->order_by('firstname', 'ASC');
            // $query = $this->db->get('users', $limit, $offset)->result_array();
            // return $query;
        }

        public function get_users_search_count($search){
            $this->db->where('role', 'patient');
            $this->db->group_start();
            $this->db->like('firstname', $search);
            $this->db->or_like('middlename', $search);
            $this->db->or_like('lastname', $search);
            $this->db->or_like('contactno', $search);
            $this->db->or_like('gender', $search);
            $this->db->or_like('occupation', $search);
            $this->db->or_like('email', $search);
            $this->db->or_like('address', $search);
            $this->db->group_end();
            $this->db->from('users');
            return $this->db->count_all_results();
        }
        
        public function get_users_search_count_assistant($search){
            $this->db->where('role', 'assistant');
            $this->db->group_start();
            $this->db->like('firstname', $search);
            $this->db->or_like('middlename', $search);
            $this->db->or_like('lastname', $search);
            $this->db->or_like('contactno', $search);
            $this->db->or_like('gender', $search);
            $this->db->or_like('occupation', $search);
            $this->db->or_like('email', $search);
            $this->db->or_like('address', $search);
            $this->db->group_end();
            $this->db->from('users');
            return $this->db->count_all_results();
        }
        
        public function search_user($search,$limit = 5, $offset = 0){
            // SELECT * FROM tblproducts WHERE prod_id != $id
            $this->db->where('role', 'patient');
            $this->db->group_start();
            $this->db->like('firstname', $search);
            $this->db->or_like('middlename', $search);
            $this->db->or_like('lastname', $search);
            $this->db->or_like('contactno', $search);
            $this->db->or_like('gender', $search);
            $this->db->or_like('occupation', $search);
            $this->db->or_like('email', $search);
            $this->db->or_like('address', $search);
            $this->db->group_end();
            $this->db->order_by('firstname', 'ASC');
            $query = $this->db->get('users',$limit, $offset);
            $result = $query->result_array();
            return $result;
        }
            
        public function search_user_assistant($search,$limit = 5, $offset = 0){
            // SELECT * FROM tblproducts WHERE prod_id != $id
            $this->db->where('role', 'assistant');
            $this->db->group_start();
            $this->db->like('firstname', $search);
            $this->db->or_like('middlename', $search);
            $this->db->or_like('lastname', $search);
            $this->db->or_like('contactno', $search);
            $this->db->or_like('gender', $search);
            $this->db->or_like('occupation', $search);
            $this->db->or_like('email', $search);
            $this->db->or_like('address', $search);
            $this->db->group_end();
            $this->db->order_by('firstname', 'ASC');
            $query = $this->db->get('users',$limit, $offset);
            $result = $query->result_array();
            return $result;
        }


        
           // ARCHIVE ACCOUNT
        public function archive_account($id, $data){
            $this->db->where(array('id' => $id));
            $this->db->update('users', $data);
        }

       // ARCHIVE ACCOUNT
        public function activate_account($id, $data){
            $this->db->where(array('id' => $id));
            $this->db->update('users', $data);
        }     
        
        //Get Dental Assistants
        public function getAssistants(){
            $this->db->where('role', 'assistant');
            $query = $this->db->get('users');
            return $query->result_array();
        }
    }