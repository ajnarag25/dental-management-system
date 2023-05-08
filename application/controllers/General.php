<?php
    class General extends CI_Controller{
        public function __construct(){
            parent::__construct();
            $this->load->helper('url');
            $this->load->helper('form');
            $this->load->library('session');
            $this->load->model('Users_model');
        }

        public function index(){
            $data['title'] = 'iSmile Dental Care Home';
            $data['active_page'] = 'home';
            $this->load->view('include/header', $data);
            $this->load->view('include/general_nav', $data);
            $this->load->view('General/home_general', $data);
            $this->load->view('include/footer');
            
        }

        public function about_us(){
            $data['title'] = 'About Us';
            $data['active_page'] = 'about_us';
            $this->load->view('include/header', $data);
            $this->load->view('include/general_nav', $data);
            $this->load->view('General/general_about_us', $data);
            $this->load->view('include/footer');
            
        }

        public function gallery(){
            $data['title'] = 'Gallery';
            $data['active_page'] = 'gallery';
            $this->load->view('include/header', $data);
            $this->load->view('include/general_nav', $data);
            $this->load->view('General/general_gallery', $data);
            $this->load->view('include/footer');
            
        }

        public function services(){
            $data['title'] = 'Services';
            $data['active_page'] = 'services';
            $this->load->view('include/header', $data);
            $this->load->view('include/general_nav', $data);
            $this->load->view('General/general_services', $data);
            $this->load->view('include/footer');
            
        }

        public function contact_us(){
            $data['title'] = 'Contact Us';
            $data['active_page'] = 'contact_us';
            $this->load->view('include/header', $data);
            $this->load->view('include/general_nav', $data);
            $this->load->view('General/general_contact_us', $data);
            $this->load->view('include/footer');
            
        }


    }
?>