<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('all/M_departemen');
        $this->load->model('M_karyawan');
        $this->load->model('M_absen');
        $this->load->model('all/M_combo');
    }

    public function output_json($data, $encode = true)
    {
        if ($encode) {
            $data = json_encode($data);
        }
        $this->output->set_content_type('application/json')->set_output($data);
    }

    //tambah data

    public function data_ijin()
    {

        if ($this->session->userdata('status') != true) {
            redirect(base_url("all/login"));
        }

        $akseslembaga = $this->session->userdata('akseslembaga');
        $idlembaga = $this->session->userdata('idlembaga');
        $data['header'] = 'layout/header';
        $data['topbar'] = 'layout/topbar';
        $data['sidebar'] = 'layout/sidebar';
        $data['content'] = 'profile/v_ijin';
        $data['js'] = 'layout/js';
        $data['jscontent'] = 'profile/jscontent';
        $data['footer'] = 'layout/footer';
        $this->load->view('layout/main', $data);
    }

    public function tambah_ijin()
    {

        if ($this->session->userdata('status') != true) {
            redirect(base_url("all/login"));
        }

        $akseslembaga = $this->session->userdata('akseslembaga');
        $idlembaga = $this->session->userdata('idlembaga');

        $data['header'] = 'layout/header';
        $data['topbar'] = 'layout/topbar';
        $data['sidebar'] = 'layout/sidebar';
        $data['content'] = 'profile/v_add_ijin';
        $data['js'] = 'layout/js';
        $data['jscontent'] = 'profile/jscontent';
        $data['footer'] = 'layout/footer';
        $this->load->view('layout/main', $data);

    }

    public function simpan_ijin()
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

    public function ubah_pengajuan_absen($id)
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

    //ubah data pokok karyawan
    public function update_pengajuan_absen()
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


}
