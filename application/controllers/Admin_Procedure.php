<?php
    class Admin_Procedure extends CI_Controller{
        public function __construct(){
            parent::__construct();
            $this->load->library('session');
            $this->load->helper('url');
            $this->load->helper('form');
            $this->load->library('upload');
            $this->load->library('image_lib');
            $this->load->library('form_validation');
            $this->load->library('pagination');
            $this->load->model('Procedures_model');
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

        public function index(){
            $id = $this->session->userdata('id');
            $data['user'] = $this->Users_model->get_myUser($id);
            $data['active_page'] = 'procedure';
            redirect(('Admin_Procedure/admin_manage_procedures/').$id,$data);
        }

        
        //ADMIN VIEW ALL ACCOUNTS
        public function admin_manage_procedures(){

            $data['title'] = 'iSmile Dental Care | Manage Dental Procedures';
            $data['firstname'] = $this->session->userdata('firstname');
            $data['active_page'] = 'procedure';

            $this->config->load('pagination', TRUE);
            $procedure_pagination_config = $this->config->item('pagination');
            $procedure_pagination_config['total_rows'] = $this->Procedures_model->get_procedures_count();
            $procedure_pagination_config['base_url'] = base_url('Admin_Procedure/admin_manage_procedures');
            $this->pagination->initialize($procedure_pagination_config);  

            $offset = $this->uri->segment(3);
            
            $data['links'] = $this->pagination->create_links();
            $data['procedures'] = $this->Procedures_model->get_procedures_with_limit($procedure_pagination_config['per_page'], $offset);
            
            $this->load->view('include/header', $data);
            $this->load->view('include/inside_nav');
            $this->load->view('include/admin_sidebar');
            $this->load->view('admin_procedure/admin_manage_procedures',$data);
            $this->load->view('include/footer');
        }
        // Procedure Archive Button
        public function archive_procedure_btn($procedure_id){


   
            $data = array('procedure_activeness	' => 'inactive');
            $data['user'] = $this->Procedures_model->archive_procedure($procedure_id,$data);
           
            // $data['user']= $this->Procedures_model->archive_procedure($procedure_id, $data);
        
            redirect('Admin_Procedure/admin_manage_procedures/'.$procedure_id , $data);

        }        
        
        public function activate_procedure_btn($procedure_id){


   
            $data = array('procedure_activeness	' => 'active');
            $data['user'] = $this->Procedures_model->activate_procedure($procedure_id,$data);
           
            // $data['user']= $this->Procedures_model->archive_procedure($procedure_id, $data);
        
            redirect('Admin_Procedure/admin_manage_procedures/'.$procedure_id , $data);

        }



        // SEARCH FOR SPECIFIC ACCOUNT
        public function search(){

            $data['title'] = 'iSmile Dental Care | Dental Procedures';
            $data['active_page'] = 'procedure';

            $search = $this->input->post('search');
            
            // $data['users'] = $this->Users_model->search_user($search);
            // $data['links'] = $this->pagination->create_links();


            $this->config->load('pagination', TRUE);
            $procedure_pagination_config = $this->config->item('pagination');
            $procedure_pagination_config['total_rows'] = $this->Procedures_model->get_procedures_search_count($search);
            $procedure_pagination_config['base_url'] = base_url('Admin_Procedure/admin_manage_procedures');
            $this->pagination->initialize($procedure_pagination_config);  

            $offset = $this->uri->segment(3);
            
            $data['links'] = $this->pagination->create_links();
            $data['procedures'] = $this->Procedures_model->search_procedure($search,$procedure_pagination_config['per_page'], $offset);
           
            $this->load->view('include/header', $data);
            $this->load->view('include/inside_nav');
            $this->load->view('include/admin_sidebar');
            $this->load->view('admin_procedure/admin_manage_procedures',$data);
            $this->load->view('include/footer');
        }



        //[SETUP] ADMIN MANUAL REGISTRATION OF ACCOUNT
        public function admin_add_procedure_view(){
            $data['title'] = "iSmile Dental Care | Dental Procedures";
            $data['active_page'] = 'procedure';
            $this->load->view('include/header', $data);
            $this->load->view('include/inside_nav');
            $this->load->view('include/admin_sidebar');
            $this->load->view('admin_procedure/admin_add_procedure',$data);
            $this->load->view('include/footer');
        }


        //ADMIN MANUAL REGISTRATION OF ACCOUNT
        public function admin_add_procedure_func(){
            
            $this->form_validation->set_rules('procedure_name', 'Procedure Name', 'required|regex_match[/^[a-zA-Z0-9\s\-]+$/]|is_unique[procedures.procedure_name]');
            $this->form_validation->set_rules('procedure_legend', 'Procedure Legend', 'required|is_unique[procedures.procedure_legend]');
            $this->form_validation->set_rules('procedure_desc', 'Procedure Description', 'required');
            $this->form_validation->set_rules('procedure_duration', 'Procedure Duration', 'required|numeric');
            $this->form_validation->set_rules('procedure_price', 'Procedure Price', 'required|numeric|regex_match[/^[0-9\.]+$/]');
            if($this->form_validation->run() == FALSE){
                $data['title'] = "iSmile Dental Care | Dental Procedures";
                $data['error'] = validation_errors();
                $data['input'] = $this->input->post();
                $data['active_page'] = 'procedure';
                
                    $this->load->view('include/header', $data);
                    $this->load->view('include/inside_nav');
                    $this->load->view('include/admin_sidebar'); 
                    $this->load->view('admin_procedure/admin_add_procedure', $data);
                    $this->load->view('include/footer');
            }else{   
                
                $procedure_name =strtoupper($this->input->post('procedure_name'));
                $words = explode(" ", $procedure_name);
                if (count($words) == 1) {
                    $procedure_id = substr($procedure_name, 0, 3);
                } elseif (count($words) == 2) {
                    $procedure_id = substr($words[0], 0, 2) . substr($words[1], 0, 1);
                } elseif (count($words) == 3) {
                    $procedure_id = $words[0][0] . $words[1][0] . $words[2][0];
                } else {
                    $procedure_id = substr($words[0], 0, 3);
                }
                

                if ($this->Procedures_model->is_duplicate_procedure_id($procedure_id)) {
                    $count=$this->Procedures_model->get_procedures_count();
                    $procedure_id= $procedure_id.$count;
                }
                $data = array(
                    'procedure_name' => $this->input->post('procedure_name'),
                    'procedure_legend' => $this->input->post('procedure_legend'),
                    'procedure_duration' => $this->input->post('procedure_duration'),
                    'procedure_desc' => $this->input->post('procedure_desc'),
                    'procedure_price' => $this->input->post('procedure_price'),
                    'procedure_id' => $procedure_id,
                    'procedure_activeness' => 'active'
                );
                


                $this->Procedures_model->insert_procedure($data);
                $data['title'] = "iSmile Dental Care | Dental Procedures";
                $this->session->set_flashdata('success', 'You have successfully signed up!');
                redirect('Admin_Procedure/admin_manage_procedures');
            }
        }



        //ADMIN DELETE
        public function delete_procedure($procedure_id){
            $this->Procedures_model->delete($procedure_id);
            redirect('Admin_Procedure/admin_manage_procedures');
        }

        
        
        //[SETUP] ADMIN UPDATE SELECTED ACCOUONT 
        //Same as Edit_user($id) in Patient controller
        // admin_update
       public function admin_update_procedure_view($procedure_id){
            $data['title'] = "iSmile Dental Care | Dental Procedures";
            $data['procedure'] = $this->Procedures_model->get_myProcedure($procedure_id);
            $data['procedure_id'] =  $this->session->userdata('procedure_id');
            $data['active_page'] = 'procedure';
            $this->load->view('include/header', $data);
            $this->load->view('include/inside_nav');
            $this->load->view('include/admin_sidebar');
            $this->load->view('admin_procedure/admin_update_procedure', $data);
            $this->load->view('include/footer');
        }


        //ADMIN UPDATE SELECTED ACCOUNT
        //Same as update_user($id) in Patient controller
        // update_user
        public function update_procedure_func(){
            $procedure_id = $this->input->post('procedure_id');
            $procedure_legend = $this->input->post('procedure_legend');
            $this->form_validation->set_rules('procedure_desc', 'Procedure Description', 'required');
            $this->form_validation->set_rules('procedure_duration', 'Procedure Duration', 'required|numeric');
            $this->form_validation->set_rules('procedure_price', 'Procedure Price', 'required|numeric|regex_match[/^[0-9\.]+$/]');

            $existing_procedure_legend = $this->db->select('procedure_legend')
                                     ->from('procedures')
                                     ->where('procedure_id', $procedure_id)
                                     ->get()
                                     ->row()
                                     ->procedure_legend;
            if ($existing_procedure_legend == $procedure_legend) {
                $this->form_validation->set_rules('procedure_legend', 'Procedure Legend', 'required');
            } else {
                $this->form_validation->set_rules('procedure_legend', 'Procedure Legend', 'required|is_unique[procedures.procedure_legend]');
            }
            
            if($this->form_validation->run() == FALSE){
                $data['title'] = 'iSmile Dental Care | Dental Procedures';
                $data['error'] = validation_errors();
                $data['active_page'] = 'procedure';
                $data['procedure'] = $this->Procedures_model->get_myProcedure($procedure_id);
                $this->load->view('include/header', $data);
                $this->load->view('include/inside_nav');
                $this->load->view('include/admin_sidebar');
                $this->load->view('admin_procedure/admin_update_procedure', $data);
                $this->load->view('include/footer');
            }else{
                $data = array(
                    'procedure_duration' => $this->input->post('procedure_duration'),
                    'procedure_legend' => $this->input->post('procedure_legend'),
                    'procedure_desc' => $this->input->post('procedure_desc'),
                    'procedure_price' => $this->input->post('procedure_price')
                );
                $this->Procedures_model->update($procedure_id, $data);
                $this->session->set_flashdata('success', 'Account updated successfully!');
                
                redirect(('Admin_Procedure/admin_update_procedure_view/').$procedure_id,$data);
                // redirect('Admin/admin_manage_accounts');
            }
        }


    
}
?>
