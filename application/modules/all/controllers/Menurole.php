<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menurole extends MX_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('M_pengguna');
	
  }

  public function index()
  {
		if($this->session->userdata('status') != TRUE){
                redirect(base_url("all/login"));
		}
	
    
		$data['datamenurole'] = $this->M_pengguna->tampil_menu_role();
		$data['header'] = 'layout/header';
		$data['topbar'] = 'layout/topbar';
		$data['sidebar'] = 'layout/sidebar';
		$data['content'] = 'menurole/v_menurole';
		$data['js'] = 'layout/js';
		$data['jscontent'] = 'menurole/jscontent';
		$data['footer'] = 'layout/footer';
		$this->load->view('layout/main', $data);
		
  }
  
   //tambah data
   public function tambah_menu_role()
  {
 	if($this->session->userdata('status') != TRUE){
        redirect(base_url("all/login"));
  }
    $namarole=$this->input->post('namarole');
    $idlembaga=$this->input->post('idrole');
	$datarole = array(
                        'nama_menu_role' => $namarole,
                        'id_menu_role'     => $idlembaga
					);
    $hasil = $this->M_pengguna->tambah_menu_role($datarole);
	
    if($hasil==TRUE){
		echo $this->session->set_flashdata('msg','success');
    }else{
		echo $this->session->set_flashdata('msg','error');
    }
      $url = base_url('all/Menurole'.'?'.uniqid());
    redirect($url,'refresh');
    }
  

  
   //ubah data  
   public function ubah_menu_role()
   {
	if($this->session->userdata('status') != TRUE){
                redirect(base_url("all/login"));
	}
  $idrole=$this->input->post('idrole');
  $namarole=$this->input->post('namarole');
  $datarole = array(
                      'nama_menu_role' => $namarole,
                      'id_menu_role'     => $idrole
        );
  $hasil = $this->M_pengguna->ubah_menu_role($idrole,$datarole);

    if($hasil==TRUE){
      echo $this->session->set_flashdata('msg','success');
    }else{
      echo $this->session->set_flashdata('msg','error');
    }
      $url = base_url('all/Menurole'.'?'.uniqid());
	  redirect($url,'refresh');
  }
  

     //hapus data  
	public function hapus_menu_role()
  {
  
	if($this->session->userdata('status') != TRUE){
        redirect(base_url("all/login"));
  }
  
    $idrole=$this->input->post('idrole');

    $hasil = $this->M_pengguna->hapus_menu_role($idrole);


    if($hasil==TRUE){
      echo $this->session->set_flashdata('msg','success');
    }else{
      echo $this->session->set_flashdata('msg','error');
    }
     $url = base_url('all/Menurole'.'?'.uniqid());
			redirect($url,'refresh');
  }
  
  
	
}
