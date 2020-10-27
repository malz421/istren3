<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Payroll extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_kode_unik');
        	if ($this->session->userdata('status') != true) {
            redirect(base_url("all/login"));
        }
        $this->load->helper('datetime_indo_helper');
        $akseslembaga = $this->session->userdata('akseslembaga');
        $idlembaga = $this->session->userdata('idlembaga');
         
        //Jika akses antar lemmbaga
        if ($akseslembaga == 'Y') {
            $idlembaga = 'all';
        }
        // $this->load->model('all/M_departemen');
        // $this->load->model('M_karyawan');
        // $this->load->model('M_absen');
        // $this->load->model('all/M_combo');

    }

    // TEAMPLATE GAJI
     public function teamplate_gaji(){
        $data['datateamplate'] = $this->db->get('teamplate')->result();
        $data['header'] = 'layout/header';
        $data['topbar'] = 'layout/topbar';
        $data['sidebar'] = 'layout/sidebar';
        $data['js'] = 'layout/js';
        $data['jscontent'] = 'payroll/teamplate_gaji/jscontent';
        $data['footer'] = 'layout/footer';
        $data['content'] = 'kepegawaian/payroll/teamplate_gaji/v_teamplate_gaji';
        $this->load->view('layout/main', $data);
    }
        public function hapus_teamplate($id){
        $this->db->where('id_teamplate',$id);
        $this->db->delete('teamplate');
        $this->session->set_flashdata('flash', 'DATA BERHASIL DI HAPUS');
        redirect('kepegawaian/payroll/teamplate_gaji/v_teamplate_gaji');
        }
    public function add_teamplate(){
        $data['kodeunik'] = $this->M_kode_unik->buat_kode(); 
        $data['datakaryawan']=$this->db->get('karyawan')->result();
        $data['datakategori']=$this->db->get('kategori')->result();
        $data['dataunit']=$this->db->get('unit_kerja')->result();
        $data['header'] = 'layout/header';
        $data['topbar'] = 'layout/topbar';
        $data['sidebar'] = 'layout/sidebar';
        $data['js'] = 'layout/js';
        $data['jscontent'] = 'payroll/teamplate_gaji/jscontent';
        $data['footer'] = 'layout/footer';
        $data['content'] = 'kepegawaian/payroll/teamplate_gaji/add_teamplate';
        $this->load->view('layout/main', $data);
    }

    public function tambah_teamplate(){
        $this->db->trans_start();
            //INSERT TO PACKAGE
            $nama_teamplate = $_POST['nama_teamplate'];
            $komponen = $_POST['komponen'];
            $Kategori=$_POST['Kategori'];
            $unit=$_POST['unit'];
            // $unit_kerja=$_POST['id_unit_kerja'];
            $nama_pendanda_tangan=$_POST['nip'];
            
            $data  = array(
                'nama_teamplate' => $nama_teamplate,
                'nip_karyawan'=> $nama_pendanda_tangan,
                'tgl' => date('Y-m-d H:i:s'),
                'id_unit_kerja' => $unit,
            );
            $this->db->insert('teamplate', $data);
            //GET ID PACKAGE
            $last_id = $this->db->insert_id();
            $result = array();
            foreach ($Kategori as $key2 => $value) {
                $Kategori = $_POST['Kategori'][$key2];
            
                foreach($komponen AS $key => $val){
                     $result[] = array(
                      'id_teamplate'   => $last_id,
                      'nama_komponen'   => $_POST['komponen'][$key],
                      'id_kategori' => $Kategori,
                      'type' => $_POST['type'][$key]
                     );
                } 
            }
            //MULTIPLE INSERT TO DETAIL TABLE
            $this->db->insert_batch('komponen_gaji', $result);
         $this->db->trans_complete();
}

function backup_loop(){
        $id_teamplate = $_POST['id_teamplate'];
           $komponen = $_POST['komponen']; // Ambil data nis dan masukkan ke variabel nis
           $type = $_POST['type'];
           $Kategori = $_POST['Kategori'];
           // var_dump($komponen,$type,$Kategori);
       //     $data = array();       
       //      $index = 0; 
       //     foreach($komponen as $datakomponen){ 
       //     array_push($data, array(        
       //     'nama_komponen'=>$komponen[$index],        
       //     // 'id_teamplate'=>$id_teamplate[$index],       
       //     'id_kategori'=>$Kategori[$index],
       //     'type'=>$type[$index]  
       // ));            
       //     $index++;
        // $this->db->insert_batch('komponen_gaji',$data);
}
    // KATEGORI
    public function kategori(){
        $data['datakategori'] = $this->db->get('kategori')->result();
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
    $this->db->where('id_kategori',$id);
    $this->db->delete('kategori');
    $this->session->set_flashdata('flash', 'DATA BERHASIL DI HAPUS');
    redirect('kepegawaian/Payroll/kategori/v_kategori');
    }

    public function tambah_kategori(){
        try {
            $data =array(
            'nama_kategori' => $this->input->post('txtnama')
             );
            $this->db->insert('kategori',$data);
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
            $this->db->where('id_kategori',$this->input->post('idkategori'));
            $this->db->update('kategori',$data);
            $this->session->set_flashdata('flash', 'DATA BERHASIL DI UBAH');
            redirect('kepegawaian/Payroll/kategori/v_kategori');
        } catch (Exception $e) {
            echo "terjadi kesalahan program";
            echo $a;
        }
        
    }

    // PERIODE
    public function periode_penggajian(){
		$data['dataperiode'] = $this->db->get('periode')->result();
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
    $this->db->delete('periode');
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
	    	$this->db->insert('periode',$data);
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
    		$this->db->update('periode',$data);
    		$this->session->set_flashdata('flash', 'DATA BERHASIL DI UBAH');
    		redirect('kepegawaian/Payroll/periode_penggajian');
    	} catch (Exception $e) {
    		echo "terjadi kesalahan program";
    		echo $a;
    	}
    	
    }
    
}