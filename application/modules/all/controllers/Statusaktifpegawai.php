<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Statusaktifpegawai extends MX_Controller {

  public function __construct()
  {
    parent::__construct();
    if($this->session->userdata('status') != TRUE){
                redirect(base_url("all/login"));
    }	
  }

  public function index()
  {
    $data['datastatusaktif']=$this->db->get('status_aktif_karyawan')->result();
    $data['header'] = 'layout/header';
		$data['topbar'] = 'layout/topbar';
		$data['sidebar'] = 'layout/sidebar';
		$data['content'] = 'statusaktifpegawai/v_status_aktif_pegawai';
		$data['js'] = 'layout/js';
		$data['jscontent'] = 'statusaktifpegawai/jscontent';
		$data['footer'] = 'layout/footer';
		$this->load->view('layout/main', $data);
  } 
  
   public function tambah_status_aktif_pegawai(){
    $data = array('ket_sts_karyaaktif' => $this->input->post('ket'));
    $this->db->insert('status_aktif_karyawan',$data);
    $this->session->set_flashdata('flash', 'DATA BERHASIL DISIMPAN');
    redirect('all/statusaktifpegawai');
  }

   public function hapus_status_aktif_pegawai($id){
    $this->db->where('id_sts_karyaaktif ',$id);
    $this->db->delete('status_aktif_karyawan');
    $this->session->set_flashdata('flash', 'DATA BERHASIL DI HAPUS');
    redirect('all/statusaktifpegawai');
  }

   public function ubah_status_aktif_pegawai(){
    $data = array('ket_sts_karyaaktif' => $this->input->post('ket'));
    $this->db->where('id_sts_karyaaktif',$this->input->post('id'));
    $this->db->update('status_aktif_karyawan',$data);
    $this->session->set_flashdata('flash', 'DATA BERHASIL DI UBAH');
    redirect('all/statusaktifpegawai');

  }
  
  
}
