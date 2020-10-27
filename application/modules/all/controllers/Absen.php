<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Absen extends MX_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('M_departemen');
	$this->load->model('M_combo');
	$this->load->model('M_absen');
  }

  public function index()
  {
		if($this->session->userdata('status') != TRUE){
			  redirect(base_url("all/login"));
			  
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
		$data['dataabsen'] = $this->M_absen->tampil_absen_umum($idlembaga);
		$data['header'] = 'layout/header';
		$data['topbar'] = 'layout/topbar';
		$data['sidebar'] = 'layout/sidebar';
		$data['content'] = 'absenumum/v_absenumum';
		$data['js'] = 'layout/js';
		$data['jscontent'] = 'absenumum/jscontent';
		$data['footer'] = 'layout/footer';
		$this->load->view('layout/main', $data);
  }
 
   //tambah data
   public function tambah_absen_umum()
  {
	
	if($this->session->userdata('status') != TRUE)
	{
        redirect(base_url("all/login"));
	}
	

$this->form_validation->set_rules('tolterlambat','Konversi Terlambat','required|trim');
$this->form_validation->set_rules('konverterlambat','Konversi Terlambat','required|trim');


if ($this->form_validation->run() == TRUE){
	
	$idlembaga 		= $this->input->post('idlembaga');
	$jammasuk		= $this->input->post('jammasuk');
	$jamkeluar		= $this->input->post('jamkeluar');
	$tolterlambat	= $this->input->post('tolterlambat');
	$konterlamabat	= $this->input->post('konverterlambat');
	

	$dataabsen = array(
		'id_lembaga'		=> $idlembaga,
		'jam_masuk'			=> $jammasuk,                 
		'jam_keluar' 		=> $jamkeluar,                
		'toleransi_lambat'  => $tolterlambat,                 
		'konversi_lambat'   => $konterlamabat
	);

    $hasil = $this->M_absen->tambah_absen_umum($dataabsen);
	
    if($hasil==TRUE){
		echo $this->session->set_flashdata('msg','success');
    }else{
		echo $this->session->set_flashdata('msg','error');
    }
	  $url = base_url('all/absen'.'?'.uniqid());
	  redirect($url,'refresh');
	}
}
  
   //ubah data  
   public function ubah_absen_umum()
  {
  
	if($this->session->userdata('status') != TRUE){
        redirect(base_url("all/login"));
	}
	
	$idabsenumum 	= $this->input->post('idabsenumum');
	$idlembaga 		= $this->input->post('idlembaga');
	$jammasuk		= $this->input->post('jammasuk');
	$jamkeluar		= $this->input->post('jamkeluar');
	$tolterlambat	= $this->input->post('tolterlambat');
	$konterlamabat	= $this->input->post('konverterlambat');
	

	$dataabsen = array(
		'id_lembaga'		=> $idlembaga,
		'jam_masuk'			=> $jammasuk,                 
		'jam_keluar' 		=> $jamkeluar,                
		'toleransi_lambat'  => $tolterlambat,                 
		'konversi_lambat'   => $konterlamabat
	);

    $hasil = $this->M_absen->ubah_absen_umum($idabsenumum,$dataabsen);
	
    if($hasil==TRUE){
		echo $this->session->set_flashdata('msg','success');
    }else{
		echo $this->session->set_flashdata('msg','error');
    }
	  $url = base_url('all/absen'.'?'.uniqid());
	  redirect($url,'refresh');
} 
	  
	public function hapus_absen_umum()
  {
  
	if($this->session->userdata('status') != TRUE){
        redirect(base_url("all/login"));
	}
	
	$idabsenumum 	= $this->input->post('idabsenumum');
	
	 
    $hasil = $this->M_absen->hapus_absen_umum($idabsenumum);

    if($hasil==TRUE){
      echo $this->session->set_flashdata('msg','success');
    }else{
      echo $this->session->set_flashdata('msg','error');
    }
     $url = base_url('all/Absen'.'?'.uniqid());
			redirect($url,'refresh');
  }

  
	
}
  
	

