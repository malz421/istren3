<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Karyawan extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('all/M_departemen');
        $this->load->model('M_karyawan');
        $this->load->model('M_absen');
        $this->load->model('all/M_combo');
        $this->load->library('upload');

    }

    public function output_json($data, $encode = true)
    {

        if ($encode) {
            $data = json_encode($data);
        }

        $this->output->set_content_type('application/json')->set_output($data);

    }

    public function index()
    {
        if ($this->session->userdata('status') != true) {
            redirect(base_url("all/login"));
        }

        $akseslembaga = $this->session->userdata('akseslembaga');
        $idlembaga = $this->session->userdata('idlembaga');

        //Jika akses antar lemmbaga
        if ($akseslembaga == 'Y') {
            $idlembaga = 'all';
        }

        $data['datakaryawan'] = $this->M_karyawan->tampil_karyawan($idlembaga);
        $data['combolembaga'] = $this->M_combo->combolembaga($idlembaga);
        $data['combostskaryawan'] = $this->M_combo->combostatuskaryawan();
        $data['combounitkerja'] = $this->M_combo->combounitkerja();
        $data['combostskerja'] = $this->M_combo->combostatuskerja();
        $data['header'] = 'layout/header';
        $data['topbar'] = 'layout/topbar';
        $data['sidebar'] = 'layout/sidebar';
        $data['content'] = 'karyawan/v_karyawan';
        $data['js'] = 'layout/js';
        $data['jscontent'] = 'karyawan/jscontent';
        $data['footer'] = 'layout/footer';
        $this->load->view('layout/main', $data);
    }

    public function data($idlembaga = null)
    {
        $this->output_json($this->M_karyawan->getDataKaryawan($idlembaga), false);
    }

    //tambah data
    public function tambah_karyawan()
    {

        if ($this->session->userdata('status') != true) {
            redirect(base_url("all/login"));
        }

        $akseslembaga = $this->session->userdata('akseslembaga');
        $idlembaga = $this->session->userdata('idlembaga');

        //Jika akses antar lemmbaga
        if ($akseslembaga == 'Y') {
            $idlembaga = 'all';
        }

        $data['combolembaga'] = $this->M_combo->combolembaga($idlembaga);
        $data['combogoldarah'] = $this->M_combo->combogoldarah();
        $data['combonikah'] = $this->M_combo->combonikah();
        $data['combostskaryawan'] = $this->M_combo->combostatuskaryawan();
        $data['combounitkerja'] = $this->M_combo->combounitkerja();
        $data['combostskerja'] = $this->M_combo->combostatuskerja();
        $data['comboststinggal'] = $this->M_combo->combostatustinggal();

        $data['header'] = 'layout/header';
        $data['topbar'] = 'layout/topbar';
        $data['sidebar'] = 'layout/sidebar';
        $data['content'] = 'karyawan/v_add_karyawan';
        $data['js'] = 'layout/js';
        $data['jscontent'] = 'karyawan/jscontent';
        $data['footer'] = 'layout/footer';
        $this->load->view('layout/main', $data);

    }

    public function simpan_karyawan()
    {

        if ($this->session->userdata('status') != true) {
            redirect(base_url("all/login"));
        }

        $this->form_validation->set_rules('namakaryawan', 'USERNAME', 'trim|required', ['required' => 'Nama Harus Diisi!']);
        $this->form_validation->set_rules('alamatkaryawan', 'ALAMAT', 'trim|required', ['required' => 'Alamat Harus Diisi!']);
        $this->form_validation->set_rules('tglmulaikerja', 'TGLKERJA', 'trim|required', ['required' => 'Tanggal Mulai Kerja Harus Diisi!']);
        $this->form_validation->set_rules('emailkaryawan', 'EMAIL', 'valid_email', ['valid_email' => 'Email Tidak Valid!']);

        if ($this->form_validation->run() == true) {

            $idlembaga = $this->input->post('idlembaga');
            $idunitkerja = $this->input->post('idunitkerja');
            $nipkaryawan = $this->input->post('nipkaryawan');
            $nikkaryawan = $this->input->post('nikkaryawan');
            $gelardepan = $this->input->post('gelardepan');
            $gelarbelakang = $this->input->post('gelarbelakang');
            $namakaryawan = $this->input->post('namakaryawan');
            $namapanggilan = $this->input->post('namapanggilan');
            $agama = $this->input->post('agama');
            $tempatlahir = $this->input->post('tempatlahir');
            $tgllahir = $this->input->post('tgllahir');
            $jeniskelamin = $this->input->post('jeniskelamin');
            $golongandarah = $this->input->post('golongandarah');
            $stsnikah = $this->input->post('stsnikah');
            $stskaryawan = $this->input->post('stskaryawan');
            $ststinggal = $this->input->post('ststinggal');
            $stsaktif = $this->input->post('stsaktif');
            $tglmulaikerja = $this->input->post('tglmulaikerja');
            $alamatkaryawan = $this->input->post('alamatkaryawan');
            $notlpkaryawan = $this->input->post('notlpkaryawan');
            $emailkaryawan = $this->input->post('emailkaryawan');
            $photoprofil = $this->input->post('filephoto');

            $config['upload_path'] = './storage/photo/karyawan/';
            $config['allowed_types'] = 'jpeg|gif|jpg|png';
            $config['overwrite'] = true;
            $config['encrypt_name'] = true;
            //$config['file_name'] = "logo-".$iddepartemen ;
            $this->load->library('upload', $config);

            if (!empty($_FILES['filephoto']['name'])) {
                if ($this->upload->do_upload('filephoto')) {
                    $gbr = $this->upload->data();
                    //Compress Image
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = './storage/photo/karyawan/' . $gbr['file_name'];
                    $config['create_thumb'] = false;
                    $config['maintain_ratio'] = false;
                    $config['quality'] = '50%';
                    $config['width'] = 150;
                    $config['height'] = 150;
                    $config['new_image'] = './storage/photo/karyawan/' . $gbr['file_name'];
                    $this->load->library('image_lib', $config);
                    $this->image_lib->resize();
                    $logo = $gbr['file_name'];
                } else {
                    echo $this->session->set_flashdata('msg', 'error');
                    $url = base_url('kepegawaian/karyawan' . '?' . uniqid());
                    redirect($url, 'refresh');
                }
            }

            $nipkaryawan = $this->M_karyawan->get_nip(str_replace('-', '', $tglmulaikerja));

            $data = array(
                'id_lembaga' => $idlembaga,
                'id_unit_kerja' => $idunitkerja,
                'nip_karyawan' => $nipkaryawan,
                'nik_karyawan' => $nikkaryawan,
                'nama_karyawan' => str_replace("'", "`", $namakaryawan),
                'gelar_awal' => str_replace("'", "`", $gelardepan),
                'gelar_akhir' => str_replace("'", "`", $gelarbelakang),
                'panggilan' => str_replace("'", "`", $namapanggilan),
                'tempat_lahir' => $tempatlahir,
                'tanggal_lahir' => $tgllahir,
                'agama' => $agama,
                'jenis_kelamin' => $jeniskelamin,
                'golongan_darah' => $golongandarah,
                'status_pernikahan' => $stsnikah,
                'id_sts_karyawan' => $stskaryawan,
                'status_pernikahan' => $stsnikah,
                'id_tinggal' => $ststinggal,
                'id_sts_aktif' => $stsaktif,
                'alamat_karyawan' => str_replace("'", "`", $alamatkaryawan),
                'no_hp' => str_replace("'", "`", $notlpkaryawan),
                'email' => str_replace("'", "`", $emailkaryawan),
                'tgl_berkerja' => $tglmulaikerja,
                'photo_profile' => str_replace("'", "`", $photoprofil));

            $hasil = $this->M_karyawan->tambah_karyawan($data);

            if ($hasil == true) {
                echo $this->session->set_flashdata('msg', 'success');
            } else {
                echo $this->session->set_flashdata('msg', 'error');
            }
            $url = base_url('kepegawaian/karyawan' . '?' . uniqid());
            redirect($url, 'refresh');

        } else {
            $akseslembaga = $this->session->userdata('akseslembaga');
            $idlembaga = $this->session->userdata('idlembaga');

            //Jika akses antar lemmbaga
            if ($akseslembaga == 'Y') {
                $idlembaga = 'all';
            }

            $data['combolembaga'] = $this->M_combo->combolembaga($idlembaga);
            $data['combogoldarah'] = $this->M_combo->combogoldarah();
            $data['combonikah'] = $this->M_combo->combonikah();
            $data['combostskaryawan'] = $this->M_combo->combostatuskaryawan();
            $data['combounitkerja'] = $this->M_combo->combounitkerja();
            $data['combostskerja'] = $this->M_combo->combostatuskerja();
            $data['comboststinggal'] = $this->M_combo->combostatustinggal();

            $data['header'] = 'layout/header';
            $data['topbar'] = 'layout/topbar';
            $data['sidebar'] = 'layout/sidebar';
            $data['content'] = 'karyawan/v_add_karyawan';
            $data['js'] = 'layout/js';
            $data['jscontent'] = 'karyawan/jscontent';
            $data['footer'] = 'layout/footer';
            $this->load->view('layout/main', $data);
        }

    }

    public function ubah_karyawan($id)
    {

        if ($this->session->userdata('status') != true) {
            redirect(base_url("all/login"));
        }

        $akseslembaga = $this->session->userdata('akseslembaga');
        $idlembaga = $this->session->userdata('idlembaga');

        //Jika akses antar lemmbaga
        if ($akseslembaga == 'Y') {
            $idlembaga = 'all';
        }
        $data['combotype_berkas']=$this->db->get('type_berkas')->result();
        $data['id_karyawan']=$id;
        $data['datakaryawan'] = $this->M_karyawan->detail_karyawan($id);
        $data['datakeluarga'] = $this->M_karyawan->data_keluarga($id);
        $data['combolembaga'] = $this->M_combo->combolembaga($idlembaga);
        $data['historiabsen'] = $this->M_karyawan->getHistoriAbsen($id);
        $data['combogoldarah'] = $this->M_combo->combogoldarah();
        $data['combonikah'] = $this->M_combo->combonikah();
        $data['combostskaryawan'] = $this->M_combo->combostatuskaryawan();
        $data['combounitkerja'] = $this->M_combo->combounitkerja();
        $data['combostskerja'] = $this->M_combo->combostatuskerja();
        $data['comboststinggal'] = $this->M_combo->combostatustinggal();
        $data['combopekerjaan'] = $this->M_combo->combopekerjaan();
        $data['combopendidikan'] = $this->M_combo->combopendidikan();
        $data['tableshift'] = $this->M_absen->tampil_absen_pola();
        $data['header'] = 'layout/header';
        $data['topbar'] = 'layout/topbar';
        $data['sidebar'] = 'layout/sidebar';
        $data['content'] = 'karyawan/v_edit_karyawan';
        $data['js'] = 'layout/js';
        $data['jscontent'] = 'karyawan/jscontent';
        $data['footer'] = 'layout/footer';
        $this->load->view('layout/main', $data);

    }

    public function datajsonkeluarga($nip)
    {
        $this->output_json($this->M_karyawan->getDataKeluarga($nip), false);
    }

    //ubah data pokok karyawan

    //tambahin update_karywan sebelumnya eror skrg sudah selsai
    public function update_karyawan()
    {

        if ($this->session->userdata('status') != true) {
            redirect(base_url("all/login"));
        }

        $this->form_validation->set_rules('namakaryawan', 'USERNAME', 'trim|required', ['required' => 'Nama Harus Diisi!']);
        $this->form_validation->set_rules('alamatkaryawan', 'ALAMAT', 'trim|required', ['required' => 'Alamat Harus Diisi!']);
        $this->form_validation->set_rules('tglmulaikerja', 'TGLKERJA', 'trim|required', ['required' => 'Tanggal Mulai Kerja Harus Diisi!']);
        $this->form_validation->set_rules('emailkaryawan', 'EMAIL', 'valid_email', ['valid_email' => 'Email Tidak Valid!']);

        if ($this->form_validation->run() == true) {

            $idlembaga = $this->input->post('idlembaga');
            $idunitkerja = $this->input->post('idunitkerja');
            $nipkaryawan = $this->input->post('nipkaryawan');
            $nikkaryawan = $this->input->post('nikkaryawan');
            $gelardepan = $this->input->post('gelardepan');
            $gelarbelakang = $this->input->post('gelarbelakang');
            $namakaryawan = $this->input->post('namakaryawan');
            $namapanggilan = $this->input->post('namapanggilan');
            $agama = $this->input->post('agama');
            $tempatlahir = $this->input->post('tempatlahir');
            $tgllahir = $this->input->post('tgllahir');
            $jeniskelamin = $this->input->post('jeniskelamin');
            $golongandarah = $this->input->post('golongandarah');
            $stsnikah = $this->input->post('stsnikah');
            $stskaryawan = $this->input->post('stskaryawan');
            $ststinggal = $this->input->post('ststinggal');
            $stsaktif = $this->input->post('stsaktif');
            $tglmulaikerja = $this->input->post('tglmulaikerja');
            $alamatkaryawan = $this->input->post('alamatkaryawan');
            $notlpkaryawan = $this->input->post('notlpkaryawan');
            $emailkaryawan = $this->input->post('emailkaryawan');
            $photoprofil = $this->input->post('filephoto');
            $idkaryawan = $this->input->post('idkaryawan');
            $nfc = $this->input->post('nfc');

            $config['upload_path'] = './storage/photo/karyawan/';
            $config['allowed_types'] = 'jpeg|gif|jpg|png';
            $config['overwrite'] = true;
            $config['encrypt_name'] = true;
            //$config['file_name'] = "logo-".$iddepartemen ;
            $this->load->library('upload', $config);

            if (!empty($_FILES['filephoto']['name'])) {
                if ($this->upload->do_upload('filephoto')) {
                    $gbr = $this->upload->data();
                    //Compress Image
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = './storage/photo/karyawan/' . $gbr['file_name'];
                    $config['create_thumb'] = false;
                    $config['maintain_ratio'] = false;
                    $config['quality'] = '50%';
                    $config['width'] = 150;
                    $config['height'] = 150;
                    $config['new_image'] = './storage/photo/karyawan/' . $gbr['file_name'];
                    $this->load->library('image_lib', $config);
                    $this->image_lib->resize();
                    $url = $gbr['file_name'];
                } else {
                    echo $this->session->set_flashdata('msg', 'error');
                    $url = base_url('kepegawaian/karyawan' . '?' . uniqid());
                    redirect($url, 'refresh');
                }

                 $data = array(

                'id_lembaga' => $idlembaga,
                'id_unit_kerja' => $idunitkerja,
                'nip_karyawan' => $nipkaryawan,
                'nik_karyawan' => $nikkaryawan,
                'nama_karyawan' => str_replace("'", "`", $namakaryawan),
                'gelar_awal' => str_replace("'", "`", $gelardepan),
                'gelar_akhir' => str_replace("'", "`", $gelarbelakang),
                'panggilan' => str_replace("'", "`", $namapanggilan),
                'tempat_lahir' => $tempatlahir,
                'tanggal_lahir' => $this->M_karyawan->rubah_tglformat($tgllahir),
                'agama' => $agama,
                'jenis_kelamin' => $jeniskelamin,
                'golongan_darah' => $golongandarah,
                'status_pernikahan' => $stsnikah,
                'id_sts_karyawan' => $stskaryawan,
                'status_pernikahan' => $stsnikah,
                'id_tinggal' => $ststinggal,
                'id_sts_aktif' => $stsaktif,
                'alamat_karyawan' => str_replace("'", "`", $alamatkaryawan),
                'no_hp' => str_replace("'", "`", $notlpkaryawan),
                'email' => str_replace("'", "`", $emailkaryawan),
                'tgl_berkerja' => $this->M_karyawan->rubah_tglformat($tglmulaikerja),
                'photo_profile' => str_replace("'", "`", $url),
                'nfc' => $nfc);

            }
            else
            {
                 $data = array(

                'id_lembaga' => $idlembaga,
                'id_unit_kerja' => $idunitkerja,
                'nip_karyawan' => $nipkaryawan,
                'nik_karyawan' => $nikkaryawan,
                'nama_karyawan' => str_replace("'", "`", $namakaryawan),
                'gelar_awal' => str_replace("'", "`", $gelardepan),
                'gelar_akhir' => str_replace("'", "`", $gelarbelakang),
                'panggilan' => str_replace("'", "`", $namapanggilan),
                'tempat_lahir' => $tempatlahir,
                'tanggal_lahir' => $this->M_karyawan->rubah_tglformat($tgllahir),
                'agama' => $agama,
                'jenis_kelamin' => $jeniskelamin,
                'golongan_darah' => $golongandarah,
                'status_pernikahan' => $stsnikah,
                'id_sts_karyawan' => $stskaryawan,
                'status_pernikahan' => $stsnikah,
                'id_tinggal' => $ststinggal,
                'id_sts_aktif' => $stsaktif,
                'alamat_karyawan' => str_replace("'", "`", $alamatkaryawan),
                'no_hp' => str_replace("'", "`", $notlpkaryawan),
                'email' => str_replace("'", "`", $emailkaryawan),
                'tgl_berkerja' => $this->M_karyawan->rubah_tglformat($tglmulaikerja),
             
                'nfc' => $nfc);
            }

           

            $hasil = $this->M_karyawan->ubah_karyawan($idkaryawan, $data);

            if ($hasil == true) {
                echo $this->session->set_flashdata('msg', 'success');
            } else {
                echo $this->session->set_flashdata('msg', 'error');
            }
            $url = base_url('kepegawaian/karyawan');
            redirect($url);

        } else {
            $idkaryawan = $this->input->post('idkaryawan');
            $akseslembaga = $this->session->userdata('akseslembaga');
            $idlembaga = $this->session->userdata('idlembaga');

            //Jika akses antar lemmbaga
            if ($akseslembaga == 'Y') {
                $idlembaga = 'all';
            }

            $data['datakaryawan'] = $this->M_karyawan->detail_karyawan($idkaryawan);
            $data['combolembaga'] = $this->M_combo->combolembaga($idlembaga);
            $data['combogoldarah'] = $this->M_combo->combogoldarah();
            $data['combonikah'] = $this->M_combo->combonikah();
            $data['combostskaryawan'] = $this->M_combo->combostatuskaryawan();
            $data['combounitkerja'] = $this->M_combo->combounitkerja();
            $data['combostskerja'] = $this->M_combo->combostatuskerja();
            $data['comboststinggal'] = $this->M_combo->combostatustinggal();
            $data['header'] = 'layout/header';
            $data['topbar'] = 'layout/topbar';
            $data['sidebar'] = 'layout/sidebar';
            $data['content'] = 'karyawan/v_edit_karyawan';
            $data['js'] = 'layout/js';
            $data['jscontent'] = 'karyawan/jscontent';
            $data['footer'] = 'layout/footer';
            $this->load->view('layout/main', $data);
        }
    }

    public function detail_karyawan($id)
    {

        if ($this->session->userdata('status') != true) {
            redirect(base_url("all/login"));
        }

        $akseslembaga = $this->session->userdata('akseslembaga');
        $idlembaga = $this->session->userdata('idlembaga');

//Jika akses antar lemmbaga
        if ($akseslembaga == 'Y') {
            $idlembaga = 'all';
        }

        $data['id_karyawan']=$id;
        $data['datakaryawan'] = $this->M_karyawan->detail_karyawan($id);
        $data['datakeluarga'] = $this->M_karyawan->data_keluarga($id);
        $data['combolembaga'] = $this->M_combo->combolembaga($idlembaga);
        $data['combogoldarah'] = $this->M_combo->combogoldarah();
        $data['combonikah'] = $this->M_combo->combonikah();
        $data['combostskaryawan'] = $this->M_combo->combostatuskaryawan();
        $data['combounitkerja'] = $this->M_combo->combounitkerja();
        $data['combostskerja'] = $this->M_combo->combostatuskerja();
        $data['comboststinggal'] = $this->M_combo->combostatustinggal();
        $data['combopekerjaan'] = $this->M_combo->combopekerjaan();
        $data['combopendidikan'] = $this->M_combo->combopendidikan();
        $data['tableshift'] = $this->M_absen->tampil_absen_pola();
        $data['header'] = 'layout/header';
        $data['topbar'] = 'layout/topbar';
        $data['sidebar'] = 'layout/sidebar';
        $data['content'] = 'karyawan/v_detail_karyawan';
        $data['js'] = 'layout/js';
        $data['jscontent'] = 'karyawan/jscontent';
        $data['footer'] = 'layout/footer';
        $this->load->view('layout/main', $data);

    }

    public function hapus_karyawan()
    {
        if ($this->session->userdata('status') != true) {
            redirect(base_url("all/login"));
        }
        $kode = $this->input->post('kode');
        $userhapus = $this->session->userdata('usrname');
        $data = array(
            'user_hapus' => $userhapus,
            'sts_data' => 1,
            'tgl_hapus' => date('Y/m/d h:i:s'),
        );
        $this->M_karyawan->hapus_karyawan($kode, $data);
        echo $this->session->set_flashdata('msg', 'success-hapus');
        $url = base_url('kepegawaian/karyawan' . '?' . uniqid());
        redirect($url, 'refresh');

    }

    public function get_nip($awalan)
    {
        $q = $this->db->query("SELECT MAX(RIGHT(nip_karyawan,4)) AS kd_max FROM karyawan WHERE MID(nip_karyawan,1,8)='.$awalan.'");
        $kd = "";
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $k) {
                $tmp = ((int) $k->kd_max) + 1;
                $kd = sprintf("%04s", $tmp);
            }
        } else {
            $kd = "0001";
        }
        return $awalan . $kd;
    }

/* TAB KELUARGA */

    public function tambah_keluarga($id, $nip)
    {

        if ($this->session->userdata('status') != true) {
            redirect(base_url("all/login"));
        }

        $akseslembaga = $this->session->userdata('akseslembaga');
        $idlembaga = $this->session->userdata('idlembaga');

        //Jika akses antar lemmbaga
        if ($akseslembaga == 'Y') {
            $idlembaga = 'all';
        }

        $data['idkaryawan'] = $id;
        $data['nipkaryawan'] = $nip;
        $data['datakeluarga'] = $this->M_karyawan->detail_keluarga($id);
        $data['combolembaga'] = $this->M_combo->combolembaga($idlembaga);
        $data['combogoldarah'] = $this->M_combo->combogoldarah();
        $data['combonikah'] = $this->M_combo->combonikah();
        $data['combostskaryawan'] = $this->M_combo->combostatuskaryawan();
        $data['combounitkerja'] = $this->M_combo->combounitkerja();
        $data['combostskerja'] = $this->M_combo->combostatuskerja();
        $data['comboststinggal'] = $this->M_combo->combostatustinggal();
        $data['combopekerjaan'] = $this->M_combo->combopekerjaan();
        $data['combopendidikan'] = $this->M_combo->combopendidikan();
        $data['combohubungan'] = $this->M_combo->combohubungan();

        $data['modal'] = true;
        $data['content'] = 'karyawan/keluarga/v_keluarga_modal_add';
        $this->load->view('layout/main', $data);



    }

    public function lihat_keluarga($idkeluarga)
    {

        if ($this->session->userdata('status') != true) {
            redirect(base_url("all/login"));
        }

        $akseslembaga = $this->session->userdata('akseslembaga');
        $idlembaga = $this->session->userdata('idlembaga');

        //Jika akses antar lemmbaga
        if ($akseslembaga == 'Y') {
            $idlembaga = 'all';
        }

        $data['datakeluarga'] = $this->M_karyawan->detail_keluarga($idkeluarga);
        $data['combolembaga'] = $this->M_combo->combolembaga($idlembaga);
        $data['combogoldarah'] = $this->M_combo->combogoldarah();
        $data['combonikah'] = $this->M_combo->combonikah();
        $data['combostskaryawan'] = $this->M_combo->combostatuskaryawan();
        $data['combounitkerja'] = $this->M_combo->combounitkerja();
        $data['combostskerja'] = $this->M_combo->combostatuskerja();
        $data['comboststinggal'] = $this->M_combo->combostatustinggal();
        $data['combopekerjaan'] = $this->M_combo->combopekerjaan();
        $data['combopendidikan'] = $this->M_combo->combopendidikan();
        $data['combohubungan'] = $this->M_combo->combohubungan();
        $data['modal'] = true;
        $data['content'] = 'karyawan/keluarga/v_keluarga_modal_view';
        $this->load->view('layout/main', $data);

    }

    public function simpan_keluarga()
    {
        if ($this->session->userdata('status') != true) {
            redirect(base_url("all/login"));
        }

        $method = $this->input->post('method');

        $this->_validate_keluarga($method); // validasi

        if ($this->form_validation->run() == false) {
            $data = [
                'status' => false,
                'errors' => [
                    'nikkel' => form_error('nikkel'),
                    'namakel' => form_error('namakel'),
                    'tgllhrkel' => form_error('tgllhrkel'),
                    'jkkel' => form_error('jkkel'),
                    'hubkel' => form_error('hubkel'),
                    'penkel' => form_error('penkel'),
                    'kerjakel' => form_error('kerjakel'),
                ],
            ];
            $this->output_json($data);
        } else {

            $idkaryawan = $this->input->post('idkaryawan');
            $nipkaryawan = $this->input->post('nipkaryawan');
            $namakel = $this->input->post('namakel');
            $nikkel = $this->input->post('nikkel');
            $tgllhrkel = $this->input->post('tgllhrkel');
            $hubkel = $this->input->post('hubkel');
            $jkkel = $this->input->post('jkkel');
            $penkel = $this->input->post('penkel');
            $kerjakel = $this->input->post('kerjakel');

            $data = array(
                'nama_keluarga' => $namakel,
                'id_karyawan' => $idkaryawan,
                'nip_karyawan' => $nipkaryawan,
                'id_pendidikan' => $penkel,
                'id_pekerjaan' => $kerjakel,
                'id_hubungan' => $hubkel,
                'tgl_lahir' => $this->M_karyawan->rubah_tglformat($tgllhrkel),
                'nik_hubungan' => $nikkel,
                'jenis_kelamin' => $jkkel);

                


            $hasil = $this->M_karyawan->simpan_keluarga($data);

            /*if($hasil==TRUE){
            echo $this->session->set_flashdata('msg','success');
            }else{
            echo $this->session->set_flashdata('msg','error');
            }*/

            if ($hasil == true) {
                $this->output_json(['status' => true]);
            } else {
                $this->output_json(['status' => false]);
            }
        }

    }
    public function simpan_kk(){
        if ($this->session->userdata('status') != true) {
            redirect(base_url("all/login"));
        }
                        $this->db->where('id_type_berkas',$this->input->post('id_type_berkas'));
                        $this->db->where('id_karyawan',$this->input->post('id_karyawan'));
            $cek_file=$this->db->get('file_berkas_karyawan')->row();

            $config['upload_path']      = 'assets/images/img_kk/';
            $config['allowed_types']    = 'gif|jpg|png|jpeg|bmp';
            $config['encrypt_name']    = TRUE;
            $this->upload->initialize($config);
        
        // jika tidak ada upload foto maka insert tanpa foto
            if(!$this->upload->do_upload())
            {
                echo "tidak ada foto yang diupload";
            }
            else {

                // buat kondisi jika ada foto kk di replace
                if ($cek_file) {
                    $id=$cek_file->id_berkas_foto;
                    // update
                    $gbr=$this->upload->data();
                        $FOTO=$gbr['file_name'];

                        $data = array(
                            'id_karyawan' =>$this->input->post('id_karyawan'),
                            'nama_foto' =>$FOTO,
                            'id_type_berkas' =>$this->input->post('id_type_berkas')
                        );
                        $this->db->where('id_berkas_foto',$id);
                        $hasil =$this->db->update('file_berkas_karyawan', $data);
                        echo "Foto KK Berhasil Diperbaharui";
                    }else{
                        $gbr=$this->upload->data();
                        $FOTO=$gbr['file_name'];

                        $data = array(
                            'id_karyawan' =>$this->input->post('id_karyawan'),
                            'nama_foto' =>$FOTO,
                            'id_type_berkas' =>$this->input->post('id_type_berkas')
                        );
                        $hasil =$this->db->insert('file_berkas_karyawan', $data);
                         echo "Foto KK Berhasil Disimpan";
                    }       
                }
           
        
    }
    public function _validate_keluarga($method)
    {
        $idkaryawan = $this->input->post('idkaryawan', true);
        $idkel = $this->input->post('idkel', true);
        $namakel = $this->input->post('namakel', true);
        $nikkel = $this->input->post('nikkel', true);
        $tgllhrkel = $this->input->post('tgllhrkel', true);
        $hubkel = $this->input->post('hubkel', true);
        $jkkel = $this->input->post('jkkel', true);
        $penkel = $this->input->post('penkel', true);
        $kerjakel = $this->input->post('kerjakel', true);

        /*if ($method == 'add') {
            $u_nikkel = '|is_unique[karyawan_keluarga.nik_hubungan]';
        }*/
        /*} else {
            $dbdata = $this->M_karyawan->detail_keluarga($idkel)->row();
            $u_nikkel = $dbdata->nik_hubungan === $nikkel ? "" : "|is_unique[karyawan_keluarga.nik_hubungan]";
        }*/

        $this->form_validation->set_rules('nikkel', 'NIK', 'required|numeric|trim|min_length[12]|max_length[12]');
        $this->form_validation->set_rules('namakel', 'Nama', 'required|trim');
        $this->form_validation->set_rules('tgllhrkel', 'Tanggal Lahir', 'required|trim');
        $this->form_validation->set_rules('jkkel', 'Jenis Kelamin', 'required');
        $this->form_validation->set_rules('penkel', 'Pendidikan', 'required');
        $this->form_validation->set_rules('kerjakel', 'Pekerjaan', 'required');

        $this->form_validation->set_message('required', 'Kolom {field} wajib diisi');

    }

    public function ubah_keluarga($idkeluarga)
    {

        if ($this->session->userdata('status') != true) {
            redirect(base_url("all/login"));
        }

        $akseslembaga = $this->session->userdata('akseslembaga');
        $idlembaga = $this->session->userdata('idlembaga');

        //Jika akses antar lemmbaga
        if ($akseslembaga == 'Y') {
            $idlembaga = 'all';
        }

        $data['datakeluarga'] = $this->M_karyawan->detail_keluarga($idkeluarga);
        $data['combolembaga'] = $this->M_combo->combolembaga($idlembaga);
        $data['combogoldarah'] = $this->M_combo->combogoldarah();
        $data['combonikah'] = $this->M_combo->combonikah();
        $data['combostskaryawan'] = $this->M_combo->combostatuskaryawan();
        $data['combounitkerja'] = $this->M_combo->combounitkerja();
        $data['combostskerja'] = $this->M_combo->combostatuskerja();
        $data['comboststinggal'] = $this->M_combo->combostatustinggal();
        $data['combopekerjaan'] = $this->M_combo->combopekerjaan();
        $data['combopendidikan'] = $this->M_combo->combopendidikan();
        $data['combohubungan'] = $this->M_combo->combohubungan();
        $data['modal'] = true;
        $data['content'] = 'karyawan/keluarga/v_keluarga_modal_edit';
        $this->load->view('layout/main', $data);

    }

    public function update_keluarga()
    {

        if ($this->session->userdata('status') != true) {
            redirect(base_url("all/login"));
        }

        $method = $this->input->post('method');
        $this->_validate_keluarga($method); // vali

        if ($this->form_validation->run() == false) {
            $data = [
                'status' => false,
                'errors' => [
                    'nikkel' => form_error('nikkel'),
                    'namakel' => form_error('namakel'),
                    'tgllhrkel' => form_error('tgllhrkel'),
                    'jkkel' => form_error('jkkel'),
                    'hubkel' => form_error('hubkel'),
                    'penkel' => form_error('penkel'),
                    'kerjakel' => form_error('kerjakel'),
                ],
            ];
            $this->output_json($data);
        } else {

            $idkaryawan = $this->input->post('idkaryawan');
            $idkel = $this->input->post('idkel');
            $namakel = $this->input->post('namakel');
            $nikkel = $this->input->post('nikkel');
            $tgllhrkel = $this->input->post('tgllhrkel');
            $hubkel = $this->input->post('hubkel');
            $jkkel = $this->input->post('jkkel');
            $penkel = $this->input->post('penkel');
            $kerjakel = $this->input->post('kerjakel');

            $data = array(
                'nama_keluarga' => $namakel,
                'id_pendidikan' => $penkel,
                'id_pekerjaan' => $kerjakel,
                'id_hubungan' => $hubkel,
                'tgl_lahir' => $this->M_karyawan->rubah_tglformat($tgllhrkel),
                'nik_hubungan' => $nikkel,
                'jenis_kelamin' => $jkkel);

            $hasil = $this->M_karyawan->ubah_keluarga($idkel, $data);

    
            if ($hasil == true) {
                $this->output_json(['status' => true]);
            } else {
                $this->output_json(['status' => false]);
            }
        }

    }

    public function hapus_keluarga($id)
    {

        if ($this->session->userdata('status') != true) {
            redirect(base_url("all/login"));
        }

        $hasil = $this->M_karyawan->hapus_keluarga($id);
        if ($hasil == true) {
            $this->output_json(['status' => true]);
        } else {
            $this->output_json(['status' => false]);
        }
    }

/* END TAB KELUARGA */

    public function tampil_combo_karyawan()
    {
        $idlembaga = $this->input->post('idlembaga');
        $idunitkerja = $this->input->post('idunitkerja');
        echo $this->M_karyawan->tampil_combo_karyawan($idlembaga, $idunitkerja);
    }

    public function datajsonabsen($id)
    {
        $this->output_json($this->M_karyawan->getHistoriAbsen($id), false);
    }

    public function datajsonabsenpola($id)
    {
        $this->output_json($this->M_karyawan->getPolaAbsen($id), false);
    }


    function ubah_password()
        {

            $id = $this->input->post('idkaryawan');
            $pin =$this->input->post('pin');

            $data = array('pin' => $pin);

            $this->M_karyawan->reset_pin($id, $data);
            echo $this->session->set_flashdata('msg', 'success');
            redirect('kepegawaian/karyawan');
        }

    // Upload dokumen foto karyawan    
    //Untuk proses upload foto
    function proses_upload(){ 

        $config['upload_path']   = FCPATH.'/upload-foto/';
        $config['allowed_types'] = 'gif|jpg|png|ico';
        $this->load->library('upload',$config);
        if($this->upload->do_upload('userfile')){
            $id_karyawan=$this->input->post('idkaryawan');
            $nama=$this->upload->data('file_name');
            $data=array(
                'id_karyawan'=>$id_karyawan,
                'nama_foto'=>$nama);
            $this->db->insert('foto_berkas_karyawan',$data);
        }
    }


    //Untuk menghapus foto
    function remove_foto(){

        //Ambil token foto
        $id_karyawan=$this->input->post('id_karyawan');

        
        $foto=$this->db->get_where('foto_berkas_karyawan',array('id_karyawan'=>$id_karyawan));


        if($foto->num_rows()>0){
            $hasil=$foto->row();
            $nama_foto=$hasil->nama_foto;
            if(file_exists($file=FCPATH.'/upload-foto/'.$nama_foto)){
                unlink($file);
            }
            $this->db->delete('foto_berkas_karyawan',array('id_karyawan'=>$id_karyawan));

        }


        echo "{}";
    }


    

}
