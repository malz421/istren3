<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kalenderkerja extends MX_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('M_kalender');
    $this->load->model('M_combo');
    $this->load->model('Kepegawaian/M_karyawan');


	
  }

  public function index()
  {
		if($this->session->userdata('status') != TRUE){
                redirect(base_url("all/login"));
    }
    
    $akseslembaga = $this->session->userdata('akseslembaga');
		$idlembaga = $this->session->userdata('idlembaga');
		
		
		//Jika akses antar lemmbaga 
		if ($akseslembaga == 'Y'){
			$idlembaga = 'all';
		}

		
		
		$data['combolembaga'] = $this->M_combo->combolembaga($idlembaga);
		$data['datakalender'] = $this->M_kalender->tampil_kalender();
		$data['header'] = 'layout/header';
		$data['topbar'] = 'layout/topbar';
		$data['sidebar'] = 'layout/sidebar';
		$data['content'] = 'kalender/v_kalender';
		$data['js'] = 'layout/js';
		$data['jscontent'] = 'kalender/jscontent';
		$data['footer'] = 'layout/footer';
		$this->load->view('layout/main', $data);
		
  }
  
  
   //tambah data
   public function tambah_kalender()
  {

    if($this->session->userdata('status') != TRUE){
          redirect(base_url("all/login"));
    }

    
    $tgl= $this->input->post('tglkalender');
    $id = $this->input->post('idlembaga');
    $keterangan=$this->input->post('ketkalender');
    $datakalender = array(
              'id_lembaga' => $id,
              'tgl_kalender' => $this->M_karyawan->rubah_tglformat($tgl),
              'ket_kalender' => $keterangan
            );
      $hasil = $this->M_kalender->tambah_kalender($datakalender);
    
      if($hasil==TRUE){
        helper_log('add','menambahkan kalender kerja '.$tgl);
      echo $this->session->set_flashdata('msg','success');
      }else{
        helper_log('add','gagal menambahkan kalender kerja'.$tgl);
      echo $this->session->set_flashdata('msg','error');
      }
        $url = base_url('all/kalenderkerja'.'?'.uniqid());
      redirect($url,'refresh');
    }
  
  
   //ubah data  
   public function ubah_kalender()
  {
  
	if($this->session->userdata('status') != TRUE){
                redirect(base_url("all/login"));
	}
	
    $id=$this->input->post('idkalender');
	  $tgl = $this->input->post('tglkalender');
    $keterangan = $this->input->post('ketkalender');


    $datakalender = array(
         'tgl_kalender' => $this->M_karyawan->rubah_tglformat($tgl),
         'ket_kalender' => $keterangan
    );

    $hasil = $this->M_kalender->ubah_kalender($id,$datakalender);

    if($hasil==TRUE){
      helper_log('edit','merubah kalender kerja '.$keterangan);
      echo $this->session->set_flashdata('msg','info');
    }else{
      helper_log('edit','gagal kalender kerja '.$keterangan);
      echo $this->session->set_flashdata('msg','info-error');
    }
      $url = base_url('all/kalenderkerja'.'?'.uniqid());
	  redirect($url,'refresh');
  }
  
	public function hapus_kalender()
  {
  
	if($this->session->userdata('status') != TRUE){
        redirect(base_url("all/login"));
	}
	
    $id=$this->input->post('idkalender');
    $hasil = $this->M_kalender->hapus_kalender($id);

    if($hasil==TRUE){
      echo $this->session->set_flashdata('msg','success-hapus');
    }else{
      echo $this->session->set_flashdata('msg','error-hapus');
    }
     $url = base_url('all/kalenderkerja'.'?'.uniqid());
			redirect($url,'refresh');
  }
  
  
	
}
