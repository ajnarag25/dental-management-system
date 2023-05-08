 <?php
    class Assistant extends CI_Controller{
        public function __construct(){
            parent::__construct();
            $this->load->library('session');
            $this->load->helper('url');
            $this->load->helper('form');
            $this->load->library('upload');
            $this->load->library('image_lib');
            $this->load->library('form_validation');
            $this->load->model('Users_model');
            $this->load->model('Appointment_model');
            $this->load->model('Patient_model');
            $this->load->model('Assistant_model');
            $this->load->library('pagination');
            $this->load->view('include/favicon');

            if($this->session->userdata('is_logged') == FALSE){
                redirect('Login');
           }
            if($this->session->userdata('role') != 'assistant'){
                if ($this->session->userdata('role')=='admin'){
                    redirect('Admin');
                }
                elseif ($this->session->userdata('role')=='patient'){
                    redirect('Patient');
                }
                else{
                    redirect('Login');
                }
            }
        }

        public function index(){
            $status='approved';
                $data['title'] =  "iSmile Dental Care | Upcoming Appointments";
            //   $data['appointment'] = $this->Appointment_model->get_ApprovedAppointments(); 
                $data['active_page'] = 'home';
            //   print_r( $data['user'] );
    
    
                $this->config->load('pagination', TRUE);
                $appointment_pagination_config = $this->config->item('pagination');
                $appointment_pagination_config['total_rows'] = $this->Assistant_model->get_Appointments_count($status);
                $appointment_pagination_config['base_url'] = base_url('Assistant/home_assistant');
                $this->pagination->initialize($appointment_pagination_config);  
                $offset = $this->uri->segment(3);
                $data['links'] = $this->pagination->create_links();
                $data['assistant_appointments'] =  $this->Appointment_model->getAppointmentsWithPatientInfoNoIDApproved($status,$appointment_pagination_config['per_page'], $offset); //(BEFORE $data['user'])
                // print_r( $data['assistant_appointments']);
                $this->load->view('include/header',$data);
                $this->load->view('include/inside_nav');
                $this->load->view('include/assistant_sidebar');
                $this->load->view('assistant/home_assistant',$data);
                $this->load->view('include/footer');
        }
        


        public function View_user($id){
            $data['user'] = $this->Users_model->get_myUser($id);
            $data['active_page'] = 'my_acc';
            $data['title'] = $data['user']['firstname']." ".$data['user']['lastname']." | Profile Picture";
            $this->load->view('include/header', $data);
            $this->load->view('include/inside_nav');
            $this->load->view('include/assistant_sidebar');
            $this->load->view('assistant/assistant_view', $data);
            $this->load->view('include/footer');
        }



        public function Edit_user($id){
            $data['user'] = $this->Users_model->get_myUser($id);
            $data['active_page'] = 'my_acc';
            $data['title'] = $data['user']['firstname']." ".$data['user']['lastname']." | Profile Picture";
            $this->load->view('include/header', $data);
            $this->load->view('include/inside_nav');
            $this->load->view('include/assistant_sidebar');
            $this->load->view('assistant/assistant_update', $data);
            $this->load->view('include/footer');
        }



        public function update_user(){
           $id = $this->session->userdata('id');

           $this->form_validation->set_rules('firstname', 'First name', 'required|alpha_numeric_spaces');
           $this->form_validation->set_rules('middlename', 'Middle name', 'required|alpha_numeric_spaces');
           $this->form_validation->set_rules('lastname', 'Last name', 'required|alpha_numeric_spaces');
           $this->form_validation->set_rules('birthday', 'Birthday', 'required');
           $this->form_validation->set_rules('gender', 'Gender', 'required');
           $this->form_validation->set_rules('occupation', 'Occupation', 'required');
           $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
           $this->form_validation->set_rules('contactnumber', 'Contact Number', 'required|regex_match[/^[0-9]{11}$/]');
           $this->form_validation->set_rules('province', 'Province', 'required');
           $this->form_validation->set_rules('address', 'Address', 'required');

            if($this->form_validation->run() == FALSE){

                $data['user'] = $this->Users_model->get_myUser($id);
                $data['error'] = validation_errors();
                $data['active_page'] = 'my_acc';
                $data['title'] = $data['user']['firstname']." ".$data['user']['lastname']." | Profile Picture";

                $this->load->view('include/header', $data);
                $this->load->view('include/inside_nav');
                $this->load->view('include/assistant_sidebar');
                $this->load->view('assistant/assistant_update', $data);
                $this->load->view('include/footer');
            }else{
                    $data = array(
                    // 'prod_name' => $_POST['prod_name'],
                    'id' => $this->input->post('id'),
                    'firstname' => $this->input->post('firstname'),
                    'middlename' => $this->input->post('middlename'),
                    'lastname' => $this->input->post('lastname'),
                    'birthday' => $this->input->post('birthday'),
                    'gender' => $this->input->post('gender'),
                    'occupation' => $this->input->post('occupation'),
                    'email' => $this->input->post('email'),
                    'contactno' => $this->input->post('contactnumber'),
                    'province' => $this->input->post('province'),
                    'address' => $this->input->post('address')
                );
                $this->Users_model->update($id, $data);
                $this->session->set_flashdata('success', 'Account updated successfully!');

                redirect(('Assistant/View_user/').$this->session->userdata('id'),$data);
                // $this->load->view('user_view', $data);
            }
        }



        public function Edit_profilepic($id){
            
            //$this->dd($id);
            $data['user'] = $this->Users_model->get_myUser($id);
            $data['title'] = $data['user']['firstname']." ".$data['user']['lastname']." | Profile Picture";
            $data['active_page'] = 'my_acc';

            $this->load->view('include/header', $data);
            $this->load->view('include/inside_nav');
            $this->load->view('include/assistant_sidebar');
            $this->load->view('assistant/assistant_profilepic', $data);
            $this->load->view('include/footer');
        }



        public function update_profilepic(){
            $id = $this->input->post('id');
        
            // Set the file upload config
            $file_config['upload_path'] = './uploads/images/profile_pictures';
            $file_config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
            $file_config['max_size'] = 5120; // 5MB
            //$file_config['max_width'] = 1024;
            //$file_config['max_height'] = 768;
            //$file_config['encrypt_name'] = TRUE;
            $file_config['file_name'] = $id;
            $file_config['file_ext_tolower'] = TRUE;
            $file_config['remove_space'] = TRUE;
            $file_config['overwrite'] = TRUE;

            // Initialize the file upload library
            $this->upload->initialize($file_config);

            // Check if the file upload is successful
            if(!$this->upload->do_upload('profilepicture')){
                $data['user'] = $this->Users_model->get_myUser($id);
                $data['error'] = $this->upload->display_errors();
                $data['title'] = $data['user']['firstname']." ".$data['user']['lastname']." | Profile Picture";
                $data['active_page'] = 'my_acc';
                $this->load->view('include/header', $data);
                // $this->load->view('include/navbar');

                $this->load->view('include/inside_nav');
                $this->load->view('include/assistant_sidebar');
                $data['user'] = $this->Users_model->get_myUser($id);
                $this->load->view('assistant/assistant_profilepic', $data);
                $this->load->view('include/footer');
            }else{
                // Set image manipulation config
                $image_config['image_library'] = 'gd2';
                $image_config['source_image'] = $this->upload->data('full_path');
                $image_config['new_image'] = './uploads/images/thumbs/'.$this->upload->data('file_name');
                $image_config['create_thumb'] = TRUE;
                $image_config['maintain_ratio'] = TRUE;
                $image_config['width'] = 100;
                $image_config['height'] = 100;
                $image_config['thumb_marker'] = FALSE;

                // Initialize the image manipulation library
                $this->image_lib->initialize($image_config);

                // Check if the image manipulation is successful
                if(!$this->image_lib->resize()){
                    $data['user'] = $this->Users_model->get_myUser($id);
                    $data['error'] = $this->image_lib->display_errors();
                    $data['title'] = $data['user']['firstname']." ".$data['user']['lastname']." | Profile Picture";
                    $this->load->view('include/header', $data);
                    // $this->load->view('include/navbar');
                    $this->load->view('assistant/assistant_update', $data);
                    // $this->load->view('include/footer');
                }
                $data = array('profilepicture' => $this->upload->data('file_name'));

                $this->Users_model->update($id, $data);
                $this->session->set_flashdata('success', 'Account updated successfully!');
                // $this->session->sess_destroy();
                
                redirect(('Assistant/View_user/').$this->session->userdata('id'),$data);
            }
        }



        function Changepassword_view(){
                //$this->dd($id);
                // $data['user'] = $this->Users_model->get_myUser($id);
                $data['user'] = $this->Users_model->get_myName($this->session->userdata('id'));
                $data['title'] = $data['user']['firstname']." ".$data['user']['lastname']." | Password";
                $data['active_page'] = 'my_acc';

                    $this->load->view('include/header', $data);
                    $this->load->view('include/inside_nav');
                    $this->load->view('include/assistant_sidebar');
                    $this->load->view('assistant/assistant_changepassword',$data);
                    $this->load->view('include/footer'); 
        }
    
    
        function Assistant_changepassword(){
            
    
            $this->form_validation->set_rules('cur_password', 'Current Password', 'required|trim|min_length[8]');
            $this->form_validation->set_rules('new_password', 'New Password', 'required|trim|min_length[8]');
            $this->form_validation->set_rules('con_password', 'Confirm Password', 'required|trim|min_length[8]|matches[new_password]');
    
            if($this->form_validation->run() == FALSE){
            $data['user'] = $this->Users_model->get_myName($this->session->userdata('id'));
            $data['title'] = $data['user']['firstname']." ".$data['user']['lastname']." | Change Password";
            $data['active_page'] = 'my_acc';
            $data['error'] = validation_errors();
            // $data['user'] = $this->Users_model->get_myUser($id);
            $this->load->view('include/header', $data);
            $this->load->view('include/inside_nav');
            $this->load->view('include/assistant_sidebar');
            $this->load->view('assistant/assistant_changepassword',$data);
            $this->load->view('include/footer'); 
            }else {
                //Update password
                $data = array(
                    'password' => sha1($this->input->post('new_password')),
    
                );
                $cur_password = $this->input->post('cur_password');
                $new_password = $this->input->post('new_password');
                $con_password = $this->input->post('con_password');
                //check current password
                $result = $this->Users_model->Check_current_password($this->session->userdata('id'), sha1($this->input->post('cur_password')));
                
                if($result > 0 AND  $result === true){
                    $this->Users_model->Update_user_password($this->session->userdata('id'), $data);
                    if($result > 0) {
                        
                        $data['user'] = $this->Users_model->get_myName($this->session->userdata('id'));
                        $data['title'] = $data['user']['firstname']." ".$data['user']['lastname']." | Change Password";
                        $data['active_page'] = 'my_acc';
                        $data['error'] = $this->session->set_flashdata('success', 'Password Changed Successfully');
                        // $data['user'] = $this->Users_model->get_myUser($id);
                        $this->load->view('include/header', $data);
                        $this->load->view('include/inside_nav');
                        $this->load->view('include/assistant_sidebar');
                        $this->load->view('assistant/assistant_changepassword',$data);
                        $this->load->view('include/footer'); 
                      
                    } else {
                       
                        $data['user'] = $this->Users_model->get_myName($this->session->userdata('id'));
                        $data['title'] = $data['user']['firstname']." ".$data['user']['lastname']." | Change Password";
                        $data['active_page'] = 'my_acc';
                        $data['error'] =  $this->session->set_flashdata('error', 'Update Password Error!');
                        // $data['user'] = $this->Users_model->get_myUser($id);
                        $this->load->view('include/header', $data);
                        $this->load->view('include/inside_nav');
                        $this->load->view('include/assistant_sidebar');
                        $this->load->view('assistant/assistant_changepassword',$data);
                        $this->load->view('include/footer'); 
                  
                    }
                }else {
                    $data['user'] = $this->Users_model->get_myName($this->session->userdata('id'));
                    $data['title'] = $data['user']['firstname']." ".$data['user']['lastname']." | Change Password";
                    $data['active_page'] = 'my_acc';
                    $data['error'] = $this->session->set_flashdata('error', 'Invalid Current Password does not match');
                    // $data['user'] = $this->Users_model->get_myUser($id);
                    $this->load->view('include/header', $data);
                    $this->load->view('include/inside_nav');
                    $this->load->view('include/assistant_sidebar');
                    $this->load->view('assistant/assistant_changepassword',$data);
                    $this->load->view('include/footer'); 
              
                }
                // var_dump($result);
            }
    
    
        }

             // View ALL Approved Appointments
             public function viewApprovedAppointments(){
                $id = $this->session->userdata('id');
                $status='approved';
                $data['title'] =  "iSmile Dental Care | Approved Appointments";
            //   $data['appointment'] = $this->Appointment_model->get_ApprovedAppointments(); 
                $data['active_page'] = 'appointment_app';
                $data['user'] = $this->Users_model->get_myUser($id);
            // print_r( $data['user'] );
    
    
                $this->config->load('pagination', TRUE);
                $appointment_pagination_config = $this->config->item('pagination');
                $appointment_pagination_config['total_rows'] = $this->Appointment_model->get_Appointments_count($status);
                $appointment_pagination_config['base_url'] = base_url('Assistant/viewApprovedAppointments');
                $this->pagination->initialize($appointment_pagination_config);  
                $offset = $this->uri->segment(3);
                $data['links'] = $this->pagination->create_links();
                $data['appointments'] =  $this->Appointment_model->getAppointmentsWithPatientInfoNoIDApproved($status,$appointment_pagination_config['per_page'], $offset); //(BEFORE $data['user'])
                // print_r($data['appointments']);
                $this->load->view('include/header',$data);
                $this->load->view('include/inside_nav');
                $this->load->view('include/assistant_sidebar');
                $this->load->view('assistant_appointments/appointments_approved',$data);
                $this->load->view('include/footer');
    
           }
           public function search($status){
            $id = $this->session->userdata('id');
            $data['user'] = $this->Users_model->get_myUser($id);
            $data['title'] = 'iSmile Dental Care | Approved Appointments';
            
            $search = $this->input->post('search');
            
            // $data['users'] = $this->Users_model->search_user($search);
            // $data['links'] = $this->pagination->create_links();
    
    
            $this->config->load('pagination', TRUE);
            $appointment_pagination_config = $this->config->item('pagination');
            $appointment_pagination_config['total_rows'] = $this->Appointment_model->get_appointment_search_count($search,$status);
    
            if($status== 'approved'){
                $data['active_page'] = 'appointment_app';
                $appointment_pagination_config['base_url'] = base_url('Appointments/viewApprovedAppointments');
            }
            if($status== 'pending'){
                $data['active_page'] = 'appointment_app';
                $appointment_pagination_config['base_url'] = base_url('Appointments/viewPendingAppointments');
            }   
            $this->pagination->initialize($appointment_pagination_config);  
    
            $offset = $this->uri->segment(3);
            
            $data['links'] = $this->pagination->create_links();
            
            $data['appointments'] = $this->Appointment_model->search_appointment($status,$search,$appointment_pagination_config['per_page'], $offset);
    
            $this->load->view('include/header', $data);
            $this->load->view('include/inside_nav');
            $this->load->view('include/assistant_sidebar');
            if($status== 'approved'){
                $this->load->view('assistant_appointments/appointments_approved',$data);
                }
            // if($status== 'pending'){
            //     $this->load->view('admin_appointments/appointments_pending',$data);
            // }   
            
            $this->load->view('include/footer');
        }

        //view all appointments
        
     
        
    



}
?>