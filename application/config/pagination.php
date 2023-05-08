<?php
defined('BASEPATH') OR exit('No direct script access allowed');

 // These are the required config items to set
 $config['base_url'] = '';
 $config['total_rows'] = 100;
 $config['per_page'] = 4;
 $config['uri_segment'] = 3;
 
 // Not required config items
 $config['full_tag_open'] = '<ul class="pagination">';        
 $config['full_tag_close'] = '</ul>';        
 $config['first_link'] = 'First';        
 $config['last_link'] = 'Last';        
 $config['first_tag_open'] = '<li class="page-link">';        
 $config['first_tag_close'] = '</li>';        
 $config['prev_link'] = '&laquo';        
 $config['prev_tag_open'] = '<li class="page-link">';        
 $config['prev_tag_close'] = '</li>';        
 $config['next_link'] = '&raquo';        
 $config['next_tag_open'] = '<li class="page-link">';        
 $config['next_tag_close'] = '</li>';        
 $config['last_tag_open'] = '<li class="page-link">';        
 $config['last_tag_close'] = '</li>';        
 $config['cur_tag_open'] = '<li class="page-link"><a href="#">';          
 $config['cur_tag_close'] = '</a></li>';        
 $config['num_tag_open'] = '<li class="page-link">';        
 $config['num_tag_close'] = '</li>';