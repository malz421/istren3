<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Statusabsen extends MX_Controller {

  public function __construct()
  {
    parent::__construct();
    if($this->session->userdata('status') != TRUE){
                redirect(base_url("all/login"));
    }	
  }

  public function index()
  {
    $data['dataabsen']=$this->db->get('status_absen')->result();
    $data['header'] = 'layout/header';
		$data['topbar'] = 'layout/topbar';
		$data['sidebar'] = 'layout/sidebar';
		$data['content'] = 'statusabsen/v_status_absen';
		$data['js'] = 'layout/js';
		$data['jscontent'] = 'statusabsen/jscontent';
		$data['footer'] = 'layout/footer';
		$this->load->view('layout/main', $data);
  } 
  
   public function tambah(){
    $data = array(
      'kd_absen ' => $this->input->post('kode'),
      'ket_absen ' => $this->input->post('ket'),
      'bc ' => $this->input->post('bc'),
    );
    $this->db->insert('status_absen',$data);
    $this->session->set_flashdata('flash', 'DATA BERHASIL DISIMPAN');
    redirect('all/statusabsen');
  }

   public function hapus($id){
    $this->db->where('id_absen ',$id);
    $this->db->delete('status_absen');
    $this->session->set_flashdata('flash', 'DATA BERHASIL DI HAPUS');
    redirect('all/statusabsen');
  }

   public function ubah(){
    $data = array(
      'kd_absen ' => $this->input->post('kode'),
      'ket_absen ' => $this->input->post('ket'),
      'bc ' => $this->input->post('bc'),
    );
    $this->db->where('id_absen',$this->input->post('id'));
    $this->db->update('status_absen',$data);
    $this->session->set_flashdata('flash', 'DATA BERHASIL DI UBAH');
    redirect('all/statusabsen');

  }
  
  
}
