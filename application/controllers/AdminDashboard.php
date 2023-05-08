<?php
    class AdminDashboard extends CI_Controller{
        public function __construct(){
            parent::__construct();
           
        }
      
        public function index(){
            $this->load->view('include/inside_nav');
            // $this->load->view('include/admin_sidebar');
            $this->load->view('calendar/index.php');
        }
    }

?>