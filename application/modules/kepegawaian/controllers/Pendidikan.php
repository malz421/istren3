<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pendidikan extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('all/M_departemen');
        $this->load->model('M_karyawan');
        $this->load->model('all/M_combo');

    }


  public function output_json($data, $encode = true)
    {

        if ($encode) {
            $data = json_encode($data);
        }

		$this->output->set_content_type('application/json')->set_output($data);
		
    }

 
     public function datajsonpendidikan($nip)
    {
        $this->output_json($this->M_karyawan->getDataPendidikan($nip), false);
    }

    public function tambah_pendidikan($id, $nip)
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
        $data['datapendidikan'] = $this->M_karyawan->data_pendidikan($nip);
        $data['combolembaga'] = $this->M_combo->combolembaga($idlembaga);
        $data['combopendidikan'] = $this->M_combo->combopendidikan();


        $data['modal'] = true;
        $data['content'] = 'karyawan/pendidikan/v_pendidikan_modal_add';
        $this->load->view('layout/main', $data);
    }

    public function lihat_pendidikan($id)
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

        $data['datapendidikan'] = $this->M_karyawan->detail_pendidikan($id);
        $data['combolembaga'] = $this->M_combo->combolembaga($idlembaga);
        $data['combopendidikan'] = $this->M_combo->combopendidikan();
        $data['modal'] = true;
        $data['content'] = 'karyawan/pendidikan/v_pendidikan_modal_view';
        $this->load->view('layout/main', $data);

    }

    public function simpan_pendidikan()
    {
        if ($this->session->userdata('status') != true) {
            redirect(base_url("all/login"));
        }

        $method = $this->input->post('method');

        $this->_validate_pendidikan($method); // validasi

        if ($this->form_validation->run() == false) {
            $data = [
                'status' => false,
                'errors' => [
                    'namasekolah' => form_error('namasekolah'),
                    'thnmasuk' => form_error('thnmasuk'),
                    'thnlulus' => form_error('thnlulus'),
                ],
            ];
            $this->output_json($data);
        } else {

            $idkaryawan = $this->input->post('idkaryawan');
            $nipkaryawan = $this->input->post('nipkaryawan');
            $idpendidikan = $this->input->post('idpendidikan');
            $namasekolah = $this->input->post('namasekolah');
            $tahunmasuk = $this->input->post('thnmasuk');
            $tahunlulus = $this->input->post('thnlulus');
            $ketsekolah = $this->input->post('ketsekolah');
            $jurusan = $this->input->post('jurusan');

        

            $data = array(
                'nip_karyawan' => $nipkaryawan,
                'nama_sekolah' => $namasekolah,
                'id_karyawan' => $idkaryawan,
                'id_pendidikan' => $idpendidikan,
                'tahun_masuk' => $tahunmasuk,
                'tahun_lulus' => $tahunlulus,
                'keterangan_sekolah' => $ketsekolah,
                'jurusan' => $jurusan
            );

            $hasil = $this->M_karyawan->simpan_pendidikan($data);

            if ($hasil == true) {
                $this->output_json(['status' => true]);
            } else {
                $this->output_json(['status' => false]);
            }
        }

    }

    public function _validate_pendidikan($method)
    {
       
       
        $namasekolah = $this->input->post('namasekolah',true);
        $tahunmasuk = $this->input->post('thnmasuk',true);
        $tahunlulus = $this->input->post('thnlulus',true);
     

        $this->form_validation->set_rules('namasekolah', 'Nama Sekolah', 'required|trim');
        $this->form_validation->set_rules('thnmasuk', 'Tahun Masuk', 'required|numeric');
        $this->form_validation->set_rules('thnlulus', 'Tahun Lulus', 'required|numeric');

        $this->form_validation->set_message('required', 'Kolom {field} wajib diisi');
      
    }

    public function ubah_pendidikan($id)
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

        $data['datapendidikan'] = $this->M_karyawan->detail_pendidikan($id);
        $data['combolembaga'] = $this->M_combo->combolembaga($idlembaga);
        $data['combopendidikan'] = $this->M_combo->combopendidikan();
        $data['modal'] = true;
        $data['content'] = 'karyawan/pendidikan/v_pendidikan_modal_edit';
        $this->load->view('layout/main', $data);

    }

    public function update_pendidikan()
    {

        if ($this->session->userdata('status') != true) {
            redirect(base_url("all/login"));
        }

        $method = $this->input->post('method');
        $this->_validate_pendidikan($method); // vali

         if ($this->form_validation->run() == false) {
            $data = [
                'status' => false,
                'errors' => [
                    'namasekolah' => form_error('namasekolah'),
                    'thnmasuk' => form_error('thnmasuk'),
                    'thnlulus' => form_error('thnlulus'),
                ],
            ];
            $this->output_json($data);
        } else {

            $idsekolah = $this->input->post('idsekolah');
            $namasekolah = $this->input->post('namasekolah');
            $idpendidikan = $this->input->post('idpendidikan');
            $tahunmasuk = $this->input->post('thnmasuk');
            $tahunlulus = $this->input->post('thnlulus');
            $ketsekolah = $this->input->post('ketsekolah');
            $jurusan = $this->input->post('jurusan');

            $data = array(
                'nama_sekolah' => $namasekolah,
                'jurusan' => $jurusan,
                'id_pendidikan' => $idpendidikan,
                'tahun_masuk' => $tahunmasuk,
                'tahun_lulus' => $tahunlulus,
                'Keterangan_sekolah' => $ketsekolah);

            $hasil = $this->M_karyawan->ubah_pendidikan($idsekolah, $data);


            if ($hasil == true) {
                $this->output_json(['status' => true]);
            } else {
                $this->output_json(['status' => false]);
            }
        }

    }

    public function hapus_pendidikan($id)
    {
        if ($this->session->userdata('status') != true) {
            redirect(base_url("all/login"));
        }
       
        $hasil = $this->M_karyawan->hapus_pendidikan($id);
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

}
