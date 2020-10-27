<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_page extends MX_Controller {

        public function __construct()
        {
            parent::__construct();
			
            $this->load->model('M_login');//load model admin
		
        }
        public function index()
        {
		
			if($this->session->userdata('status') != TRUE  ){
                redirect(base_url("all/login"));
			}
			
			
		    //load template halaman
			$data['header'] 				= 'layout/header';
			$data['topbar'] 				= 'layout/topbar';
			$data['sidebar'] 				= 'layout/sidebar';
			$data['control_sidebar'] 		= 'layout/control_sidebar';
			$data['content_header'] 		= 'layout/content_header';
			$data['content'] 				= 'layout/content';
			$data['js'] 					= 'layout/js';
			$data['jscontent'] 				= 'layout/jscontent';
			$data['footer']					= 'layout/footer';
			$this->load->view('layout/main', $data);
	
        }
		
        function logout(){
		  $this->session->sess_destroy();
          $url = base_url('all/login');
		  redirect ($url);
		}
	}
    