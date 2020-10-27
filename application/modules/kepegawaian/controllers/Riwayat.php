<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Riwayat extends MX_Controller
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

     public function datajson($nip)
    {
        $this->output_json($this->M_karyawan->getDataRiwayat($nip), false);
    }

    public function tambah($id, $nip)
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
        $data['data'] = $this->M_karyawan->data_riwayat($nip);
        $data['modal'] = true;
        $data['content'] = 'karyawan/riwayat/v_modal_add';
        $this->load->view('layout/main', $data);
    }

    public function lihat($id)
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

        $data['data'] = $this->M_karyawan->detail_riwayat($id);
        $data['modal'] = true;
        $data['content'] = 'karyawan/riwayat/v_modal_view';
        $this->load->view('layout/main', $data);

    }

    public function simpan()
    {
        if ($this->session->userdata('status') != true) {
            redirect(base_url("all/login"));
        }
        $method = $this->input->post('method');
        $this->_validate($method); // validasi
        if ($this->form_validation->run() == false) {
            $data = [
                'status' => false,
                'errors' => [
                'namaperusahaan' => form_error('namaperusahaan'),
                     'jabatan' => form_error('jabatan'),
                ],
            ];
            $this->output_json($data);
        } else {
            $idkaryawan = $this->input->post('idkaryawan');
            $nipkaryawan = $this->input->post('nipkaryawan');
            $namaperusahaan = $this->input->post('namaperusahaan');
            $jabatan = $this->input->post('jabatan');
            $gaji = $this->input->post('gaji');
            $tahunmasuk = $this->input->post('tahunmasuk');
            $tahunkeluar = $this->input->post('tahunkeluar');
            $data = array(
                'nip_karyawan' => $nipkaryawan,
                'id_karyawan' => $idkaryawan,
                'nama_perusahaan' => $namaperusahaan,
                'gaji' => $gaji,
                'jabatan' => $jabatan,
                'tahun_awal' => $tahunmasuk,
                'tahun_akhir' => $tahunkeluar,
            );
            $hasil = $this->M_karyawan->simpan_riwayat($data);
            if ($hasil == true) {
                $this->output_json(['status' => true]);
            } else {
                $this->output_json(['status' => false]);
            }
            }
            
    }

    public function ubah($id)
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

        $data['data'] = $this->M_karyawan->detail_riwayat($id);
        $data['combolembaga'] = $this->M_combo->combolembaga($idlembaga);
        $data['combojabatan'] = $this->M_combo->combojabatan();
        $data['combounitkerja'] = $this->M_combo->combounitkerja();
        $data['modal'] = true;
        $data['content'] = 'karyawan/riwayat/v_modal_edit';
        $this->load->view('layout/main', $data);

    }

    public function update()
    {
         if ($this->session->userdata('status') != true) {
            redirect(base_url("all/login"));
        }

        $method = $this->input->post('method');
        $this->_validate($method); // validasi

        if ($this->form_validation->run() == false) {
            $data = [
                'status' => false,
                'errors' => [
                    'namaperusahaan' => form_error('namaperusahaan'),
                     'jabatan' => form_error('jabatan'),
                ],
            ];
            $this->output_json($data);
        } else {
            $idriwayat = $this->input->post('idriwayat');
            $nipkaryawan = $this->input->post('nipkaryawan');
            $namaperusahaan = $this->input->post('namaperusahaan');
            $jabatan = $this->input->post('jabatan');
            $gaji = $this->input->post('gaji');
            $tahunmasuk = $this->input->post('tahunmasuk');
            $tahunkeluar = $this->input->post('tahunkeluar');

            $data = array(
                'nama_perusahaan' => $namaperusahaan,
                'gaji' => $gaji,
                'jabatan' => $jabatan,
                'tahun_awal' => $tahunmasuk,
                'tahun_akhir' => $tahunkeluar,
            );

                $hasil = $this->M_karyawan->ubah_riwayat($idriwayat,$data);
                if ($hasil == true) {
                    $this->output_json(['status' => true]);
                } else {
                    $this->output_json(['status' => false]);
                }
            }
        
    }

    public function hapus($id)
    {
        if ($this->session->userdata('status') != true) {
            redirect(base_url("all/login"));
        }
        $hasil = $this->M_karyawan->hapus_riwayat($id);
        if ($hasil == true) {
            $this->output_json(['status' => true]);
        } else {
            $this->output_json(['status' => false]);
        }
    }

     public function _validate($method)
    {
        $namaperusahaan = $this->input->post('namaperusahaan',true);
        $jabatan = $this->input->post('jabatan',true);
        $this->form_validation->set_rules('namaperusahaan', 'Nama Perusahaan', 'required|trim');
        $this->form_validation->set_rules('jabatan', 'Jabatan', 'required|trim');
        $this->form_validation->set_message('required', 'Kolom {field} wajib diisi');
    }


}
