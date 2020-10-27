<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Diklat extends MX_Controller
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
        $this->output_json($this->M_karyawan->getDataDiklat($nip), false);
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
        $data['data'] = $this->M_karyawan->data_diklat($nip);
        $data['combolembaga'] = $this->M_combo->combolembaga($idlembaga);
        $data['combojabatan'] = $this->M_combo->combojabatan();
        $data['combounitkerja'] = $this->M_combo->combounitkerja();

        $data['modal'] = true;
        $data['content'] = 'karyawan/diklat/v_modal_add';
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

        $data['data'] = $this->M_karyawan->detail_diklat($id);
        $data['combolembaga'] = $this->M_combo->combolembaga($idlembaga);
        $data['combojabatan'] = $this->M_combo->combojabatan();
        $data['combounitkerja'] = $this->M_combo->combounitkerja();

        $data['modal'] = true;
        $data['content'] = 'karyawan/diklat/v_modal_view';
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
                'namadiklat' => form_error('namadiklat'),
                ],
            ];
            $this->output_json($data);
        } else {
            $idkaryawan = $this->input->post('idkaryawan');
            $nipkaryawan = $this->input->post('nipkaryawan');
            $namadiklat = $this->input->post('namadiklat');
            $penyelenggaradiklat = $this->input->post('penyelenggaradiklat');
            $tempatdiklat = $this->input->post('tempatdiklat');
            $tahundiklat = $this->input->post('tahundiklat');
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
                        'nama_diklat' => $namadiklat,
                        'penyelenggara_diklat' => $penyelenggaradiklat,
                        'tempat_diklat' => $tempatdiklat,
                        'tahun_diklat' => $tahundiklat,
                        'url_sertifikat' => $url,
                    );

                    $hasil = $this->M_karyawan->simpan_diklat($data);

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
                        'nama_diklat' => $namadiklat,
                        'tempat_diklat' => $tempatdiklat,
                        'tahun_diklat' => $tahundiklat,
                    );

                    $hasil = $this->M_karyawan->simpan_diklat($data);
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

        $data['data'] = $this->M_karyawan->detail_diklat($id);
        $data['combolembaga'] = $this->M_combo->combolembaga($idlembaga);
        $data['combojabatan'] = $this->M_combo->combojabatan();
        $data['combounitkerja'] = $this->M_combo->combounitkerja();
        $data['modal'] = true;
        $data['content'] = 'karyawan/diklat/v_modal_edit';
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
                    'namadiklat' => form_error('namadiklat'),
                ],
            ];
            $this->output_json($data);
        } else {
            $idkaryawan = $this->input->post('idkaryawan');
            $iddiklat = $this->input->post('iddiklat');
            $nipkaryawan = $this->input->post('nipkaryawan');
            $namadiklat = $this->input->post('namadiklat');
            $tempatdiklat = $this->input->post('tempatdiklat');
            $penyelenggaradiklat = $this->input->post('penyelenggaradiklat');
            $tahundiklat = $this->input->post('tahundiklat');
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
                        'nama_diklat' => $namadiklat,
                        'penyelenggara_diklat' =>  $penyelenggaradiklat,
                        'tempat_diklat' => $tempatdiklat,
                        'tahun_diklat' => $tahundiklat,
                        'url_sertifikat' => $url,
                    );


                    $hasil = $this->M_karyawan->ubah_diklat($iddiklat,$data);

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
                    'nama_diklat' => $namadiklat,
                    'penyelenggara_diklat' => $penyelenggaradiklat,
                    'tempat_diklat' => $tempatdiklat,
                    'tahun_diklat' => $tahundiklat,
                );

                $hasil = $this->M_karyawan->ubah_diklat($iddiklat,$data);
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
        $hasil = $this->M_karyawan->hapus_diklat($id);
        if ($hasil == true) {
            $this->output_json(['status' => true]);
        } else {
            $this->output_json(['status' => false]);
        }
    }

     public function _validate($method)
    {
  
        $namadiklat = $this->input->post('namadiklat',true);
        $this->form_validation->set_rules('namadiklat', 'Nama Diklat', 'required|trim');
        $this->form_validation->set_message('required', 'Kolom {field} wajib diisi');
    }


}
