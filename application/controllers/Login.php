<?php
    class Login extends CI_Controller{
        public function __construct(){
            parent::__construct();
            $this->load->helper('url');
            $this->load->helper('form');
            $this->load->library('session');
            $this->load->model('Users_model');
            $this->load->view('include/favicon');
        }
        public function index(){
            if($this->session->userdata('is_logged') == TRUE){
                redirect('Login');
            }
            $data['title'] = 'iSmile Dental Care Login';
            $data['active_page'] = 'login';
            $this->load->view('include/header', $data);
            $this->load->view('include/general_nav', $data);
            $this->load->view('login_view', $data);
            $this->load->view('include/footer');
            
        }
        public function login_user(){

            $user = $this->Users_model->get_user($this->input->post('email'),sha1($this->input->post('password')));
            if($user){
                
                if($user['active'] == 0){
                    $data['error']= "Your account is not yet activated. <br />Please check your email to activate your account.";
                    $data['title'] = 'Log In to iSmile Dental Care';
                    $data['active_page'] = 'login';
                    $this->load->view('include/header', $data);
                    $this->load->view('include/general_nav', $data);
                    $this->load->view('login_view', $data);
                    $this->load->view('include/footer');
                    return;
                }
                
                if($user['state'] == 'inactive'){
                    $data['error']= "'Your account is disabled. Please contact the Dentist!'";
                    $data['title'] = 'Log In to iSmile Dental Care';
                    $data['active_page'] = 'login';
                    $this->load->view('include/header', $data);
                    $this->load->view('include/general_nav', $data);
                    $this->load->view('login_view', $data);
                    $this->load->view('include/footer');
                    return;
                }


                if($user['role'] == 'patient'){
                $data['title'] = 'Log In to iSmile Dental Care';
                $data['firstname'] = $this->session->userdata('firstname');
                    $this->load->view('include/header', $data);
                    // $this->load->view('login_view', $data);
                    $this->load->view('include/footer');
                
          
                $this->load->view('include/header', $data);
                $this->load->view('login_view', $data);
                $this->load->view('include/footer');
               
            
                $data = array(
                    'id' => $user['id'],
                    'firstname' => $user['firstname'],
                    'middlename' => $user['middlename'],
                    'lastname' => $user['lastname'],
                    'birthday' => $user['birthday'],
                    'gender' => $user['gender'],
                    'occupation' => $user['occupation'],
                    'email' => $user['email'],
                    'contactno' => $user['contactno'],
                    'province' => $user['province'],
                    'address' => $user['address'],
                    'password' => $user['password'],
                    'role' => $user['role'],
                    'state' => $user['state'],
                    'is_logged' => TRUE
                );
                $this->session->set_userdata($data);
                redirect('Patient');
            }
            
                else if($user['role'] == 'admin'){
                    $data['title'] = 'Log In to iSmile Dental Care';
                    // $data['firstname'] = $this->session->userdata('firstname');
                    $this->load->view('include/header', $data);
                    // $this->load->view('login_view', $data);
                    $this->load->view('include/footer');
                
                
                    $data = array(
                        'id' => $user['id'],
                        'firstname' => $user['firstname'],
                        'middlename' => $user['middlename'],
                        'lastname' => $user['lastname'],
                        'birthday' => $user['birthday'],
                        'gender' => $user['gender'],
                        'occupation' => $user['occupation'],
                        'email' => $user['email'],
                        'contactno' => $user['contactno'],
                        'province' => $user['province'],
                        'address' => $user['address'],
                        'password' => $user['password'],
                        'role' => $user['role'],
                        'state' => $user['state'],
                        'is_logged' => TRUE
                    );
                    $this->session->set_userdata($data);
                    redirect('Admin');
                }
                else if($user['role'] == 'assistant'){
                    $data['title'] = 'Log In to iSmile Dental Care';
                    $data['firstname'] = $this->session->userdata('firstname');
                    $this->load->view('include/header', $data);
                    // $this->load->view('login_view', $data);
                    $this->load->view('include/footer');
                
                
                    $data = array(
                        'id' => $user['id'],
                        'firstname' => $user['firstname'],
                        'middlename' => $user['middlename'],
                        'lastname' => $user['lastname'],
                        'birthday' => $user['birthday'],
                        'gender' => $user['gender'],
                        'occupation' => $user['occupation'],
                        'email' => $user['email'],
                        'contactno' => $user['contactno'],
                        'province' => $user['province'],
                        'address' => $user['address'],
                        'password' => $user['password'],
                        'role' => $user['role'],
                        'state' => $user['state'],
                        'is_logged' => TRUE
                    );
                    $this->session->set_userdata($data);
                    redirect('Assistant');
                }
                else {
                    $data['error']= "Email or password is incorrect";
                    $data['title'] = 'Log In to iSmile Dental Care';
                    $data['active_page'] = 'login';
                    $this->load->view('include/header', $data);
                    $this->load->view('include/general_nav', $data);
                    // $this->load->view('login_view', $data);
                    $this->load->view('include/footer');
                }

            }
            else {
                $data['error']= "Email or password is incorrect";
                $data['title'] = 'Log In to iSmile Dental Care';
                $data['active_page'] = 'login';
                $this->load->view('include/header', $data);
                $this->load->view('include/general_nav', $data);
                $this->load->view('login_view', $data);
                $this->load->view('include/footer');
            }

        }

        public function logout(){
            $this->session->sess_destroy();
            redirect('Login');
        }
    }