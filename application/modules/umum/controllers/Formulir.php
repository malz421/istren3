<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Formulir extends MX_Controller {

  public function __construct()
  {
    parent::__construct();
    // if($this->session->userdata('status') != TRUE){
    //             redirect(base_url("all/login"));
    // }	
  }

 
  public function index()
  {
    $data['header'] = 'layout/header';
		$data['topbar'] = 'layout/topbar';
		$data['sidebar'] = 'layout/sidebar';
		$data['content'] = 'umum/bukutamu/v_buku_tamu';
		$data['js'] = 'layout/js';
		$data['jscontent'] = 'umum/bukutamu/jscontent';
		$data['footer'] = 'layout/footer';
    $data['datalembaga']=$this->db->get('lembaga')->result();
    $data['dataunit']=$this->db->get('unit_kerja')->result();
    $data['datakaryawan']=$this->db->get('karyawan')->result();
		$this->load->view('layout/main', $data);
  } 

  public function tampil_karyawan_perlembaga(){
        $karyawan = null;
        $id_lembaga = $this->input->post('lembaga');
        $unit = $this->input->post('unit');
       if ($unit==null) {
            $this->db->join('lembaga','lembaga.id_lembaga = karyawan.id_lembaga');
            $this->db->where('karyawan.id_lembaga',$id_lembaga);
            $hsl=$this->db->get('karyawan');
        }else{
            $this->db->join('lembaga','lembaga.id_lembaga = karyawan.id_lembaga');
            $this->db->join('unit_kerja','unit_kerja.id_unit_kerja = karyawan.id_unit_kerja');
            $this->db->where('karyawan.id_lembaga',$id_lembaga);
            $this->db->where('karyawan.id_unit_kerja',$unit);
            $hsl=$this->db->get('karyawan');
        }
       
        foreach ($hsl->result_array() as $key) {
            $karyawan .= "<option value='$key[id_karyawan]'>$key[nama_karyawan]</option>";
        }
        echo  $karyawan;
    }

    public function tampil_karyawan()
    {
      $cmb='';
      $karyawan = $this->input->post('karyawan');
      
      $this->db->join('lembaga','lembaga.id_lembaga = karyawan.id_lembaga');
      $this->db->join('unit_kerja','unit_kerja.id_unit_kerja = karyawan.id_unit_kerja');
      $this->db->where('id_karyawan',$karyawan);
      $hsl=$this->db->get('karyawan');

      foreach ($hsl->result_array() as $key) {
            $karyawan .= "<option value='$key[id_unit_kerja]'>$key[nama_unit_kerja]</option>";
        }
        echo  $karyawan;

      # code...
    }

     public function tampil_karyawan_perunit(){
        $karyawan = null;
        $id_lembaga = $this->input->post('lembaga');
        $unit = $this->input->post('unit');
        if ($id_lembaga==null) {
            $this->db->join('unit_kerja','unit_kerja.id_unit_kerja = karyawan.id_unit_kerja');
            $this->db->where('karyawan.id_unit_kerja',$unit);
            $hsl=$this->db->get('karyawan');
        }else{
            $this->db->join('lembaga','lembaga.id_lembaga = karyawan.id_lembaga');
            $this->db->join('unit_kerja','unit_kerja.id_unit_kerja = karyawan.id_unit_kerja');
            $this->db->where('karyawan.id_lembaga',$id_lembaga);
            $this->db->where('karyawan.id_unit_kerja',$unit);
            $hsl=$this->db->get('karyawan');
        }
       
        foreach ($hsl->result_array() as $key) {
            $karyawan .= "<option value='$key[id_karyawan]'>$key[id_karyawan]-$key[nama_karyawan]</option>";
        }
        echo  $karyawan;
    }

  public function add_tamu(){
    $nama_tamu=$this->input->post('nama_tamu');
    $no_hp_tamu=$this->input->post('no_hp_tamu');
    $instansi_tamu=$this->input->post('instansi_tamu');
    $alamat_tamu=$this->input->post('alamat_tamu');
    $tujuan_tamu=$this->input->post('tujuan_tamu');
    $image=$this->input->post('image');
    $tanda_tangan=$this->input->post('tanda_tangan');
    $id_karyawan=$this->input->post('id_karyawan');

    $this->form_validation->set_rules('nama_tamu', 'Nama_tamu','trim|required',
        array('required' => 'Mohon Isi Nama Tamu'));
    $this->form_validation->set_rules('no_hp_tamu', 'No_hp_tamu','trim|required|min_length[10]|max_length[13]',
      array('required' => 'Mohon Isi Nomer Handphone',
            'max_length'=>'No Handphone Minimal 10 Digit Dan Maximal 13 Digit',
            'min_length'=>'No Handphone Minimal 10 Digit Dan Maximal 13 Digit'));
    $this->form_validation->set_rules('instansi_tamu', 'Instansi_tamu','trim|required',
      array('required' => 'Mohon Isi Instansi' ));
    $this->form_validation->set_rules('alamat_tamu', 'Alamat_tamu','trim|required',
      array('required' => 'Mohon Isi Alamat Tamu' ));
    $this->form_validation->set_rules('tujuan_tamu', 'Tujuan_tamu','trim|required',
      array('required' => 'Mohon Isi Tujuan Tamu' ));
    $this->form_validation->set_rules('image', 'Image','trim|required',
      array('required' => 'Mohon Lakukan Pengambilan Foto Sebelum Data Disimpan'));
     $this->form_validation->set_rules('tanda_tangan', 'Tanda_tangan','trim|required',
      array('required' => 'Mohon Lakukan Tanda Tangan Sebelum Data Disimpan'));
     $this->form_validation->set_rules('id_karyawan', 'Id_karyawan','trim|required',
      array('required' => 'Mohon isi Nama Karyawan'));

     
        if ($this->form_validation->run() == false) {
            $errors = validation_errors();
            echo json_encode(['error'=>$errors]);
        }else{
            $data = array(
              'nama_tamu' => $nama_tamu, 
              'no_hp_tamu' => $no_hp_tamu, 
              'instansi_tamu' => $instansi_tamu, 
              'alamat_tamu' => $alamat_tamu, 
              'tujuan_tamu' => $tujuan_tamu, 
              'image' => $image, 
              'tanda_tangan' => $tanda_tangan,
              'id_karyawan' => $id_karyawan
            );
      // echo "<pre>";
      // var_dump($data); die();
            $cek=$this->db->insert('buku_tamu',$data);
            if ($cek) {
             $callback = array('status' => 'sukses',
               'pesan' => 'DATA BERHASIL DISUMPAN'
             );
           }else{
             $callback = array('status' => 'gagal',
               'pesan' => 'DATA GAGAL DISIMPAN'
             );
           }

           echo json_encode($callback);
        }

  }

  public function update_tamu(){
    $id_tamu=$this->input->post('id_tamu');
    $nama_tamu=$this->input->post('nama_tamu');
    $no_hp_tamu=$this->input->post('no_hp_tamu');
    $instansi_tamu=$this->input->post('instansi_tamu');
    $alamat_tamu=$this->input->post('alamat_tamu');
    $tujuan_tamu=$this->input->post('tujuan_tamu');
    $image=$this->input->post('image');
    $tanda_tangan=$this->input->post('tanda_tangan');
    $id_karyawan=$this->input->post('id_karyawan');
//data:, =format null untung ttd
    if($image == '' && $tanda_tangan == 'data:,'){
      $data = array(
      'nama_tamu' => $nama_tamu, 
      'no_hp_tamu' => $no_hp_tamu, 
      'instansi_tamu' => $instansi_tamu, 
      'alamat_tamu' => $alamat_tamu, 
      'tujuan_tamu' => $tujuan_tamu,
      'id_karyawan' => $id_karyawan
    );
    $this->db->where('id_tamu',$id_tamu);
    $cek=$this->db->update('buku_tamu',$data);
    }elseif ($image == '') {
       $data = array(
      'nama_tamu' => $nama_tamu, 
      'no_hp_tamu' => $no_hp_tamu, 
      'instansi_tamu' => $instansi_tamu, 
      'alamat_tamu' => $alamat_tamu, 
      'tujuan_tamu' => $tujuan_tamu,
      'tanda_tangan' => $tanda_tangan,
      'id_karyawan' => $id_karyawan
    );
    $this->db->where('id_tamu',$id_tamu);
    $cek=$this->db->update('buku_tamu',$data);
    }elseif($tanda_tangan == 'data:,'){
      $data = array(
      'nama_tamu' => $nama_tamu, 
      'no_hp_tamu' => $no_hp_tamu, 
      'instansi_tamu' => $instansi_tamu, 
      'alamat_tamu' => $alamat_tamu, 
      'tujuan_tamu' => $tujuan_tamu, 
      'image' => $image,
      'id_karyawan' => $id_karyawan
    );
    $this->db->where('id_tamu',$id_tamu);
    $cek=$this->db->update('buku_tamu',$data);
    }else{
      $data = array(
      'nama_tamu' => $nama_tamu, 
      'no_hp_tamu' => $no_hp_tamu, 
      'instansi_tamu' => $instansi_tamu, 
      'alamat_tamu' => $alamat_tamu, 
      'tujuan_tamu' => $tujuan_tamu, 
      'image' => $image, 
      'tanda_tangan' => $tanda_tangan,
      'id_karyawan' => $id_karyawan
    );
    $this->db->where('id_tamu',$id_tamu);
    $cek=$this->db->update('buku_tamu',$data);
    }

    if ($cek) {
       $callback = array('status' => 'sukses',
                     'pesan' => 'DATA BERHASIL DIUBAH'
                    );
    }else{
       $callback = array('status' => 'gagal',
                     'pesan' => 'DATA GAGAL DIUBAH'
                    );
    }

      echo json_encode($callback);
  }
  
}
