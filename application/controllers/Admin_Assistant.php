<?php
    class Admin_Assistant extends CI_Controller{
        public function __construct(){
           parent::__construct();
            $this->load->library('session');
            $this->load->helper('url');
            $this->load->library('email');
            $this->load->helper('form');
            $this->load->library('upload');
            $this->load->library('image_lib');
            $this->load->library('form_validation');
            $this->load->library('pagination');
            $this->load->model('Users_model');
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

         // VIEW ALL ASSISTANT
        public function admin_manage_accounts_assistants(){
            $data['title'] = 'iSmile Dental Care | Manage Assistants';
            $data['firstname'] = $this->session->userdata('firstname');
            $data['active_page'] = 'manage_assistants';

            $this->config->load('pagination', TRUE);
            $account_pagination_config = $this->config->item('pagination');
            $account_pagination_config['total_rows'] = $this->Users_model->get_users_count_assistants();
            $account_pagination_config['base_url'] = base_url('admin/admin_manage_assistants');
            $this->pagination->initialize($account_pagination_config);  

            $offset = $this->uri->segment(3);
            
            $data['links'] = $this->pagination->create_links();
            $data['users'] = $this->Users_model->get_users_with_limit_assistants($account_pagination_config['per_page'], $offset);
            
            $this->load->view('include/header', $data);
            $this->load->view('include/inside_nav');
            $this->load->view('include/admin_sidebar');
            $this->load->view('admin/admin_manage_assistants',$data);
            $this->load->view('include/footer');
        }
        

        
        //[SETUP] ADMIN MANUAL REGISTRATION OF ACCOUNT(ASSISTANT)
        public function admin_registration_assistant(){
            $data['title'] = "iSmile Dental Care | Manual Account Registration";
            $data['active_page'] = 'manage_assistants';
            $this->load->view('include/header', $data);
            $this->load->view('include/inside_nav');
            $this->load->view('include/admin_sidebar');
            $this->load->view('admin/admin_registration_assistant',$data);
            $this->load->view('include/footer');
        }


         // SEARCH FOR SPECIFIC ACCOUNT
         public function search_assistant(){

            $data['title'] = 'iSmile Dental Care | Manage Assistants';
            $data['active_page'] = 'manage_assistants';

            $search = $this->input->post('search');
            
            // $data['users'] = $this->Users_model->search_user($search);
            // $data['links'] = $this->pagination->create_links();


            $this->config->load('pagination', TRUE);
            $account_pagination_config = $this->config->item('pagination');
            $account_pagination_config['total_rows'] = $this->Users_model->get_users_search_count_assistant($search);
            $account_pagination_config['base_url'] = base_url('Admin/admin_manage_assistants');
            $this->pagination->initialize($account_pagination_config);  

            $offset = $this->uri->segment(3);
            
            $data['links'] = $this->pagination->create_links();
            $data['users'] = $this->Users_model->search_user_assistant($search,$account_pagination_config['per_page'], $offset);
           
            $this->load->view('include/header', $data);
            $this->load->view('include/inside_nav');
            $this->load->view('include/admin_sidebar');
            $this->load->view('admin/admin_manage_assistants',$data);
            $this->load->view('include/footer');
        }

             //[SETUP] ADMIN UPDATE SELECTED ACCOUONT 
        //Same as Edit_user($id) in Patient controller
       public function admin_update_assistant($id){
        $data['title'] = 'iSmile Dental Care | Manage Account';
        $data['user'] = $this->Users_model->get_myUser($id);
        $data['id'] =  $this->session->userdata('id');
        $data['active_page'] = 'manage_assistants';
        $this->load->view('include/header', $data);
        $this->load->view('include/inside_nav');
        $this->load->view('include/admin_sidebar');
        $this->load->view('admin/admin_update_assistant', $data);
        $this->load->view('include/footer');
    }
             //[SETUP] ADMIN UPDATE SELECTED ACCOUONT 
        //Same as Edit_user($id) in Patient controller
        public function admin_update_assistant_view($id){
            $data['title'] = 'iSmile Dental Care | Manage Account';
            $data['user'] = $this->Users_model->get_myUser($id);
            $data['id'] =  $this->session->userdata('id');
            $data['active_page'] = 'manage_assistants';
            $this->load->view('include/header', $data);
            $this->load->view('include/inside_nav');
            $this->load->view('include/admin_sidebar');
            $this->load->view('admin/admin_update_assistant_view', $data);
            $this->load->view('include/footer');
        }

        //Assistant UPDATE SELECTED ACCOUNT
        //Same as update_user($id) in Assistant controller
        public function update_assistant(){
            $id = $this->input->post('id');

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
                $data['title'] = 'iSmile Dental Care | Manage Account';
                $data['error'] = validation_errors();
                $data['active_page'] = 'manage_assistants';
                $data['user'] = $this->Users_model->get_myUser($id);
                $this->load->view('include/header', $data);
                $this->load->view('include/inside_nav');
                $this->load->view('include/admin_sidebar');
                $this->load->view('admin/admin_update_assistant', $data);
                $this->load->view('include/footer');
            }else{
                    $data = array(
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
                
                redirect(('Admin_Assistant/admin_update_assistant/').$id,$data);
                // redirect('Admin/admin_manage_accounts');
            }
        } 
        
           // Admin  Archive Button
           public function archive_account_btn($id){


   
            $data = array('state' => 'inactive');
            $data['user'] = $this->Users_model->archive_account($id,$data);
           
            // $data['user']= $this->Procedures_model->archive_procedure($procedure_id, $data);
        
            redirect('Admin_Assistant/admin_manage_accounts_assistants/' , $data);

        } 
          // Admin  Archive Button
          public function activate_account_btn($id){


   
            $data = array('state' => 'active');
            $data['user'] = $this->Users_model->activate_account($id,$data);
           
            // $data['user']= $this->Procedures_model->archive_procedure($procedure_id, $data);
        
            redirect('Admin_Assistant/admin_manage_accounts_assistants/' , $data);

        }     
        
        
         //ADMIN MANUAL REGISTRATION OF ACCOUNT
        public function admin_signup_assistant(){
            $this->form_validation->set_rules('firstname', 'First name', 'required|alpha_numeric_spaces');
            $this->form_validation->set_rules('middlename', 'Middle name', 'required|alpha_numeric_spaces');
            $this->form_validation->set_rules('lastname', 'Last name', 'required|alpha_numeric_spaces');
            $this->form_validation->set_rules('birthday', 'Birthday', 'required');
            $this->form_validation->set_rules('gender', 'Gender', 'required');
            $this->form_validation->set_rules('occupation', 'Occupation', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[Users.email]');
            $this->form_validation->set_rules('contactnumber', 'Contact Number', 'required|regex_match[/^[0-9]{11}$/]');
            $this->form_validation->set_rules('province', 'Province', 'required');
            $this->form_validation->set_rules('address', 'Address', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required|min_length[8] ');
            $this->form_validation->set_rules('cpassword', 'Confirm Password', 'required|matches[password]');
            $this->form_validation->set_rules('role', 'Role', 'required');

            if($this->form_validation->run() == FALSE){
                $data['title'] = 'iSmile Dental Care Patient Registration';
                $data['error'] = validation_errors();
                $data['input'] = $this->input->post();
                $data['active_page'] = 'manage_assistants';
                    $this->load->view('include/header', $data);
                    $this->load->view('include/inside_nav');
                    $this->load->view('include/admin_sidebar'); 
                    $this->load->view('admin/admin_registration_assistant', $data);
                    $this->load->view('include/footer');
            }else{   
                $data = array(
                    'firstname' => $this->input->post('firstname'),
                    'middlename' => $this->input->post('middlename'),
                    'lastname' => $this->input->post('lastname'),
                    'birthday' => $this->input->post('birthday'),
                    'gender' => $this->input->post('gender'),
                    'occupation' => $this->input->post('occupation'),
                    'email' => $this->input->post('email'),
                    'contactno' => $this->input->post('contactnumber'),
                    'province' => $this->input->post('province'),
                    'address' => $this->input->post('address'),
                    'password' => sha1($this->input->post('password')),
                    'role' => $this->input->post('role'), 
                    'state' => 'active', 
                    'activation_code' => sha1($this->input->post('email')),
                    // sha1
                    // 'activation_code' => sha1($this->input->post('email'))
                );
                $this->Users_model->insert_user($data);
                $data['title'] = 'iSmile Dental Care Patient Registration';
                $this->session->set_flashdata('success', 'You have successfully signed up!');
                // Set email configurations
                $email_config['protocol'] = 'smtp';
                $email_config['smtp_host'] = 'ssl://smtp.googlemail.com';
                $email_config['smtp_port'] = '465'; //587 new //465 old
                // Open your config.php file and set a valid email and password
                $email_config['smtp_user'] = $this->config->item('email');
                $email_config['smtp_pass'] = $this->config->item('pass');;
                $email_config['mailtype'] = 'html';
                $email_config['starttls'] = TRUE;
                $email_config['newline'] = "\r\n";

                // Initialize email library
                $this->email->initialize($email_config);

                // Set email content
                $this->email->from('wonderts2022@gmail.com', 'iSmile Dental Care');
                $this->email->to($this->input->post('email'));
                $this->email->subject('Welcome to iSmile Dental Care, Activate your account');
                $this->email->message('Please click the link below to activate your account: <br /><br />
                    <a href="'.base_url().'Admin/activate/'.$data['activation_code'].'">Activate Account</a>');
                $this->email->send();
                redirect('Admin_Assistant/admin_manage_accounts_assistants');
            }
        }
        //activation
        public function activate($activation_code){
            $this->Users_model->activate_user($activation_code);
            $this->session->set_flashdata('success', 'Your account has been activated. You can now login.');
            redirect('Admin_Assistant/admin_manage_accounts_assistants');
        }
    
        
        //[SETUP] ASSISTANT UPDATE SELECTED PROFILE PIC
        public function Edit_all_profilepic_assistant($id){

            //$this->dd($id);
            $data['title'] = 'View User Profile Picture';
            $data['user'] = $this->Users_model->get_myUser($id);
            $data['id'] =  $this->session->userdata('id');
            
            $data['active_page'] = 'manage_assistants';
            $this->load->view('include/header', $data);
            $this->load->view('include/inside_nav');
            $this->load->view('include/admin_sidebar');
            $this->load->view('admin/admin_profilepic_assistant', $data);
            $this->load->view('include/footer');
        }
         //ASSISTANT UPDATE SELECTED PROFILE PIC
         public function update_all_profilepic_assistant(){

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
                $data['title'] = 'View User Profile Picture';
                $data['error'] = $this->upload->display_errors();
                $data['user'] = $this->Users_model->get_myUser($id);
                $data['active_page'] = 'manage_assistants';
                $this->load->view('include/header', $data);
                $this->load->view('include/inside_nav');
                $this->load->view('include/admin_sidebar');
                // $this->load->view('include/navbar');
                $this->load->view('admin/admin_all_profilepic_assistant', $data);
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
                    $data['title'] = 'View User Profile Picture';
                    $data['error'] = $this->image_lib->display_errors();
                    $data['user'] = $this->Users_model->get_myUser($id);
                    $this->load->view('include/header', $data);
                    // $this->load->view('include/navbar');
                    $this->load->view('admin/admin_all_profilepic_assistant', $data);
                    // $this->load->view('include/footer');
                }
                $data = array('profilepicture' => $this->upload->data('file_name'));

                $this->Users_model->update($id, $data);
                $this->session->set_flashdata('success', 'Account updated successfully!');
                // $this->session->sess_destroy();
                redirect(('Admin_Assistant/admin_update_assistant/').$id,$data);
            }
        }
        

    }

?>