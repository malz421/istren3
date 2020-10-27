<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Seminar extends MX_Controller
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
        $this->output_json($this->M_karyawan->getDataSeminar($nip), false);
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
        $data['data'] = $this->M_karyawan->data_seminar($nip);
        $data['combolembaga'] = $this->M_combo->combolembaga($idlembaga);
        $data['combojabatan'] = $this->M_combo->combojabatan();
        $data['combounitkerja'] = $this->M_combo->combounitkerja();

        $data['modal'] = true;
        $data['content'] = 'karyawan/seminar/v_modal_add';
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

        $data['data'] = $this->M_karyawan->detail_seminar($id);
        $data['combolembaga'] = $this->M_combo->combolembaga($idlembaga);
        $data['combojabatan'] = $this->M_combo->combojabatan();
        $data['combounitkerja'] = $this->M_combo->combounitkerja();

        $data['modal'] = true;
        $data['content'] = 'karyawan/seminar/v_modal_view';
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
                'namaseminar' => form_error('namaseminar'),
                'penyelenggaraseminar' => form_error('penyelenggaraseminar'),
                ],
            ];
            $this->output_json($data);
        } else {
            $idkaryawan = $this->input->post('idkaryawan');
            $nipkaryawan = $this->input->post('nipkaryawan');
            $namaseminar = $this->input->post('namaseminar');
            $penyelenggaraseminar = $this->input->post('penyelenggaraseminar');
            $tempatseminar = $this->input->post('tempatseminar');
            $tglawalseminar = $this->input->post('tglawalseminar');
            $tglakhirseminar = $this->input->post('tglakhirseminar');
            $url = $this->input->post('urlpic');

            $config['upload_path'] = './storage/photo/karyawan/';
            $config['allowed_types'] = 'jpeg|gif|jpg|png';
            $config['overwrite'] = true;
            $config['encrypt_name'] = true;
            //$config['file_name'] = "logo-".$iddepartemen ;
            $this->load->library('upload', $config);

            if (!empty($_FILES['urlpic']['name'])) {
                if ($this->upload->do_upload('urlpic')) {
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

                    $data = array(
                        'nip_karyawan' => $nipkaryawan,
                        'id_karyawan' => $idkaryawan,
                        'nama_seminar' => $namaseminar,
                        'penyelenggara' => $penyelenggaraseminar,
                        'tempat_seminar' => $tempatseminar,
                        'tgl_awal_seminar' => $this->M_karyawan->rubah_tglformat($tglawalseminar),
                        'tgl_akhir_seminar' => $this->M_karyawan->rubah_tglformat($tglakhirseminar),
                        'url_sertifikat' => $url,
                    );

                    $hasil = $this->M_karyawan->simpan_seminar($data);

                    if ($hasil == true) {
                        $this->output_json(['status' => true]);
                    } else {
                        $this->output_json(['status' => false,'err' => $this->upload->display_errors()]);
                    }

                } 
                else {
                
                    $this->output_json(['status' => false,'erk' => $this->upload->display_errors()]);
                }
                
            }
            else
            {
                    $data = array(
                        'nip_karyawan' => $nipkaryawan,
                        'id_karyawan' => $idkaryawan,
                        'nama_seminar' => $namaseminar,
                        'penyelenggara' => $penyelenggaraseminar,
                        'tempat_seminar' => $tempatseminar,
                        'tgl_awal_seminar' => $this->M_karyawan->rubah_tglformat($tglawalseminar),
                        'tgl_akhir_seminar' => $this->M_karyawan->rubah_tglformat($tglakhirseminar),
                    );

                    $hasil = $this->M_karyawan->simpan_seminar($data);
                    if ($hasil == true) {
                        $this->output_json(['status' => true]);
                    } else {
                        $this->output_json(['status' => false]);
                    }
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

        $data['data'] = $this->M_karyawan->detail_seminar($id);
        $data['combolembaga'] = $this->M_combo->combolembaga($idlembaga);
        $data['combojabatan'] = $this->M_combo->combojabatan();
        $data['combounitkerja'] = $this->M_combo->combounitkerja();
        $data['modal'] = true;
        $data['content'] = 'karyawan/seminar/v_modal_edit';
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
                'namaseminar' => form_error('namaseminar'),
                'penyelenggaraseminar' => form_error('penyelenggaraseminar'),
                ],
            ];
            $this->output_json($data);
        } else {
            $idkaryawan = $this->input->post('idkaryawan');
            $nipkaryawan = $this->input->post('nipkaryawan');
            $idseminar = $this->input->post('idseminar');
            $namaseminar = $this->input->post('namaseminar');
            $penyelenggaraseminar = $this->input->post('penyelenggaraseminar');
            $tempatseminar = $this->input->post('tempatseminar');
            $tglawalseminar = $this->input->post('tglawalseminar');
            $tglakhirseminar = $this->input->post('tglakhirseminar');
            $url = $this->input->post('urlpic');


            $config['upload_path'] = './storage/photo/karyawan/';
            $config['allowed_types'] = 'jpeg|gif|jpg|png';
            $config['overwrite'] = true;
            $config['encrypt_name'] = true;
            //$config['file_name'] = "logo-".$iddepartemen ;
            $this->load->library('upload', $config);

            if (!empty($_FILES['urlpic']['name'])) {
                if ($this->upload->do_upload('urlpic')) {
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

                   $data = array(
                        'nama_seminar' => $namaseminar,
                        'penyelenggara' => $penyelenggaraseminar,
                        'tempat_seminar' => $tempatseminar,
                        'tgl_awal_seminar' => $this->M_karyawan->rubah_tglformat($tglawalseminar),
                        'tgl_akhir_seminar' => $this->M_karyawan->rubah_tglformat($tglakhirseminar),
                        'url_sertifikat' => $url,
                    );


                    $hasil = $this->M_karyawan->ubah_seminar($idseminar,$data);

                    if ($hasil == true) {
                        $this->output_json(['status' => true]);
                    } else {
                        $this->output_json(['status' => false,'err' => $this->upload->display_errors()]);
                    }

                } 
                else {
                
                    $this->output_json(['status' => false,'erk' => $this->upload->display_errors()]);
                }
                
            }
            else
            {
                $data = array(
                    'nama_seminar' => $namaseminar,
                    'penyelenggara' => $penyelenggaraseminar,
                    'tempat_seminar' => $tempatseminar,
                    'tgl_awal_seminar' => $this->M_karyawan->rubah_tglformat($tglawalseminar),
                    'tgl_akhir_seminar' => $this->M_karyawan->rubah_tglformat($tglakhirseminar),
                );

                $hasil = $this->M_karyawan->ubah_seminar($idseminar,$data);
                if ($hasil == true) {
                    $this->output_json(['status' => true]);
                } else {
                    $this->output_json(['status' => false]);
                }
            }
        }
    }

    public function hapus($id)
    {
        if ($this->session->userdata('status') != true) {
            redirect(base_url("all/login"));
        }
        $hasil = $this->M_karyawan->hapus_seminar($id);
        if ($hasil == true) {
            $this->output_json(['status' => true]);
        } else {
            $this->output_json(['status' => false]);
        }
    }

     public function _validate($method)
    {
  
        $namaseminar = $this->input->post('namaseminar',true);
        $penyelenggaraseminar = $this->input->post('penyelenggaraseminar', true);
        $this->form_validation->set_rules('namaseminar', 'Nama Seminar', 'required|trim');
        $this->form_validation->set_rules('penyelenggaraseminar', 'Penyelenggara Seminar', 'required|trim');
        $this->form_validation->set_message('required', 'Kolom {field} wajib diisi');
    }


}
