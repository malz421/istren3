<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Absen_pola extends MX_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('M_departemen');
	$this->load->model('M_combo');
	$this->load->model('M_absen');
  }

  public function index()
  {
		if($this->session->userdata('status') != TRUE  ){
			if ($this->session->userdata('role') != 'admin'){
				redirect(base_url("all/login"));
			}
			else
			{
			   redirect(base_url("all/login"));
			}
			  
		}
	    
		$akseslembaga = $this->session->userdata('akseslembaga');
		$idlembaga = $this->session->userdata('idlembaga');
		$aksesdepartemen = $this->session->userdata('aksesdepartemen');
		$idepartemen = $this->session->userdata('iddepartemen');
		
		
		//Jika akses antar lemmbaga 
		if ($akseslembaga == 'Y'){
			$idlembaga = 'all';
		}

		if ($aksesdepartemen == 'Y'){
			$idepartmen = 'all';
		}
		
		$data['combolembaga'] = $this->M_combo->combolembaga($idlembaga);
		$data['dataabsen'] = $this->M_absen->tampil_absen_pola();
		$data['header'] = 'layout/header';
		$data['topbar'] = 'layout/topbar';
		$data['sidebar'] = 'layout/sidebar';
		$data['content'] = 'absenpola/v_absenpola';
	    $data['js'] = 'layout/js';
        $data['jscontent'] = 'absenpola/jscontent';
		$data['footer'] = 'layout/footer';
		$this->load->view('layout/main', $data);
  }
 
 
   //tambah data
   public function tambah_absen_pola()
  {
	
	if($this->session->userdata('status') != TRUE)
	{
        redirect(base_url("all/login"));
	}
	

$this->form_validation->set_rules('jammasuk','Harus Di isi','required|trim');
$this->form_validation->set_rules('jamkeluar','Harus Di isi','required|trim');


if ($this->form_validation->run() == TRUE){
	
	$kodeshift	= $this->input->post('kodeshift');
	$namashift	= $this->input->post('namashift');
	$jammasuk	= $this->input->post('jammasuk');
	$jamkeluar	= $this->input->post('jamkeluar');

	$dataabsen = array(
		'kode_shift'	=> $kodeshift,
		'nama_shift'	=> $namashift,
		'jam_masuk'		=> $jammasuk,                 
		'jam_keluar' 	=> $jamkeluar,              
	);

    $hasil = $this->M_absen->tambah_absen_pola($dataabsen);
	
    if($hasil==TRUE){
		echo $this->session->set_flashdata('msg','success');
    }else{
		echo $this->session->set_flashdata('msg','error');
    }
	  $url = base_url('all/Absen_pola'.'?'.uniqid());
	  redirect($url,'refresh');
	}
}
  
   //ubah data  
   public function ubah_absen_pola()
  {
  
	if($this->session->userdata('status') != TRUE){
        redirect(base_url("all/Login"));
	}
	
	$idshift 		= $this->input->post('idshift');
	$kodeshift 		= $this->input->post('kodeshift');
	$namashift 		= $this->input->post('namashift');
	$jammasuk		= $this->input->post('jammasuk');
	$jamkeluar		= $this->input->post('jamkeluar');

	

	$dataabsen = array(
		'kode_shift'		=> $kodeshift,
		'nama_shift'		=> $namashift,
		'jam_masuk'			=> $jammasuk,                 
		'jam_keluar' 		=> $jamkeluar
	);

    $hasil = $this->M_absen->ubah_absen_pola($idshift,$dataabsen);
	
    if($hasil==TRUE){
		echo $this->session->set_flashdata('msg','success');
    }else{
		echo $this->session->set_flashdata('msg','error');
    }
	  $url = base_url('all/Absen_pola'.'?'.uniqid());
	  redirect($url,'refresh');
} 
	  
	public function hapus_absen_pola()
  {
  
	if($this->session->userdata('status') != TRUE){
        redirect(base_url("all/Login"));
	}
	
	$idabsenpola 	= $this->input->post('idshift');
	
	 
    $hasil = $this->M_absen->hapus_absen_pola($idabsenpola);

    if($hasil==TRUE){
      echo $this->session->set_flashdata('msg','success');
    }else{
      echo $this->session->set_flashdata('msg','error');
    }
     $url = base_url('all/Absen_pola'.'?'.uniqid());
			redirect($url,'refresh');
  }
	
}
  
	

