<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lembaga extends MX_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('M_lembaga');	
  }

  public function index()
  {
		if($this->session->userdata('status') != TRUE){
                redirect(base_url("all/login"));
		}
		$data['datalembaga'] = $this->M_lembaga->tampil_lembaga();
		$data['header'] = 'layout/header';
		$data['topbar'] = 'layout/topbar';
		$data['sidebar'] = 'layout/sidebar';
		$data['content'] = 'lembaga/v_lembaga';
		$data['js'] = 'layout/js';
		$data['jscontent'] = 'lembaga/jscontent';
		$data['footer'] = 'layout/footer';
		$this->load->view('layout/main', $data);
  }
  
  
   //tambah data
   public function tambah_lembaga()
  {
 	if($this->session->userdata('status') != TRUE){
        redirect(base_url("all/login"));
	}
	$lembaga=$this->input->post('lembaga');
	$datalembaga = array(
						'nama_lembaga' => $lembaga
					);
    $hasil = $this->M_lembaga->tambah_lembaga($datalembaga);
	
    if($hasil==TRUE){
		echo $this->session->set_flashdata('msg','success');
    }else{
		echo $this->session->set_flashdata('msg','error');
    }
      $url = base_url('all/lembaga'.'?'.uniqid());
	  redirect($url,'refresh');
  }
  
   //ubah data  
   public function ubah_lembaga(){
   
	if($this->session->userdata('status') != TRUE){
        redirect(base_url("all/login"));
	}
	
    $id=$this->input->post('idlembaga');
	  $lembaga=$this->input->post('lembaga');
	$datalembaga = array(
						'nama_lembaga' => $lembaga
					);
    $hasil = $this->M_lembaga->ubah_lembaga($id,$datalembaga);

    if($hasil==TRUE){
      echo $this->session->set_flashdata('msg','success');
    }else{
      echo $this->session->set_flashdata('msg','error');
    }
      $url = base_url('all/lembaga'.'?'.uniqid());
	  redirect($url,'refresh');
  }
  
  //hapus data
	public function hapus_lembaga(){
  
	if($this->session->userdata('status') != TRUE){
        redirect(base_url("all/login"));
	}
	
    $id=$this->input->post('idlembaga');
    $hasil = $this->M_lembaga->hapus_lembaga($id);

    if($hasil==TRUE){
      echo $this->session->set_flashdata('msg','success');
    }else{
      echo $this->session->set_flashdata('msg','error');
    }
     $url = base_url('all/lembaga'.'?'.uniqid());
			redirect($url,'refresh');
  }
  
  
	
}
