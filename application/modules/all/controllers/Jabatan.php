<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jabatan extends MX_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('M_jabatan');
	
  }

  public function index()
  {
		if($this->session->userdata('status') != TRUE){
                redirect(base_url("all/login"));
		}
	
    
		$data['datajabatan'] = $this->M_jabatan->tampil_jabatan();
		$data['header'] = 'layout/header';
		$data['topbar'] = 'layout/topbar';
		$data['sidebar'] = 'layout/sidebar';
		$data['content'] = 'jabatan/v_jabatan';
		$data['js'] = 'layout/js';
		$data['jscontent'] = 'jabatan/jscontent';
		$data['footer'] = 'layout/footer';
		$this->load->view('layout/main', $data);
		
  }
  
  
   //tambah data
   public function tambah_jabatan()
  {


 	if($this->session->userdata('status') != TRUE){
        redirect(base_url("all/login"));
  }

  



	$jabatan=$this->input->post('jabatan');
	$datajabatan = array(
						'nama_jabatan' => $jabatan
					);
    $hasil = $this->M_jabatan->tambah_jabatan($datajabatan);
	
    if($hasil==TRUE){
      helper_log('add','menambahkan jabatan '.$jabatan);
		echo $this->session->set_flashdata('msg','success');
    }else{
      helper_log('add','gagal menambahkan jabaran'.$jabatan);
		echo $this->session->set_flashdata('msg','error');
    }
      $url = base_url('all/jabatan'.'?'.uniqid());
    redirect($url,'refresh');
    }
  
  
  
   //ubah data  
   public function ubah_jabatan()
  {
  
	if($this->session->userdata('status') != TRUE){
                redirect(base_url("all/login"));
	}
	
    $id=$this->input->post('idjabatan');
	$jabatan=$this->input->post('jabatan');
	$datajabatan = array(
						'nama_jabatan' => $jabatan
					);
    $hasil = $this->M_jabatan->ubah_jabatan($id,$datajabatan);

    if($hasil==TRUE){
      helper_log('edit','merubah jabatan '.$jabatan);
      echo $this->session->set_flashdata('msg','success');
    }else{
      helper_log('edit','gagal merubah jabatan '.$jabatan);
      echo $this->session->set_flashdata('msg','error');
    }
      $url = base_url('all/jabatan'.'?'.uniqid());
	  redirect($url,'refresh');
  }
  
	public function hapus_jabatan()
  {
  
	if($this->session->userdata('status') != TRUE){
        redirect(base_url("all/login"));
	}
	
    $id=$this->input->post('idjabatan');
    $hasil = $this->M_jabatan->hapus_jabatan($id);

    if($hasil==TRUE){
      echo $this->session->set_flashdata('msg','success');
    }else{
      echo $this->session->set_flashdata('msg','error');
    }
     $url = base_url('all/jabatan'.'?'.uniqid());
			redirect($url,'refresh');
  }
  
  
	
}
