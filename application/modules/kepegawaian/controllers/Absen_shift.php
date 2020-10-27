<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Absen_shift extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('all/M_departemen');
        $this->load->model('all/M_combo');
        $this->load->model('M_absen');
        $this->load->model('M_karyawan');
        $this->load->library('datatables');
    }

    // Json Output
    public function output_json($data, $encode = true)
    {
        if ($encode) {
            $data = json_encode($data);
        }
        $this->output->set_content_type('application/json')->set_output($data);
    }

    //halamam awal data shift
    public function index()
    {
        if ($this->session->userdata('status') != true) {
            redirect(base_url("all/login"));
        }

        $akseslembaga = $this->session->userdata('akseslembaga');
        $idlembaga = $this->session->userdata('idlembaga');
        $aksesdepartemen = $this->session->userdata('aksesdepartemen');
        $idepartemen = $this->session->userdata('iddepartemen');
        

        //Jika akses antar lemmbaga
        if ($akseslembaga == 'Y') {
            $idlembaga = 'all';
        }

        if ($aksesdepartemen == 'Y') {
            $idepartmen = 'all';
        }

        $data['combolembaga'] = $this->M_combo->combolembaga($idlembaga);
        $data['combounitkerja'] = $this->M_combo->combounitkerja();
        $data['comboshift'] = $this->M_combo->comboshift();

        $data['header'] = 'layout/header';
        $data['topbar'] = 'layout/topbar';
        $data['sidebar'] = 'layout/sidebar';
        $data['content'] = 'absenshift/v_absenshift';
        $data['js'] = 'layout/js';
        $data['jscontent'] = 'absenshift/jscontent';
        $data['footer'] = 'layout/footer';
        $this->load->view('layout/main', $data);
    }

    // json data karyawan berdasarkan lembga dan unit kerja
    public function data($idlembaga=null,$idunit=null)
    {
        $this->output_json($this->M_absen->getKaryawan($idlembaga,$idunit), false);
    }

    //tambah absen pola
    public function tambah_absen_pola()
    {
        if ($this->session->userdata('status') != true) {
            redirect(base_url("all/login"));
        }
        $this->form_validation->set_rules('jammasuk', 'Harus Di isi', 'required|trim');
        $this->form_validation->set_rules('jamkeluar', 'Harus Di isi', 'required|trim');

        if ($this->form_validation->run() == true) {

            $kodeshift = $this->input->post('kodeshift');
            $namashift = $this->input->post('namashift');
            $jammasuk = $this->input->post('jammasuk');
            $jamkeluar = $this->input->post('jamkeluar');

            $dataabsen = array(
                'kode_shift' => $kodeshift,
                'nama_shift' => $namashift,
                'jam_masuk' => $jammasuk,
                'jam_keluar' => $jamkeluar,
            );

            $hasil = $this->M_absen->tambah_absen_pola($dataabsen);

            if ($hasil == true) {
                echo $this->session->set_flashdata('msg', 'success');
            } else {
                echo $this->session->set_flashdata('msg', 'error');
            }
            $url = base_url('kepegawaian/Absen_shift' . '?' . uniqid());
            redirect($url, 'refresh');
        }
    }

    //ubah data
    public function ubah_absen_pola()
    {
        if ($this->session->userdata('status') != true) {
            redirect(base_url("all/Login"));
        }

        $idshift = $this->input->post('idshift');
        $kodeshift = $this->input->post('kodeshift');
        $namashift = $this->input->post('namashift');
        $jammasuk = $this->input->post('jammasuk');
        $jamkeluar = $this->input->post('jamkeluar');

        $dataabsen = array(
            'kode_shift' => $kodeshift,
            'nama_shift' => $namashift,
            'jam_masuk' => $jammasuk,
            'jam_keluar' => $jamkeluar,
        );

        $hasil = $this->M_absen->ubah_absen_pola($idshift, $dataabsen);

        if ($hasil == true) {
            echo $this->session->set_flashdata('msg', 'success');
        } else {
            echo $this->session->set_flashdata('msg', 'error');
        }
        $url = base_url('kepegawaian/Absen_shif' . '?' . uniqid());
        redirect($url, 'refresh');
    }

    public function hapus_absen_pola()
    {
        if ($this->session->userdata('status') != true) {
            redirect(base_url("all/Login"));
        }

        $idabsenpola = $this->input->post('idshift');

        $hasil = $this->M_absen->hapus_absen_pola($idabsenpola);

        if ($hasil == true) {
            echo $this->session->set_flashdata('msg', 'success');
        } else {
            echo $this->session->set_flashdata('msg', 'error');
        }
        $url = base_url('kepegawaian/Absen_shif' . '?' . uniqid());
        redirect($url, 'refresh');
    }

    public function TambahAbsenShift(){

        if ($this->session->userdata('status') != true) {
            redirect(base_url("all/login"));
        }

        $akseslembaga = $this->session->userdata('akseslembaga');
        $idlembaga = $this->session->userdata('idlembaga');
        $aksesdepartemen = $this->session->userdata('aksesdepartemen');
        $idepartemen = $this->session->userdata('iddepartemen');
        
        //Jika akses antar lemmbaga
        if ($akseslembaga == 'Y') {
            $idlembaga = 'all';
        }

        if ($aksesdepartemen == 'Y') {
            $idepartemen = 'all';
        }
        
        $data['judul'] = "Tambah Absen Shift";
        $data['combolembaga'] = $this->M_combo->combolembaga($idlembaga);
        $data['combounitkerja'] = $this->M_combo->combounitkerja();
        $data['comboshift'] = $this->M_combo->comboshift();

        $data['header'] = 'layout/header';
        $data['topbar'] = 'layout/topbar';
        $data['sidebar'] = 'layout/sidebar';
        $data['content'] = 'absenshift/v_absenshift_add';
        $data['js'] = 'layout/js';
        $data['jscontent'] = 'absenshift/jscontent';
        $data['footer'] = 'layout/footer';
        $this->load->view('layout/main', $data);

    }
    

    // Simpan pengaturan shift karyawan 
    public function SimpanShift(){
        if ($this->session->userdata('status') != true) {
            redirect(base_url("all/login"));
        }

        $idshift = $this->input->post('idabsenshift');
        $tglawal = $this->M_karyawan->rubah_tglformat($this->input->post('tglperiode1'));
        $tglakhir = $this->M_karyawan->rubah_tglformat($this->input->post('tglperiode2'));

        $idkaryawan = $this->input->post('idkaryawan');
        $checkid = explode(',', $idkaryawan);
        $jml = count($checkid);
        
        $tglaw = $this->M_karyawan->rubah_tglformat($this->input->post('tglperiode1'));

        for ($i = 0; $i <= $jml - 1; $i++) {
            while (strtotime($tglawal) <= strtotime($tglakhir)) {
                $data = array(
                    'id_karyawan' =>  $checkid[$i],
                    'id_shift' => $idshift,
                    'tgl_absen' => $tglawal);
                $tglawal =   date('Y-m-d', strtotime($tglawal . ' + 1 days'));
                $this->M_absen->delete_absen_shift($data);
                $hasil = $this->M_absen->simpan_absen_shift($data); 
            }
            $tglawal = $tglaw;     
        }
        if ($hasil == true) {
            $this->output_json(['status' => true]);
        } else 
        {
            $this->output_json(['status' => false]);
        }
    }


    //Tampil Data Shift Karyawan
    public function TampilShift(){

        if ($this->session->userdata('status') != true) {
            redirect(base_url("all/login"));
        }

        $idshift = $this->input->post('idabsenshift');
        $tglawal = $this->M_karyawan->rubah_tglformat($this->input->post('tglperiode1'));
        $tglakhir = $this->M_karyawan->rubah_tglformat($this->input->post('tglperiode2'));
        $idkaryawan = $this->input->post('idkaryawan');
        $checkid = explode(',', $idkaryawan);
        $jml = count($checkid);

        
        $data['datashift'] = $this->M_absen->TampilShift($idshift, $tglawal, $tglakhir, $idkaryawan);
        $data['datakaryawan'] = $this->M_absen->getKaryawanMulti($checkid);
        $data['idshift'] = $idshift;
        $data['idkaryawan'] = $idkaryawan;
        $data['tglawal'] = $tglawal;
        $data['tglakhir'] = $tglakhir;


        $this->load->view('absenshift/v_datashiftajax', $data);
    }

    public function HapusShift($id){
    if ($this->session->userdata('status') != true) {
        redirect(base_url("all/Login"));
    }

        $hasil = $this->M_absen->HapusShiftId($id);

        if ($hasil == true) {
            $this->output_json(['status' => true]);
            } 
            else {
                $this->output_json(['status' => false]);
            }

    }



    public function ExportDataShift(){

       if ($this->session->userdata('status') != true) {
        redirect(base_url("all/login"));
        }

            $idshift = $this->input->post('idabsenshift');
            $tglawal = $this->M_karyawan->rubah_tglformat($this->input->post('tglperiode1'));
            $tglakhir = $this->M_karyawan->rubah_tglformat($this->input->post('tglperiode2'));
            $idkaryawan = $this->input->post('idkaryawan');
            $checkid = explode(',', $idkaryawan);
            $jml = count($checkid);

            $data['datashift'] = $this->M_absen->TampilShift($idshift, $tglawal, $tglakhir, $idkaryawan);
            $data['datakaryawan'] = $this->M_absen->getKaryawanMulti($checkid);
            $data['tableshift'] = $this->M_absen->tampil_absen_pola();
            $data['idshift'] = $idshift;
            $data['idkaryawan'] = $idkaryawan;
            $data['tglawal'] = $tglawal;
            $data['tglakhir'] = $tglakhir;

            $this->load->view('absenshift/v_expdatashift', $data);

    }
    
}


      

  

	




    



    
    


