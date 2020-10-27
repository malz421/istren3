<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Daftartamu extends MX_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('M_tamu');
    // if($this->session->userdata('status') != TRUE){
    //             redirect(base_url("all/login"));
    // }	
  }
 public function dashboard(){
  $tahun_sekarang=date('Y'); 
  $tahun_kemarin=$tahun_sekarang-1;
  $bulan_sekarang=date('m');
  $bulan_kemarin=$bulan_sekarang-1;
  $hari_sekarang=date('d');
  $hari_kemarin=$hari_sekarang-1;
// echo $bulan_sekarang; die();

    $data['bulan_ini']=$this->db->query('SELECT COUNT(id_tamu) as jml_bulan_ini FROM `buku_tamu` WHERE MONTH(`tgl_bertamu`)="'.$bulan_sekarang.'" AND YEAR(`tgl_bertamu`)="'.$tahun_sekarang.'"')->row();

    $data['bulan_kemarin']=$this->db->query('SELECT COUNT(id_tamu) as jml_bulan_kemarin FROM `buku_tamu` WHERE MONTH(`tgl_bertamu`)="'.$bulan_kemarin.'" AND YEAR(`tgl_bertamu`)="'.$tahun_sekarang.'"')->row();

    $data['tahun_ini']=$this->db->query('SELECT COUNT(id_tamu) as jml_tahun_ini FROM `buku_tamu` WHERE YEAR(`tgl_bertamu`)="'.$tahun_sekarang.'"')->row();
    
    $data['tahun_kemarin']=$this->db->query('SELECT COUNT(id_tamu) as jml_tahun_kemarin FROM `buku_tamu` WHERE YEAR(`tgl_bertamu`)="'.$tahun_kemarin.'"')->row();

    $data['hari_ini']=$this->db->query('SELECT COUNT(id_tamu) as jml_hari_ini FROM `buku_tamu` WHERE DAY(`tgl_bertamu`)="'.$hari_sekarang.'" AND MONTH(`tgl_bertamu`)="'.$bulan_sekarang.'" AND YEAR(`tgl_bertamu`)="'.$tahun_sekarang.'"')->row();

     $data['hari_kemarin']=$this->db->query('SELECT COUNT(id_tamu) as jml_hari_kemarin FROM `buku_tamu` WHERE DAY(`tgl_bertamu`)="'.$hari_kemarin.'" AND MONTH(`tgl_bertamu`)="'.$bulan_sekarang.'" AND YEAR(`tgl_bertamu`)="'.$tahun_sekarang.'"')->row();
    // echo "<pre>";
    // var_dump($data); die();
    $data['header'] = 'layout/header';
    $data['topbar'] = 'layout/topbar';
    $data['sidebar'] = 'layout/sidebar';
    $data['content'] = 'umum/bukutamu/v_dashboard';
    $data['js'] = 'layout/js';
    $data['jscontent'] = 'umum/bukutamu/jscontent';
    $data['footer'] = 'layout/footer';
    $this->load->view('layout/main', $data);
  }
  public function index()
  {
    $this->db->join('karyawan','karyawan.id_karyawan = buku_tamu.id_karyawan','left');
    $this->db->join('lembaga','lembaga.id_lembaga=karyawan.id_lembaga','left');
    $this->db->join('unit_kerja', 'unit_kerja.id_unit_kerja = karyawan.id_unit_kerja','left');
    $data['datatamu']=$this->db->get('buku_tamu')->result();
    $data['header'] = 'layout/header';
		$data['topbar'] = 'layout/topbar';
		$data['sidebar'] = 'layout/sidebar';
		$data['content'] = 'umum/bukutamu/v_daftar_tamu';
		$data['js'] = 'layout/js';
		$data['jscontent'] = 'umum/bukutamu/jscontent';
		$data['footer'] = 'layout/footer';
		$this->load->view('layout/main', $data);
  } 

  function hapus_tamu($id){
    $this->db->where('id_tamu',$id);
    $this->db->delete('buku_tamu');
      $this->session->set_flashdata('flash', 'DATA BERHASIL DIHAPUS');
        redirect('umum/daftartamu/');

  }

  function edit_tamu($id){
    $this->db->join('karyawan','karyawan.id_karyawan = buku_tamu.id_karyawan','left');
    $this->db->join('lembaga','lembaga.id_lembaga=karyawan.id_lembaga','left');
    $this->db->join('unit_kerja', 'unit_kerja.id_unit_kerja = karyawan.id_unit_kerja','left');
    $this->db->where('buku_tamu.id_tamu',$id);
    $data['datatamu']=$this->db->get('buku_tamu')->row();

    $data['datalembaga']=$this->db->get('lembaga')->result();
    $data['dataunit']=$this->db->get('unit_kerja')->result();
    $data['datakaryawan']=$this->db->get('karyawan')->result();
    $data['header'] = 'layout/header';
    $data['topbar'] = 'layout/topbar';
    $data['sidebar'] = 'layout/sidebar';
    $data['content'] = 'umum/bukutamu/v_edit_tamu';
    $data['js'] = 'layout/js';
    $data['jscontent'] = 'umum/bukutamu/jscontent';
    $data['footer'] = 'layout/footer';
    $this->load->view('layout/main',$data);

  }

  
}
