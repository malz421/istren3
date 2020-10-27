<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pendidikan extends MX_Controller {

  public function __construct()
  {
    parent::__construct();
    if($this->session->userdata('status') != TRUE){
                redirect(base_url("all/login"));
    }	
  }

  public function index()
  {
    $data['datapendidikan']=$this->db->get('pendidikan')->result();
    $data['header'] = 'layout/header';
		$data['topbar'] = 'layout/topbar';
		$data['sidebar'] = 'layout/sidebar';
		$data['content'] = 'pendidikan/v_pendidikan';
		$data['js'] = 'layout/js';
		$data['jscontent'] = 'pendidikan/jscontent';
		$data['footer'] = 'layout/footer';
		$this->load->view('layout/main', $data);
  } 
  
   public function tambah(){
    $data = array('nama_pendidikan' => $this->input->post('nama'));
    $this->db->insert('pendidikan',$data);
    $this->session->set_flashdata('flash', 'DATA BERHASIL DISIMPAN');
    redirect('all/pendidikan');
  }

   public function hapus($id){
    $this->db->where('id_pendidikan ',$id);
    $this->db->delete('pendidikan');
    $this->session->set_flashdata('flash', 'DATA BERHASIL DI HAPUS');
    redirect('all/pendidikan');
  }

   public function ubah(){
    $data = array('nama_pendidikan' => $this->input->post('nama'));
    $this->db->where('id_pendidikan',$this->input->post('id'));
    $this->db->update('pendidikan',$data);
    $this->session->set_flashdata('flash', 'DATA BERHASIL DI UBAH');
    redirect('all/pendidikan');

  }
  
  
}
