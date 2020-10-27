<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MX_Controller {

        public function __construct()
        {
            parent::__construct();
            $this->load->model('M_login');//load model admin
			$this->load->library('user_agent');
        
        }
        public function index()
        {
			If ($this->session->userdata('status')==TRUE){
				if ($this->session->userdata('role')=='admin'){
				$url = base_url('all/admin_page');
				}
				else{
					$url = base_url('all/user_page');
				}
				redirect($url);
			}
			else{
			 $this->load->view('v_admin_login'); //load  halaman awal 
			}
        }
    
        //login admin
        function cek_user()
		{
		
			// cek broser pengguna
			if ($this->agent->is_browser()){
			$agent = $this->agent->browser().' '.$this->agent->version();
			}elseif ($this->agent->is_mobile()){
				$agent = $this->agent->mobile();
			}else{
				$agent = 'Data user gagal di dapatkan';
			}
			
			//echo password_hash($_POST['password'], PASSWORD_DEFAULT);
			//echo password_hash($_POST['password'], PASSWORD_BCRYPT);
			//exit;
			
			//cek sistem operasi pengguna
		    $osuser = $this->agent->platform();
			
			//cek ip operasi pengguna
		    $ipuser = $this->input->ip_address();
			
            //ambil nilai username dan password
			$url = base_url('all/admin_page');
			$urluser = base_url('all/user_page');
			$role =strip_tags(stripslashes($this->input->post('comborole',TRUE)));
            $username=strip_tags(stripslashes($this->input->post('username',TRUE)));
            $password=strip_tags(stripslashes($this->input->post('password',TRUE)));
			//panggil model login_admin untuk cek user
			if ($role=='admin'){
						$checking = $this->M_login->login_admin($username,$password);
						//jika data ada
						if($checking->num_rows() > 0){
						
							$datalogin=$checking->row_array(); //admbil data user dari databas
							$level = $datalogin['id_role'];
							$namauser = $datalogin['nama_karyawan'];
							$pass = $datalogin['pass'];
							$pin =  $datalogin['pin'];
							$id = $datalogin['idpengguna'];

							if (password_verify($_POST['password'], $pass)){
									$datalogin=$checking->row_array(); //admbil data user dari databas
									$level = $datalogin['id_role'];
									$namauser = $datalogin['nama_karyawan'];
									$akseslembaga = $datalogin['akses_antar_lembaga'];
									$aksesdepartemen= $datalogin['akses_antar_departemen'];
									$iddepartemen= $datalogin['id_departemen'];
									$idlembaga = $datalogin['id_lembaga'];
									$id = $datalogin['idpengguna'];
									$data_session = array(
													'idpengguna' => $id,
													'usrname' => $username,
													'namauser' => $namauser,
													'idlembaga' => $idlembaga,
													'iddepartmen' => $iddepartemen,
													'role' => $role,
													'level'=> $level,
													'status' => TRUE,
													'app' => $agent,
													'osuser' => $osuser,
													'ipuser' => $ipuser,
													'ipuser' => $ipuser,
													'akseslembaga' => $akseslembaga,
													'aksesdepartemen' => $aksesdepartemen
													);
									$this->session->set_userdata($data_session);
									helper_log("login", "Login Berhasil");
									if($role=='admin'){
										redirect($url);
									}
									else{
										redirect($urluser);
									}
									
								} else {
									// login gagal
									if($_POST['password']==$pin)
									{
										$datalogin=$checking->row_array(); //admbil data user dari databas
										$level = $datalogin['id_role'];
										$namauser = $datalogin['nama_karyawan'];
										$akseslembaga = $datalogin['akses_antar_lembaga'];
										$aksesdepartemen= $datalogin['akses_antar_departemen'];
										$iddepartemen= $datalogin['id_departemen'];
										$idlembaga = $datalogin['id_lembaga'];
										$id = $datalogin['idpengguna'];
										$data_session = array(
														'idpengguna' => $id,
														'usrname' => $username,
														'namauser' => $namauser,
														'idlembaga' => $idlembaga,
														'iddepartmen' => $iddepartemen,
														'level'=> $level,
														'status' => TRUE,
														'app' => $agent,
														'osuser' => $osuser,
														'ipuser' => $ipuser,
														'akseslembaga' => $akseslembaga,
														'aksesdepartemen' => $aksesdepartemen
														);
										$this->session->set_userdata($data_session);
										helper_log("login", "Login Berhasil");
										if ($role == 'admin') {
											redirect($url);
										} else {
											redirect($urluser);
										}

									}
									else
									{
							
										$this->session->set_flashdata('status_login', '<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert"><span class="fa fa-close"></span></button> Username Atau Password Salah</div>');

										helper_log("login", "Login Gagal");
										$url = base_url('all/login');
										redirect($url);
									}
									$this->session->set_flashdata('status_login', '<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert"><span class="fa fa-close"></span></button> Username Atau Password Salah</div>');

									$data_session = array(
													'usrname' => $username,
													'status' => FALSE,
													'app' => $agent,
													'osuser' => $osuser,
													'ipuser' => $ipuser);
									$this->session->set_userdata($data_session);
									//simpan log
									helper_log("login", "Login Gagal");
									$url = base_url('all/login');
									redirect($url);	
							}
						} 
						else
						{
							$this->session->set_flashdata('status_login', '<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert"><span class="fa fa-close"></span></button> Username Atau Password Salah</div>');
							helper_log("login", "Login Gagal");
							$url = base_url('all/login');
							redirect($url);
						}
					}
					else
					{
						$checking = $this->M_login->login_user($username, $password);
						//jika data ada
						if ($checking->num_rows() > 0) {

							$datalogin = $checking->row_array(); //admbil data user dari databas
							$namauser = $datalogin['nama_karyawan'];
							$pass = $datalogin['pass'];
							$pin = $datalogin['pin'];
							$id = $datalogin['id_karyawan'];

							if (password_verify($_POST['password'], $pass)) {
								$datalogin = $checking->row_array(); //admbil data user dari databas
								$namauser = $datalogin['nama_karyawan'];
								$akseslembaga = $datalogin['akses_antar_lembaga'];
								$aksesdepartemen = $datalogin['akses_antar_departemen'];
								$iddepartemen = $datalogin['id_departemen'];
								$idlembaga = $datalogin['id_lembaga'];
								$id = $datalogin['id'];
								$data_session = array(
									'idpengguna' => $id,
									'usrname' => $username,
									'namauser' => $namauser,
									'idlembaga' => $idlembaga,
									'iddepartmen' => $iddepartemen,
									'role' => $role,
									'status' => true,
									'app' => $agent,
									'osuser' => $osuser,
									'ipuser' => $ipuser,
									'ipuser' => $ipuser
								);
								$this->session->set_userdata($data_session);
								helper_log("login", "Login Berhasil");
								if ($role == 'admin') {
									redirect($url);
								} else {
									redirect($urluser);
								}

							} else {
								// login gagal
								if ($_POST['password'] == $pin) {
									$datalogin = $checking->row_array(); //admbil data user dari databas
									$namauser = $datalogin['nama_karyawan'];
									$iddepartemen = $datalogin['id_departemen'];
									$idlembaga = $datalogin['id_lembaga'];
									$id = $datalogin['id_karyawan'];
									$data_session = array(
										'idpengguna' => $id,
										'usrname' => $username,
										'namauser' => $namauser,
										'idlembaga' => $idlembaga,
										'iddepartmen' => $iddepartemen,
										'status' => true,
										'app' => $agent,
										'osuser' => $osuser,
										'ipuser' => $ipuser
									);
									$this->session->set_userdata($data_session);
									helper_log("login", "Login Berhasil");
									if ($role == 'admin') {
										redirect($url);
									} else {
										redirect($urluser);
									}

								} else {

									$this->session->set_flashdata('status_login', '<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert"><span class="fa fa-close"></span></button> Username Atau Password Salah</div>');

									helper_log("login", "Login Gagal");
									$url = base_url('all/login');
									redirect($url);
								}
								$this->session->set_flashdata('status_login', '<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert"><span class="fa fa-close"></span></button> Username Atau Password Salah</div>');

								$data_session = array(
									'usrname' => $username,
									'status' => false,
									'app' => $agent,
									'osuser' => $osuser,
									'ipuser' => $ipuser);
								$this->session->set_userdata($data_session);
								//simpan log
								helper_log("login", "Login Gagal");
								$url = base_url('all/login');
								redirect($url);
							}
						} else {
							$this->session->set_flashdata('status_login', '<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert"><span class="fa fa-close"></span></button> Username Atau Password Salah</div>');
							helper_log("login", "Login Gagal");
							$url = base_url('all/login');
							redirect($url);
						}


					}
					
          
        }

		//logout 
        function logout(){
		  $this->session->sess_destroy();
          $url = base_url('all/login');
		  redirect ($url);
		}

}
    
    
    



