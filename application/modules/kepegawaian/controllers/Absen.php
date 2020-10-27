<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Departemen extends MX_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('M_departemen');
		$this->load->model('M_combo');
  }

  public function index()
  {
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
		$data['datadepartemen'] = $this->M_departemen->tampil_departemen($idlembaga);
		$data['header'] = 'layout/header';
		$data['topbar'] = 'layout/topbar';
		$data['sidebar'] = 'layout/sidebar';
		$data['content'] = 'departemen/v_departemen';
		$data['js'] = 'layout/js';
		$data['jscontent'] = 'absenshift/jscontent';
		$data['footer'] = 'layout/footer';
		$this->load->view('layout/main', $data);
  }
 
 
   //tambah data
   public function tambah_departemen()
  {
	
	if($this->session->userdata('status') != TRUE)
	{
        redirect(base_url("all/login"));
	}
	
$this->form_validation->set_rules('namadepartemen','Nama Departemen','required|trim');

if ($this->form_validation->run() == TRUE){
	
	$idlembaga 			= $this->input->post('idlembaga');
	$namadepartemen		= $this->input->post('namadepartemen');
	$ketdepartemen		= $this->input->post('ketdepartemen');
	$kepaladepartemen	= $this->input->post('kepaladepartemen');
	$alamatdepartemen	= $this->input->post('alamatdepartemen');
	$notlp1				= $this->input->post('notlp1');
	$notlp2				= $this->input->post('notlp2');
	$nofax				= $this->input->post('nofax');
	$email				= $this->input->post('email');
	$website			= $this->input->post('website');
	$logo				= $this->input->post('logo');
	
	$config['upload_path'] = './storage/photo/lembaga/';
	$config['allowed_types'] = 'jpeg|gif|jpg|png';
	$config['overwrite'] = TRUE ;
	$config['encrypt_name'] =TRUE;
	//$config['file_name'] = "logo-".$iddepartemen ;
	$this->load->library('upload', $config);
	

	if (!empty($_FILES['logo']['name']))
	{
		if ($this->upload->do_upload('logo')){
			$gbr = $this->upload->data();
			//Compress Image
			$config['image_library']='gd2';
			$config['source_image']='./storage/photo/departemen/'.$gbr['file_name'];
			$config['create_thumb']= FALSE;
			$config['maintain_ratio']= FALSE;
			$config['quality']= '50%';
			$config['width']= 150;
			$config['height']=150;
			$config['new_image']= './storage/photo/departemen/'.$gbr['file_name'];
			$this->load->library('image_lib', $config);
			$this->image_lib->resize();
			$logo=$gbr['file_name'];
		}		
		else
		{
			echo $this->session->set_flashdata('msg','error');
			$url = base_url('all/departemen'.'?'.uniqid());
			redirect($url,'refresh');
		}	
	}
	
	$datadepartemen = array(
		'id_lembaga'			=> $idlembaga,
		'nama_departemen'		=> str_replace("'","`",$namadepartemen),                 
		'keterangan_departemen' => str_replace( "'","`",$ketdepartemen),                
		'kepala_departemen'     => $kepaladepartemen,                 
		'alamat_departemen'     => str_replace("'","`",$alamatdepartemen),                 
		'notlp_departemen'      => $notlp1,                 
		'notlp_departemen2'		=> $notlp2,                  
		'fax_departemen'        => $nofax,                 
		'email_departemen'      => $email,                 
		'web_departemen'        => $website,                 
		'icon_departemen'		=> $logo
	);

    $hasil = $this->M_departemen->tambah_departemen($datadepartemen);
	
    if($hasil==TRUE){
		echo $this->session->set_flashdata('msg','success');
    }else{
		echo $this->session->set_flashdata('msg','error');
    }
	  $url = base_url('all/departemen'.'?'.uniqid());
	  redirect($url,'refresh');
	}
	else
	{
			

	}

}
  
   //ubah data  
   public function ubah_departemen()
  {
  
	if($this->session->userdata('status') != TRUE){
        redirect(base_url("all/login"));
	}
	
	$idlembaga 			= $this->input->post('idlembaga');
	$iddepartemen		= $this->input->post('iddepartemen');
	$namadepartemen 	= $this->input->post('namadepartemen');
	$namalembaga		= $this->input->post('namalembaga');
	$ketdepartemen		= $this->input->post('ketdepartemen');
	$kepaladepartemen	= $this->input->post('kepaladepartemen');
	$alamatdepartemen	= $this->input->post('alamatdepartemen');
	$notlp1				= $this->input->post('notlp1');
	$notlp2				= $this->input->post('notlp2');
	$nofax				= $this->input->post('nofax');
	$email				= $this->input->post('email');
	$website			= $this->input->post('website');
	$logo				= $this->input->post('logo');
	
	$config['upload_path'] = './storage/photo/departemen/';
	$config['allowed_types'] = 'jpeg|gif|jpg|png';
	$config['overwrite'] = TRUE ;
	$config['encrypt_name'] =TRUE;
	$this->load->library('upload', $config);
	
	

	if (!empty($_FILES['logo']['name']))
	{
		if ($this->upload->do_upload('logo')){
			$gbr = $this->upload->data();
			//Compress Image
			$config['image_library']='gd2';
			$config['source_image']='./storage/photo/departemen/'.$gbr['file_name'];
			$config['create_thumb']= FALSE;
			$config['maintain_ratio']= FALSE;
			$config['quality']= '50%';
			$config['width']= 150;
			$config['height']=150;
			$config['new_image']= './storage/photo/departemen/'.$gbr['file_name'];
			$this->load->library('image_lib', $config);
			$this->image_lib->resize();
			$logo=$gbr['file_name'];
		}		
		else
		{
			echo $this->session->set_flashdata('msg','error');
			$url = base_url('all/departemen'.'?'.uniqid());
			redirect($url,'refresh');
		}	
	}
	
	$datadepartemen = array(
		'nama_departemen'		=> str_replace("'","`",$namadepartemen),                 
		'keterangan_departemen' => str_replace("'","`",$namadepartemen),               
		'kepala_departemen'     => $kepaladepartemen,                 
		'alamat_departemen'     => str_replace("'","`",$namadepartemen),                 
		'notlp_departemen'      => $notlp1,                 
		'notlp_departemen2'		=> $notlp2,                  
		'fax_departemen'        => $nofax,                 
		'email_departemen'      => $email,                 
		'web_departemen'        => $website,                 
		'icon_departemen'		=> $logo
	);

    $hasil = $this->M_departemen->ubah_departemen($iddepartemen,$datadepartemen);
	
    if($hasil==TRUE){
		echo $this->session->set_flashdata('msg','success');
    }else{
		echo $this->session->set_flashdata('msg','error');
    }
	  $url = base_url('all/departemen'.'?'.uniqid());
	  redirect($url,'refresh');
} 
	  
	public function hapus_departemen()
  {
  
	if($this->session->userdata('status') != TRUE){
        redirect(base_url("all/login"));
	}
	
    $id				=	$this->input->post('iddepartemen');
	$icondepartemen	=	$this->input->post('icondepartemen');
	 
    $hasil = $this->M_departemen->hapus_departemen($id);

    if($hasil==TRUE){
	  unlink('./storage/photo/lembaga/'.$icondepartemen);	
      echo $this->session->set_flashdata('msg','success');
    }else{
      echo $this->session->set_flashdata('msg','error');
    }
     $url = base_url('all/departemen'.'?'.uniqid());
			redirect($url,'refresh');
  }
	
}
  
	

