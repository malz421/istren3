<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menuakses extends MX_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('M_pengguna');
    $this->load->model('M_combo');
  }

  public function index()
  {
		if($this->session->userdata('status') != TRUE){
      redirect(base_url("all/login"));
		}
		$data['comboakses'] = $this->M_combo->combohakakses();
		$data['header'] = 'layout/header';
		$data['topbar'] = 'layout/topbar';
		$data['sidebar'] = 'layout/sidebar';
		$data['content'] = 'menuakses/v_menuakses';
	  $data['js'] = 'layout/js';
		$data['jscontent'] = 'menuakses/jscontent';
		$data['footer'] = 'layout/footer';
		$this->load->view('layout/main', $data);
  }

   //tambah data
   public function tambah_menu()
   {
    if($this->session->userdata('status') != TRUE){
          redirect(base_url("all/login"));
    }
    $namamenu=$this->input->post('namamenu');
    $idparent=$this->input->post('idparent');
    $urlmenu=$this->input->post('urlmenu');
    $icon=$this->input->post('icon');

	  $datamenu = array(
                        'parent_id' => $idparent,
                        'nama_menu' => $namamenu,
                        'url' => $urlmenu,
                        'icon'=> $icon
    );
    
    $hasil = $this->M_pengguna->tambah_menu($datamenu);
    if($hasil==TRUE){
		  echo $this->session->set_flashdata('msg','success');
    }else{
		  echo $this->session->set_flashdata('msg','error');
    }
      $url = base_url('all/menu'.'?'.uniqid());
    redirect($url,'refresh');
    }
  
  
   //ubah data  
  public function ubah_menu(){
    if($this->session->userdata('status') != TRUE){
                  redirect(base_url("all/login"));
    }
    $idmenu=$this->input->post('idmenu');
    $namamenu=$this->input->post('namamenu');
    $idparent=$this->input->post('idparent');
    $urlmenu=$this->input->post('urlmenu');
    $icon=$this->input->post('icon');
    
    $datamenu = array(
                        'parent_id' => $idparent,
                        'nama_menu' => $namamenu,
                        'url' => $urlmenu,
                        'icon'=> $icon
    );
      $hasil = $this->M_pengguna->ubah_menu($idmenu,$datamenu);
      if($hasil==TRUE){
        echo $this->session->set_flashdata('msg','success');
      }else{
        echo $this->session->set_flashdata('msg','error');
      }
        $url = base_url('all/menu'.'?'.uniqid());
        redirect($url,'refresh');
  }
  

     //hapus data  
	public function hapus_menu(){
    if($this->session->userdata('status') != TRUE){
          redirect(base_url("all/login"));
    }
    
      $idmenu=$this->input->post('idmenu');
      $hasil = $this->M_pengguna->hapus_menu($idmenu);
      if($hasil==TRUE){
        echo $this->session->set_flashdata('msg','success');
      }else{
        echo $this->session->set_flashdata('msg','error');
      }
        $url = base_url('all/menu'.'?'.uniqid());
        redirect($url,'refresh');
  }


  function data_hak_akses(){  
         
        $idrole= $this->input->post('idrole');

        
        $fetch_data = $this->M_pengguna->make_datatables($idrole); 
        $data = array();  
        foreach($fetch_data as $row)  
        {  
            $onclick_tampil = 'cgHakAkses("'.trim($row->id).'","'.trim($row->id_menu).'","'.trim($row->parent_id).'","'.$idrole.'","tampil")';
            $onclick_tambah = 'cgHakMenu("'.trim($row->id_menu).'","'.$idrole.'","tambah")';
            $onclick_ubah   = 'cgHakMenu("'.trim($row->id_menu).'","'.$idrole.'","ubah")';
            $onclick_hapus  = 'cgHakMenu("'.trim($row->id_menu).'","'.$idrole.'","hapus")';

            if ($row->tampil== 1) { 
              $haktampil = "checked='checked'";
              $distambah  = "";
              $disubah = "";
              $dishapus = "";
            }
            else{
              $haktampil = "";
              $distambah = "disabled='disabled'";
              $disubah = "disabled='disabled'";
              $dishapus = "disabled='disabled'";
            } 
              
            if ($row->tambah== 1) { 
              $haktambah = "checked='checked'";
            }
            else{
              $haktambah = "";
            } 
            
            if ($row->ubah== 1){ 
              $hakubah = "checked='checked'";
            }
            else{
              $hakubah = "";
            }  
              
            if ($row->hapus== 1){ 
              $hakhapus = "checked='checked'";
            }
            else{
              $hakhapus = "";
            }     
              
            $sub_array = array();  
             //$sub_array[] = '<img src="'.base_url().'upload/'.$row->image.'" class="img-thumbnail" width="50" height="35" />';  
             $sub_array[] ='<input type="checkbox"  data-kode="'.$row->id_menu.'"  id="'.$row->id_menu.'" '.$haktampil.' onclick='.$onclick_tampil.' name="tampil['.$row->id.']" value="'.$row->tampil.'">'; 
             $sub_array[] = $row->parent_menu;
             $sub_array[] = $row->nama_menu;  
             $sub_array[] ='<input type="checkbox"   id="'.$row->id_menu.'_tambah" onclick='.$onclick_tambah.' '.$haktambah.'  '.$distambah.' name="tambah['.$row->id_menu.']" value="'.$row->tambah.'">';
             $sub_array[] ='<input type="checkbox"   id="'.$row->id_menu.'_ubah" onclick='.$onclick_ubah.' '.$hakubah.' '.$disubah.' name="ubah['.$row->id_menu.']"  value="'.$row->ubah.'">';
             $sub_array[] ='<input type="checkbox"   id="'.$row->id_menu.'_hapus"  onclick='.$onclick_hapus.' '.$hakhapus.'  '.$dishapus.' name="hapus['.$row->id_menu.']"  value="'.$row->hapus.'">';
             /*$sub_array[] = '<a href="'.base_url().'psbalmatuq/atur/pendaftaran/bagiruangall/yes/'.$row->nik.'" data-toggle="tooltip	"title="Pindah Ruang" onclick="return confirm("Anda yakin ingin Pindah Ruang data ini?");">
                     <button class="btn btn-xs btn-info">
                       <i class="fa fa-check"></i>Pindah
                     </button>
                   </a>'; */
             $data[] = $sub_array;  
     
     
        }  
    
        $output = array(  
             "draw"                    =>     intval($_POST["draw"]),  
             "data"                    =>     $data
        );  
        echo json_encode($output);  
      }


 public function changeHakAkses()
	{

    $id = $this->input->post('idakses');
    $idmenu = $this->input->post('idmenu');
    $parentid = $this->input->post('idparent');
    $idrole = $this->input->post('idrole');
		$hak 		= $this->input->post('hak');
   
    $data = array(
      'id_menu' =>  $idmenu,
      'id_role' =>  $idrole
    );

    $result= $this->db->get_where('menu_akses',$data);

    if($result->num_rows() < 1){
      
      $datasimpan = array(
        'id_menu' =>  $idmenu,
        'parent_id' => $parentid,
        'id_role' =>  $idrole
      );
      $this->db->insert('menu_akses',$datasimpan);
    }
    else
    {
      $this->db->delete('menu_akses',$data);
    }
    
	}


public function updateHakMenu()
	{

    $idmenu = $this->input->post('idmenu');
    $idrole = $this->input->post('idrole');
		$hak 		= $this->input->post('hak');

    $db_hak = $this->M_pengguna->getHak($idmenu,$idrole);

		  if($hak == 'tambah')
			{
				if($db_hak[0]->flag_tambah == 1)
				{
					$ubah1 = array(
						'flag_tambah' => 0
          );
          $this->db->where('id_menu',$idmenu);
          $this->db->where('id_role',$idrole);
          $this->db->update('menu_akses',$ubah1);
				}
				else
				{
					$ubah2 = array(
						'flag_tambah' => 1
					);
          $this->db->where('id_menu',$idmenu);
          $this->db->where('id_role',$idrole);
          $this->db->update('menu_akses',$ubah2);
				}
      }
      elseif ($hak == 'ubah')
			{
				if($db_hak[0]->flag_ubah == 1)
				{
					$ubah1 = array(
						'flag_ubah' => 0
          );
          $this->db->where('id_menu',$idmenu);
          $this->db->where('id_role',$idrole);
          $this->db->update('menu_akses',$ubah1);
				}
				else
				{
					$ubah2 = array(
						'flag_ubah' => 1
					);
          $this->db->where('id_menu',$idmenu);
          $this->db->where('id_role',$idrole);
          $this->db->update('menu_akses',$ubah2);
				}
      }
      elseif ($hak == 'hapus')
			{
				if($db_hak[0]->flag_hapus == 1)
				{
					$ubah1 = array(
						'flag_hapus' => 0
          );
          $this->db->where('id_menu',$idmenu);
          $this->db->where('id_role',$idrole);
          $this->db->update('menu_akses',$ubah1);
				}
				else
				{
					$ubah2 = array(
						'flag_hapus' => 1
					);
          $this->db->where('id_menu',$idmenu);
          $this->db->where('id_role',$idrole);
          $this->db->update('menu_akses',$ubah2);
				}
      }
		}

}

