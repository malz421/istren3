<?php
defined('BASEPATH') or exit('No direct script access allowed');

class TypeBerkas extends MX_Controller
{
	public function index(){
		$data['data_type_berkas']=$this->db->get('type_berkas')->result();
    	$data['header'] = 'layout/header';
		$data['topbar'] = 'layout/topbar';
		$data['sidebar'] = 'layout/sidebar';
		$data['content'] = 'karyawan/typeberkas/v_type_berkas';
		$data['js'] = 'layout/js';
		$data['jscontent'] = 'karyawan/typeberkas/jscontent';
		$data['footer'] = 'layout/footer';
		$this->load->view('layout/main', $data);
	}

	 public function tambah_type_berkas(){
    $data = array('nama_type_berkas' => $this->input->post('nama'));
    $this->db->insert('type_berkas',$data);
    $this->session->set_flashdata('flash', 'DATA BERHASIL DISIMPAN');
    redirect('kepegawaian/typeberkas');
  }

   public function hapus_type_berkas($id){
    $this->db->where('id_type_berkas ',$id);
    $this->db->delete('type_berkas');
    $this->session->set_flashdata('flash', 'DATA BERHASIL DI HAPUS');
    redirect('kepegawaian/typeberkas');
  }

   public function edit_type_berkas(){
    $data = array('nama_type_berkas' => $this->input->post('nama'));
    $this->db->where('id_type_berkas',$this->input->post('id'));
    $this->db->update('type_berkas',$data);
    $this->session->set_flashdata('flash', 'DATA BERHASIL DI UBAH');
    redirect('kepegawaian/typeberkas');

  }
}