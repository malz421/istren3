<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Statuskaryawan extends MX_Controller {

  public function __construct()
  {
    parent::__construct();
    if($this->session->userdata('status') != TRUE){
                redirect(base_url("all/login"));
    }	
  }

  public function index()
  {
    $data['datastatus']=$this->db->get('status_karyawan')->result();
    $data['header'] = 'layout/header';
		$data['topbar'] = 'layout/topbar';
		$data['sidebar'] = 'layout/sidebar';
		$data['content'] = 'status_karyawan/v_status_karyawan';
		$data['js'] = 'layout/js';
		$data['jscontent'] = 'status_karyawan/jscontent';
		$data['footer'] = 'layout/footer';
		$this->load->view('layout/main', $data);
  } 
  public function tambah_status_karyawan(){
    $data = array('ket_sts_karyawan' => $this->input->post('ket'));
    $this->db->insert('status_karyawan',$data);
    $this->session->set_flashdata('flash', 'DATA BERHASIL DISIMPAN');
    redirect('all/statuskaryawan');
  }
	 public function ubah_status_karyawan(){
    $data = array('ket_sts_karyawan' => $this->input->post('ket'));
    $this->db->where('id_sts_karyawan ',$this->input->post('id'));
    $this->db->update('status_karyawan',$data);
    $this->session->set_flashdata('flash', 'DATA BERHASIL DI UBAH');
    redirect('all/statuskaryawan');

  }

  public function hapus_status_karyawan($id){
    $this->db->where('id_sts_karyawan',$id);
    $this->db->delete('status_karyawan');
    $this->session->set_flashdata('flash', 'DATA BERHASIL DI HAPUS');
    redirect('all/statuskaryawan');
  }
  
}
