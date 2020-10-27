<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forbidden extends MX_Controller {

        public function __construct()
        {
            parent::__construct();
			
            $this->load->model('M_login');//load model admin
		
        }
        public function index()
        {
		
			
		    //load template halaman
			$data['header'] 				= 'layout/header';
			$data['topbar'] 				= 'layout/topbar_user';
			$data['sidebar'] 				= 'layout/sidebar_user';
			$data['control_sidebar'] 		= 'layout/control_sidebar';
			$data['content_header'] 		= 'layout/content_header';
			$data['content'] 				= 'layout/content_forbiden';
			$data['js'] 					= 'layout/js';
			$data['jscontent'] 				= 'layout/jscontent';
			$data['footer']					= 'layout/footer';
			$this->load->view('layout/main', $data);
	
        }
		
       
	}
    