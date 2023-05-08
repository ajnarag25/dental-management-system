<?php 

class Users extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('session');
        $this->load->library('email');
        $this->load->library('form_validation');
        $this->load->model('Users_model');
        $this->load->view('include/favicon');
        }
        public function index(){
        
            $data['title'] = 'iSmile Dental Care Patient Registration';
            $data['active_page'] = 'register';
            $this->load->view('include/header', $data);
            $this->load->view('include/general_nav', $data);
            $this->load->view('registration', $data);
            $this->load->view('include/footer');
        }

        public function signup(){
            
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


            $role = "patient"; 
            $state = "active";

            if($this->form_validation->run() == FALSE){
                $data['title'] = 'iSmile Dental Care Patient Registration';
                $data['error'] = validation_errors();
                $data['input'] = $this->input->post();
                $data['active_page'] = 'register';
                $this->load->view('include/header', $data);
                $this->load->view('include/general_nav', $data);
                $this->load->view('registration', $data);
                $this->load->view('include/footer');
            }
            else {
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
                    'role' => $role, // sha1
                    'activation_code' => sha1($this->input->post('email')),
                    'state' => $state
                );
                $this->Users_model->insert_user($data);
                $this->session->set_flashdata('success', 'You have successfully signed up!</br>Please check your email to activate your account.');
                
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
                    <a href="'.base_url().'Users/activate/'.$data['activation_code'].'">Activate Account</a>');
                $this->email->send();
                   
                redirect('/');
            }
        }

        public function activate($activation_code){
            $this->Users_model->activate_user($activation_code);
            $this->session->set_flashdata('success', 'Your account has been activated. You can now login.');
            redirect('/');
        }

    }
?>

    