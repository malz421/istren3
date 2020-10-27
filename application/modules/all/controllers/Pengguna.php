<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengguna extends MX_Controller {

  public function __construct()
  {
	parent::__construct();
	
	$this->load->library('upload');
    $this->load->model('M_pengguna');
	$this->load->model('M_combo');
  }

function index(){

		if($this->session->userdata('status') != TRUE){
				redirect(base_url("all/login"));
		}

		$akseslembaga = $this->session->userdata('akseslembaga');
		$idlembaga = $this->session->userdata('idlembaga');
		$aksesdepartemen = $this->session->userdata('aksesdepartemen');
		$idepartemen = $this->session->userdata('iddepartemen');
		
		
		//Jika akses antar lemmbaga 
		if ($akseslembaga == 'Y'){
			$idlembaga = 'all';
		}

		if ($aksesdepartemen == 'Y'){
			$idepartmen = 'all';
		}
	
		$data['combolembaga'] = $this->M_combo->combolembaga($idlembaga);
		$data['datapengguna']=$this->M_pengguna->get_all_pengguna();
		$data['combopengguna']=$this->M_combo->combopengguna();
		$data['comboakses'] = $this->M_combo->combohakakses();
		$data['header'] = 'layout/header';
		$data['topbar'] = 'layout/topbar';
		$data['sidebar'] = 'layout/sidebar';
		$data['content'] = 'pengguna/v_pengguna';
		$data['js'] = 'layout/js';
		$data['jscontent'] = 'pengguna/jscontent';
		$data['footer'] = 'layout/footer';
		$this->load->view('layout/main', $data);
	
	}

    function tambah_pengguna(){

		

		if($this->session->userdata('status') != TRUE){
			redirect(base_url("all/login"));
		}

		$akseslembaga = $this->session->userdata('akseslembaga');
		$idlembaga = $this->session->userdata('idlembaga');
		$aksesdepartemen = $this->session->userdata('aksesdepartemen');
		$idepartemen = $this->session->userdata('iddepartemen');
		
		
		//Jika akses antar lemmbaga 
		if ($akseslembaga == 'Y'){
			$idlembaga = 'all';
		}

		if ($aksesdepartemen == 'Y'){
			$idepartmen = 'all';
		}
	
		$data['combolembaga'] = $this->M_combo->combolembaga($idlembaga);
		$data['datapengguna']=$this->M_pengguna->get_all_pengguna();
		$data['combopengguna']=$this->M_combo->combopengguna();
		$data['comboakses'] = $this->M_combo->combohakakses();
		$data['header'] = 'layout/header';
		$data['topbar'] = 'layout/topbar';
		$data['sidebar'] = 'layout/sidebar';
		$data['content'] = 'pengguna/v_add_pengguna';
	    $data['js'] = 'layout/js';
        $data['jscontent'] = 'pengguna/jscontent';
		$data['footer'] = 'layout/footer';
		$this->load->view('layout/main', $data);
	
	}
	
	function simpan_pengguna(){


				$this->form_validation->set_rules('username','USERNAME', 'trim|required|max_length[17]|is_unique[user_admin.user_name]',['required'=>'User Name Harus Diisi!','is_unique'=>'Username sudah ada,gunakan yang lain.']);
				$this->form_validation->set_rules('pin','pin', 'trim|required|min_length[6]|max_length[6]',['min_length'=>'Jumlah Karakter kurang dari 6','numeric'=>'pin harus angka','required'=>'PIN Harus Diisi!']);
				$this->form_validation->set_rules('password','password', 'trim|required|min_length[6]',['min_length'=>'Jumlah Karakter kurang dari 6','numeric'=>'pin harus angka','required'=>'Password Harus Diisi!']);

				if ($this->form_validation->run()==true)
				{
					$config['upload_path'] = './assets/images/'; //path folder
					$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
					$config['encrypt_name'] = TRUE; //nama yang terupload nantinya

					$this->upload->initialize($config);
					if(!empty($_FILES['filefoto']['name']))
					{
						if ($this->upload->do_upload('filefoto'))
						{
								$gbr = $this->upload->data();
								//Compress Image
								$config['image_library']='gd2';
								$config['source_image']='./assets/images/'.$gbr['file_name'];
								$config['create_thumb']= FALSE;
								$config['maintain_ratio']= FALSE;
								$config['quality']= '60%';
								$config['width']= 300;
								$config['height']= 300;
								$config['new_image']= './assets/images/'.$gbr['file_name'];
								$this->load->library('image_lib', $config);
								$this->image_lib->resize();

								$gambar=$gbr['file_name'];
								$nikpengguna=$this->input->post('nikpengguna');
								$idlembaga=$this->input->post('idlembaga');
								$idrole = $this->input->post('idrole');
								$username=$this->input->post('username');
								$password=password_hash($this->input->post('password'),PASSWORD_DEFAULT);
								$pin= $this->input->post('pin');
								
								$datamenu = array(
													'nip_karyawan' => $nikpengguna,
													'id_lembaga' => $idlembaga,
													'user_name' => $username,
													'id_role' => $idrole,
													'pass'=> $password,
													'pin'=> $pin
								);
								$this->M_pengguna->ubah_pengguna($nikpengguna,$datamenu);
								echo $this->session->set_flashdata('msg','success');
								redirect('all/pengguna');
				
						}else{
							
							echo $this->session->set_flashdata('msg','warning');
							redirect('all/pengguna');
						}
						
					}else{
		
						$nikpengguna=$this->input->post('nikpengguna');
						$idlembaga=$this->input->post('idlembaga');
						$username=$this->input->post('username');
						$idrole = $this->input->post('idrole');
						$password=password_hash($this->input->post('password'),PASSWORD_DEFAULT);
						$pin= $this->input->post('pin');
						$datamenu = array(
											'id_karyawan' => $nikpengguna,
											'id_lembaga' => $idlembaga,
											'user_name' => $username,
											'id_role' => $idrole,
											'pass'=> $password,
											'pin'=> $pin
						);
						$this->M_pengguna->simpan_pengguna($datamenu);
						echo $this->session->set_flashdata('msg','success');
						redirect('all/pengguna');
					} 
				}
				else
				{
					$akseslembaga = $this->session->userdata('akseslembaga');
					$idlembaga = $this->session->userdata('idlembaga');
					$aksesdepartemen = $this->session->userdata('aksesdepartemen');
					$idepartemen = $this->session->userdata('iddepartemen');
					
					
					//Jika akses antar lemmbaga 
					if ($akseslembaga == 'Y'){
						$idlembaga = 'all';
					}
			
					if ($aksesdepartemen == 'Y'){
						$idepartmen = 'all';
					}
				
					$data['combolembaga'] = $this->M_combo->combolembaga($idlembaga);
					$data['datapengguna']=$this->M_pengguna->get_all_pengguna();
					$data['combopengguna']=$this->M_combo->combopengguna();
					$data['comboakses'] = $this->M_combo->combohakakses();
					$data['header'] = 'layout/header';
					$data['topbar'] = 'layout/topbar';
					$data['sidebar'] = 'layout/sidebar';
					$data['content'] = 'pengguna/v_add_pengguna';
					$data['js'] = 'layout/js';
					$data['jscontent'] = 'pengguna/jscontent';
					$data['footer'] = 'layout/footer';
					$this->load->view('layout/main', $data);
				}

	}


	function ubah_pengguna($kode){


		if($this->session->userdata('status') != TRUE){
			redirect(base_url("all/login"));
		}

		$akseslembaga = $this->session->userdata('akseslembaga');
		$idlembaga = $this->session->userdata('idlembaga');
		$aksesdepartemen = $this->session->userdata('aksesdepartemen');
		$idepartemen = $this->session->userdata('iddepartemen');
		
		
		//Jika akses antar lemmbaga 
		if ($akseslembaga == 'Y'){
			$idlembaga = 'all';
		}

		if ($aksesdepartemen == 'Y'){
			$idepartmen = 'all';
		}
	
		$data['combolembaga'] = $this->M_combo->combolembaga($idlembaga);
		$data['datapengguna']=$this->M_pengguna->get_pengguna($kode);
		$data['combopengguna']=$this->M_combo->combopengguna();
		$data['comboakses'] = $this->M_combo->combohakakses();
		$data['header'] = 'layout/header';
		$data['topbar'] = 'layout/topbar';
		$data['sidebar'] = 'layout/sidebar';
		$data['content'] = 'pengguna/v_edit_pengguna';
		$data['js'] = 'layout/js';
		$data['jscontent'] = 'pengguna/jscontent';
		$data['footer'] = 'layout/footer';
		$this->load->view('layout/main', $data);
	}


	function update_pengguna(){
				
					$kode=$this->input->post('kode');
					$idlembaga=$this->input->post('idlembaga');
					//$nikkaryawan = $this->input->post('nikpengguna');
					$username  =$this->input->post('username');
					$idrole = $this->input->post('idrole');
					$akseslembaga = $this->input->post('akseslembaga');

					$data = array(
										'id_role' => $idrole,
										'akses_antar_lembaga' => $akseslembaga,
					);
					$this->M_pengguna->ubah_pengguna($kode,$data);
					echo $this->session->set_flashdata('msg','success-hapus');
					redirect('all/pengguna');

	}



	function hapus_pengguna(){
		$kode=$this->input->post('kode');
		$userhapus = $this->session->userdata('usrname');
		$data = array(
							'user_hapus' => $userhapus,
							'sts_data' => 1,
							'tgl_hapus' => date('Y/m/d h:i:s')
		);
		$this->M_pengguna->hapus_pengguna($kode,$data);
	    echo $this->session->set_flashdata('msg','success-hapus');
	    redirect('all/pengguna');
	}

	function reset_password(){

		$id=$this->input->post('idpengguna');
		$pass=password_hash($this->input->post('password'),PASSWORD_DEFAULT);

		$data = array('pass' => $pass);

        $this->M_pengguna->reset_password($id,$data);
		echo $this->session->set_flashdata('msg','success');
	    redirect('all/pengguna');
   
	}

	function ubah_password_admin()
{

    $id = $this->input->post('idpengguna');
    $pass = password_hash($this->input->post('password'), PASSWORD_DEFAULT);

    $data = array('pass' => $pass);

    $this->M_pengguna->reset_password($id, $data);
    echo $this->session->set_flashdata('msg', 'success');
    redirect('all/admin_page');
}





	function edit_profile($idpengguna){
		{
			if ($this->session->userdata('status') != true) {
				redirect(base_url("all/login"));
			}
	
			$data['datapengguna'] = $this->M_pengguna->get_pengguna($idpengguna);

			$data['header'] = 'layout/header';
			$data['topbar'] = 'layout/topbar';
			$data['sidebar'] = 'layout/sidebar';
			$data['content'] = 'pengguna/v_ubah_profile';
			$data['js'] = 'layout/js';
			$data['jscontent'] = 'pengguna/jscontent';
			$data['footer'] = 'layout/footer';
			$this->load->view('layout/main', $data);
		}
	}


}