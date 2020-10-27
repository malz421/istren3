<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Unitkerja extends MX_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('M_unitkerja');
	
  }

  public function index()
  {
		if($this->session->userdata('status') != TRUE){
                redirect(base_url("all/login"));
		}
	
    
		$data['dataunitkerja'] = $this->M_unitkerja->tampil_unitkerja();
		$data['header'] = 'layout/header';
		$data['topbar'] = 'layout/topbar';
		$data['sidebar'] = 'layout/sidebar';
		$data['content'] = 'unitkerja/v_unitkerja';
    $data['js'] = 'layout/js';
    $data['jscontent'] = 'unitkerja/jscontent';
		$data['footer'] = 'layout/footer';
		$this->load->view('layout/main', $data);
		
  }
  
  
   //tambah data
   public function tambah_unitkerja()
  {
 	if($this->session->userdata('status') != TRUE){
        redirect(base_url("all/login"));
	}
	
	$unitkerja=$this->input->post('unitkerja');
	
	$dataunitkerja = array(
						'nama_unit_kerja' => $unitkerja
					);
    $hasil = $this->M_unitkerja->tambah_unitkerja($dataunitkerja);
	
    if($hasil==TRUE){
		echo $this->session->set_flashdata('msg','success');
    }else{
		echo $this->session->set_flashdata('msg','error');
    }
      $url = base_url('all/unitkerja'.'?'.uniqid());
	  redirect($url,'refresh');
  }
  
   //ubah data  
   public function ubah_unitkerja()
  {
  
	if($this->session->userdata('status') != TRUE){
      redirect(base_url("all/login"));
	}
	
    $id=$this->input->post('idunitkerja');
	$namaunitkerja=$this->input->post('namaunitkerja');
	$dataunitkerja = array(
						'nama_unit_kerja' => $namaunitkerja
					);
    $hasil = $this->M_unitkerja->ubah_unitkerja($id,$dataunitkerja);

    if($hasil==TRUE){
      echo $this->session->set_flashdata('msg','success');
    }else{
      echo $this->session->set_flashdata('msg','error');
    }
      $url = base_url('all/unitkerja'.'?'.uniqid());
	  redirect($url,'refresh');
  }
  
	public function hapus_unitkerja()
  {
  
	if($this->session->userdata('status') != TRUE){
        redirect(base_url("all/login"));
	}
	
    $id=$this->input->post('idunitkerja');
    $hasil = $this->M_unitkerja->hapus_unitkerja($id);

    if($hasil==TRUE){
      echo $this->session->set_flashdata('msg','success');
    }else{
      echo $this->session->set_flashdata('msg','error');
    }
     $url = base_url('all/unitkerja'.'?'.uniqid());
			redirect($url,'refresh');
  }
  
  
	
}
