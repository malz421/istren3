<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class LaporanGaji extends MX_Controller {

 public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('status') != true) {
            redirect(base_url("all/login"));
        }
        $this->load->helper('datetime_indo_helper','file');
        $this->load->library('upload');
        $this->load->model(array('M_laporangaji'));
        
        $akseslembaga = $this->session->userdata('akseslembaga');
        $idlembaga = $this->session->userdata('idlembaga');
         
        //Jika akses antar lemmbaga
        if ($akseslembaga == 'Y') {
            $idlembaga = 'all';
        }

        $this->load->library(array('upload'));

    }

  public function index()
  {
  	$data['dataperiode'] = $this->db->get('payroll_periode_gaji')->result();
  	$data['datalembaga']=$this->db->get('lembaga')->result();
  	$data['dataunit']=$this->db->get('unit_kerja')->result();

	  $data['header'] = 'layout/header';
  	$data['topbar'] = 'layout/topbar';
  	$data['sidebar'] = 'layout/sidebar';
  	$data['content'] = 'laporangaji/v_rekapagaji';
  	$data['js'] = 'layout/js';
  	$data['jscontent'] = 'laporangaji/jscontent';
  	$data['footer'] = 'layout/footer';
  	$this->load->view('layout/main', $data);
  }

  public function TampilRekapGajiByDep(){
    $idlembaga = $this->input->post('idlembaga');
    $idunitkerja = $this->input->post('idunitkerja');
    $idperiode = $this->input->post('idperiode');

    $data['idlembaga']=$this->input->post('idlembaga');
    $data['idunitkerja']=$this->input->post('idunitkerja');
    $data['idperiode']=$this->input->post('idperiode');
    $data['jscontent'] = 'laporangaji/jscontent';
    if ($idunitkerja == 'Umum') {
       $data=$this->M_laporangaji->Cari_Rekap_Gaji_Umum($idlembaga);
    }else{
      $data=$this->M_laporangaji->Cari_Rekap_Gaji($idlembaga,$idunitkerja,$idperiode);
    }

    $callback = array(
      'status' => 'sukses',
      'ok' => $data
    );
    echo json_encode($callback);
  }

 public function ExportRekapGaji(){

    $idlembaga = $this->input->post('idlembaga2');
    $idunitkerja = $this->input->post('idunitkerja2');
    $idperiode = $this->input->post('idperiode2');
    $this->db->where('id_periode',$idperiode);
    $data['dataperiode']=$this->db->get('payroll_periode_gaji')->row();

    $this->db->where('id_lembaga',$idlembaga);
    $data['datalembaga']=$this->db->get('lembaga')->row();

    if($idperiode != null && $idunitkerja=='Umum' && $idlembaga != null){
      $this->db->join('karyawan','karyawan.id_karyawan = payroll_transaksi.id_karyawan');
      $this->db->join('unit_kerja','unit_kerja.id_unit_kerja = karyawan.id_unit_kerja');
      // $this->db->where('karyawan.id_unit_kerja',$idunitkerja);
      $this->db->where('payroll_transaksi.id_periode',$idperiode);
      $this->db->where('karyawan.id_lembaga',$idlembaga);
      // $this->db->select('karyawan.nip_karyawan')
      $data['datagaji']=$this->db->get('payroll_transaksi')->result_array();
    
    }elseif ($idlembaga != null && $idperiode == null && $idunitkerja == null) {
      // echo "masuk LEMBAGA";
      $this->db->join('karyawan','karyawan.id_karyawan = payroll_transaksi.id_karyawan');
      $this->db->where('karyawan.id_lembaga',$idlembaga);
      $data['datagaji']=$this->db->get('payroll_transaksi')->result();
      # code...
    }elseif ($idperiode != null && $idunitkerja == null && $idlembaga == null) {
      // echo 'masuk PERIODE';
      $this->db->join('karyawan','karyawan.id_karyawan = payroll_transaksi.id_karyawan');
      $this->db->join('unit_kerja','unit_kerja.id_unit_kerja = karyawan.id_unit_kerja');
      $this->db->where('payroll_transaksi.id_periode',$idperiode);
      $data['datagaji']=$this->db->get('payroll_transaksi')->result();
    }elseif ($idunitkerja != null && $idperiode == null && $idlembaga == null) {
            // echo 'masuk UNIT';
      $this->db->join('karyawan','karyawan.id_karyawan = payroll_transaksi.id_karyawan');
      $this->db->join('unit_kerja','unit_kerja.id_unit_kerja = karyawan.id_unit_kerja');
      $this->db->where('unit_kerja.id_unit_kerja',$idunitkerja);
      $data['datagaji']=$this->db->get('payroll_transaksi')->result();
    }elseif($idunitkerja != null && $idlembaga != null){
      // echo "masuk LEMBAGA DAN UNIT";
      $this->db->join('karyawan','karyawan.id_karyawan = payroll_transaksi.id_karyawan');
      $this->db->join('unit_kerja','unit_kerja.id_unit_kerja = karyawan.id_unit_kerja');
      $this->db->where('karyawan.id_unit_kerja',$idunitkerja);
       $this->db->where('karyawan.id_lembaga',$idlembaga);
      $data['datagaji']=$this->db->get('payroll_transaksi')->result();
    }elseif($idperiode != null && $idlembaga != null){
       // echo 'masuk LEMBAGA dan PERIODE';
      $this->db->join('karyawan','karyawan.id_karyawan = payroll_transaksi.id_karyawan');
      $this->db->join('unit_kerja','unit_kerja.id_unit_kerja = karyawan.id_unit_kerja');
      $this->db->where('payroll_transaksi.id_periode',$idperiode);
       $this->db->where('karyawan.id_lembaga',$idlembaga);
      $data['datagaji']=$this->db->get('payroll_transaksi')->result();

    }elseif($idperiode != null && $idunitkerja != null){
        // echo 'masuk UNIT DAN PERIODE';
      $this->db->join('karyawan','karyawan.id_karyawan = payroll_transaksi.id_karyawan');
      $this->db->join('unit_kerja','unit_kerja.id_unit_kerja = karyawan.id_unit_kerja');
      $this->db->where('karyawan.id_unit_kerja',$idunitkerja);
      $this->db->where('payroll_transaksi.id_periode',$idperiode);
      $data['datagaji']=$this->db->get('payroll_transaksi')->result();
    }elseif ($idperiode != null && $idunitkerja != null && $idlembaga != null) {
      // echo 'masuk UNIT DAN PERIODE LEMBAGA';
      $this->db->join('karyawan','karyawan.id_karyawan = payroll_transaksi.id_karyawan');
      $this->db->join('unit_kerja','unit_kerja.id_unit_kerja = karyawan.id_unit_kerja');
      $this->db->where('karyawan.id_unit_kerja',$idunitkerja);
      $this->db->where('payroll_transaksi.id_periode',$idperiode);
      $this->db->where('karyawan.id_lembaga',$idlembaga);
      // $this->db->select('karyawan.nip_karyawan')
      $data['datagaji']=$this->db->get('payroll_transaksi')->result_array();
    }else{
      echo "data tidak temukan";
      // die();
    }

    // var_dump($data['datagaji']);die();
        $this->db->join('payroll_detail_transaksi','payroll_detail_transaksi.id_detail_template = payroll_detail_template.id_detail_template');
        $this->db->join('payroll_transaksi','payroll_transaksi.id_transaksi = payroll_detail_transaksi.id_transaksi');
        $this->db->join('karyawan','karyawan.id_karyawan = payroll_transaksi.id_karyawan');
        $this->db->where('payroll_detail_template.type','Penambahan');
        $this->db->where('payroll_transaksi.id_periode',$idperiode);
        $this->db->select_sum('payroll_detail_transaksi.jml_gaji', 'Pendapatan');
        $data['total_pendapatan']=$this->db->get('payroll_detail_template')->row();


      $this->db->join('payroll_detail_transaksi','payroll_detail_transaksi.id_detail_template = payroll_detail_template.id_detail_template');
      $this->db->join('payroll_transaksi','payroll_transaksi.id_transaksi = payroll_detail_transaksi.id_transaksi');
      $this->db->join('karyawan','karyawan.id_karyawan = payroll_transaksi.id_karyawan');
      $this->db->where('payroll_detail_template.type','Pengurangan');
      $this->db->where('payroll_transaksi.id_periode',$idperiode);
      // $this->db->where('gaji.id_karyawan',$key->id_karyawan);
      $this->db->select_sum('payroll_detail_transaksi.jml_gaji', 'Potongan');
      $data['total_potongan']=$this->db->get('payroll_detail_template')->row();


        $this->db->join('payroll_detail_transaksi','payroll_detail_transaksi.id_detail_template = payroll_detail_template.id_detail_template');
        $this->db->join('payroll_transaksi','payroll_transaksi.id_transaksi = payroll_detail_transaksi.id_transaksi');
        $this->db->join('karyawan','karyawan.id_karyawan = payroll_transaksi.id_karyawan');
        $this->db->where('payroll_detail_template.type','Perusahaan');
        $this->db->where('payroll_transaksi.id_periode',$idperiode);
        $this->db->select_sum('payroll_detail_transaksi.jml_gaji', 'Perusahaan');
        $data['total_perushaan']=$this->db->get('payroll_detail_template')->row();
  // $data['datagaji']=$this->db->get('gaji')->result();
        $this->load->view('laporangaji/v_rekapgajiexp',$data);
  }
 }
