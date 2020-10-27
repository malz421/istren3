<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends MX_Controller {

  public function __construct()
  {
    parent::__construct();
	$this->load->model('M_pengguna');
	$this->load->model('M_combo');
	
  }

  public function index()
  {
		if($this->session->userdata('status') != TRUE){
                redirect(base_url("all/login"));
		}
	
    
		$data['datamenu'] = $this->M_pengguna->tampil_menu();
		$data['combomenu'] = $this->M_combo->combomenu();
		$data['header'] = 'layout/header';
		$data['topbar'] = 'layout/topbar';
		$data['sidebar'] = 'layout/sidebar';
		$data['content'] = 'menu/v_menu';
		$data['js'] = 'layout/js';	
		$data['jscontent'] = 'menu/jscontent';
		$data['footer'] = 'layout/footer';
		$this->load->view('layout/main', $data);
		
  }
  
   //tambah data
   public function tambah_menu()
  {
 	if($this->session->userdata('status') != TRUE){
        redirect(base_url("all/login"));
  }
    $namamenu=$this->input->post('namamenu');
    $idparent=$this->input->post('idparent');
    $urlmenu=$this->input->post('urlmenu');
    $icon=$this->input->post('icon');
    
	  $datamenu = array(
                        'parent_id' => $idparent,
                        'nama_menu' => $namamenu,
                        'url' => $urlmenu,
                        'icon'=> $icon
		);
    $hasil = $this->M_pengguna->tambah_menu($datamenu);
    if($hasil==TRUE){
		echo $this->session->set_flashdata('msg','success');
    }else{
		echo $this->session->set_flashdata('msg','error');
    }
      $url = base_url('all/menu'.'?'.uniqid());
    redirect($url,'refresh');
    }
  
  
   //ubah data  
   public function ubah_menu()
   {
	if($this->session->userdata('status') != TRUE){
                redirect(base_url("all/login"));
  }
  $idmenu=$this->input->post('idmenu');
  $namamenu=$this->input->post('namamenu');
  $idparent=$this->input->post('idparent');
  $urlmenu=$this->input->post('urlmenu');
  $icon=$this->input->post('icon');
  
  $datamenu = array(
                      'parent_id' => $idparent,
                      'nama_menu' => $namamenu,
                      'url' => $urlmenu,
                      'icon'=> $icon
  );

  $hasil = $this->M_pengguna->ubah_menu($idmenu,$datamenu);

    if($hasil==TRUE){
      echo $this->session->set_flashdata('msg','success');
    }else{
      echo $this->session->set_flashdata('msg','error');
    }
      $url = base_url('all/menu'.'?'.uniqid());
	  redirect($url,'refresh');
  }
  

     //hapus data  
	public function hapus_menu()
  {
  
	if($this->session->userdata('status') != TRUE){
        redirect(base_url("all/login"));
  }
  
    $idmenu=$this->input->post('idmenu');

    $hasil = $this->M_pengguna->hapus_menu($idmenu);


    if($hasil==TRUE){
      echo $this->session->set_flashdata('msg','success');
    }else{
      echo $this->session->set_flashdata('msg','error');
    }
     $url = base_url('all/menu'.'?'.uniqid());
			redirect($url,'refresh');
  }
  
  
	
}




