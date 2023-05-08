<?php
    // class for User_model
    class Appointment_model extends CI_Model{
        public function __construct(){
            parent::__construct();
            $this->load->database();
        }
        // display all appointments
        public function get_Appointments(){ 
            
            return $users = $this->db->get('appointments')->result_array();
        }
        // display approved appointments
        public function get_ApprovedAppointments(){ 
            $this->db->where(array('status' => 'approved'));
            $query = $this->db->get('appointments')->result_array();
            return $query;
        }

        public function get_PendingAppointments(){ 
            $this->db->where(array('status' => 'pending'));
            $query = $this->db->get('appointments')->result_array();
            return $query;
        }

        
        public function get_AppointmentUser($id){
            // SELECT * FROM tblproducts WHERE prod_id != $id
            $this->db->where(array('appointment_id' => $id));
            $query = $this->db->get('appointments');
            $result = $query->row_array();
            return $result;
        }

        public function Update_appointment($id, $data){
            $this->db->where(array('appointment_id' => $id));
            $this->db->update('appointments', $data);
            
        }


        // GET PATIENT INFO
        // public function getAppointmentsWithPatientInfo($id) {
        //     $sql = "SELECT  users.id, users.firstname, users.middlename, users.lastname, users.birthday, users.email, users.contactno,appointments.appointment_id, appointments.appointment_date, 
        //     TIME_FORMAT(appointments.start_time, '%H:%i') AS start_time, TIME_FORMAT(appointments.end_time, '%H:%i') AS end_time, appointments.service_name,appointments.service_name,appointments.service_duration,appointments.description,  appointments.status
        //                  FROM users
        //                  INNER JOIN appointments ON users.id = appointments.user_id
        //                  WHERE appointments.appointment_id = $id  OR appointments.user_id = $id";
    
        //          $query = $this->db->query($sql);
        //          return $query->result();
        // }

        public function getAppointmentsWithPatientInfo($id,$status) {
            $this->db->select('users.id, users.firstname, users.middlename, users.lastname,
            users.birthday, users.email, users.contactno, appointments.appointment_id,
            appointments.appointment_date, appointments.start_time, appointments.end_time,
            appointments.service_name, appointments.service_duration, appointments.description, appointments.status');
            $this->db->from('users');
            $this->db->join('appointments', 'users.id = appointments.user_id');
            $this->db->order_by('users.firstname', 'ASC');
            
            $this->db->where('status', $status);
            $this->db->where('appointment_id', $id); // add this line to filter by appointment_id
            $query = $this->db->get();
            $result = $query->result_array();
            return $result;
            }

        // DISPLAY ALL APPROVED APPOINTMENTS
        // public function getAppointmentsWithPatientInfoNoIDApproved() {
        //     $sql = "SELECT users.id, users.firstname, users.middlename, users.lastname, users.birthday, users.email, users.contactno, appointments.appointment_id,  appointments.appointment_date, 
        //     TIME_FORMAT(appointments.start_time, '%H:%i') AS start_time, TIME_FORMAT(appointments.end_time, '%H:%i') AS end_time, appointments.service_name,appointments.service_name,appointments.service_duration,appointments.description,  appointments.status
        //                  FROM users
        //                  INNER JOIN appointments ON users.id = appointments.user_id
        //                  WHERE appointments.appointment_id = appointment_id AND appointments.status = 'approved'";
    
        //          $query = $this->db->query($sql);
        //          return $query->result();
        // }

        public function getAppointmentsWithPatientInfoNoIDApproved($status,$limit = 5, $offset = 0) {
            $this->db->select('users.id, users.firstname, users.middlename, users.lastname, 
            users.birthday, users.email, users.contactno, appointments.appointment_id,
             appointments.appointment_date, appointments.start_time, appointments.end_time, 
             appointments.service_name, appointments.service_duration, appointments.description, appointments.status');
            $this->db->from('users');
            $this->db->join('appointments', 'users.id = appointments.user_id');
            $this->db->order_by('appointments.appointment_date', 'ASC');
            $this->db->order_by('appointments.start_time', 'ASC');
            $this->db->where('status', $status);
            $this->db->limit($limit, $offset);
            $query = $this->db->get();
            $result = $query->result_array();
            return $result;
        }
        
        // GET ALL APPROVED APPOINTMENTS COUNT
        public function get_Appointments_count($status){
            $this->db->where('status',  $status);
            return $this->db->count_all_results('appointments');
        }


        public function get_appointment_search_count($search, $status) {
            $this->db->select('COUNT(*) as count');
            $this->db->from('appointments');
            $this->db->join('users', 'appointments.user_id = users.id');
            $this->db->where('appointments.status', $status);
            $this->db->group_start();
            $this->db->like('users.firstname', $search);
            $this->db->or_like('users.middlename', $search);
            $this->db->or_like('users.lastname', $search);
            $this->db->or_like('users.contactno', $search);
            $this->db->or_like('appointments.appointment_date', $search);
            $this->db->or_like('appointments.start_time', $search);
            $this->db->or_like('appointments.end_time', $search);
            $this->db->or_like('appointments.service_name', $search);
            $this->db->or_like('appointments.service_duration', $search);
            $this->db->or_like('appointments.description', $search);
            $this->db->group_end();
            $query = $this->db->get();
            $row = $query->row();
            return $row->count;
        }

        public function search_appointment( $status, $search, $limit = 5, $offset = 0){
            $this->db->select('appointments.*, users.firstname, users.middlename, users.lastname, users.birthday, users.contactno');
            $this->db->from('appointments');
            $this->db->join('users', 'appointments.user_id = users.id');
            $this->db->where('appointments.status', $status);
            $this->db->group_start();
            $this->db->like('users.firstname', $search);
            $this->db->or_like('users.middlename', $search);
            $this->db->or_like('users.lastname', $search);
            $this->db->or_like('users.contactno', $search);
            $this->db->or_like('appointments.appointment_date', $search);
            $this->db->or_like('appointments.start_time', $search);
            $this->db->or_like('appointments.end_time', $search);
            $this->db->or_like('appointments.service_name', $search);
            $this->db->or_like('appointments.service_duration', $search);
            $this->db->or_like('appointments.description', $search);
            $this->db->group_end();
            $this->db->order_by('appointments.appointment_date', 'ASC');
            $this->db->order_by('appointments.start_time', 'ASC');
            $this->db->limit($limit, $offset);
            $query = $this->db->get();
            $result = $query->result_array();
            return $result;
        }

        // DISPLAY ALL PENDING APPOINTMENTS
        public function getAppointmentsWithPatientInfoNoIDPending() {
            $sql = "SELECT users.id, users.firstname, users.middlename, users.lastname, users.birthday, users.email, users.contactno, appointments.appointment_id,  appointments.appointment_date, 
            TIME_FORMAT(appointments.start_time, '%H:%i') AS start_time, TIME_FORMAT(appointments.end_time, '%H:%i') AS end_time, appointments.service_name,appointments.service_name,appointments.service_duration,appointments.description,  appointments.status
                         FROM users
                         INNER JOIN appointments ON users.id = appointments.user_id
                         WHERE appointments.appointment_id = appointment_id AND appointments.status = 'pending'";
    
                 $query = $this->db->query($sql);
                 return $query->result();
        }


        public function get_myNameAppointment($id){
            // SELECT * FROM tblproducts WHERE prod_id != $id
            $this->db->select('id, firstname, middlename, lastname, contactno');
            $this->db->where(array('id' => $id));
            $query = $this->db->get('users');
            $result = $query->row_array();
            return $result;
        }
        
        public function approve_appointment($appointment_id, $data){
            $this->db->where(array('appointment_id' => $appointment_id));
            $this->db->update('appointments', $data);
        }

        public function reject_appointment($appointment_id, $data){
            $this->db->where(array('appointment_id' => $appointment_id));
            $this->db->update('appointments', $data);
        }

        public function get_Patients(){
            
            $this->db->select('id, firstname, middlename, lastname, contactno');
            $this->db->where(array('role' => 'patient'));
            $this->db->order_by('firstname', 'ASC');
            $result = $this->db->get('users')->result_array();
            
            return $result;
        }

        public function get_PatientCount(){
            $this->db->where('role', 'patient');
            return $this->db->count_all_results('users');
        }

        public function get_patients_with_limit($limit = 5, $offset = 0){
            
            $this->db->where('role',  'patient');
            $this->db->order_by('firstname', 'ASC');
            $query = $this->db->get('users', $limit, $offset);
            $result = $query->result_array();
            return $result;
        }

        public function get_patient_search_count($search){
            $this->db->from('users');
            $this->db->where('role', 'patient');
            $this->db->group_start();
            $this->db->like('firstname', $search);
            $this->db->or_like('middlename', $search);
            $this->db->or_like('lastname', $search);
            $this->db->or_like('contactno', $search);
            $this->db->group_end();
            
            return $this->db->count_all_results();
        }

        public function search_patient($search, $limit = 5, $offset = 0){
            $this->db->where('role', 'patient');
            $this->db->group_start();
            $this->db->like('firstname', $search);
            $this->db->or_like('middlename', $search);
            $this->db->or_like('lastname', $search);
            $this->db->or_like('contactno', $search);
            $this->db->group_end();
            $this->db->order_by('firstname', 'ASC');
            $query = $this->db->get('users',$limit, $offset);
            $result = $query->result_array();
            return $result;
        }
        

        public function create_Appointment($data){
            $this->db->insert('appointments', $data);
            
        }

        public function get_Procedures(){
            $this->db->select('procedure_id, procedure_name,procedure_duration, procedure_activeness');
            // $this->db->from('procedures');
            $this->db->where(array('procedure_activeness' => 'active'));
            $result = $this->db->get('procedures')->result_array();
            return $result;
        }
        public function get_existingAppointments(){
            $this->db->select('appointment_date, start_time,end_time');
                // $this->db->from('procedures');
                $this->db->where(array('status' => 'approved'));
                $result = $this->db->get('appointments')->result_array();
                return $result;
        }
        public function get_CovidForm($id){ 
            $this->db->where(array('appointment_id' => $id));
            $query = $this->db->get('appointments')->result_array();
            return $query;
        }

    }
    


    

?>
