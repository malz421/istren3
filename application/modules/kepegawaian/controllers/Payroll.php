<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Payroll extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_kode_unik');
        $this->load->model('M_gaji');
         $this->load->model('M_template');
         $this->load->library('Pdf');
        	if ($this->session->userdata('status') != true) {
            redirect(base_url("all/login"));
        }
        $this->load->helper('datetime_indo_helper','file');
          $this->load->library('upload');
        
        $akseslembaga = $this->session->userdata('akseslembaga');
        $idlembaga = $this->session->userdata('idlembaga');
         
        //Jika akses antar lemmbaga
        if ($akseslembaga == 'Y') {
            $idlembaga = 'all';
        }

        $this->load->library(array('upload'));
        $this->load->library('FPDF');
        define('FPDF_FONTPATH',$this->config->item('fonts_path'));

    }

//KATEGORI KOMPONEN
    public function kategori_komponen(){
        $this->db->join('payroll_group_kategori_komponen','payroll_group_kategori_komponen.id_group_kategori_komponen=payroll_komponen_gaji.id_group_kategori_komponen');
        $data['datakomponenkategori'] = $this->db->get('payroll_komponen_gaji')->result();
        $data['datakategori']=$this->db->get('payroll_group_kategori_komponen')->result();
        $data['header'] = 'layout/header';
        $data['topbar'] = 'layout/topbar';
        $data['sidebar'] = 'layout/sidebar';
        $data['js'] = 'layout/js';
        $data['jscontent'] = 'payroll/kategori_komponen/jscontent';
        $data['footer'] = 'layout/footer';
        $data['content'] = 'kepegawaian/payroll/kategori_komponen/v_kategori_komponen';
        $this->load->view('layout/main', $data);
    }

      public function edit_kategori_komponen(){
        try {
            $data = array(
            'id_group_kategori_komponen '=> $this->input->post('Kategori'),
            'nama_kategori_komponen ' => $this->input->post('nama_kategori_komponen'),  
            'create_at' => date('Y-m-d')
        );
            $this->db->where('id_komponen_gaji',$this->input->post('id'));
            $this->db->update('payroll_komponen_gaji',$data);
            $this->session->set_flashdata('flash', 'DATA BERHASIL DIUBAH');
            redirect('kepegawaian/payroll/kategori_komponen');
        } catch (Exception $e) {
            echo "terjadi kesalahan program";
            echo $a;
        }
        
    }

    public function tambah_kategori_komponen(){
         $data = array(
            'id_group_kategori_komponen '=> $this->input->post('Kategori'),
            'nama_kategori_komponen ' => $this->input->post('nama_kategori_komponen'),  
            'create_at' => date('Y-m-d')
        );
        $this->db->insert('payroll_komponen_gaji',$data);
        $this->session->set_flashdata('flash', 'DATA BERHASIL DISIMPAN');
        redirect('kepegawaian/payroll/kategori_komponen');


    }
    function hapus_kategori_komponen($id){
        $this->db->where('id_komponen_gaji',$id);
        $this->db->delete('payroll_komponen_gaji');
        $this->session->set_flashdata('flash', 'DATA BERHASIL DIHAPUS');
        redirect('kepegawaian/payroll/kategori_komponen');
    }

// TEAMPLATE GAJI
     public function teamplate_gaji(){
        $this->db->join('lembaga','lembaga.id_lembaga = payroll_teamplate.id_lembaga');
        $data['datateamplate'] = $this->db->get('payroll_teamplate')->result();

        $data['header'] = 'layout/header';
        $data['topbar'] = 'layout/topbar';
        $data['sidebar'] = 'layout/sidebar';
        $data['js'] = 'layout/js';
        $data['jscontent'] = 'payroll/teamplate_gaji/jscontent';
        $data['footer'] = 'layout/footer';
        $data['content'] = 'kepegawaian/payroll/teamplate_gaji/v_teamplate_gaji';
        $this->load->view('layout/main', $data);
    }

    public function hapus_komponen(){
        $id_teamplate=$this->uri->segment(5);
       $id_detail_template=$this->uri->segment(4);

        $this->db->where('id_detail_template',$id_detail_template);
        $this->db->delete('payroll_detail_transaksi');

        $this->db->where('id_detail_template',$id_detail_template);
        $this->db->delete('payroll_detail_template');
        
        $this->session->set_flashdata('flash', 'DATA KOMPONEN BERHASIL DI HAPUS');
       redirect('kepegawaian/payroll/edit_teamplate/'.$id_teamplate);
    }

    public function hapus_teamplate($id){
    $this->db->where('id_teamplate',$id);
    $data = $this->db->get('payroll_teamplate')->row();
    // lokasi gambar berada
    $path = './assets/images/img_tanda_tangan/';
    @unlink($path.$data->scan_tanda_tangan);
    $this->db->where('id_teamplate',$id);
    $this->db->delete('payroll_teamplate');

    $this->db->where('id_teamplate',$id);
    $this->db->delete('payroll_detail_template');
    $this->session->set_flashdata('flash', 'DATA BERHASIL DI HAPUS');
    redirect('kepegawaian/payroll/teamplate_gaji');
    }

    public function add_teamplate(){
        $data['datakaryawan']=$this->db->get('karyawan')->result();
        $data['datakategori']=$this->db->get('payroll_group_kategori_komponen')->result();
        $data['dataunit']=$this->db->get('unit_kerja')->result();
        $data['datakomponen']=$this->db->get('payroll_komponen_gaji')->result();
        $data['datalembaga']=$this->db->get('lembaga')->result();
        $data['header'] = 'layout/header';
        $data['topbar'] = 'layout/topbar';
        $data['sidebar'] = 'layout/sidebar';
        $data['js'] = 'layout/js';
        $data['jscontent'] = 'payroll/teamplate_gaji/jscontent';
        $data['footer'] = 'layout/footer';
        $data['content'] = 'kepegawaian/payroll/teamplate_gaji/add_teamplate';
        $this->load->view('layout/main', $data);
    }
    public function edit_teamplate($id){
        $data['datakomponen']=$this->M_template->cari_komponen($id);

        $data['datalembaga']=$this->db->get('lembaga')->result();
        $data['datakomponen2']=$this->db->get('payroll_komponen_gaji')->result();
        $data['datakaryawan']=$this->db->get('karyawan')->result();
        $data['dataunit']=$this->db->get('unit_kerja')->result();
        $data['datakategori']=$this->db->get('payroll_group_kategori_komponen')->result();
        
        $this->db->join('payroll_komponen_gaji','payroll_komponen_gaji.id_komponen_gaji= payroll_detail_template.id_komponen_gaji');
        $this->db->join('payroll_group_kategori_komponen', 'payroll_group_kategori_komponen.id_group_kategori_komponen = payroll_detail_template.id_group_kategori_komponen');
        $this->db->where('payroll_detail_template.id_teamplate',$id);
        $data['komponen_gaji']=$this->db->get('payroll_detail_template');

         $this->db->join('payroll_detail_template', 'payroll_detail_template.id_teamplate = payroll_teamplate.id_teamplate','left');
         $this->db->where('payroll_teamplate.id_teamplate',$id);
         $data['jml']=$this->db->get('payroll_teamplate')->num_rows();
       
        $data['id']=$id;

        $data['header'] = 'layout/header';
        $data['topbar'] = 'layout/topbar';
        $data['sidebar'] = 'layout/sidebar';
        $data['js'] = 'layout/js';
        $data['jscontent'] = 'payroll/teamplate_gaji/jscontent';
        $data['footer'] = 'layout/footer';
        $data['content'] = 'kepegawaian/payroll/teamplate_gaji/edit_teamplate';
        $this->load->view('layout/main', $data);
    }
public function update_teamplate(){
  
  $id_teamplate=$_POST['id_teamplate'];
  $nama_teamplate = $_POST['nama_teamplate'];
  $komponen = $_POST['komponen'];
  $Kategori=$_POST['Kategori'];
  $unit=$_POST['unit'];
  $nama_pendanda_tangan=$_POST['nip'];
  $lembaga=$_POST['lembaga'];
  $type=$_POST['type'];

  $this->db->where('id_teamplate',$id_teamplate);
  $cekkomponen=$this->db->get('payroll_detail_template')->num_rows();


// jika ada maka komponen di hapus dan di insert
  if ($cekkomponen > 0) {
    echo "ada komponen";
// delete detail_template
    $this->db->where('id_teamplate',$id_teamplate);
    $this->db->delete('payroll_detail_template');

//untuk insert detail_template
    $result = array();
    foreach($komponen AS $key => $val){
      $result[] = array(
        'id_teamplate'   => $id_teamplate,
        'id_komponen_gaji'   => $_POST['komponen'][$key],
        'id_group_kategori_komponen' => $_POST['Kategori'][$key],
        'type' => $_POST['type'][$key]
      );
    } 

//MULTIPLE INSERT komponen ke detail_template
    $this->db->insert_batch('payroll_detail_template', $result);
// untuk update data template
    $data  = array(
      'nama_teamplate' => $nama_teamplate,
      'nip_karyawan'=> $nama_pendanda_tangan,
      'tgl' => date('Y-m-d'),
      'id_unit_kerja' => $unit,
      'id_lembaga' => $lembaga
    );
    $this->db->where('id_teamplate',$id_teamplate);
    $this->db->update('payroll_teamplate',$data);

//JIKA UPDATE MAKA AKAN MENGHAPUS DAN INSERT KEMBALI DI DETAIL TEMPLATE HANYA YG STATUSNYA BELUM DIBAYARKAN/0 
// mencari id_transaksi
    $this->db->join('payroll_detail_template','payroll_detail_template.id_teamplate = payroll_transaksi.id_teamplate');
    $this->db->where('payroll_transaksi.id_teamplate',$id_teamplate);
    $this->db->where('payroll_transaksi.status',0);
    $tbtransaksi=$this->db->get('payroll_transaksi')->result();
// jika id_transaksi ga ada di payroll_transaksi maka
if ($tbtransaksi) {
//cek apakah ada data yang sama di payrol transaksi jika ada maka data di reset
// delete berdasarkan jumlah transaksi yg ada
  foreach ($tbtransaksi as $key) {
    $this->db->where('id_transaksi',$key->id_transaksi);
    $this->db->delete('payroll_detail_transaksi');
  }

  foreach ($tbtransaksi as $key2) {
    $data = array(
      'id_transaksi' => $key2->id_transaksi, 
      'id_detail_template' => $key2->id_detail_template,
      'id_group_kategori_komponen' => $key2->id_group_kategori_komponen,
      'id_komponen_gaji' => $key2->id_komponen_gaji,
      'type' => $key2->type
    );
    $this->db->insert('payroll_detail_transaksi',$data);
  }
  $callback = array(
    'status' => 'sukses',
    'pesan' => 'Data berhasil disimpan'
  );
  echo json_encode($callback);     
  }else{
  //jika tidak ada data di detail payroll transaksi maka ke kondisi ini

    $callback = array(
      'status' => 'sukses',
      'pesan' => 'bisa euy'
    );
    echo json_encode($callback);   
  }
}else{
  echo "tidak ada komponen";
  $this->db->trans_start();
// untuk update
  $data  = array(
    'nama_teamplate' => $nama_teamplate,
    'nip_karyawan'=> $nama_pendanda_tangan,
    'tgl' => date('Y-m-d'),
    'id_unit_kerja' => $unit,
    'id_lembaga' => $lembaga
  );
  $this->db->where('id_teamplate',$id_teamplate);
  $this->db->update('payroll_teamplate',$data);

//untuk insert komponen
  $last_id = $this->db->insert_id();
  $result = array();
  foreach($komponen AS $key => $val){
    $result[] = array(
      'id_teamplate'   => $id_teamplate,
      'id_komponen_gaji'   => $_POST['komponen'][$key],
      'id_group_kategori_komponen' => $_POST['Kategori'][$key],
      'type' => $_POST['type'][$key]
    );
  } 
//MULTIPLE INSERT TO DETAIL TABLE
  $this->db->insert_batch('payroll_detail_template', $result);
  $this->db->trans_complete();
// echo "kondisi 2";
//JIKA UPDATE MAKA AKAN MENGHAPUS DAN INSERT KEMBALI DI DETAIL TEMPLATE HANYA YG STATUSNYA BELUM DIBAYARKAN/0 
// mencari id_transaksi
  $this->db->join('payroll_detail_template','payroll_detail_template.id_teamplate = payroll_transaksi.id_teamplate');
  $this->db->where('payroll_transaksi.id_teamplate',$id_teamplate);
  $this->db->where('payroll_transaksi.status',0);
  $tbtransaksi=$this->db->get('payroll_transaksi')->result();
// jika id_transaksi ga ada di payroll_transaksi maka
  if ($tbtransaksi) {
// delete berdasarkan jumlah transaksi yg ada
    foreach ($tbtransaksi as $key) {
      $this->db->where('id_transaksi',$key->id_transaksi);
      $this->db->delete('payroll_detail_transaksi');
    }

    foreach ($tbtransaksi as $key2) {
      $data = array(
        'id_transaksi' => $key2->id_transaksi, 
        'id_detail_template' => $key2->id_detail_template,
        'id_group_kategori_komponen' => $key2->id_group_kategori_komponen,
        'id_komponen_gaji' => $key2->id_komponen_gaji,
        'type' => $key2->type
      );
      $this->db->insert('payroll_detail_transaksi',$data);
    }
    $callback = array(
      'status' => 'sukses',
      'pesan' => 'Data berhasil disimpan'
    );
    echo json_encode($callback);     
  }
  else{
//tidak melakukan apapun
    $callback = array(
      'status' => 'gagal',
      'pesan' => 'gagal disimpan'
    );
    echo json_encode($callback);   
  }
}
}



    // public function update_teamplate(){
    //   $id_teamplate=$_POST['id_teamplate'];
    //   $nama_teamplate = $_POST['nama_teamplate'];
    //   $komponen = $_POST['komponen'];
    //   $Kategori=$_POST['Kategori'];
    //   $unit=$_POST['unit'];
    //   $nama_pendanda_tangan=$_POST['nip'];
    //   $lembaga=$_POST['lembaga'];
    //   $type=$_POST['type'];
        
    //   $path = './assets/images/img_tanda_tangan/';
    //   $this->db->where('id_teamplate',$id_teamplate);
    //   $cekkomponen=$this->db->get('payroll_detail_template')->num_rows();

    //   $this->db->where('payroll_teamplate.id_teamplate',$id_teamplate);
    //   $cekfoto=$this->db->get('payroll_teamplate')->row();
      
    //   $config['upload_path']      = 'assets/images/img_tanda_tangan/';
    //   $config['allowed_types']    = 'gif|jpg|png|jpeg|bmp';
    //   $config['encrypt_name']    = TRUE;
    //   // $config['max_size']          = '2048';
    //   // $config['max_height']        = '768';
    //   // $config['max_width']     = '1288';
    //   $this->upload->initialize($config);
    //   // jika tidak ada upload foto maka insert tanpa foto
    //   if(!$this->upload->do_upload())
    //   {   

    //                // jika ada maka komponen di hapus dan di insert
    //               if ($cekkomponen > 0) {
    //                     echo "ada komponen";
    //                       // delete detail_template
    //                     $this->db->where('id_teamplate',$id_teamplate);
    //                     $this->db->delete('payroll_detail_template');
                        
    //                         //untuk insert detail_template
    //                     $result = array();
    //                     foreach($komponen AS $key => $val){
    //                        $result[] = array(
    //                         'id_teamplate'   => $id_teamplate,
    //                         'id_komponen_gaji'   => $_POST['komponen'][$key],
    //                         'id_group_kategori_komponen' => $_POST['Kategori'][$key],
    //                         'type' => $_POST['type'][$key]
    //                       );
    //                      } 

    //                     //MULTIPLE INSERT komponen ke detail_template
    //                      $this->db->insert_batch('payroll_detail_template', $result);
    //                           // untuk update data template
    //                         $data  = array(
    //                           'nama_teamplate' => $nama_teamplate,
    //                           'nip_karyawan'=> $nama_pendanda_tangan,
    //                           'tgl' => date('Y-m-d'),
    //                           'id_unit_kerja' => $unit,
    //                           'id_lembaga' => $lembaga
    //                       );
    //                         $this->db->where('id_teamplate',$id_teamplate);
    //                         $this->db->update('payroll_teamplate',$data);

    //                    // echo "kondisi 1";

    //                         //JIKA UPDATE MAKA AKAN MENGHAPUS DAN INSERT KEMBALI DI DETAIL TEMPLATE HANYA YG STATUSNYA BELUM DIBAYARKAN/0 
    //                           // mencari id_transaksi
    //                             $this->db->join('payroll_detail_template','payroll_detail_template.id_teamplate = payroll_transaksi.id_teamplate');
    //                             $this->db->where('payroll_transaksi.id_teamplate',$id_teamplate);
    //                             $this->db->where('payroll_transaksi.status',0);
    //                             $tbtransaksi=$this->db->get('payroll_transaksi')->result();
    //                             // jika id_transaksi ga ada di payroll_transaksi maka
    //                             if ($tbtransaksi) {//cek apakah ada data yang sama di payrol transaksi jika ada maka data di reset
    //                                  // delete berdasarkan jumlah transaksi yg ada
    //                               foreach ($tbtransaksi as $key) {
    //                                 $this->db->where('id_transaksi',$key->id_transaksi);
    //                                 $this->db->delete('payroll_detail_transaksi');
    //                               }

    //                               foreach ($tbtransaksi as $key2) {
    //                               $data = array(
    //                                 'id_transaksi' => $key2->id_transaksi, 
    //                                 'id_detail_template' => $key2->id_detail_template,
    //                                 'id_group_kategori_komponen' => $key2->id_group_kategori_komponen,
    //                                 'id_komponen_gaji' => $key2->id_komponen_gaji,
    //                                 'type' => $key2->type
    //                               );
    //                                 $this->db->insert('payroll_detail_transaksi',$data);
    //                               }
    //                               $callback = array(
    //                                 'status' => 'sukses',
    //                                 'pesan' => 'Data berhasil disimpan'
    //                               );
    //                               echo json_encode($callback);     
    //                             }else{
    //                               //jika tidak ada data di detail payroll transaksi maka ke kondisi ini

    //                               $callback = array(
    //                                 'status' => 'sukses',
    //                                 'pesan' => 'bisa euy'
    //                               );
    //                               echo json_encode($callback);   
    //                             }
    //               // jika tidak ada maka hanya di update dan di insert
    //               }else {
    //                 echo "tidak ada komponen";
    //                       $this->db->trans_start();
    //                       // untuk update
    //                       $data  = array(
    //                           'nama_teamplate' => $nama_teamplate,
    //                           'nip_karyawan'=> $nama_pendanda_tangan,
    //                           'tgl' => date('Y-m-d'),
    //                           'id_unit_kerja' => $unit,
    //                           'id_lembaga' => $lembaga
    //                       );
    //                       $this->db->where('id_teamplate',$id_teamplate);
    //                       $this->db->update('payroll_teamplate',$data);

    //                         //untuk insert komponen
    //                       $last_id = $this->db->insert_id();
    //                       $result = array();
    //                       foreach($komponen AS $key => $val){
    //                        $result[] = array(
    //                         'id_teamplate'   => $id_teamplate,
    //                         'id_komponen_gaji'   => $_POST['komponen'][$key],
    //                         'id_group_kategori_komponen' => $_POST['Kategori'][$key],
    //                         'type' => $_POST['type'][$key]
    //                     );
    //                    } 
    //                           //MULTIPLE INSERT TO DETAIL TABLE
    //                    $this->db->insert_batch('payroll_detail_template', $result);
    //                    $this->db->trans_complete();
    //               // echo "kondisi 2";
    //                       //JIKA UPDATE MAKA AKAN MENGHAPUS DAN INSERT KEMBALI DI DETAIL TEMPLATE HANYA YG STATUSNYA BELUM DIBAYARKAN/0 
    //                           // mencari id_transaksi
    //                             $this->db->join('payroll_detail_template','payroll_detail_template.id_teamplate = payroll_transaksi.id_teamplate');
    //                             $this->db->where('payroll_transaksi.id_teamplate',$id_teamplate);
    //                             $this->db->where('payroll_transaksi.status',0);
    //                             $tbtransaksi=$this->db->get('payroll_transaksi')->result();
    //                             // jika id_transaksi ga ada di payroll_transaksi maka
    //                             if ($tbtransaksi) {
    //                                  // delete berdasarkan jumlah transaksi yg ada
    //                               foreach ($tbtransaksi as $key) {
    //                                 $this->db->where('id_transaksi',$key->id_transaksi);
    //                                 $this->db->delete('payroll_detail_transaksi');
    //                               }

    //                               foreach ($tbtransaksi as $key2) {
    //                               $data = array(
    //                                 'id_transaksi' => $key2->id_transaksi, 
    //                                 'id_detail_template' => $key2->id_detail_template,
    //                                 'id_group_kategori_komponen' => $key2->id_group_kategori_komponen,
    //                                 'id_komponen_gaji' => $key2->id_komponen_gaji,
    //                                 'type' => $key2->type
    //                               );
    //                                 $this->db->insert('payroll_detail_transaksi',$data);
    //                               }
    //                               $callback = array(
    //                                 'status' => 'sukses',
    //                                 'pesan' => 'Data berhasil disimpan'
    //                               );
    //                               echo json_encode($callback);     
    //                             }
    //                             else{
    //                               //tidak melakukan apapun
    //                               $callback = array(
    //                                 'status' => 'gagal',
    //                                 'pesan' => 'gagal disimpan'
    //                               );
    //                               echo json_encode($callback);   
    //                             }
    //               }
    //      }else {
    //               // jika ada foto maka insert dengan foto
    //               $gbr=$this->upload->data();
    //               $FOTO=$gbr['file_name'];
                     
    //                   if ($cekkomponen > 0) {
    //                   // delete komponen
    //                   $this->db->where('id_teamplate',$id_teamplate);
    //                   $this->db->delete('payroll_detail_template');
    //                 // hapus foto sebelumnay
    //                 @unlink($path.$cekfoto->scan_tanda_tangan);
    //                       // untuk update
    //                     $data  = array(
    //                       'nama_teamplate' => $nama_teamplate,
    //                       'nip_karyawan'=> $nama_pendanda_tangan,
    //                       'tgl' => date('Y-m-d'),
    //                       'id_unit_kerja' => $unit,
    //                       'id_lembaga' => $lembaga,
    //                       'scan_tanda_tangan' => $FOTO
    //                   );
    //                     $this->db->where('id_teamplate',$id_teamplate);
    //                     $this->db->update('payroll_teamplate',$data);
                      
    //                         //untuk insert komponen
    //                     $result = array();
    //                     foreach($komponen AS $key => $val){
    //                        $result[] = array(
    //                         'id_teamplate'   => $id_teamplate,
    //                         'id_komponen_gaji'   => $_POST['komponen'][$key],
    //                         'id_group_kategori_komponen' => $_POST['Kategori'][$key],
    //                         'type' => $_POST['type'][$key]
    //                     );
    //                    } 
    //                           //MULTIPLE INSERT TO DETAIL TABLE
    //                    $this->db->insert_batch('payroll_detail_template', $result);
    //                    // echo "kondisi 1 foto";
    //                     $this->session->set_flashdata('flash', 'DATA BERHASIL DIUBAH');
    //                     redirect('kepegawaian/Payroll/teamplate_gaji');
    //                   // jika tidak ada maka hanya di update dan di insert
    //                   }else {
    //                            // hapus foto sebelumnay
    //                     @unlink($path.$cekfoto->scan_tanda_tangan);
    //                       // untuk update
    //                       $data  = array(
    //                           'nama_teamplate' => $nama_teamplate,
    //                           'nip_karyawan'=> $nama_pendanda_tangan,
    //                           'tgl' => date('Y-m-d'),
    //                           'id_unit_kerja' => $unit,
    //                           'id_lembaga' => $lembaga,
    //                           'scan_tanda_tangan' => $FOTO
    //                       );
    //                       $this->db->where('id_teamplate',$id_teamplate);
    //                       $this->db->update('payroll_teamplate',$data);

    //                         //untuk insert komponen
    //                       $last_id = $this->db->insert_id();
    //                       $result = array();
    //                       foreach($komponen AS $key => $val){
    //                        $result[] = array(
    //                         'id_teamplate'   => $id_teamplate,
    //                         'id_komponen_gaji'   => $_POST['komponen'][$key],
    //                         'id_group_kategori_komponen' => $_POST['Kategori'][$key],
    //                         'type' => $_POST['type'][$key]
    //                     );
    //                    } 
    //                           //MULTIPLE INSERT TO DETAIL TABLE
    //                    $this->db->insert_batch('payroll_detail_template', $result);
    //                   // echo "kondisi 2 foto";
    //     //JIKA UPDATE MAKA AKAN MENGHAPUS DAN INSERT KEMBALI DI DETAIL TEMPLATE HANYA YG STATUSNYA BELUM DIBAYARKAN/0 
    //                           // mencari id_transaksi
    //                             $this->db->join('payroll_detail_template','payroll_detail_template.id_teamplate = payroll_transaksi.id_teamplate');
    //                             $this->db->where('payroll_transaksi.id_teamplate',$id_teamplate);
    //                             $this->db->where('payroll_transaksi.status',0);
    //                             $tbtransaksi=$this->db->get('payroll_transaksi')->result();
    //                             // jika id_transaksi ga ada di payroll_transaksi maka
    //                             if ($tbtransaksi) {
    //                                  // delete berdasarkan jumlah transaksi yg ada
    //                               foreach ($tbtransaksi as $key) {
    //                                 $this->db->where('id_transaksi',$key->id_transaksi);
    //                                 $this->db->delete('payroll_detail_transaksi');
    //                               }

    //                               foreach ($tbtransaksi as $key2) {
    //                               $data = array(
    //                                 'id_transaksi' => $key2->id_transaksi, 
    //                                 'id_detail_template' => $key2->id_detail_template,
    //                                 'id_group_kategori_komponen' => $key2->id_group_kategori_komponen,
    //                                 'id_komponen_gaji' => $key2->id_komponen_gaji,
    //                                 'type' => $key2->type
    //                               );
    //                                 $this->db->insert('payroll_detail_transaksi',$data);
    //                               }
    //                               $callback = array(
    //                                 'status' => 'sukses',
    //                                 'pesan' => 'Data berhasil disimpan'
    //                               );
    //                               echo json_encode($callback);     
    //                             }
    //                             else{
    //                               //tidak melakukan apapun
    //                               $callback = array(
    //                                 'status' => 'gagal',
    //                                 'pesan' => 'gagal disimpan'
    //                               );
    //                               echo json_encode($callback);   
    //                             }
    //                   }

    //               }                      
    // }
    public function tambah_teamplate(){

            $config['upload_path']      = 'assets/images/img_tanda_tangan/';
            $config['allowed_types']    = 'gif|jpg|png|jpeg|bmp';
            $config['encrypt_name']    = TRUE;
        // $config['max_size']          = '2048';
        // $config['max_height']        = '768';
        // $config['max_width']     = '1288';
           

            $this->upload->initialize($config);
        // jika tidak ada upload foto maka insert tanpa foto
            if(!$this->upload->do_upload())
            {
                // $a=$this->upload->display_errors();
                 $this->db->trans_start();
                $nama_teamplate = $_POST['nama_teamplate'];
                $komponen = $_POST['komponen'];
                $Kategori=$_POST['Kategori'];
                $unit=$_POST['unit'];
                $nama_pendanda_tangan=$_POST['nip'];
                $lembaga=$_POST['lembaga'];
               
                $data  = array(
                    'nama_teamplate' => $nama_teamplate,
                    'nip_karyawan'=> $nama_pendanda_tangan,
                    'tgl' => date('Y-m-d'),
                    'id_unit_kerja' => $unit,
                    'id_lembaga' => $lembaga
                );
                $this->db->insert('payroll_teamplate', $data);
            //GET ID PACKAGE
                $last_id = $this->db->insert_id();
                $result = array();
                    foreach($komponen AS $key => $val){
                       $result[] = array(
                          'id_teamplate'   => $last_id,
                          'id_komponen_gaji'   => $_POST['komponen'][$key],
                          'id_group_kategori_komponen' => $_POST['Kategori'][$key],
                          'type' => $_POST['type'][$key]
                      );
                   } 
            //MULTIPLE INSERT TO DETAIL TABLE
               $this->db->insert_batch('payroll_detail_template', $result);
               $this->db->trans_complete();
               
               $this->session->set_flashdata('flash', 'DATA BERHASIL DISIMPAN');
                redirect('kepegawaian/Payroll/teamplate_gaji');
            }
            else {
                // jika ada foto maka insert dengan foto
                $this->db->trans_start();
            //INSERT TO PACKAGE
                $gbr=$this->upload->data();
                $FOTO=$gbr['file_name'];
                $nama_teamplate = $_POST['nama_teamplate'];
                $komponen = $_POST['komponen'];
                $Kategori=$_POST['Kategori'];
                $unit=$_POST['unit'];
                $nama_pendanda_tangan=$_POST['nip'];
                $lembaga=$_POST['lembaga'];
               
                $data  = array(
                    'nama_teamplate' => $nama_teamplate,
                    'nip_karyawan'=> $nama_pendanda_tangan,
                    'tgl' => date('Y-m-d'),
                    'id_unit_kerja' => $unit,
                    'id_lembaga' => $lembaga,
                    'scan_tanda_tangan' =>$FOTO
                );
                $this->db->insert('payroll_teamplate', $data);
            //GET ID PACKAGE
                $last_id = $this->db->insert_id();
                $result = array();
                    foreach($komponen AS $key => $val){
                       $result[] = array(
                          'id_teamplate'   => $last_id,
                          'id_komponen_gaji'   => $_POST['komponen'][$key],
                          'id_group_kategori_komponen' => $_POST['Kategori'][$key],
                          'type' => $_POST['type'][$key]
                      );
                   } 
            //MULTIPLE INSERT TO DETAIL TABLE
               $this->db->insert_batch('payroll_detail_template', $result);
               $this->db->trans_complete();
               
               $this->session->set_flashdata('flash', 'DATA BERHASIL DISIMPAN');
                redirect('kepegawaian/Payroll/teamplate_gaji');
            }        
        
    }

    public function tampil_combo_komponen()
    {
        $komponen = null;
        $Kategori = $this->input->post('Kategori');
        $this->db->where('id_group_kategori_komponen',$Kategori);
        $hsl=$this->db->get('payroll_komponen_gaji');
        foreach ($hsl->result_array() as $key) {
            $komponen .= "<option value='$key[id_komponen_gaji]'>$key[nama_kategori_komponen]</option>";
        }
        echo  $komponen;
    }

    public function tampil_karyawan_perlembaga(){
        $karyawan = null;
        $id_lembaga = $this->input->post('lembaga');
        $unit = $this->input->post('unit');
         $periode = $this->input->post('periode');
       if ($unit==null) {
            // $this->db->join('lembaga','lembaga.id_lembaga = karyawan.id_lembaga');
            // $this->db->where('karyawan.id_lembaga',$id_lembaga);
            // $hsl=$this->db->get('karyawan');

        $hsl=$this->db->query('SELECT * FROM karyawan INNER JOIN unit_kerja ON unit_kerja.id_unit_kerja = karyawan.id_unit_kerja WHERE karyawan.id_lembaga='.$id_lembaga.' AND NOT EXISTS (SELECT * FROM payroll_transaksi WHERE payroll_transaksi.id_karyawan = karyawan.id_karyawan AND payroll_transaksi.id_periode='.$periode.')');
        }else{
            // $this->db->join('lembaga','lembaga.id_lembaga = karyawan.id_lembaga');
            // $this->db->join('unit_kerja','unit_kerja.id_unit_kerja = karyawan.id_unit_kerja');
            // $this->db->where('karyawan.id_lembaga',$id_lembaga);
            // $this->db->where('karyawan.id_unit_kerja',$unit);
            // $hsl=$this->db->get('karyawan');

              $hsl=$this->db->query('SELECT * FROM karyawan INNER JOIN unit_kerja ON unit_kerja.id_unit_kerja = karyawan.id_unit_kerja WHERE karyawan.id_unit_kerja='.$unit.' AND karyawan.id_lembaga='.$id_lembaga.' AND NOT EXISTS (SELECT * FROM payroll_transaksi WHERE payroll_transaksi.id_karyawan = karyawan.id_karyawan AND payroll_transaksi.id_periode='.$periode.')');
        }
       
        foreach ($hsl->result_array() as $key) {
            $karyawan .= "<option value='$key[id_karyawan]'>$key[nip_karyawan]-$key[nama_karyawan]-$key[nama_lembaga]</option>";
        }
        echo  $karyawan;
    }

    public function tampil_karyawan_perunit(){
        $karyawan = null;
        $id_lembaga = $this->input->post('lembaga');
        $unit = $this->input->post('unit');
        if ($id_lembaga==null) {
         
  
            // $this->db->join('unit_kerja','unit_kerja.id_unit_kerja = karyawan.id_unit_kerja');
            // $this->db->where('karyawan.id_unit_kerja',$unit);
            // $hsl=$this->db->get('karyawan');
          $hsl=$this->db->query('SELECT * FROM karyawan INNER JOIN unit_kerja ON unit_kerja.id_unit_kerja = karyawan.id_unit_kerja WHERE karyawan.id_unit_kerja='.$unit.' AND NOT EXISTS (SELECT * FROM payroll_transaksi WHERE payroll_transaksi.id_karyawan = karyawan.id_karyawan)');
        }else{


            // $this->db->join('lembaga','lembaga.id_lembaga = karyawan.id_lembaga');
            // $this->db->join('unit_kerja','unit_kerja.id_unit_kerja = karyawan.id_unit_kerja');
            // $this->db->where('karyawan.id_lembaga',$id_lembaga);
            // $this->db->where('karyawan.id_unit_kerja',$unit);
            // $hsl=$this->db->get('karyawan');

            $hsl=$this->db->query('SELECT * FROM karyawan INNER JOIN unit_kerja ON unit_kerja.id_unit_kerja = karyawan.id_unit_kerja WHERE karyawan.id_unit_kerja='.$unit.' AND karyawan.id_lembaga='.$id_lembaga.' AND NOT EXISTS (SELECT * FROM payroll_transaksi WHERE payroll_transaksi.id_karyawan = karyawan.id_karyawan)');
        }
       
        foreach ($hsl->result_array() as $key) {
            $karyawan .= "<option value='$key[id_karyawan]'>$key[id_karyawan]-$key[nama_karyawan]</option>";
        }
        echo  $karyawan;
    }


// KATEGORI
    public function kategori(){
        $data['datakategori'] = $this->db->get('payroll_group_kategori_komponen')->result();
        $data['header'] = 'layout/header';
        $data['topbar'] = 'layout/topbar';
        $data['sidebar'] = 'layout/sidebar';
        $data['js'] = 'layout/js';
        $data['jscontent'] = 'payroll/kategori/jscontent';
        $data['footer'] = 'layout/footer';
        $data['content'] = 'kepegawaian/payroll/kategori/v_kategori';
        $this->load->view('layout/main', $data);
    }
    
    public function hapus_kategori($id){
    $this->db->where('id_group_kategori_komponen',$id);
    $this->db->delete('payroll_group_kategori_komponen');
    $this->session->set_flashdata('flash', 'DATA BERHASIL DI HAPUS');
    redirect('kepegawaian/Payroll/kategori/v_kategori');
    }

    public function tambah_kategori(){
        try {
            $data =array(
            'nama_kategori' => $this->input->post('txtnama')
             );
            $this->db->insert('payroll_group_kategori_komponen',$data);
            $this->session->set_flashdata('flash', 'DATA BERHASIL DI TAMBAHKAN');
            redirect('kepegawaian/Payroll/kategori/v_kategori');
        } catch (Exception $e) {
            echo "terjadi kesalahan program";
            echo $a;
        }
    }

    public function edit_kategori(){
        try {
            $data =array(
                'nama_kategori' => $this->input->post('txtnama')
            );
            $this->db->where('id_group_kategori_komponen',$this->input->post('idkategori'));
            $this->db->update('payroll_group_kategori_komponen',$data);
            $this->session->set_flashdata('flash', 'DATA BERHASIL DI UBAH');
            redirect('kepegawaian/Payroll/kategori/v_kategori');
        } catch (Exception $e) {
            echo "terjadi kesalahan program";
            echo $a;
        }
        
    }

// PERIODE
    public function periode_penggajian(){
		$data['dataperiode'] = $this->db->get('payroll_periode_gaji')->result();
        $data['header'] = 'layout/header';
        $data['topbar'] = 'layout/topbar';
        $data['sidebar'] = 'layout/sidebar';
        $data['js'] = 'layout/js';
        $data['jscontent'] = 'kepegawaian/payroll/periode/jscontent';
        $data['footer'] = 'layout/footer';
    	$data['content'] = 'kepegawaian/payroll/periode/v_periode_penggajian';
    	$this->load->view('layout/main', $data);
    }

    public function hapus_periode($id){
    $this->db->where('id_periode',$id);
    $this->db->delete('payroll_periode_gaji');
    $this->session->set_flashdata('flash', 'DATA BERHASIL DI HAPUS');
	redirect('kepegawaian/Payroll/periode_penggajian');
    }

    public function add_periode(){
    	try {
	    	$data =array(
	    	'nama_periode' => $this->input->post('txtnama'),
	    	 'bulan' => bulan_int($this->input->post('cmbbulan')), 
	    	 'tahun' => $this->input->post('nmtahun') 
	    	 );
	    	$this->db->insert('payroll_periode_gaji',$data);
	    	$this->session->set_flashdata('flash', 'DATA BERHASIL DI TAMBAHKAN');
			redirect('kepegawaian/Payroll/periode_penggajian');
    	} catch (Exception $e) {
    		echo "terjadi kesalahan program";
    		echo $a;
    	}
    }
    
    public function edit_periode(){
    	try {
    		$data =array(
    			'nama_periode' => $this->input->post('txtnama'),
    			'bulan' => bulan_int($this->input->post('cmbbulan')), 
    			'tahun' => $this->input->post('nmtahun') 
    		);
    		$this->db->where('id_periode',$this->input->post('idperiode'));
    		$this->db->update('payroll_periode_gaji',$data);
    		$this->session->set_flashdata('flash', 'DATA BERHASIL DI UBAH');
    		redirect('kepegawaian/Payroll/periode_penggajian');
    	} catch (Exception $e) {
    		echo "terjadi kesalahan program";
    		echo $a;
    	}
    	
    }

// GAJI
    public function gaji(){
        $data['datakaryawan']=$this->db->get('karyawan')->result();
        $data['datateamplate'] = $this->db->get('payroll_teamplate')->result();
        $data['dataperiode'] = $this->db->get('payroll_periode_gaji')->result();
        $data['datagaji']=$this->M_gaji->tampil_gaji();
        $data['dataunit']=$this->db->get('unit_kerja')->result();

        $data['header'] = 'layout/header';
        $data['topbar'] = 'layout/topbar';
        $data['sidebar'] = 'layout/sidebar';
        $data['js'] = 'layout/js';
        $data['jscontent'] = 'kepegawaian/payroll/gaji/jscontent';
        $data['footer'] = 'layout/footer';
        $data['content'] = 'kepegawaian/payroll/gaji/v_gaji';
        $this->load->view('layout/main', $data);
    }

    public function pilih_teamplate_gaji(){
        $id_karyawan=$this->input->post('id_pegawai');
        $id_periode=$this->input->post('id_periode');
        $id_teamplate=$this->input->post('id_teamplate');

        // $cekdata=$this->M_gaji->cek_gaji($id_karyawan,$id_periode,$id_teamplate);
      //cek data apkah karyawan sudah di gaji apa  belum di periode tertentu
      // if ($cekdata > 0) {
      //   $this->session->set_flashdata('flash2', 'Data Penggajian Sudah Ada di Periode Ini, Silahkan Cek Kembali Data Penggajian!!');
      //   redirect('kepegawaian/payroll/gaji/');
      // }else{

       $data['datakaryawan']=$this->db->query('SELECT * FROM  karyawan WHERE  NOT EXISTS (SELECT * FROM payroll_transaksi WHERE payroll_transaksi.id_karyawan = karyawan.id_karyawan)')->result();



      //   foreach ($a as $key) {
      //     $ok=$this->db->query('SELECT * FROM karyawan where karyawan.id_karyawan NOT IN (id_karyawan="$key->id_karyawan")');
      //        echo('<pre>');
      //   var_dump($ok);
      //   }
      // die();
        $data['id_teamplate']=$id_teamplate;

        // $data['datakaryawan']=$this->db->get('karyawan')->result();
        $data['datakategori']=$this->db->get('payroll_group_kategori_komponen')->result();
        $data['dataunit']=$this->db->get('unit_kerja')->result();
        $data['datakomponen']=$this->db->get('payroll_komponen_gaji')->result();
        $data['datalembaga']=$this->db->get('lembaga')->result();

        $this->db->where('id_periode',$id_periode);
        $data['dataperiode']=$this->db->get('payroll_periode_gaji')->row();
        
        $this->db->where('id_teamplate',$id_teamplate);
        $data['datafoto']=$this->db->get('payroll_teamplate')->row();
        
        $this->db->where('id_teamplate',$id_teamplate);
        $data['datateamplate']=$this->db->get('payroll_teamplate')->result();

        $data['datakategori']=$this->M_gaji->tampil_kategori($id_teamplate);

        $data['header'] = 'layout/header';
        $data['topbar'] = 'layout/topbar';
        $data['sidebar'] = 'layout/sidebar';
        $data['js'] = 'layout/js';
        $data['jscontent'] = 'kepegawaian/payroll/gaji/jscontent';
        $data['footer'] = 'layout/footer';
        $data['content'] = 'kepegawaian/payroll/gaji/v_add_gaji';
        $this->load->view('layout/main', $data);
      // }
    }

    public function add_gaji(){
      $jml_gaji = str_replace(".", "", $this->input->post('jml_gaji'));
      $id_teamplate=$this->input->post('id_teamplate');
      $id_detail_template=$this->input->post('id_detail_template');
      $id_periode=$this->input->post('id_periode');
      $id_karyawan=$this->input->post('id_karyawan');
      
      $data  = array(
                    'id_karyawan' => $id_karyawan,
                    'id_periode'=> $id_periode,
                    'id_teamplate' => $id_teamplate,
                    'id_periode' => $id_periode,
                    'create_at' => date('Y-m-d'),
                    // 'update_at' => $lembaga
                );
      $this->db->insert('payroll_transaksi', $data);
            //GET ID PACKAGE
                $last_id = $this->db->insert_id();
                $komponen=$_POST['type'];
                $result = array();
                    foreach($komponen AS $key => $val){
                       $result[] = array(
                          'id_transaksi'   => $last_id,
                          'id_group_kategori_komponen' => $_POST['id_group_kategori_komponen'][$key],
                          'type' => $_POST['type'][$key],
                          'id_komponen_gaji' => $_POST['id_komponen_gaji'][$key],
                          'jml_gaji' => $jml_gaji[$key],
                          'id_detail_template' => $id_detail_template[$key]
                      );
                   } 
            //MULTIPLE INSERT TO DETAIL TABLE
              $this->db->insert_batch('payroll_detail_transaksi', $result);

               $callback = array(
                                    'status' => 'sukses',
                                    'pesan' => 'Data berhasil disimpan'
                                  );
              echo json_encode($callback);
              // $this->session->set_flashdata('flash', 'DATA BERHASIL DI UBAH');
              // redirect('kepegawaian/payroll/gaji/');
        }
    public function update_gaji(){
      $id_detail_transaksi=$this->input->post('id_detail_transaksi');
      $jml_gaji = str_replace(".", "", $this->input->post('jml_gaji'));
              $id_detail_transaksi=$_POST['id_detail_transaksi'];
              $result = array();
                    foreach($id_detail_transaksi AS $key => $val){
                       $result[] = array(
                          'id_detail_transaksi' => $_POST['id_detail_transaksi'][$key],
                          'jml_gaji' => $jml_gaji[$key]
                      );
                   } 
            //MULTIPLE updates TO DETAIL TABLE
              $this->db->update_batch('payroll_detail_transaksi', $result,'id_detail_transaksi');
              $this->session->set_flashdata('flash', 'DATA BERHASIL DI UBAH');
              redirect('kepegawaian/payroll/gaji/');
    }

    public function edit_gaji($id_karyawan,$id_teamplate){
        $data['datakategori']=$this->M_gaji->cari_kategori_perkaryawan($id_karyawan,$id_teamplate);

        $data['detail_karyawan']=$this->M_gaji->cari_detail_karyawan($id_karyawan);

        $data['header'] = 'layout/header';
        $data['topbar'] = 'layout/topbar';
        $data['sidebar'] = 'layout/sidebar';
        $data['js'] = 'layout/js';
        $data['jscontent'] = 'kepegawaian/payroll/gaji/jscontent';
        $data['footer'] = 'layout/footer';
        $data['content'] = 'kepegawaian/payroll/gaji/v_edit_gaji';
        $this->load->view('layout/main', $data);
    }

    public function hapus_gaji($id_karyawan){
      $this->db->where('id_karyawan',$id_karyawan);
      $data_gaji=$this->db->get('payroll_transaksi')->row();

      $this->db->where('id_transaksi',$data_gaji->id_transaksi);
      $this->db->delete('payroll_detail_transaksi');

      $this->db->where('id_transaksi',$data_gaji->id_transaksi);
      $this->db->delete('payroll_transaksi');
      
      $this->session->set_flashdata('flash', 'DATA KOMPONEN BERHASIL DI HAPUS');
       redirect('kepegawaian/payroll/gaji');
    }


    public function pengambilan_gaji(){
      $id_karyawan = $_POST['id_karyawan'];
      
      $data = array('status' =>1);   
      $this->db->where_in('id_karyawan', $id_karyawan);
      $cek=$this->db->update('payroll_transaksi',$data);
      if ($cek) {
       $this->session->set_flashdata('flash', 'DATA BERHASIL DI UBAH');
       redirect('kepegawaian/payroll/gaji/');
      }else{
        echo "gagal transaksi";
      }
    }

    public function batal_pengambilan_gaji($id_karyawan){
      
      $data = array('status' =>0);   
      $this->db->where_in('id_karyawan', $id_karyawan);
      $cek=$this->db->update('payroll_transaksi',$data);
      if ($cek) {
       $this->session->set_flashdata('flash', 'DATA BERHASIL DI UBAH');
       redirect('kepegawaian/payroll/gaji/');
      }else{
        echo "gagal transaksi";
      }
    }

    public function print_slip_gaji($id_karyawan){
      $data['datagaji_pendapatan']=$this->M_gaji->cari_gaji_perkaryawan_pendapatan($id_karyawan);
      $data['datagaji_potongan']=$this->M_gaji->cari_gaji_perkaryawan_potongan($id_karyawan);
      $data['datagaji_informasi']=$this->M_gaji->cari_gaji_perkaryawan_informasi($id_karyawan);
    //data karyawan
      $data['datakaryawan']=$this->M_gaji->tampil_pegawai();  
    // covert tgl 
      $waktuawal  = date_create($data['datakaryawan']->tgl_berkerja); //waktu di setting
      $waktuakhir = date_create(); //waktu sekarang
      $data['diff'] = date_diff($waktuawal, $waktuakhir);
      // status pegawai    
      if ($data['datakaryawan']->id_sts_karyawan ==1) {
       $data['statuskaryawan']='TETAP';
      }else{
        $data['statuskaryawan']='TIDAK TETAP';
      }

    //tanggal input gaji
      $date =  $data['datakaryawan']->create_at;


      $createDate = new DateTime($date);
      $data['tgl']= $createDate->format('Y-m-d');

    // total gaji pendaptan
      $this->db->join('payroll_detail_transaksi','payroll_detail_transaksi.id_transaksi = payroll_transaksi.id_transaksi');
      $this->db->join('payroll_detail_template','payroll_detail_template.id_detail_template= payroll_detail_transaksi.id_detail_template');
      $this->db->join('payroll_komponen_gaji','payroll_komponen_gaji.id_komponen_gaji= payroll_detail_template.id_komponen_gaji');
      $this->db->join('payroll_group_kategori_komponen','payroll_group_kategori_komponen.id_group_kategori_komponen = payroll_komponen_gaji.id_group_kategori_komponen');
      $this->db->where('payroll_transaksi.id_karyawan',$id_karyawan);
      $this->db->where('payroll_detail_template.type','Penambahan');
      $this->db->select_sum('payroll_detail_transaksi.jml_gaji','total_gaji_pendapatan');
      $data['total_pendapatan']=$this->db->get('payroll_transaksi')->row();
    //total gaji potongan
      $this->db->join('payroll_detail_transaksi','payroll_detail_transaksi.id_transaksi = payroll_transaksi.id_transaksi');
      $this->db->join('payroll_detail_template','payroll_detail_template.id_detail_template= payroll_detail_transaksi.id_detail_template');
      $this->db->join('payroll_komponen_gaji','payroll_komponen_gaji.id_komponen_gaji= payroll_detail_template.id_komponen_gaji');
      $this->db->join('payroll_group_kategori_komponen','payroll_group_kategori_komponen.id_group_kategori_komponen = payroll_komponen_gaji.id_group_kategori_komponen');
      $this->db->where('payroll_transaksi.id_karyawan',$id_karyawan);
      $this->db->where('payroll_detail_template.type','Pengurangan');
      $this->db->select_sum('payroll_detail_transaksi.jml_gaji','total_gaji_potongan');
      $data['total_potongan']=$this->db->get('payroll_transaksi')->row();
      
      //total gaji Perusahaan
      $this->db->join('payroll_detail_transaksi','payroll_detail_transaksi.id_transaksi = payroll_transaksi.id_transaksi');
      $this->db->join('payroll_detail_template','payroll_detail_template.id_detail_template= payroll_detail_transaksi.id_detail_template');
      $this->db->join('payroll_komponen_gaji','payroll_komponen_gaji.id_komponen_gaji= payroll_detail_template.id_komponen_gaji');
      $this->db->join('payroll_group_kategori_komponen','payroll_group_kategori_komponen.id_group_kategori_komponen = payroll_komponen_gaji.id_group_kategori_komponen');
      $this->db->where('payroll_transaksi.id_karyawan',$id_karyawan);
      $this->db->where('payroll_detail_template.type','Perusahaan');
      $this->db->select_sum('payroll_detail_transaksi.jml_gaji','total_gaji_perusahaan');
      $data['total_perusahaan']=$this->db->get('payroll_transaksi')->row();

      $this->load->view('kepegawaian/payroll/gaji/laporan/slip_gaji_pegawai',$data);
    }
    
}