<?php
     class Appointments extends CI_Controller{
        public function __construct(){
            parent::__construct();
            $this->load->library('session');
            $this->load->helper('url');
            $this->load->helper('form');
            $this->load->library('upload');
            $this->load->library('image_lib');
            $this->load->library('form_validation');
            $this->load->library('pagination');
            $this->load->model('Users_model');
            $this->load->model('Appointment_model');
            $this->load->view('include/favicon');


            if($this->session->userdata('is_logged') == FALSE){
                redirect('Login');
           }
            if($this->session->userdata('role') != 'admin'){
                if ($this->session->userdata('role')=='assistant'){
                    redirect('Assistant');
                }
                elseif ($this->session->userdata('role')=='patient'){
                    redirect('Patient');
                }
                else{
                    redirect('Login');
                }
            }
        }

        // View ALL Approved Appointments
        public function viewApprovedAppointments(){
            $status='approved';
            $data['title'] =  "iSmile Dental Care | Approved Appointments";
        //   $data['appointment'] = $this->Appointment_model->get_ApprovedAppointments(); 
            $data['active_page'] = 'appointmentapp';
        //   print_r( $data['user'] );


            $this->config->load('pagination', TRUE);
            $appointment_pagination_config = $this->config->item('pagination');
            $appointment_pagination_config['total_rows'] = $this->Appointment_model->get_Appointments_count($status);
            $appointment_pagination_config['base_url'] = base_url('Appointments/viewApprovedAppointments');
            $this->pagination->initialize($appointment_pagination_config);  
            $offset = $this->uri->segment(3);
            $data['links'] = $this->pagination->create_links();
            $data['appointments'] =  $this->Appointment_model->getAppointmentsWithPatientInfoNoIDApproved($status,$appointment_pagination_config['per_page'], $offset); //(BEFORE $data['user'])

            $this->load->view('include/header',$data);
            $this->load->view('include/inside_nav');
            $this->load->view('include/admin_sidebar');
            $this->load->view('admin_appointments/appointments_approved',$data);
            $this->load->view('include/footer');

       }

       public function search($status){

        $data['title'] = 'iSmile Dental Care | Approved Appointments';
        
        $search = $this->input->post('search');
        
        // $data['users'] = $this->Users_model->search_user($search);
        // $data['links'] = $this->pagination->create_links();


        $this->config->load('pagination', TRUE);
        $appointment_pagination_config = $this->config->item('pagination');
        $appointment_pagination_config['total_rows'] = $this->Appointment_model->get_appointment_search_count($search,$status);

        if($status== 'approved'){
            $data['active_page'] = 'appointmentapp';
            $appointment_pagination_config['base_url'] = base_url('Appointments/viewApprovedAppointments');
        }
        if($status== 'pending'){
            $data['active_page'] = 'appointmentpen';
            $appointment_pagination_config['base_url'] = base_url('Appointments/viewPendingAppointments');
        }   
        $this->pagination->initialize($appointment_pagination_config);  

        $offset = $this->uri->segment(3);
        
        $data['links'] = $this->pagination->create_links();
        
        $data['appointments'] = $this->Appointment_model->search_appointment($status,$search,$appointment_pagination_config['per_page'], $offset);

        $this->load->view('include/header', $data);
        $this->load->view('include/inside_nav');
        $this->load->view('include/admin_sidebar');
        if($status== 'approved'){
            $this->load->view('admin_appointments/appointments_approved',$data);
            }
        if($status== 'pending'){
            $this->load->view('admin_appointments/appointments_pending',$data);
        }   
        
        $this->load->view('include/footer');
    }


        //Appointments View Button
        public function displayApprovedAppointment_view($id){
            $status='approved';
            $data['procedures'] = $this->Appointment_model->get_Procedures();
            $data['appointments'] = $this->Appointment_model->getAppointmentsWithPatientInfo($id,$status); 
            // print_r($data['appointments']);
        
            $data['active_page'] = 'appointmentapp';
            // $appointment_id = $this->input->post('appointment_id');
            
            $this->load->view('include/header', $data);
            $this->load->view('include/inside_nav');
            $this->load->view('include/admin_sidebar');
            $this->load->view('admin_appointments/appointments_approved_view',$data);
            $this->load->view('include/footer');
        }

        public function displayApprovedCovidForm($id){
            $data['appointments'] = $this->Appointment_model->get_CovidForm($id); 
            // print_r($data['appointments']);

            $data['active_page'] = 'appointmentapp';
            // $appointment_id = $this->input->post('appointment_id');
            print_r($data['appointments'] );
            $this->load->view('include/header', $data);
            $this->load->view('include/inside_nav');
            $this->load->view('include/admin_sidebar');
            $this->load->view('admin_appointments/appointments_approved_covid_form',$data);
            $this->load->view('include/footer');
        }

        // Update Approved Appointment 
        public function UpdateApprovedAppointment(){
            $status='approved';
            $id = $this->input->post('user_id');
            $appointment_id = $this->input->post('appointment_id');
           
            $this->form_validation->set_rules('app_date', 'Appointment Date', 'required');
            $this->form_validation->set_rules('app_start', 'Appointment Start Time', 'required');
            $this->form_validation->set_rules('app_end', 'Appointment End Time', 'required');
            $this->form_validation->set_rules('service_name', 'Service name', 'required');
            $this->form_validation->set_rules('service_dur', 'Service Duration', 'required');
            $this->form_validation->set_rules('description', 'Description', 'required');
       
            if($this->form_validation->run() == FALSE){
                $data['appointments'] = $this->Appointment_model->getAppointmentsWithPatientInfo($id,$status);
                $data['procedures'] = $this->Appointment_model->get_Procedures();
                $data['error'] = validation_errors();
                $data['active_page'] = 'appointmentapp';
                $data['user'] = $this->Users_model->get_myUser($id);
                
             
                // $data['title'] = $data['user']['firstname']." ".$data['user']['lastname']." | Profile Picture";
                $this->load->view('include/header', $data);
                $this->load->view('include/inside_nav');
                $this->load->view('include/admin_sidebar');
                $this->load->view('admin_appointments/appointments_approved_view',$data);
                $this->load->view('include/footer');

            } else {

                $data = array(
                    'appointment_date'=> $this->input->post('app_date'),
                    'start_time'=> $this->input->post('app_start'),
                    'end_time'=> $this->input->post('app_end'),
                    'service_name'=> $this->input->post('service_name'),
                    'service_duration'=> $this->input->post('service_dur'),
                    'description'=> $this->input->post('description'),
                    'status'=> $this->input->post('status'),
                );

                $this->Appointment_model->Update_appointment($id,$data);
               
                $data['error'] =   $this->session->set_flashdata('success', 'Appointment Updated Successfully!');
                $data['active_page'] = 'appointmentapp';
                redirect('Appointments/displayApprovedAppointment_view/'.$id , $data);
            }


        }

        
        // Display Pending Appointments
        public function viewPendingAppointments(){
            $status='pending';
            $data['title'] =  "iSmile Dental Care | Appointment Requests";
            $data['active_page'] = 'appointmentpen';


            $this->config->load('pagination', TRUE);
            $appointment_pagination_config = $this->config->item('pagination');
            $appointment_pagination_config['total_rows'] = $this->Appointment_model->get_Appointments_count($status);
            $appointment_pagination_config['base_url'] = base_url('Appointments/viewPendingAppointments');
            $this->pagination->initialize($appointment_pagination_config);  
            $offset = $this->uri->segment(3);
            $data['links'] = $this->pagination->create_links();
            // $data['appointments'] =  $this->Appointment_model->getAppointmentsWithPatientInfoNoIDPending();    //(BEFORE $data['user'])
            $data['appointments'] =  $this->Appointment_model->getAppointmentsWithPatientInfoNoIDApproved($status,$appointment_pagination_config['per_page'], $offset); //(BEFORE $data['user'])
      
           $this->load->view('include/header',$data);
           $this->load->view('include/inside_nav');
           $this->load->view('include/admin_sidebar');
           $this->load->view('admin_appointments/appointments_pending',$data);
           $this->load->view('include/footer');
       }


       // MAY
       // View an appointment
       public function displayPendingAppointment_view($id){
        $status='pending';
        $data['procedures'] = $this->Appointment_model->get_Procedures();
        $data['appointments'] = $this->Appointment_model->getAppointmentsWithPatientInfo($id,$status); 
        $data['active_page'] = 'appointmentpen';
        $data['user'] = $this->Users_model->get_myUser($id);
        if(!empty($data['appointments'])){
            foreach($data['appointments'] as $appointment){
               echo $appointment['contactno']."<br>";
            }
         }
            $this->load->view('include/header', $data);
            $this->load->view('include/inside_nav');
            $this->load->view('include/admin_sidebar');
            $this->load->view('admin_appointments/appointments_pending_view',$data);
            $this->load->view('include/footer');
        }

        public function displayPendingCovidForm($id){
            $data['appointments'] = $this->Appointment_model->get_CovidForm($id); 
            // print_r($data['appointments']);

            $data['active_page'] = 'appointmentpen';
            // $appointment_id = $this->input->post('appointment_id');
            print_r($data['appointments'] );
            $this->load->view('include/header', $data);
            $this->load->view('include/inside_nav');
            $this->load->view('include/admin_sidebar');
            $this->load->view('admin_appointments/appointments_pending_covid_form',$data);
            $this->load->view('include/footer');
        }

        //Edit an appointment
        public function EditPendingAppointment_view($id){
            $data['procedures'] = $this->Appointment_model->get_Procedures();
            $data['appointments'] = $this->Appointment_model->getAppointmentsWithPatientInfo($id);   //(BEFORE $data['user'])
            $data['active_page'] = 'appointmentpen';
         
                $this->load->view('include/header', $data);
                $this->load->view('include/inside_nav');
                $this->load->view('include/admin_sidebar');
                $this->load->view('admin_appointments/appointment_edit',$data);
                $this->load->view('include/footer');

                
        }
        
        // Update Pending Appointment 
        public function UpdatePendingAppointment(){
            $status='pending';
            $id = $this->input->post('user_id');
            $appointment_id = $this->input->post('appointment_id');

            $data['user'] = $this->Users_model->get_myUser($id);
            print_r($data['user']);
            $this->form_validation->set_rules('app_date', 'Appointment Date', 'required');
            $this->form_validation->set_rules('app_start', 'Appointment Start Time', 'required');
            $this->form_validation->set_rules('app_end', 'Appointment End Time', 'required');
            $this->form_validation->set_rules('service_name', 'Service name', 'required');
            $this->form_validation->set_rules('service_dur', 'Service Duration', 'required');
            $this->form_validation->set_rules('description', 'Description', 'required');
       
            if($this->form_validation->run() == FALSE){ 
                $data['appointments'] = $this->Appointment_model->getAppointmentsWithPatientInfo($id,$status);
                $data['procedures'] = $this->Appointment_model->get_Procedures();
                $data['user'] = $this->Users_model->get_myUser($id);
                $data['error'] = validation_errors();
                $data['active_page'] = 'appointmentpen';
                
                // $data['title'] = $data['user']['firstname']." ".$data['user']['lastname']." | Profile Picture";
                $this->load->view('include/header', $data);
                $this->load->view('include/inside_nav');
                $this->load->view('include/admin_sidebar');
                $this->load->view('admin_appointments/appointments_pending_view',$data);

                $this->load->view('include/footer');

            } else {

                $data = array(
                    'appointment_date'=> $this->input->post('app_date'),
                    'start_time'=> $this->input->post('app_start'),
                    'end_time'=> $this->input->post('app_end'),
                    'service_name'=> $this->input->post('service_name'),
                    'service_duration'=> $this->input->post('service_dur'),
                    'description'=> $this->input->post('description'),
                    'status'=> $this->input->post('status'),
                );

                $this->Appointment_model->Update_appointment($id,$data);

                // Infobip API key
                $api_key = 'f1c4e88b60ffd3ab2209472711f8a556-8556bbaf-8ff4-4614-9915-ef11193d96ba';
                // Infobip API sender name
                $sender_name = 'iSmileDentalCare';
                // Registered Infobip API number
                $phone_number = '639455776246'; // To send to other phone number you need to avail the plan for this api
                // Infobip API message
                $message_text = 'We would like to imform you that your appointment status is now'.' '.$data['status'].' - iSmileDentalCare';
            
                // Set up the API URL
                $api_url = "https://api.infobip.com/sms/1/text/single";
            
                // Set up the request headers
                $headers = array(
                'Authorization: App ' . $api_key,
                'Content-Type: application/json'
                );
            
                // Set up the request body
                $data = array(
                'from' => $sender_name,
                'to' => $phone_number,
                'text' => $message_text
                );
            
                // Convert the data to JSON format
                $json_data = json_encode($data);
            
                // Send the request using cURL
                $ch = curl_init($api_url);
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                $response = curl_exec($ch);
                curl_close($ch);
            
                // echo $response;

                $data['error'] =   $this->session->set_flashdata('success', 'Appointment Updated Successfully!');;
                $data['active_page'] = 'appointmentpen';
   

                redirect('Appointments/displayPendingAppointment_view/'.$id , $data);
            }


        }
        // Approve Button
        public function Approve_Appointment_btn($appointment_id){
            $data['user'] = $this->Appointment_model->getAppointmentsWithPatientInfo($appointment_id);
            $data = array('status' => 'approved');
            
            $data['user'] = $this->Appointment_model->approve_appointment($appointment_id, $data);
            redirect('Appointments/viewPendingAppointments/'.$appointment_id , $data);

        }

        // Reject Button
        public function Reject_Appointment_btn($appointment_id){
            $data['user'] = $this->Appointment_model->getAppointmentsWithPatientInfo($appointment_id);
            $data = array('status' => 'rejected');
            
            $data['user'] = $this->Appointment_model->approve_appointment($appointment_id, $data);
            redirect('Appointments/viewPendingAppointments/'.$appointment_id , $data);
        }


         //MANUAL APPOINTMENT SELECT PATIENT
         public function manualAppointments(){
  
            $data['active_page'] = 'manual_appointment';

            $data['title'] =  "iSmile Dental Care Manual Appointment";

            $this->config->load('pagination', TRUE);
            $patient_pagination_config = $this->config->item('pagination');
            $patient_pagination_config['total_rows'] = $this->Appointment_model->get_PatientCount();
            $patient_pagination_config['base_url'] = base_url('Appointments/manualAppointments');
            $this->pagination->initialize($patient_pagination_config);
            $offset = $this->uri->segment(3);
            $data['links'] = $this->pagination->create_links();
            $data['patient'] =  $this->Appointment_model->get_patients_with_limit($patient_pagination_config['per_page'], $offset);

            $this->load->view('include/header', $data);
            $this->load->view('include/inside_nav');
            $this->load->view('include/admin_sidebar');
            $this->load->view('admin_appointments/appointments_manual', $data);
            $this->load->view('include/footer');
        }

        //CREATE MANUAL APPOINTMENT VIEW
        public function create_ManualAppointmentView($id){
            $data['procedures'] = $this->Appointment_model->get_Procedures();
            $data['user'] = $this->Appointment_model->get_myNameAppointment($id);
            
            $data['title'] =  "iSmile Dental Care Manual Appointment";
            $data['existing_appointments'] = $this->Appointment_model->get_existingAppointments();
            // print_r($this->session->userdata());
            // print_r($data);
            $check = $this->session->set_userdata($data['user']['firstname']);
            print_r($check);
            $data['active_page'] = 'manual_appointment';
            $this->load->view('include/header', $data);
            $this->load->view('include/inside_nav');
            $this->load->view('include/admin_sidebar');
            $this->load->view('admin_appointments/appointments_manual_create',$data);
            $this->load->view('include/footer');

        }

        // CREATE MANUAL APPOINTMENT BACK
        public function create_ManualAppointment_back($id){
            $data['title'] = "iSmile Dental Care Manual Appointment";
            $data['active_page'] = 'manual_appointment';
            $data['user'] = $this->Appointment_model->get_myNameAppointment($id);
            $data['procedures'] = $this->Appointment_model->get_Procedures();
            print_r($this->session->userdata());
            $this->load->view('include/header', $data);
            $this->load->view('include/inside_nav');
            $this->load->view('include/admin_sidebar');
            $this->load->view('admin_appointments/appointments_manual_covid', $data);
            $this->load->view('include/footer');
            

        }

        //MANUAL APPOINTMENT FORM
        public function create_ManualAppointment_CovidScreening($user_id)
        {
            $user_id = $user_id;
            $status = "approved";
            // $appoitment_id  =  $this->input->post('appointment_id');
        
            // VALIDATION
            $this->form_validation->set_rules('app_date', 'Appointment Date', 'required');
            $this->form_validation->set_rules('app_start', 'Appointment Start Time', 'required');
            $this->form_validation->set_rules('app_end', 'Appointment End Time', 'required');
            $this->form_validation->set_rules('service_name', 'Service name', 'required');
            $this->form_validation->set_rules('service_dur', 'Service Duration', 'required');
            $this->form_validation->set_rules('description', 'Description', 'required');
            $this->form_validation->set_rules('patient', 'Patient', 'required');
        
        
            if ($this->form_validation->run() == FALSE) {
                $data['title'] =  "iSmile Dental Care Manual Appointment";
                $data['error'] = validation_errors();
                $data['active_page'] = 'manual_appointment';
                $data['user'] = $this->Appointment_model->get_myNameAppointment($user_id);
                $data['existing_appointments'] = $this->Appointment_model->get_existingAppointments();
                $data['procedures'] = $this->Appointment_model->get_Procedures();
                $this->load->view('include/header', $data);
                $this->load->view('include/inside_nav');
                $this->load->view('include/admin_sidebar');
                // print_r($data);
                $this->load->view('admin_appointments/appointments_manual_create', $data);
                $this->load->view('include/footer');
            } else {
                $data = array(
                    'user_id' =>  $user_id,
                    'appointment_date' => $this->input->post('app_date'),
                    'start_time' => $this->input->post('app_start'),
                    'end_time' => $this->input->post('app_end'),
                    'service_name' => $this->input->post('service_name'),
                    'service_duration' => $this->input->post('service_dur'),
                    'description' => $this->input->post('description'),
                    'patient' => $this->input->post('patient'),
                    'status' => $status,
                );
        
                // $this->create_ManualAppointment_Submit($user_id, $data);
                $this->session->set_userdata($data);
        
                print_r($data);
                $data['active_page'] = 'manual_appointment';
                $this->load->view('include/header', $data);
                $this->load->view('include/inside_nav');
                $this->load->view('include/admin_sidebar');
                $this->load->view('admin_appointments/appointments_manual_covid', $data);
                // $this->Appointment_model->create_Appointment($data);
                // $data['user'] = $this->Appointment_model->get_myNameAppointment($user_id);
                // $data['procedures'] = $this->Appointment_model->get_Procedures();
                // $data['title'] = 'iSmile Dental Care Patient Registration';
                // $data['error'] =   $this->session->set_flashdata('success', 'Appointment Created Successfully!');
                // redirect('Appointments/manualAppointments/');
            }
        
            // Add this code block to set the previous page URL as the back button
        }


        public function create_ManualAppointment_Submit($user_id){
                  
            $status = "approved";

            $this->form_validation->set_rules('exp_con', 'Exposure with a confirmed case', 'required');
            $this->form_validation->set_rules('exp_inv', 'Exposure with under investigation', 'required');
            $this->form_validation->set_rules('exp_mon', 'Exposure with under monitoring', 'required');
            $this->form_validation->set_rules('fever', 'Fever', 'required');
            $this->form_validation->set_rules('sore_throat', 'Sore Throat', 'required');
            $this->form_validation->set_rules('runny_nose', 'Runny Nose', 'required');
            $this->form_validation->set_rules('cough', 'Cough', 'required');
            $this->form_validation->set_rules('diff_breath', 'Difficulty of Breath', 'required');
            $this->form_validation->set_rules('nausea', 'Nausea', 'required');
            $this->form_validation->set_rules('body_ache', 'Body Ache', 'required');
            $this->form_validation->set_rules('diarrhea', 'Diarrhea', 'required');
            $this->form_validation->set_rules('loss_smell', 'Loss of Smell', 'required');
            $this->form_validation->set_rules('loss_taste', 'Loss of Taste', 'required');

            if($this->form_validation->run() == FALSE){
                $data['title'] =  "iSmile Dental Care Manual Appointment";
                $data['error'] = validation_errors();
                $data['active_page'] = 'manual_appointment';
                $this->load->view('include/header', $data);
                $this->load->view('include/inside_nav');
                $this->load->view('include/admin_sidebar');
                
                $this->load->view('admin_appointments/appointments_manual_covid',$data);
                $this->load->view('include/footer');

            }else {
                $data = array(
                    'user_id' =>  $user_id,
                    'patient' => $this->session->userdata('patient'),
                    'appointment_date' => $this->session->userdata('appointment_date'),
                    'start_time'=> $this->session->userdata('start_time'),
                    'end_time'=> $this->session->userdata('end_time'),
                    'service_name'=> $this->session->userdata('service_name'),
                    'service_duration'=> $this->session->userdata('service_duration'),
                    'description'=> $this->session->userdata('description'),
                    'status'=> $this->session->userdata('status'),
                    'exp_con'=> $this->input->post('exp_con'),
                    'exp_inv'=> $this->input->post('exp_inv'),
                    'exp_mon'=> $this->input->post('exp_mon'),
                    'fever'=> $this->input->post('fever'),
                    'sore_throat'=> $this->input->post('sore_throat'),
                    'runny_nose'=> $this->input->post('runny_nose'),
                    'cough'=> $this->input->post('cough'),
                    'diff_breath'=> $this->input->post('diff_breath'),
                    'nausea'=> $this->input->post('nausea'),
                    'body_ache'=> $this->input->post('body_ache'),
                    'diarrhea'=> $this->input->post('diarrhea'),
                    'loss_smell'=> $this->input->post('loss_smell'),
                    'loss_taste'=> $this->input->post('loss_taste'),
                );
                $this->session->set_userdata($data);    
                $data['active_page'] = 'manual_appointment';
                $data['title'] =  "iSmile Dental Care Manual Appointment";
                print_r($data);
                $this->load->view('include/header', $data);
                $this->load->view('include/inside_nav');
                $this->load->view('include/admin_sidebar');
                $this->load->view('admin_appointments/appointments_manual_submit',$data);
                $this->load->view('include/footer');

        }
    }
    public function create_ManualAppointment_done(){
        $data = array(
            'user_id' =>  $this->session->userdata('user_id'),
            'patient' => $this->session->userdata('patient'),
            'appointment_date' => $this->session->userdata('appointment_date'),
            'start_time'=> $this->session->userdata('start_time'),
            'end_time'=> $this->session->userdata('end_time'),
            'service_name'=> $this->session->userdata('service_name'),
            'service_duration'=> $this->session->userdata('service_duration'),
            'description'=> $this->session->userdata('description'),
            'status'=> $this->session->userdata('status'),
            'exp_con'=> $this->session->userdata('exp_con'),
            'exp_inv'=> $this->session->userdata('exp_inv'),
            'exp_mon'=> $this->session->userdata('exp_mon'),
            'fever'=> $this->session->userdata('fever'),
            'sore_throat'=> $this->session->userdata('sore_throat'),
            'runny_nose'=> $this->session->userdata('runny_nose'),
            'cough'=> $this->session->userdata('cough'),
            'diff_breath'=> $this->session->userdata('diff_breath'),
            'nausea'=> $this->session->userdata('nausea'),
            'body_ache'=> $this->session->userdata('body_ache'),
            'diarrhea'=> $this->session->userdata('diarrhea'),
            'loss_smell'=> $this->session->userdata('loss_smell'),
            'loss_taste'=> $this->session->userdata('loss_taste'),
        );

        $this->Appointment_model->create_Appointment($data);
        $this->session->unset_userdata(array('user_id','patient', 'appointment_date', 'start_time','end_time','service_name','service_duration','description',
        'status','exp_con','exp_inv','exp_mon','fever','sore_throat','runny_nose','cough','diff_breath','nausea','body_ache','diarrhea','loss_smell','loss_taste')
        );
        // $session_data = $this->session->all_userdata();
        // print_r($session_data); die;
        redirect('Appointments/manualAppointments/');

    
    }
        public function searchPatient() {

            $data['title'] =  "iSmile Dental Care Manual Appointment";
            $data['active_page'] = 'manual_appointment';
            $search = $this->input->post('search');
            
            // $data['users'] = $this->Users_model->search_user($search);
            // $data['links'] = $this->pagination->create_links();
    
    
            $this->config->load('pagination', TRUE);
            $patient_pagination_config = $this->config->item('pagination');
            $patient_pagination_config['total_rows'] = $this->Appointment_model->get_patient_search_count($search);
            
            $patient_pagination_config['base_url'] = base_url('Appointments/manualAppointments');

            $this->pagination->initialize($patient_pagination_config);  
    
            $offset = $this->uri->segment(3);
            
            $data['links'] = $this->pagination->create_links();
            
            $data['patient'] = $this->Appointment_model->search_patient($search,$patient_pagination_config['per_page'], $offset);
    
            $this->load->view('include/header', $data);
            $this->load->view('include/inside_nav');
            $this->load->view('include/admin_sidebar');
            $this->load->view('admin_appointments/appointments_manual',$data);
            $this->load->view('include/footer');
        }

        // Conclude Button
        public function Conclude_Appointment_btn($appointment_id){
            $status = "concluded";
            $data = array('status' =>  $status);
            
            // $data['user'] = $this->Appointment_model->getAppointmentsWithPatientInfo($appointment_id,$status);
            // print_r($user_id);
      
            $data['user'] = $this->Appointment_model->approve_appointment($appointment_id, $data);
            
            redirect('Appointments/viewApprovedAppointments/');

        }  
      
    
}

?>